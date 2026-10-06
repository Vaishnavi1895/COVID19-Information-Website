<?php
require_once 'config.php';
$pageTitle = 'Community | VitaSafe';
$activePage = 'comments';
$errors = [];
$body = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_login();
    verify_csrf();
    $body = trim((string)($_POST['body'] ?? ''));
    if ($body === '' || mb_strlen($body) < 3 || mb_strlen($body) > 1000) {
        $errors[] = 'Comment must be between 3 and 1,000 characters.';
    }
    if (preg_match('/(https?:\/\/|www\.)/i', $body)) {
        $errors[] = 'Links are disabled in comments for this student project.';
    }
    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO comments (user_id, body) VALUES (?, ?)');
        $stmt->execute([$_SESSION['user_id'], $body]);
        header('Location: comments.php?posted=1');
        exit;
    }
}
$comments = $pdo->query('SELECT comments.body, comments.created_at, users.name FROM comments JOIN users ON users.id = comments.user_id ORDER BY comments.created_at DESC LIMIT 50')->fetchAll();
require 'partials/header.php';
?>
<section class="page-hero"><div class="container"><div class="eyebrow">THE VITASAFE COMMUNITY</div><h1>Learn from each other.</h1><p>Keep the conversation kind, useful, and respectful. Do not share private medical details.</p></div></section>
<section class="container section community-layout"><div class="comment-compose"><div class="eyebrow dark-eyebrow">JOIN THE DISCUSSION</div><h2>Share a thought</h2>
<?php if (isset($_GET['posted'])): ?><div class="alert success" role="status">Your comment has been posted.</div><?php endif; ?>
<?php if ($errors): ?><div class="alert error" role="alert"><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<?php if (is_logged_in()): ?><form method="post" class="form-stack"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label for="body">Your comment</label><textarea id="body" name="body" rows="5" minlength="3" maxlength="1000" required placeholder="Share a helpful thought or question..."><?= e($body) ?></textarea><div class="character-count"><span id="comment-count">0</span>/1000 characters</div><button class="btn btn-primary" type="submit">Post comment <span>→</span></button></form><?php else: ?><p>Log in to post a comment and take part in the community.</p><a class="btn btn-primary" href="login.php">Log in to comment <span>→</span></a><?php endif; ?></div>
<div class="comments-feed"><div class="feed-heading"><div><div class="eyebrow dark-eyebrow">COMMUNITY VOICES</div><h2>Recent comments</h2></div><span class="feed-count"><?= count($comments) ?> shown</span></div>
<?php if (!$comments): ?><div class="empty-state"><span>✦</span><h3>Be the first to join in</h3><p>There are no comments yet. Start a thoughtful conversation.</p></div><?php else: foreach ($comments as $comment): ?><article class="comment-card"><div class="avatar"><?= e(mb_strtoupper(mb_substr($comment['name'], 0, 1))) ?></div><div class="comment-body"><div class="comment-meta"><strong><?= e($comment['name']) ?></strong><time datetime="<?= e(date('c', strtotime($comment['created_at']))) ?>"><?= e(date('M j, Y · g:i a', strtotime($comment['created_at']))) ?></time></div><p><?= nl2br(e($comment['body'])) ?></p></div></article><?php endforeach; endif; ?>
</div></section>
<?php require 'partials/footer.php'; ?>
