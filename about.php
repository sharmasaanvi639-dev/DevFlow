<?php $currentPage = 'about.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me | Nikhil Honkalaskar</title>
    <!-- Include Same Head Files -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ORIGINAL CSS BLOCK - Use from index.php styles */
        :root { --bg-dark: #0B1120; --bg-card: rgba(30, 41, 59, 0.7); --primary: #38BDF8; --text-muted: #94A3B8; --glass-border: rgba(255, 255, 255, 0.1); --gradient-main: linear-gradient(135deg, #38BDF8 0%, #818CF8 100%); --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        html, body { background-color: var(--bg-dark); color: #F1F5F9; font-family: 'Outfit', sans-serif; overflow-x: hidden; line-height: 1.7; }
        p, span, small, div, li { color: inherit !important; }
        h1, h2, h3, h4 { font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: white !important; }
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
        .timeline { position: relative; padding-left: 30px; border-left: 2px solid rgba(255,255,255,0.1); }
        .timeline-item { position: relative; margin-bottom: 50px; }
        .timeline-item::before { content: ''; position: absolute; left: -36px; top: 5px; width: 14px; height: 14px; border-radius: 50%; background: var(--bg-dark); border: 2px solid var(--primary); box-shadow: 0 0 10px var(--primary); }
        .progress { height: 8px; background-color: rgba(255,255,255,0.1); border-radius: 10px; overflow: visible; }
        .progress-bar { background: var(--gradient-main); position: relative; border-radius: 10px; box-shadow: 0 0 15px rgba(56, 189, 248, 0.5); transition: width 1.5s cubic-bezier(0.22, 1, 0.36, 1); }
        .progress-bar::after { content: ''; position: absolute; right: 0; top: -4px; width: 16px; height: 16px; background: white; border-radius: 50%; box-shadow: 0 0 10px white; }
        .stat-item h3 { font-size: 3rem; background: var(--gradient-main); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800; }
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
                <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="portfolio.php">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- SMALL HERO -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3 reveal">About <span class="text-gradient">Me</span></h1>
        <p class="lead text-muted reveal">Passionate about clean code and modern frameworks.</p>
    </div>
</section>

<!-- ABOUT & SKILLS -->
<section id="about" class="section-padding" style="background: rgba(255,255,255,0.02);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 reveal">
                <div class="glass-panel p-1">
                    <img src="https://images.unsplash.com/photo-1549692520-acc6669e2f0c" alt="About Nikhil" class="img-fluid w-100 rounded-3">
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <div class="glass-panel p-4 mb-4 reveal">
                    <p class="text-muted mb-4">
                        I am a dedicated <strong>Full Stack Developer</strong> currently working at <strong>Tushar Bhumkar Institute Pvt. Ltd.</strong>. 
                        I bridge the gap between dynamic frontends using <strong>React JS</strong> and powerful backends using <strong>PHP</strong> and <strong>Java</strong>.
                    </p>
                    <div class="row text-center g-4">
                        <div class="col-4 border-end border-secondary border-opacity-25">
                            <div class="stat-item"><h3 class="counter" data-target="1">0</h3><span style="font-size:1.5rem; vertical-align:top;">+</span></div>
                            <small class="text-muted">Years Exp.</small>
                        </div>
                        <div class="col-4 border-end border-secondary border-opacity-25">
                            <div class="stat-item"><h3 class="counter" data-target="10">0</h3><span style="font-size:1.5rem; vertical-align:top;">+</span></div>
                            <small class="text-muted">Projects</small>
                        </div>
                        <div class="col-4">
                            <div class="stat-item"><h3 class="counter" data-target="3">0</h3><span style="font-size:1.5rem; vertical-align:top;">+</span></div>
                            <small class="text-muted">Clients</small>
                        </div>
                    </div>
                </div>

                <div class="reveal">
                    <h4 class="mb-3">Technical Skills</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-1"><small>HTML5</small><small class="text-primary">98%</small></div>
                            <div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%" data-width="98%"></div></div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-1"><small>React JS</small><small class="text-primary">95%</small></div>
                            <div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%" data-width="95%"></div></div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-1"><small>PHP Backend</small><small class="text-primary">90%</small></div>
                            <div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%" data-width="90%"></div></div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-1"><small>PostgreSQL</small><small class="text-primary">85%</small></div>
                            <div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%" data-width="85%"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TIMELINE -->
<section id="experience" class="section-padding">
    <div class="container">
        <div class="section-header text-center reveal">
            <h2>Experience <span class="text-gradient">Timeline</span></h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="timeline reveal">
                    <div class="timeline-item">
                        <span class="text-primary fw-bold">July 2025 – Present</span>
                        <h4 class="mt-2">Web Developer</h4>
                        <h6 class="text-muted">Tushar Bhumkar Institute Pvt. Ltd.</h6>
                        <p class="text-muted mt-2 small">• Built trading and educational platforms.<br>• Integrated Razorpay payment systems.</p>
                    </div>
                    <div class="timeline-item">
                        <span class="text-primary fw-bold">Jan 2025 – Mar 2025</span>
                        <h4 class="mt-2">Software Developer Intern</h4>
                        <h6 class="text-muted">Nauai Lab Pvt. Ltd.</h6>
                        <p class="text-muted mt-2 small">• Developed web application modules.<br>• Assisted in backend integration.</p>
                    </div>
                </div>
            </div>
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
    const observerOptions = { threshold: 0.15 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                if (entry.target.querySelector('.progress-bar')) {
                    const bars = entry.target.querySelectorAll('.progress-bar');
                    bars.forEach(bar => bar.style.width = bar.getAttribute('data-width'));
                }
                const counters = entry.target.querySelectorAll('.counter');
                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-target');
                    const increment = target / 100; let current = 0;
                    const updateCounter = () => { current += increment; if (current < target) { counter.innerText = Math.ceil(current); requestAnimationFrame(updateCounter); } else { counter.innerText = target; } };
                    updateCounter();
                });
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
</body>
</html>