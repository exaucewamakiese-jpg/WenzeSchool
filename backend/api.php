<?php
// Point d'entrée JSON : authentification et gestion des fiches de l'établissement.
require_once __DIR__ . '/bootstrap.php';
$action = $_GET['action'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
try {
    if ($action === 'login' && $method === 'POST') {
        $data = requestData();
        $stmt = $pdo->prepare('SELECT id, school_id, name, email, password_hash, role FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([strtolower(trim($data['email'] ?? ''))]);
        $user = $stmt->fetch();
        if (!$user || !password_verify($data['password'] ?? '', $user['password_hash'])) respond(['error' => 'Adresse e-mail ou mot de passe incorrect.'], 401);
        session_regenerate_id(true); unset($user['password_hash']); $_SESSION['user'] = $user; $_SESSION['csrf'] = bin2hex(random_bytes(32));
        respond(['user' => $user, 'csrf' => $_SESSION['csrf']]);
    }
    if ($action === 'logout' && $method === 'POST') { requireUser(); $_SESSION = []; session_destroy(); respond(['ok' => true]); }
    if ($action === 'me' && $method === 'GET') { $user = requireUser(false); respond(['user' => $user, 'csrf' => $_SESSION['csrf'] ?? '']); }
    $user = requireUser();
    if ($action === 'records') {
        $model = modelFor($_GET['type'] ?? '');
        if ($method === 'GET') respond(['records' => $model->all((int)$user['school_id'])]);
        $data = requestData();
        if ($method === 'POST') respond(['record' => $model->save((int)$user['school_id'], $data)]);
        if ($method === 'PUT') respond(['record' => $model->save((int)$user['school_id'], $data, (int)($data['id'] ?? 0))]);
        if ($method === 'DELETE') { $model->delete((int)$user['school_id'], (int)($_GET['id'] ?? 0)); respond(['ok' => true]); }
        respond(['error' => 'Méthode non autorisée.'], 405);
    }
    if ($action === 'sync' && $method === 'POST') {
        $data = requestData(); $results = [];
        foreach (($data['operations'] ?? []) as $operation) {
            try {
                $type = $operation['type'] ?? ''; $model = modelFor($type); $key = (string)($operation['offline_key'] ?? '');
                if (($operation['action'] ?? '') === 'delete') {
                    $id = $key ? $model->findByOfflineKey((int)$user['school_id'], $key) : (int)($operation['id'] ?? 0);
                    if ($id) $model->delete((int)$user['school_id'], $id);
                    $results[] = ['key' => $key, 'ok' => true];
                } else {
                    $record = $model->save((int)$user['school_id'], $operation['data'] ?? [], null);
                    $results[] = ['key' => $key, 'ok' => true, 'id' => $record['id']];
                }
            } catch (Throwable $error) { $results[] = ['key' => $operation['offline_key'] ?? '', 'ok' => false, 'error' => $error->getMessage()]; }
        }
        respond(['results' => $results]);
    }
    respond(['error' => 'Action inconnue.'], 404);
} catch (InvalidArgumentException $error) { respond(['error' => $error->getMessage()], 422); }
catch (Throwable $error) { error_log($error); respond(['error' => 'Une erreur est survenue. Vérifiez les données et réessayez.'], 500); }
