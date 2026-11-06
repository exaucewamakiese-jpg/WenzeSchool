<!doctype html>
<html lang="fr">
<head>
  <!-- Métadonnées essentielles et styles Bootstrap pour une interface adaptable. -->
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#183b67"><title>WenzeSchool — Gestion scolaire</title>
  <link rel="manifest" href="manifest.json"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="frontend/assets/style.css">
</head>
<body>
  <!-- Connexion : le premier compte est créé depuis backend/setup.php. -->
  <main id="loginView" class="login-page d-none"><div class="login-card"><div class="brand-mark">W</div><p class="eyebrow">ESPACE DE GESTION SCOLAIRE</p><h1>Bienvenue à WenzeSchool</h1><p class="text-secondary mb-4">Connectez-vous pour gérer votre établissement.</p><form id="loginForm"><label class="form-label" for="email">Adresse e-mail</label><input class="form-control mb-3" id="email" type="email" required autocomplete="username"><label class="form-label" for="password">Mot de passe</label><input class="form-control mb-3" id="password" type="password" required autocomplete="current-password"><div id="loginError" class="alert alert-danger d-none"></div><button class="btn btn-primary w-100 py-2">Se connecter</button></form><small class="d-block text-secondary mt-4">Première visite ? <a href="backend/setup.php">Configurer un établissement</a></small></div></main>
  <!-- Application principale : la navigation et les tableaux sont générés par JavaScript. -->
  <div id="appView" class="d-none"><aside class="sidebar" id="sidebar"><a class="brand" href="#dashboard"><span class="brand-mark">W</span><span>Wenze<span class="brand-light">School</span></span></a><div class="school-label">VOTRE ÉTABLISSEMENT</div><nav id="navigation" class="nav flex-column"></nav><div class="sidebar-bottom"><span class="avatar" id="userAvatar">W</span><span class="user-info"><b id="userName">Utilisateur</b><small id="userRole">Administrateur</small></span><button class="btn btn-sm btn-outline-light ms-auto" id="logoutBtn" title="Déconnexion">↗</button></div></aside>
    <main class="main-area"><header class="topbar"><button class="btn btn-light d-lg-none" id="menuToggle" aria-label="Ouvrir le menu">☰</button><div><div class="eyebrow">ESPACE ADMINISTRATEUR</div><h1 id="pageTitle">Tableau de bord</h1></div><div class="connection-pill" id="connectionStatus"><span class="status-dot"></span><span>Connexion vérifiée</span></div></header><div class="container-fluid content-area"><div id="alertBox" class="alert d-none" role="alert"></div><section id="pageContent"></section></div></main>
  </div>
  <!-- Bibliothèques demandées et logique de l'application. -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><script src="frontend/assets/app.js"></script>
</body>
</html>
