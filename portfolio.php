<?php
 $supabaseUrl = "https://gflakfgduibcppsaowao.supabase.co"; 
 $supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImdmbGFrZmdkdWliY3Bwc2Fvd2FvIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODA1NjI4OTYsImV4cCI6MjA5NjEzODg5Nn0.XvJ8hJgCkVDaQKeRkxM9meFhBD1a7gvyeqF29BYnAI0"; 

function supabase_get_projects($url, $key) {
    $endpoint = $url . "/rest/v1/projects?order=created_at.desc";
    $ch = curl_init($endpoint); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["apikey: " . $key, "Authorization: Bearer " . $key, "Content-Type: application/json"]);
    $response = curl_exec($ch); curl_close($ch);
    return json_decode($response, true) ?? [];
}
 $portfolioProjects = supabase_get_projects($supabaseUrl, $supabaseKey);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Nikhil Honkalaskar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --bg-dark: #0B1120; --bg-card: rgba(30, 41, 59, 0.7); --primary: #38BDF8; --text-muted: #94A3B8; --glass-border: rgba(255, 255, 255, 0.1); --gradient-main: linear-gradient(135deg, #38BDF8 0%, #818CF8 100%); }
        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        html, body { background-color: var(--bg-dark); color: #F1F5F9; font-family: 'Outfit', sans-serif; overflow-x: hidden; line-height: 1.7; }
        p, span, small, div, li { color: inherit !important; }
        h1, h2, h3, h4, h5 { font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: white !important; }
        a { text-decoration: none; color: inherit; }
        .text-gradient { background: var(--gradient-main); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block; }
        .text-muted { color: var(--text-muted) !important; }
        .glass-panel { background: var(--bg-card); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid var(--glass-border); border-radius: 20px; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); color: #F1F5F9; }
        .reveal { opacity: 0; transform: translateY(50px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .navbar { background: rgba(11, 17, 32, 0.85); backdrop-filter: blur(10px); border-bottom: 1px solid var(--glass-border); padding: 15px 0; }
          .navbar-toggler { border: none; padding: 0; }
        .navbar-toggler .bi-list {color: white !important; font-size: 28px;}
        .navbar-brand { font-weight: 800; font-size: 28px; color: white !important; }
        .nav-link { color: var(--text-muted) !important; font-weight: 500; margin: 0 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }
        .section-padding { padding: 100px 0; }
        .hero-section { min-height: 60vh; position: relative; display: flex; align-items: center; padding-top: 80px; background: rgba(0,0,0,0.2); }
        .project-card { border-radius: 20px; overflow: hidden; position: relative; border: 1px solid var(--glass-border); height: 100%; }
        .project-thumb { height: 250px; overflow: hidden; position: relative; }
        .project-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .project-card:hover .project-thumb img { transform: scale(1.1); }
        .project-overlay { position: absolute; inset: 0; background: rgba(11, 17, 32, 0.8); display: flex; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; }
        .project-card:hover .project-overlay { opacity: 1; }
        .project-info { padding: 25px; background: var(--bg-card); }
        .btn-glow { background: var(--gradient-main); color: white; padding: 8px 20px; border-radius: 50px; font-weight: 600; border: none; text-decoration: none; transition: 0.3s; }
        .btn-glow:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(56, 189, 248, 0.5); color: white; }
        footer { background: #020617; padding: 50px 0; border-top: 1px solid var(--glass-border); margin-top: 50px; }
    </style>
</head>
<body>

<!-- NAV -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Dev<span class="text-gradient">Flow</span>.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="bi bi-list" style="color:white; font-size: 28px;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link active" href="portfolio.php">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- SMALL HERO -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3 reveal">My <span class="text-gradient">Portfolio</span></h1>
        <p class="lead text-muted reveal">A collection of my full-stack development projects.</p>
    </div>
</section>

<!-- PROJECTS SECTION -->
<section id="projects" class="section-padding">
    <div class="container">
        <div class="row g-4">
            <?php if(count($portfolioProjects) > 0): ?>
                <?php foreach($portfolioProjects as $proj): ?>
                    <div class="col-md-6 col-lg-4 reveal">
                        <div class="glass-panel project-card">
                            <div class="project-thumb">
                                <img src="<?= htmlspecialchars($proj['image_url'] ?? 'https://picsum.photos/seed/tech/400/300') ?>" alt="<?= htmlspecialchars($proj['title']) ?>">
                                <div class="project-overlay">
                                    <a href="<?= htmlspecialchars($proj['link'] ?? '#') ?>" target="_blank" class="btn-glow btn-sm">Visit Site</a>
                                </div>
                            </div>
                            <div class="project-info">
                                <h5><?= htmlspecialchars($proj['title']) ?></h5>
                                <p class="text-muted small mb-3"><?= htmlspecialchars($proj['description']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center"><div class="glass-panel p-5 reveal"><p class="text-muted">Loading projects...</p></div></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<footer>
    <div class="container text-center"><p class="text-muted mb-0">&copy; 2026 Nikhil Honkalaskar. All Rights Reserved.</p></div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const observerOptions = { threshold: 0.15 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) { entry.target.classList.add('active'); observer.unobserve(entry.target); }
        });
    }, observerOptions);
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
</body>
</html>