<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#183b67">
  <title>WenzeSchool — Portail de gestion</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    :root{--navy:#183b67;--blue:#2864c5;--pale:#f4f7fb;--ink:#172b4d;--muted:#75839a;--line:#e8edf4}
    *{box-sizing:border-box}body{margin:0;background:var(--pale);color:var(--ink);font-family:Inter,system-ui,-apple-system,"Segoe UI",sans-serif}
    .layout{min-height:100vh;display:grid;grid-template-columns:250px minmax(0,1fr)}.sidebar{background:#fff;border-right:1px solid var(--line);padding:26px 18px;display:flex;flex-direction:column}.brand{display:flex;align-items:center;gap:11px;color:var(--navy);font-size:20px;font-weight:800;text-decoration:none;padding:0 10px 32px}.brand-mark{width:39px;height:39px;border-radius:13px;background:var(--navy);color:#fff;display:grid;place-items:center;font-size:21px}.side-label{font-size:11px;letter-spacing:.13em;color:var(--muted);font-weight:700;padding:10px}.side-link{display:flex;align-items:center;gap:12px;padding:11px 12px;color:#52647e;text-decoration:none;border-radius:10px;font-size:14px;margin:2px 0}.side-link:hover,.side-link.active{background:#edf4ff;color:var(--blue)}.side-icon{width:22px;text-align:center;font-size:17px}.side-note{margin-top:auto;color:var(--muted);font-size:12px;padding:14px 10px 0;line-height:1.6}
    .main{min-width:0}.topbar{height:74px;padding:0 34px;background:#fff;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between}.crumb{font-size:13px;color:var(--muted)}.user{display:flex;align-items:center;gap:10px;font-size:13px;font-weight:650}.avatar{width:35px;height:35px;border-radius:50%;display:grid;place-items:center;background:#e8f0ff;color:var(--blue);font-weight:800}.content{max-width:1220px;margin:auto;padding:34px}.welcome{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:26px}.eyebrow{font-size:11px;letter-spacing:.13em;text-transform:uppercase;color:var(--blue);font-weight:800}.welcome h1{font-size:29px;font-weight:800;margin:7px 0}.welcome p{color:var(--muted);margin:0}.search{max-width:290px;min-width:210px;border:1px solid var(--line);border-radius:11px;background:#fff;padding:11px 14px;outline:none}.search:focus{border-color:#9bb8ee;box-shadow:0 0 0 3px #2864c51a}
    .summary{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:15px;margin-bottom:29px}.summary-card,.module{background:#fff;border:1px solid var(--line);border-radius:15px}.summary-card{padding:18px;display:flex;align-items:center;gap:14px}.summary-icon{width:43px;height:43px;border-radius:13px;background:#edf4ff;color:var(--blue);display:grid;place-items:center;font-size:20px}.summary-card strong{display:block;font-size:14px}.summary-card span{font-size:12px;color:var(--muted)}.section-title{display:flex;align-items:center;justify-content:space-between;margin:0 0 14px}.section-title h2{font-size:17px;font-weight:800;margin:0}.section-title span{font-size:12px;color:var(--muted)}.modules{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:15px}.module{padding:19px;display:flex;gap:14px;min-height:135px;text-decoration:none;color:inherit;transition:transform .15s,box-shadow .15s,border-color .15s}.module:hover{transform:translateY(-2px);box-shadow:0 10px 24px #172b4d0d;border-color:#cddbf3;color:inherit}.module-icon{width:43px;height:43px;flex:0 0 43px;border-radius:13px;background:#f0f5fc;color:var(--navy);display:grid;place-items:center;font-size:20px}.module h3{font-size:14px;font-weight:800;margin:2px 0 7px}.module p{font-size:12px;line-height:1.55;color:var(--muted);margin:0 0 10px}.go{font-size:12px;color:var(--blue);font-weight:750}.empty{display:none;color:var(--muted);padding:22px;background:#fff;border:1px solid var(--line);border-radius:12px}.foot{color:var(--muted);font-size:12px;text-align:center;padding:30px 0 12px}
    @media(max-width:1000px){.summary{grid-template-columns:repeat(2,1fr)}.modules{grid-template-columns:repeat(2,minmax(0,1fr))}.layout{grid-template-columns:215px minmax(0,1fr)}}
    @media(max-width:700px){.layout{display:block}.sidebar{display:none}.topbar{height:62px;padding:0 18px}.content{padding:25px 17px}.welcome{display:block}.search{width:100%;max-width:none;margin-top:18px}.modules{grid-template-columns:1fr}.summary{gap:9px}.summary-card{padding:13px;gap:10px}.summary-icon{width:36px;height:36px;flex-basis:36px}.summary-card strong{font-size:12px}.summary-card span{font-size:11px}.welcome h1{font-size:25px}}
  </style>
</head>
<body>
  <div class="layout">
    <aside class="sidebar" aria-label="Navigation du portail">
      <a class="brand" href="#accueil"><span class="brand-mark">W</span><span>Wenze<span style="font-weight:500">School</span></span></a>
      <div class="side-label">ESPACE DE GESTION</div>
      <a class="side-link active" href="#accueil"><span class="side-icon">⌂</span>Accueil</a>
      <a class="side-link" href="../index.php#dashboard"><span class="side-icon">▦</span>Tableau de bord</a>
      <div class="side-label" style="margin-top:20px">RACCOURCIS</div>
      <a class="side-link" href="../index.php#students"><span class="side-icon">♙</span>Apprenants</a>
      <a class="side-link" href="../index.php#teachers"><span class="side-icon">♧</span>Enseignants</a>
      <a class="side-link" href="../index.php#classes"><span class="side-icon">▤</span>Classes</a>
      <div class="side-note">Portail WenzeSchool<br>Gestion scolaire simple et centralisée.</div>
    </aside>
    <main class="main" id="accueil">
      <header class="topbar"><div class="crumb">WenzeSchool <span aria-hidden="true">/</span> Portail</div><div class="user"><span class="avatar">W</span><span>Accès à la gestion</span></div></header>
      <div class="content">
        <section class="welcome"><div><div class="eyebrow">Votre établissement, en un seul endroit</div><h1>Bienvenue sur WenzeSchool</h1><p>Choisissez un espace pour gérer les activités de votre établissement.</p></div><input id="moduleSearch" class="search" type="search" placeholder="Rechercher un espace…" aria-label="Rechercher un espace"></section>
        <section class="summary" aria-label="Espaces disponibles">
          <a class="summary-card text-decoration-none text-reset" href="../index.php#students"><span class="summary-icon">♙</span><span><strong>Vie scolaire</strong><span>Élèves et inscriptions</span></span></a>
          <a class="summary-card text-decoration-none text-reset" href="../index.php#courses"><span class="summary-icon">▤</span><span><strong>Enseignement</strong><span>Équipe et cours</span></span></a>
          <a class="summary-card text-decoration-none text-reset" href="../index.php#payments"><span class="summary-icon">＄</span><span><strong>Finances</strong><span>Suivi des paiements</span></span></a>
          <a class="summary-card text-decoration-none text-reset" href="../index.php#publications"><span class="summary-icon">▣</span><span><strong>Communication</strong><span>Publications de l’école</span></span></a>
        </section>
        <div class="section-title"><h2>Espaces de gestion</h2><span>Accès rapide aux interfaces</span></div>
        <section class="modules" id="modules">
          <a class="module" data-search="administration tableau de bord gestion accueil" href="../index.php#dashboard"><span class="module-icon">⌂</span><span><h3>Administration</h3><p>Accédez au tableau de bord et à la vue d’ensemble de votre établissement.</p><span class="go">Ouvrir l’espace →</span></span></a>
          <a class="module" data-search="élève eleve apprenant étudiant étudiant" href="../index.php#students"><span class="module-icon">♙</span><span><h3>Élèves / Apprenants</h3><p>Consultez et gérez les dossiers des apprenants.</p><span class="go">Gérer les apprenants →</span></span></a>
          <a class="module" data-search="inscription réinscription admission" href="../index.php#enrollments"><span class="module-icon">✚</span><span><h3>Inscriptions</h3><p>Suivez les admissions et les inscriptions par année scolaire.</p><span class="go">Gérer les inscriptions →</span></span></a>
          <a class="module" data-search="enseignant professeur personnel équipe" href="../index.php#teachers"><span class="module-icon">♧</span><span><h3>Enseignants</h3><p>Gérez les profils et les matières de l’équipe pédagogique.</p><span class="go">Gérer les enseignants →</span></span></a>
          <a class="module" data-search="classe niveau salle année scolaire" href="../index.php#classes"><span class="module-icon">▦</span><span><h3>Classes</h3><p>Organisez les classes, niveaux et salles de cours.</p><span class="go">Gérer les classes →</span></span></a>
          <a class="module" data-search="cours matière enseignement" href="../index.php#courses"><span class="module-icon">▤</span><span><h3>Cours</h3><p>Retrouvez les cours, leurs classes et leurs enseignants.</p><span class="go">Gérer les cours →</span></span></a>
          <a class="module" data-search="notes résultats évaluation bulletin" href="../index.php#grades"><span class="module-icon">★</span><span><h3>Notes & résultats</h3><p>Consultez les évaluations et résultats des apprenants.</p><span class="go">Gérer les résultats →</span></span></a>
          <a class="module" data-search="paiement frais finance reçu" href="../index.php#payments"><span class="module-icon">＄</span><span><h3>Paiements</h3><p>Suivez les frais scolaires et les paiements enregistrés.</p><span class="go">Gérer les paiements →</span></span></a>
          <a class="module" data-search="publication annonce actualité communication" href="../index.php#publications"><span class="module-icon">▣</span><span><h3>Publications</h3><p>Publiez les actualités et communiqués de l’établissement.</p><span class="go">Gérer les publications →</span></span></a>
          <a class="module" data-search="parent famille contact" href="../index.php#parents"><span class="module-icon">♡</span><span><h3>Parents</h3><p>Centralisez les coordonnées des parents et responsables.</p><span class="go">Gérer les parents →</span></span></a>
        </section>
        <div id="emptyState" class="empty">Aucun espace ne correspond à cette recherche.</div>
        <footer class="foot">WenzeSchool · Portail de gestion scolaire</footer>
      </div>
    </main>
  </div>
  <script>
    const search = document.getElementById('moduleSearch');
    const cards = [...document.querySelectorAll('.module')];
    const empty = document.getElementById('emptyState');
    search.addEventListener('input', () => {
      const query = search.value.trim().toLocaleLowerCase('fr');
      let visible = 0;
      cards.forEach(card => {
        const match = `${card.dataset.search} ${card.innerText}`.toLocaleLowerCase('fr').includes(query);
        card.hidden = !match;
        if (match) visible++;
      });
      empty.style.display = visible ? 'none' : 'block';
    });
  </script>
</body>
</html>
