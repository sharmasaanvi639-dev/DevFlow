<?php
// ==========================================
// CONFIGURATION
// ==========================================
 $supabaseUrl = "https://gflakfgduibcppsaowao.supabase.co"; 
 $supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImdmbGFrZmdkdWliY3Bwc2Fvd2FvIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODA1NjI4OTYsImV4cCI6MjA5NjEzODg5Nn0.XvJ8hJgCkVDaQKeRkxM9meFhBD1a7gvyeqF29BYnAI0"; 

// Helper: Send Contact Message
function supabase_post($url, $key, $table, $data) {
    $endpoint = $url . "/rest/v1/" . $table;
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $headers = [
        "apikey: " . $key,
        "Authorization: Bearer " . $key,
        "Content-Type: application/json",
        "Prefer: return=minimal"
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpCode == 201; 
}

// 1. Handle Contact Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? ''); // New Phone Field
    $message = trim($_POST['message'] ?? '');

    // Updated Validation
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    $data = [
        "name" => $name,
        "email" => $email,
        "phone" => $phone, // Adding phone to data
        "message" => $message
    ];

    if (supabase_post($supabaseUrl, $supabaseKey, "messages", $data)) {
        echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to save message."]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Nikhil Honkalaskar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* CORE VARIABLES */
        :root {
            --bg-dark: #0B1120;
            --bg-card: rgba(30, 41, 59, 0.7);
            --primary: #38BDF8;
            --text-muted: #94A3B8;
            --glass-border: rgba(255, 255, 255, 0.1);
            --gradient-main: linear-gradient(135deg, #38BDF8 0%, #818CF8 100%);
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
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

        /* NAVIGATION */
        .navbar { background: rgba(11, 17, 32, 0.85); backdrop-filter: blur(10px); border-bottom: 1px solid var(--glass-border); padding: 15px 0; }
        .navbar-toggler { border: none; padding: 0; }
        .navbar-toggler .bi-list { color: white !important; font-size: 28px; }
        .navbar-brand { font-weight: 800; font-size: 28px; color: white !important; }
        .nav-link { color: var(--text-muted) !important; font-weight: 500; margin: 0 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }

        /* CONTACT */
        .section-padding { padding: 100px 0; }
        .hero-section { min-height: 60vh; position: relative; display: flex; align-items: center; padding-top: 80px; background: rgba(0,0,0,0.2); }
        .form-control { background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); color: #ffffff !important; padding: 15px; border-radius: 10px; }
        .form-control::placeholder { color: rgba(255,255,255,0.5) !important; opacity: 1; }
        .form-control:focus { background: rgba(255,255,255,0.1); border-color: var(--primary); color: white !important; box-shadow: 0 0 15px rgba(56, 189, 248, 0.2); }
        .form-label { color: var(--text-muted) !important; }
        .btn-glow { background: var(--gradient-main); color: white; padding: 14px 35px; border-radius: 50px; font-weight: 600; border: none; transition: 0.3s; box-shadow: 0 0 20px rgba(56, 189, 248, 0.3); }
        .btn-glow:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(56, 189, 248, 0.5); color: white; }
        .toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; }
        .custom-toast { background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); color: white !important; padding: 15px 25px; border-radius: 10px; border-left: 4px solid var(--primary); box-shadow: 0 10px 30px rgba(0,0,0,0.5); display: flex; align-items: center; gap: 15px; transform: translateX(120%); transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); min-width: 300px; }
        .custom-toast.show { transform: translateX(0); }
        .custom-toast.success { border-left-color: #22c55e; }
        .custom-toast.error { border-left-color: #ef4444; }
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
                <li class="nav-item"><a class="nav-link" href="portfolio.php">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- PAGE HEADER -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3 reveal">Get In <span class="text-gradient">Touch</span></h1>
        <p class="lead text-muted reveal">Let's build something amazing together.</p>
    </div>
</section>

<!-- CONTACT SECTION -->
<section id="contact" class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-panel p-5 reveal">
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Your Name</label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Your Email</label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Message</label>
                            <textarea name="message" class="form-control" rows="5" placeholder="Tell me about your project..." required></textarea>
                        </div>
                        <button type="submit" class="btn-glow w-100" id="submitBtn">Send Message <i class="bi bi-send-fill ms-2"></i></button>
                    </form>
                </div>
                <div class="text-center mt-4 reveal">
                    <p class="text-muted">Or contact me directly on</p>
                    <a href="https://wa.me/917057988551" class="text-white fs-4 me-4"><i class="bi bi-whatsapp"></i></a>
                    <a href="mailto:contact@nikhildev.com" class="text-white fs-4 me-4"><i class="bi bi-envelope-fill"></i></a>
                    <a href="https://linkedin.com/in/nikhil-honkalaskar-458a09303" class="text-white fs-4"><i class="bi bi-linkedin"></i></a>
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

<div class="toast-container" id="toastContainer"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer'); const toast = document.createElement('div');
        toast.className = `custom-toast ${type}`; let icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
        toast.innerHTML = `<i class="bi ${icon} fs-5"></i><div><h6 class="mb-0 fw-bold">${type === 'success' ? 'Success' : 'Error'}</h6><small class="opacity-75">${message}</small></div>`;
        container.appendChild(toast); setTimeout(() => toast.classList.add('show'), 100);
        setTimeout(() => { toast.classList.remove('show'); setTimeout(() => toast.remove(), 400); }, 3000);
    }
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault(); const btn = document.getElementById('submitBtn'); const originalText = btn.innerHTML; btn.disabled = true; btn.innerHTML = 'Sending...';
        fetch(window.location.href, { method: 'POST', body: new FormData(this) })
        .then(response => response.json()).then(data => {
            btn.disabled = false; btn.innerHTML = originalText;
            if (data.status === 'success') { showToast(data.message, "success"); this.reset(); }
            else { showToast(data.message, "error"); }
        }).catch(error => { btn.disabled = false; btn.innerHTML = originalText; showToast("Connection error.", "error"); });
    });
    const observerOptions = { threshold: 0.15 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => { if (entry.isIntersecting) { entry.target.classList.add('active'); observer.unobserve(entry.target); } });
    }, observerOptions);
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
</body>
</html>
