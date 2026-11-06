<?php
// Démarre la session et charge les composants communs de l'API.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params(['httponly' => true, 'secure' => !empty($_SERVER['HTTPS']), 'samesite' => 'Lax']);
    session_start();
}
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Entity.php';
require_once __DIR__ . '/Models.php';

// Lit les données JSON envoyées par le navigateur.
function requestData(): array {
    $raw = file_get_contents('php://input');
    return $raw ? (json_decode($raw, true) ?: []) : $_POST;
}

// Renvoie une réponse JSON homogène puis termine la requête.
function respond(array $data, int $status = 200): never {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}

// Vérifie la session, l'établissement associé et le jeton anti-CSRF.
function requireUser(bool $checkCsrf = true): array {
    $user = $_SESSION['user'] ?? null;
    if (!$user) respond(['error' => 'Connexion requise.'], 401);
    if ($checkCsrf && !in_array($_SERVER['REQUEST_METHOD'], ['GET', 'HEAD', 'OPTIONS'], true)) {
        $token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        if (!$token || !hash_equals($_SESSION['csrf'] ?? '', $token)) respond(['error' => 'Jeton de sécurité invalide.'], 403);
    }
    return $user;
}

// Définit les modèles autorisés : aucune table ne vient directement du navigateur.
function modelFor(string $name): Entity {
    $models = [
        'students' => Student::class, 'teachers' => Teacher::class, 'classes' => SchoolClass::class,
        'parents' => ParentRecord::class, 'courses' => Course::class, 'payments' => Payment::class,
        'grades' => Grade::class, 'publications' => Publication::class, 'enrollments' => Enrollment::class,
    ];
    if (!isset($models[$name])) throw new InvalidArgumentException('Rubrique inconnue.');
    return new $models[$name]($GLOBALS['pdo']);
}
