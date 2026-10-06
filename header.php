<?php
$pageTitle = $pageTitle ?? 'COVID-19 Information Portal';
$activePage = $activePage ?? '';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="A student project sharing general COVID-19 prevention and public-health information.">
  <title><?= e($pageTitle) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script defer src="assets/js/app.js"></script>
</head>
<body>
<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="index.php" aria-label="VitaSafe home"><span class="brand-mark">+</span><span>Vita<span class="brand-accent">Safe</span><small>PUBLIC HEALTH PORTAL</small></span></a>
    <button class="menu-toggle" aria-label="Toggle navigation" aria-expanded="false">☰</button>
    <nav class="nav-links" aria-label="Main navigation">
      <a class="<?= $activePage==='home'?'active':'' ?>" href="index.php">Home</a>
      <a class="<?= $activePage==='info'?'active':'' ?>" href="information.php">COVID-19 Info</a>
      <a class="<?= $activePage==='comments'?'active':'' ?>" href="comments.php">Community</a>
      <?php if (is_logged_in()): ?>
        <span class="nav-user">Hi, <?= e($_SESSION['user_name'] ?? 'Member') ?></span>
        <a class="nav-cta" href="logout.php">Log out</a>
      <?php else: ?>
        <a href="login.php">Log in</a><a class="nav-cta" href="register.php">Create account</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
<main>
