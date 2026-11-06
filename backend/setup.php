<?php
// Crée le premier établissement et son compte administrateur après installation.
require_once __DIR__ . '/../config/database.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $school = trim($_POST['school'] ?? ''); $name = trim($_POST['name'] ?? '');
        $email = strtolower(trim($_POST['email'] ?? '')); $password = $_POST['password'] ?? '';
        if (!$school || !$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 10) throw new RuntimeException('Complétez tous les champs et choisissez un mot de passe de 10 caractères minimum.');
        $pdo->beginTransaction();
        $stmt = $pdo->prepare('INSERT INTO schools (name) VALUES (?)'); $stmt->execute([$school]); $schoolId = (int)$pdo->lastInsertId();
        $stmt = $pdo->prepare('INSERT INTO users (school_id,name,email,password_hash,role) VALUES (?,?,?,?,?)');
        $stmt->execute([$schoolId,$name,$email,password_hash($password,PASSWORD_DEFAULT),'admin']);
        $pdo->commit(); $message = 'Installation terminée. Supprimez ou protégez backend/setup.php, puis connectez-vous.';
    } catch (Throwable $error) { if ($pdo->inTransaction()) $pdo->rollBack(); $message = 'Installation impossible : vérifiez les données et le schéma SQL.'; }
}
?>
<!doctype html><html lang="fr"><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Installation WenzeSchool</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><body class="bg-light"><main class="container py-5" style="max-width:560px"><section class="card border-0 shadow-sm p-4"><h1 class="h3">Installation de WenzeSchool</h1><p>Créez le premier établissement et son administrateur.</p><?php if ($message): ?><div class="alert alert-info"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div><?php endif ?><form method="post"><label class="form-label">Nom de l'établissement</label><input class="form-control mb-3" name="school" required><label class="form-label">Nom de l'administrateur</label><input class="form-control mb-3" name="name" required><label class="form-label">E-mail</label><input class="form-control mb-3" type="email" name="email" required><label class="form-label">Mot de passe (10 caractères minimum)</label><input class="form-control mb-3" type="password" name="password" minlength="10" required><button class="btn btn-primary w-100">Créer mon établissement</button></form><a class="d-block mt-3" href="../">Retour à la connexion</a></section></main></body></html>
