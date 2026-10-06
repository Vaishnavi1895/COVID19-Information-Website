<?php
require_once 'config.php';
$pageTitle = 'VitaSafe | COVID-19 Information';
$activePage = 'home';
require 'partials/header.php';
?>
<section class="hero">
  <div class="hero-overlay"></div>
  <div class="container hero-content">
    <div class="eyebrow"><span class="pulse-dot"></span> HEALTH INFORMATION, MADE CLEAR</div>
    <h1>Knowledge is a<br><span>powerful form of care.</span></h1>
    <p class="hero-copy">Understand COVID-19, learn practical prevention habits, and find reliable places to check the latest public-health guidance.</p>
    <div class="hero-actions"><a class="btn btn-primary" href="information.php">Explore COVID-19 info <span>→</span></a><a class="btn btn-glass" href="register.php">Join the community</a></div>
    <div class="hero-trust"><span>✓ Prevention basics</span><span>✓ Symptom awareness</span><span>✓ Trusted sources</span></div>
  </div>
  <div class="hero-note"><span class="note-icon">✦</span><span><strong>Stay informed, not alarmed.</strong><small>Use trusted sources for updates.</small></span></div>
</section>
<section class="container section intro-section">
  <div class="section-heading"><div><div class="eyebrow dark-eyebrow">YOUR WELLBEING MATTERS</div><h2>Small steps. <span>Meaningful protection.</span></h2></div><p>COVID-19 is an illness caused by the SARS-CoV-2 virus. Information and recommendations can change, so check official sources for current advice.</p></div>
  <div class="feature-grid">
    <article class="feature-card"><div class="feature-icon mint">♡</div><h3>Know the symptoms</h3><p>Learn common symptoms and understand when it may be important to seek medical advice.</p><a href="information.php#symptoms">Learn about symptoms <span>→</span></a></article>
    <article class="feature-card"><div class="feature-icon blue">✳</div><h3>Reduce your risk</h3><p>Use practical habits such as cleaner indoor air, staying home when unwell, and hand hygiene.</p><a href="information.php#prevention">Explore prevention <span>→</span></a></article>
    <article class="feature-card"><div class="feature-icon violet">⌁</div><h3>Find reliable guidance</h3><p>Use recognized public-health organizations rather than unverified posts or forwarded messages.</p><a href="information.php#resources">View trusted resources <span>→</span></a></article>
  </div>
</section>
<section class="stats-band"><div class="container stats-content"><div><span class="eyebrow">A BETTER WAY TO STAY INFORMED</span><h2>Reliable information starts with reliable sources.</h2></div><div class="stat-item"><strong>01</strong><span>Check official<br>health guidance</span></div><div class="stat-item"><strong>02</strong><span>Protect people<br>around you</span></div><div class="stat-item"><strong>03</strong><span>Ask a professional<br>when unsure</span></div></div></section>
<section class="container section community-cta"><div class="cta-symbol">✦</div><div><div class="eyebrow dark-eyebrow">LEARN TOGETHER</div><h2>Questions are welcome here.</h2><p>Create an account to join the learning community and leave a comment. Please don't share private medical details.</p></div><a class="btn btn-primary" href="comments.php">Visit community <span>→</span></a></section>
<?php require 'partials/footer.php'; ?>
