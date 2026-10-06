<?php
require_once 'config.php';
if (is_logged_in()) { header('Location: index.php'); exit; }
$pageTitle = 'Create account | VitaSafe';
$activePage = '';
$errors = [];
$name = $email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim((string)($_POST['name'] ?? ''));
    $email = strtolower(trim((string)($_POST['email'] ?? '')));
    $password = (string)($_POST['password'] ?? '');
    $confirm = (string)($_POST['confirm_password'] ?? '');

    // Regex test targets: name, email, password length/complexity.
    if (!preg_match("/^[\p{L}][\p{L} .'-]{1,49}$/u", $name)) $errors[] = 'Name must be 2–50 characters and contain letters, spaces, apostrophes, dots, or hyphens.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254) $errors[] = 'Enter a valid email address.';
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,72}$/', $password)) $errors[] = 'Password must be 8–72 characters with uppercase, lowercase, number, and special character.';
    if ($password !== $confirm) $errors[] = 'Passwords do not match.';

    if (!$errors) {
        $check = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $check->execute([$email]);
        if ($check->fetch()) {
            $errors[] = 'An account with this email already exists.';
        } else {
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)');
            $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int)$pdo->lastInsertId();
            $_SESSION['user_name'] = $name;
            header('Location: index.php?welcome=1');
            exit;
        }
    }
}
require 'partials/header.php';
?>
<section class="auth-section"><div class="auth-art"><div class="auth-art-content"><span class="eyebrow">A COMMUNITY THAT CARES</span><h2>Better information.<br>Healthier choices.</h2><p>Join VitaSafe to participate in our educational community.</p><div class="art-orbit">+</div></div></div><div class="auth-panel"><div class="auth-form-wrap"><div class="eyebrow dark-eyebrow">GET STARTED</div><h1>Create your account</h1><p class="form-subtitle">Already registered? <a href="login.php">Log in</a></p>
<?php if ($errors): ?><div class="alert error" role="alert"><strong>Please check:</strong><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<form method="post" class="form-stack" novalidate>
<input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<label for="name">Full name</label><input id="name" name="name" value="<?= e($name) ?>" autocomplete="name" required minlength="2" maxlength="50" placeholder="e.g. Asha Patil">
<label for="email">Email address</label><input id="email" name="email" type="email" value="<?= e($email) ?>" autocomplete="email" required maxlength="254" placeholder="you@example.com">
<label for="password">Password</label><input id="password" name="password" type="password" autocomplete="new-password" required minlength="8" maxlength="72" placeholder="8+ characters, mixed types"><small class="field-hint">Use uppercase, lowercase, a number and a special character.</small>
<label for="confirm_password">Confirm password</label><input id="confirm_password" name="confirm_password" type="password" autocomplete="new-password" required>
<button class="btn btn-primary btn-full" type="submit">Create account <span>→</span></button>
<p class="privacy-note">By registering, you agree not to post private medical or sensitive personal information in community comments.</p>
</form></div></div></section>
<?php require 'partials/footer.php'; ?>
