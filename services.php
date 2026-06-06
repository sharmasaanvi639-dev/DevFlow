<?php
 $currentPage = 'services.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services | Nikhil Honkalaskar</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ==========================================
           CORE VARIABLES & RESET
           ========================================== */
        :root {
            --bg-dark: #0B1120;
            --bg-card: rgba(30, 41, 59, 0.7);
            --primary: #38BDF8;
            --primary-glow: rgba(56, 189, 248, 0.4);
            --secondary: #818CF8;
            --accent: #22D3EE;
            --text-main: #F1F5F9;
            --text-muted: #94A3B8;
            --glass-border: rgba(255, 255, 255, 0.1);
            --gradient-main: linear-gradient(135deg, #38BDF8 0%, #818CF8 100%);
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        html, body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
            line-height: 1.7;
        }
        p, span, small, div, li { color: inherit !important; }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            color: white !important;
        }
        a { text-decoration: none; color: inherit; }

        .text-gradient {
            background: var(--gradient-main);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }
        .text-muted { color: var(--text-muted) !important; }
        .glass-panel {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            color: var(--text-main);
        }
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* NAVIGATION */
        .navbar {
            background: rgba(11, 17, 32, 0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .navbar-toggler { 
        border: none; 
        padding: 0; 
    }

.navbar-toggler .bi-list {
    color: white !important; 
    font-size: 28px;
}
        .navbar-brand {
            font-weight: 800;
            font-size: 28px;
            letter-spacing: -1px;
            color: white !important;
        }
        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            margin: 0 10px;
            position: relative;
            transition: 0.3s;
        }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }

        /* PAGE HEADER */
        .hero-section {
            min-height: 60vh;
            position: relative;
            display: flex;
            align-items: center;
            padding-top: 80px;
            background: rgba(0,0,0,0.2);
        }

        /* SERVICES & PRICING */
        .section-padding { padding: 100px 0; }
        .section-header { margin-bottom: 60px; text-align: center; }
        .section-header h2 { font-size: 2.5rem; margin-bottom: 15px; position: relative; display: inline-block; color: white !important; }
        
        .service-card {
            padding: 50px 40px; /* Increased padding for better spacing */
            transition: var(--transition);
            height: 100%;
            position: relative;
            overflow: hidden;
            text-align: center;
        }
        .service-card:hover {
            transform: translateY(-10px);
            border-color: rgba(56, 189, 248, 0.3);
            background: rgba(30, 41, 59, 0.9);
        }
        
        .service-icon {
            width: 80px;
            height: 80px;
            background: rgba(56, 189, 248, 0.1);
            border-radius: 50%; /* Circular Icon */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: var(--primary);
            margin: 0 auto 25px; /* Centered and gap */
            transition: 0.3s;
        }
        .service-card:hover .service-icon {
            background: var(--gradient-main);
            color: white;
            transform: rotateY(180deg);
        }

        /* Pricing List */
        .pricing-list {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }
        .pricing-list li {
            margin-bottom: 15px;
            padding-left: 25px;
            position: relative;
            color: var(--text-muted);
        }
        .pricing-list li::before {
            content: '✔';
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: bold;
        }

        /* FOOTER */
        footer {
            background: #020617;
            padding: 50px 0;
            border-top: 1px solid var(--glass-border);
            margin-top: 50px;
        }
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
                <li class="nav-item"><a class="nav-link active" href="services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="portfolio.php">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- PAGE HEADER (SMALL HERO) -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3 reveal">My <span class="text-gradient">Services</span></h1>
        <p class="lead text-muted reveal">Comprehensive web solutions tailored to your business needs.</p>
    </div>
</section>

<!-- SERVICES -->
<section id="services" class="section-padding">
    <div class="container">
        <div class="section-header reveal">
            <h2>Core <span class="text-gradient">Expertise</span></h2>
            <p>Tailored tech solutions for modern businesses.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="glass-panel service-card reveal">
                    <div class="service-icon"><i class="bi bi-code-slash"></i></div>
                    <h4>Web Development</h4>
                    <p class="text-muted mt-3">Custom web applications built with HTML5, CSS3, JavaScript, and PHP. High performance and SEO optimized.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-panel service-card reveal" style="transition-delay: 0.1s;">
                    <div class="service-icon"><i class="bi bi-phone"></i></div>
                    <h4>Responsive Design</h4>
                    <p class="text-muted mt-3">Fluid layouts that adapt perfectly to mobile, tablet, and desktop screens using modern CSS frameworks.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-panel service-card reveal" style="transition-delay: 0.2s;">
                    <div class="service-icon"><i class="bi bi-cart-check"></i></div>
                    <h4>Business Solutions</h4>
                    <p class="text-muted mt-3">Complex systems including trading portals, educational platforms, and payment gateway integrations.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PRICING -->
<section id="pricing" class="section-padding" style="background: rgba(255,255,255,0.02);">
    <div class="container">
        <div class="section-header text-center reveal">
            <h2>Website <span class="text-gradient">Pricing</span></h2>
            <p>Affordable and professional web development services.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-5">
                <div class="glass-panel service-card reveal text-center">
                    <div class="service-icon mx-auto"><i class="bi bi-display"></i></div>
                    <h3>Front-End Website</h3>
                    <div class="my-4"><h1 class="text-gradient fw-bold">₹3,000+</h1></div>
                    <ul class="list-unstyled pricing-list">
                        <li>Responsive Design</li>
                        <li>HTML, CSS, Bootstrap</li>
                        <li>JavaScript Features</li>
                        <li>Mobile Friendly</li>
                        <li>Landing Pages</li>
                        <li>Business Websites</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="glass-panel service-card reveal text-center" style="border: 1px solid var(--primary);">
                    <div class="service-icon mx-auto" style="background: var(--gradient-main); color: white;"><i class="bi bi-server"></i></div>
                    <h3>Front-End + Back-End</h3>
                    <div class="my-4"><h1 class="text-gradient fw-bold">₹5,000+</h1></div>
                    <ul class="list-unstyled pricing-list">
                        <li>Everything in Front-End</li>
                        <li>PHP Backend</li>
                        <li>PostgreSQL Database</li>
                        <li>Login / Signup</li>
                        <li>Admin Panel</li>
                        <li>Dynamic Features</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-lg-10 mx-auto">
                <div class="glass-panel p-4 reveal text-center">
                    <h4 class="mb-3">Important Note</h4>
                    <p class="text-muted mb-0">
                        Prices shown above are starting prices. Final pricing depends on project requirements,
                        number of pages, custom design, admin panel, payment gateway integration,
                        API integrations, database complexity, deployment requirements,
                        and additional custom features.
                    </p>
                    <p class="mt-3 mb-0 fw-bold text-white">
                        Final cost will be discussed after understanding the project requirements.
                    </p>
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
            if (entry.isIntersecting) { entry.target.classList.add('active'); observer.unobserve(entry.target); }
        });
    }, observerOptions);
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
</body>
</html>