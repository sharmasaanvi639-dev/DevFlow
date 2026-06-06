<?php
// ==========================================
// CONFIGURATION
// ==========================================
 $supabaseUrl = "https://gflakfgduibcppsaowao.supabase.co"; 
 $supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImdmbGFrZmdkdWliY3Bwc2Fvd2FvIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODA1NjI4OTYsImV4cCI6MjA5NjEzODg5Nn0.XvJ8hJgCkVDaQKeRkxM9meFhBD1a7gvyeqF29BYnAI0"; 

// Helper: Fetch Projects
function supabase_get_projects($url, $key) {
    $endpoint = $url . "/rest/v1/projects?order=created_at.desc";
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: " . $key,
        "Authorization: Bearer " . $key,
        "Content-Type: application/json"
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($response, true);
    return $decoded ?? [];
}

 $portfolioProjects = supabase_get_projects($supabaseUrl, $supabaseKey);
 // Get only top 3 for landing page
 $featuredProjects = array_slice($portfolioProjects, 0, 3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nikhil Honkalaskar | Full Stack Developer</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ORIGINAL CORE VARIABLES */
        :root {
            --bg-dark: #0B1120;
            --bg-card: rgba(30, 41, 59, 0.7);
            --primary: #38BDF8;
            --primary-glow: rgba(56, 189, 248, 0.4);
            --secondary: #818CF8;
            --text-main: #F1F5F9;
            --text-muted: #94A3B8;
            --glass-border: rgba(255, 255, 255, 0.1);
            --gradient-main: linear-gradient(135deg, #38BDF8 0%, #818CF8 100%);
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        html, body { background-color: var(--bg-dark); color: var(--text-main); font-family: 'Outfit', sans-serif; overflow-x: hidden; line-height: 1.7; }
        p, span, small, div, li, td, th { color: inherit !important; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: white !important; }
        a { text-decoration: none; color: inherit; }
        
        /* UTILITIES */
        .text-gradient { background: var(--gradient-main); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block; }
        .text-muted { color: var(--text-muted) !important; }
        .glass-panel { background: var(--bg-card); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid var(--glass-border); border-radius: 20px; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); color: var(--text-main); }
        .reveal { opacity: 0; transform: translateY(50px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* NAVIGATION */
        
        .navbar { background: rgba(11, 17, 32, 0.85); backdrop-filter: blur(10px); border-bottom: 1px solid var(--glass-border); padding: 15px 0; transition: all 0.3s ease; }
        .navbar-toggler { border: none; padding: 0; }
        .navbar-toggler .bi-list {color: white !important; font-size: 28px;}
        .navbar-brand { font-weight: 800; font-size: 28px; letter-spacing: -1px; color: white !important; cursor: pointer; } /* Added cursor pointer for admin access */
        .nav-link { color: var(--text-muted) !important; font-weight: 500; margin: 0 10px; position: relative; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }
        
        /* HERO SECTION */
        .hero-section { min-height: 100vh; position: relative; display: flex; align-items: center; padding-top: 80px; overflow: hidden; }
        #heroCanvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; }
        .hero-content { position: relative; z-index: 2; }
        .hero-badge { background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.3); color: var(--primary); padding: 8px 16px; border-radius: 50px; font-size: 14px; font-weight: 600; display: inline-block; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; }
        .hero-title { font-size: 4rem; line-height: 1.1; margin-bottom: 25px; letter-spacing: -2px; color: white !important; }
        .hero-subtitle { font-size: 1.25rem; color: var(--text-muted); margin-bottom: 40px; max-width: 550px; }
        .btn-glow { background: var(--gradient-main); color: white; padding: 14px 35px; border-radius: 50px; font-weight: 600; border: none; position: relative; z-index: 1; overflow: hidden; transition: 0.3s; box-shadow: 0 0 20px rgba(56, 189, 248, 0.3); display: inline-block; }
        .btn-glow:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(56, 189, 248, 0.5); color: white; }
        .btn-outline-glow { background: transparent; color: white; padding: 14px 35px; border-radius: 50px; font-weight: 600; border: 2px solid var(--glass-border); margin-left: 15px; transition: 0.3s; display: inline-block; }
        .btn-outline-glow:hover { border-color: var(--primary); color: var(--primary); }

        /* ==========================================
           UPDATED PROCESS SECTION WITH GAPS
           ========================================== */
        .section-padding { padding: 100px 0; }
        
        .process-card {
            text-align: center;
            transition: var(--transition);
            height: 100%; /* Make cards equal height */
        }
        .process-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 10px 40px rgba(56, 189, 248, 0.15);
        }
        .process-icon-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(56, 189, 248, 0.1);
            border-radius: 50%; /* Circle Icon */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--primary);
            margin-bottom: 25px; /* Gap between icon and title */
            transition: 0.3s;
        }
        .process-card:hover .process-icon-wrapper {
            background: var(--gradient-main);
            color: white;
            transform: rotateY(180deg);
        }
        .step-number {
            font-size: 3.5rem;
            font-weight: 800;
            background: var(--gradient-main);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0.1;
            position: absolute;
            top: 10px;
            right: 20px;
            z-index: 0;
            line-height: 1;
        }
        
        /* PROJECTS */
        .project-card { border-radius: 20px; overflow: hidden; position: relative; border: 1px solid var(--glass-border); height: 100%; }
        .project-thumb { height: 220px; overflow: hidden; position: relative; }
        .project-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .project-card:hover .project-thumb img { transform: scale(1.1); }
        .project-overlay { position: absolute; inset: 0; background: rgba(11, 17, 32, 0.8); display: flex; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; }
        .project-card:hover .project-overlay { opacity: 1; }
        .project-info { padding: 20px; background: var(--bg-card); }

        /* STATS & CTA */
        .stat-big { font-size: 3.5rem; font-weight: 800; line-height: 1; margin-bottom: 10px; }
        .cta-box { background: linear-gradient(135deg, rgba(56, 189, 248, 0.1) 0%, rgba(129, 140, 248, 0.1) 100%); border: 1px solid var(--glass-border); padding: 60px; border-radius: 30px; text-align: center; position: relative; overflow: hidden; }
        .cta-box::before { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 70%); animation: rotate 10s linear infinite; }
        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        footer { background: #020617; padding: 50px 0; border-top: 1px solid var(--glass-border); }
        @media (max-width: 768px) { .hero-title { font-size: 2.5rem; } .btn-outline-glow { margin-left: 0; margin-top: 15px; display: block; text-align: center; } }
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
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="portfolio.php">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <!-- HIDDEN ADMIN BUTTON (Only accessible via Double-Click Logo or Shortcut) -->
                <li class="nav-item d-none">
                    <a class="nav-link" href="admin.php">Admin Panel</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<section id="hero" class="hero-section">
    <canvas id="heroCanvas"></canvas>
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="hero-badge reveal">Full Stack Developer</span>
                <h1 class="hero-title reveal">Building Digital <br> <span class="text-gradient">Experiences</span> That Matter.</h1>
                <p class="hero-subtitle reveal">
                    I'm <strong>Nikhil Honkalaskar</strong>. I transform complex problems into scalable web applications using React, PHP, and PostgreSQL.
                </p>
                <div class="reveal mt-4">
                    <a href="contact.php" class="btn-glow">Start a Project</a>
                    <a href="portfolio.php" class="btn-outline-glow">View Work</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW I WORK (Process Section - With Gaps) -->
<section class="section-padding">
    <div class="container">
        <div class="section-header text-center reveal">
            <h2>How I <span class="text-gradient">Work</span></h2>
            <p>A streamlined process from idea to deployment.</p>
        </div>
        
        <!-- 'g-4' adds the horizontal gap (spacing) between columns -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="glass-panel p-5 position-relative process-card reveal">
                    <span class="step-number">01</span>
                    <div class="process-icon-wrapper">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                    <h4>Discovery</h4>
                    <p class="text-muted mt-3">Understanding your goals and planning the technical architecture to ensure success.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-panel p-5 position-relative process-card reveal" style="transition-delay: 0.1s;">
                    <span class="step-number">02</span>
                    <div class="process-icon-wrapper">
                        <i class="bi bi-code-slash"></i>
                    </div>
                    <h4>Development</h4>
                    <p class="text-muted mt-3">Building high-performance code with modern frameworks and clean standards.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-panel p-5 position-relative process-card reveal" style="transition-delay: 0.2s;">
                    <span class="step-number">03</span>
                    <div class="process-icon-wrapper">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <h4>Launch</h4>
                    <p class="text-muted mt-3">Rigorous testing, deployment, and post-launch support to keep your site running.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURED WORK (Top 3) -->
<section class="section-padding" style="background: rgba(255,255,255,0.02);">
    <div class="container">
        <div class="section-header text-center reveal">
            <h2>Selected <span class="text-gradient">Works</span></h2>
            <p>A glimpse into my recent full-stack projects.</p>
        </div>
        <div class="row g-4">
            <?php if(count($featuredProjects) > 0): ?>
                <?php foreach($featuredProjects as $proj): ?>
                    <div class="col-md-6 col-lg-4 reveal">
                        <div class="glass-panel project-card">
                            <div class="project-thumb">
                                <img src="<?= htmlspecialchars($proj['image_url'] ?? 'https://picsum.photos/seed/tech/400/300') ?>" alt="<?= htmlspecialchars($proj['title']) ?>">
                                <div class="project-overlay">
                                    <a href="<?= htmlspecialchars($proj['link'] ?? '#') ?>" target="_blank" class="btn-glow btn-sm">View Live</a>
                                </div>
                            </div>
                            <div class="project-info">
                                <h5><?= htmlspecialchars($proj['title']) ?></h5>
                                <p class="text-muted small text-truncate"><?= htmlspecialchars($proj['description']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5 reveal">
            <a href="portfolio.php" class="btn-outline-glow">View All Projects</a>
        </div>
    </div>
</section>

<!-- QUICK STATS -->
<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4 text-center reveal">
                <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-center">
                    <div class="stat-big text-gradient">1+</div>
                    <p class="text-muted fw-bold">Year Experience</p>
                </div>
            </div>
            <div class="col-md-4 text-center reveal">
                <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-center">
                    <div class="stat-big text-gradient">10+</div>
                    <p class="text-muted fw-bold">Projects Completed</p>
                </div>
            </div>
            <div class="col-md-4 text-center reveal">
                <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-center">
                    <div class="stat-big text-gradient">100%</div>
                    <p class="text-muted fw-bold">Client Satisfaction</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="section-padding">
    <div class="container">
        <div class="cta-box reveal">
            <h2 class="mb-3">Ready to build something amazing?</h2>
            <p class="text-muted mb-4">Let's discuss your project and turn your idea into reality.</p>
            <a href="contact.php" class="btn-glow">Get a Quote</a>
        </div>
    </div>
</section>

<footer>
    <div class="container text-center">
        <p class="text-muted mb-0">&copy; 2026 Nikhil Honkalaskar. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // CANVAS ANIMATION
    const canvas = document.getElementById('heroCanvas');
    const ctx = canvas.getContext('2d');
    let width, height, particles = [];
    const particleCount = 60, connectionDistance = 150, mouseDistance = 200;
    const mouse = { x: null, y: null };
    function resize() { width = canvas.width = window.innerWidth; height = canvas.height = window.innerHeight; }
    window.addEventListener('resize', resize); resize();
    window.addEventListener('mousemove', (e) => { mouse.x = e.x; mouse.y = e.y; });
    window.addEventListener('mouseout', () => { mouse.x = null; mouse.y = null; });
    class Particle {
        constructor() {
            this.x = Math.random() * width; this.y = Math.random() * height;
            this.vx = (Math.random() - 0.5) * 1.5; this.vy = (Math.random() - 0.5) * 1.5;
            this.size = Math.random() * 2 + 1; this.color = '#38BDF8';
        }
        update() {
            this.x += this.vx; this.y += this.vy;
            if (this.x < 0 || this.x > width) this.vx *= -1;
            if (this.y < 0 || this.y > height) this.vy *= -1;
            if (mouse.x != null) {
                let dx = mouse.x - this.x, dy = mouse.y - this.y, distance = Math.sqrt(dx*dx + dy*dy);
                if (distance < mouseDistance) {
                    const forceDirectionX = dx / distance, forceDirectionY = dy / distance;
                    const force = (mouseDistance - distance) / mouseDistance;
                    const directionX = forceDirectionX * force * 2, directionY = forceDirectionY * force * 2;
                    this.vx -= directionX * 0.05; this.vy -= directionY * 0.05;
                }
            }
        }
        draw() { ctx.beginPath(); ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2); ctx.fillStyle = this.color; ctx.fill(); }
    }
    function initParticles() { particles = []; for (let i = 0; i < particleCount; i++) particles.push(new Particle()); }
    function animateParticles() {
        ctx.clearRect(0, 0, width, height);
        for (let i = 0; i < particles.length; i++) {
            particles[i].update(); particles[i].draw();
            for (let j = i; j < particles.length; j++) {
                let dx = particles[i].x - particles[j].x, dy = particles[i].y - particles[j].y, distance = Math.sqrt(dx*dx + dy*dy);
                if (distance < connectionDistance) {
                    ctx.beginPath();
                    let opacity = 1 - (distance / connectionDistance);
                    ctx.strokeStyle = `rgba(56, 189, 248, ${opacity * 0.5})`;
                    ctx.lineWidth = 1;
                    ctx.moveTo(particles[i].x, particles[i].y); ctx.lineTo(particles[j].x, particles[j].y); ctx.stroke();
                }
            }
        }
        requestAnimationFrame(animateParticles);
    }
    initParticles(); animateParticles();

    // SCROLL REVEAL
    const observerOptions = { threshold: 0.15 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) { entry.target.classList.add('active'); observer.unobserve(entry.target); }
        });
    }, observerOptions);
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // ==========================================
    // SECRET ADMIN ACCESS TRIGGER
    // ==========================================
    
    // Method 1: Double Click on Logo
    const brandLogo = document.querySelector('.navbar-brand');
    if (brandLogo) {
        brandLogo.addEventListener('dblclick', function() {
            window.location.href = 'admin.php';
        });
    }

    // Method 2: Keyboard Shortcut (Ctrl + Shift + A)
    document.addEventListener('keydown', function(event) {
        if (event.ctrlKey && event.shiftKey && (event.key === 'A' || event.key === 'a')) {
            window.location.href = 'admin.php';
        }
    });
</script>
</body>
</html>
