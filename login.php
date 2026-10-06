<?php
require_once 'config.php';
if (is_logged_in()) { header('Location: index.php'); exit; }
$pageTitle = 'Log in | VitaSafe';
$activePage = '';
$error = '';
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = strtolower(trim((string)($_POST['email'] ?? '')));
    $password = (string)($_POST['password'] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Enter a valid email and password.';
    } else {
        $stmt = $pdo->prepare('SELECT id, name, password_hash FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: index.php');
            exit;
        }
        $error = 'Email or password is incorrect.';
    }
}
require 'partials/header.php';
?>
<section class="auth-section login-auth"><div class="auth-art"><div class="auth-art-content"><span class="eyebrow">WELCOME BACK</span><h2>Stay curious.<br>Stay informed.</h2><p>Your space for learning and respectful community discussion.</p><div class="art-orbit">+</div></div></div><div class="auth-panel"><div class="auth-form-wrap"><div class="eyebrow dark-eyebrow">MEMBER ACCESS</div><h1>Welcome back</h1><p class="form-subtitle">New to VitaSafe? <a href="register.php">Create an account</a></p>
<?php if ($error): ?><div class="alert error" role="alert"><?= e($error) ?></div><?php endif; ?>
<form method="post" class="form-stack">
<input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<label for="email">Email address</label><input id="email" name="email" type="email" value="<?= e($email) ?>" autocomplete="email" required maxlength="254" placeholder="you@example.com">
<label for="password">Password</label><input id="password" name="password" type="password" autocomplete="current-password" required>
<button class="btn btn-primary btn-full" type="submit">Log in <span>→</span></button>
</form></div></div></section>
<?php require 'partials/footer.php'; ?>
