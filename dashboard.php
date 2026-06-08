<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Nikhil Honkalaskar</title>
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root { 
            --bg-dark: #0B1120; 
            --bg-card: rgba(30, 41, 59, 0.7); 
            --primary: #38BDF8; 
            --text-muted: #94A3B8; 
            --glass-border: rgba(255, 255, 255, 0.1); 
            --gradient-main: linear-gradient(135deg, #38BDF8 0%, #818CF8 100%); 
        }
        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        
        html, body { 
            background-color: var(--bg-dark); 
            color: #F1F5F9; 
            font-family: 'Outfit', sans-serif; 
            overflow-x: hidden; 
            line-height: 1.7; 
        }
        
        /* FIX: Force all text elements to inherit light color */
        h1, h2, h3, h4, h5, h6, p, span, small, label, a, li { color: inherit !important; }
        
        a { text-decoration: none; color: inherit; }
        .text-gradient { background: var(--gradient-main); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block; }
        .text-muted { color: var(--text-muted) !important; }
        .glass-panel { background: var(--bg-card); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid var(--glass-border); border-radius: 20px; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); color: #F1F5F9; }
        .navbar { background: rgba(11, 17, 32, 0.85); backdrop-filter: blur(10px); border-bottom: 1px solid var(--glass-border); padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 28px; color: white !important; cursor: pointer; }
        .nav-link { font-weight: 500; margin: 0 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }
        .section-padding { padding: 80px 0; }
        
        /* Auth Button & Dropdown */
        .btn-auth-nav { background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); color: white; padding: 6px 16px; border-radius: 50px; transition: 0.3s; font-size: 0.9rem; display: flex; align-items: center; gap: 8px; white-space: nowrap; }
        .btn-auth-nav:hover { background: var(--primary); color: #000; border-color: var(--primary); }
        .user-avatar-small { width: 24px; height: 24px; border-radius: 50%; object-fit: cover; }
        .dropdown-menu { background: rgba(30, 41, 59, 0.95) !important; backdrop-filter: blur(10px); border: 1px solid var(--glass-border) !important; }
        .dropdown-item { color: #cbd5e1 !important; }
        .dropdown-item:hover { background: rgba(255,255,255,0.05); color: var(--primary) !important; }

        /* TOGGLE BUTTON COLOR FIX */
        .navbar-toggler { border: none; padding: 0; }
        .navbar-toggler .bi { 
            color: white !important; /* Forces the icon to be white */
        }

        /* Dashboard Specifics */
        .stat-card { text-align: center; padding: 30px; height: 100%; transition: 0.3s; }
        .stat-card:hover { transform: translateY(-5px); border-color: var(--primary); }
        .stat-number { font-size: 2.5rem; font-weight: 800; margin-bottom: 5px; background: var(--gradient-main); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .reveal { opacity: 0; transform: translateY(20px); transition: 0.6s; }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* Profile Picture Styles */
        .avatar-header {
            width: 80px; 
            height: 80px; 
            object-fit: cover; 
            border: 3px solid var(--primary); 
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.4);
        }
        .avatar-large {
            width: 120px; 
            height: 120px; 
            object-fit: cover; 
            border: 3px solid white; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

<!-- NAV -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php">Dev<span class="text-gradient">Flow</span>.</a>
        
        <!-- RIGHT SIDE: Toggler + User Dropdown -->
        <div class="d-flex align-items-center ms-auto">
            
            <!-- Hamburger Menu (Visible on Mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <!-- Icon will be white due to the CSS rule .navbar-toggler .bi -->
                <span class="bi bi-list" style="font-size: 28px;"></span>
            </button>

            <!-- USER DROPDOWN (Visible when logged in - OUTSIDE COLLAPSE) -->
            <div class="dropdown ms-2" id="user-dropdown-container" style="display: none;">
                <a class="dropdown-toggle btn-auth-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img id="dropdown-avatar" src="" class="user-avatar-small">
                    <span id="dropdown-name" class="d-none d-lg-inline">User</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 glass-panel mt-3 shadow-lg">
                    <li>
                        <div class="px-3 py-2">
                            <small class="text-muted d-block">Logged in as</small>
                            <span id="dropdown-email" class="fw-bold text-white">user@email.com</span>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider border-secondary opacity-25"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 text-white" href="dashboard.php">
                            <i class="bi bi-grid"></i> Dashboard
                        </a>
                    </li>
                    <li><hr class="dropdown-divider border-secondary opacity-25"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="#" id="nav-logout-btn">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- COLLAPSIBLE MENU CONTENT (Links Only) -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="portfolio.php">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- DASHBOARD CONTENT -->
<section class="section-padding" style="padding-top: 120px;">
    <div class="container">
        
        <!-- HEADER WITH AVATAR -->
        <div class="row mb-5 align-items-center reveal">
            <div class="col-auto">
                <img id="dashboard-avatar-header" src="" class="rounded-circle avatar-header">
            </div>
            <div class="col">
                <h2 class="mb-1">Welcome back, <span id="welcome-name" class="text-gradient">User</span>!</h2>
                <p class="text-muted mb-0">Here is your account overview.</p>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="row g-4 mb-5 justify-content-center">
            <div class="col-md-5">
                <div class="glass-panel stat-card reveal">
                    <div class="stat-number">100%</div>
                    <div class="text-muted">Profile Completion</div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="glass-panel stat-card reveal" style="transition-delay: 0.1s;">
                    <div class="stat-number" id="last-login-display">Today</div>
                    <div class="text-muted">Last Login</div>
                </div>
            </div>
        </div>

        <!-- ACCOUNT DETAILS CARD WITH LARGE AVATAR -->
        <div class="row">
            <div class="col-12">
                <div class="glass-panel p-5 reveal">
                    <h4 class="mb-4">Account Details</h4>
                    <div class="row align-items-center">
                        <!-- Large Avatar Column -->
                        <div class="col-md-3 text-center mb-4 mb-md-0">
                            <img id="dashboard-avatar-large" src="" class="rounded-circle avatar-large mb-3">
                            <button class="btn btn-sm btn-outline-light rounded-pill">Change Photo</button>
                        </div>

                        <!-- Details Column -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small">Display Name</label>
                                    <div id="detail-name" class="fs-5 fw-bold">-</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small">Email Address</label>
                                    <div id="detail-email" class="fs-5">-</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small">User ID (UID)</label>
                                    <div id="detail-uid" class="fs-5 text-muted" style="font-family: monospace;">-</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small">Email Verified</label>
                                    <div id="detail-verified" class="fs-5 text-success">Yes</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- FIREBASE AUTH MODULE -->
<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
    import { getAuth, onAuthStateChanged, signOut } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

    const firebaseConfig = {
        apiKey: "AIzaSyBs_IJ_74Y8GsyChljUe2574PvyKokhV9c",
        authDomain: "login-f9a06.firebaseapp.com",
        projectId: "login-f9a06",
        storageBucket: "login-f9a06.firebasestorage.app",
        messagingSenderId: "493587142230",
        appId: "1:493587142230:web:d87480038d5f020d71cdf7",
        measurementId: "G-451PH7KT8T"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);

    // DOM Elements
    const userDropdown = document.getElementById('user-dropdown-container');
    const logoutBtn = document.getElementById('nav-logout-btn');
    const dropdownAvatar = document.getElementById('dropdown-avatar');
    const dropdownName = document.getElementById('dropdown-name');
    const dropdownEmail = document.getElementById('dropdown-email');
    
    // Dashboard Elements
    const welcomeName = document.getElementById('welcome-name');
    const detailName = document.getElementById('detail-name');
    const detailEmail = document.getElementById('detail-email');
    const detailUid = document.getElementById('detail-uid');
    const lastLoginDisplay = document.getElementById('last-login-display');

    // Avatar Elements
    const avatarHeader = document.getElementById('dashboard-avatar-header');
    const avatarLarge = document.getElementById('dashboard-avatar-large');

    // 1. Auth State Listener
    onAuthStateChanged(auth, (user) => {
        if (user) {
            // LOGGED IN
            userDropdown.style.display = 'block';
            
            // Get Photo URL (Fallback to generated avatar if Google photo is missing)
            const photoUrl = user.photoURL || `https://ui-avatars.com/api/?name=${user.email}&background=random&size=128`;
            const displayName = user.displayName || "User";

            // Update Navbar Dropdown
            dropdownAvatar.src = photoUrl;
            dropdownName.textContent = displayName;
            dropdownEmail.textContent = user.email;

            // Update Dashboard Details
            welcomeName.textContent = displayName;
            detailName.textContent = displayName;
            detailEmail.textContent = user.email;
            detailUid.textContent = user.uid;
            lastLoginDisplay.textContent = new Date(user.metadata.lastSignInTime).toLocaleDateString();

            // UPDATE PROFILE PICTURES
            avatarHeader.src = photoUrl;
            avatarLarge.src = photoUrl;

            // Animation Trigger
            document.querySelectorAll('.reveal').forEach(el => el.classList.add('active'));

        } else {
            // NOT LOGGED IN - Redirect to Home
            window.location.href = 'index.php';
        }
    });

    // 2. Logout Handler
    if(logoutBtn) {
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            signOut(auth).then(() => {
                window.location.href = 'index.php'; 
            });
        });
    }
</script>
</body>
</html>
