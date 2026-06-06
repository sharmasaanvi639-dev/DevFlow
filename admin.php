<?php
session_start();

// ==========================================
// CONFIGURATION
// ==========================================
 $supabaseUrl = "https://gflakfgduibcppsaowao.supabase.co"; 
 $supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImdmbGFrZmdkdWliY3Bwc2Fvd2FvIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODA1NjI4OTYsImV4cCI6MjA5NjEzODg5Nn0.XvJ8hJgCkVDaQKeRkxM9meFhBD1a7gvyeqF29BYnAI0"; 
 $adminUser = "admin";
 $adminPass = "admin123";

// ==========================================
// API HELPER FUNCTIONS
// ==========================================
function supabase_request($method, $table, $data = null, $id = null) {
    global $supabaseUrl, $supabaseKey;
    $endpoint = $supabaseUrl . "/rest/v1/" . $table;
    
    if ($id) {
        $endpoint .= "?id=eq." . $id;
    } elseif ($method === 'GET') {
        $endpoint .= "?order=created_at.desc";
    }

    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $headers = [
        "apikey: " . $supabaseKey,
        "Authorization: Bearer " . $supabaseKey,
        "Content-Type: application/json"
    ];

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    } elseif ($method === 'DELETE') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

// ==========================================
// BACKEND LOGIC
// ==========================================
 $errorMessage = "";
 $successMessage = "";
 $currentSection = $_GET['section'] ?? 'dashboard';

// Handle Actions
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: admin.php");
    exit();
}

// Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    if ($_POST['username'] === $adminUser && $_POST['password'] === $adminPass) {
        $_SESSION['logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $errorMessage = "Invalid credentials.";
    }
}

// Add Project
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_project'])) {
    $projectData = [
        "title" => $_POST['title'],
        "description" => $_POST['description'],
        "image_url" => $_POST['image_url'],
        "link" => $_POST['link'] ?? '#'
    ];
    supabase_request('POST', 'projects', $projectData);
    $successMessage = "Project added successfully!";
}

// Delete Message
if (isset($_POST['delete_msg'])) {
    supabase_request('DELETE', 'messages', null, $_POST['delete_msg']);
    $successMessage = "Message deleted.";
}

// Delete Project
if (isset($_POST['delete_proj'])) {
    supabase_request('DELETE', 'projects', null, $_POST['delete_proj']);
    $successMessage = "Project deleted.";
}

// Fetch Data
 $messages = [];
 $projects = [];

if (isset($_SESSION['logged_in'])) {
    $messages = supabase_request('GET', 'messages') ?? [];
    $projects = supabase_request('GET', 'projects') ?? [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Nikhil Honkalaskar</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        /* ==========================================
           CORE VARIABLES & DARK THEME
           ========================================== */
        :root { 
            --sidebar-width: 260px; 
            --bg-dark: #0B1120;
            --bg-sidebar: #0f172a;
            --bg-card: rgba(30, 41, 59, 0.7);
            --primary: #38BDF8; /* Electric Blue */
            --primary-glow: rgba(56, 189, 248, 0.4);
            --secondary: #818CF8;
            --text-main: #F1F5F9;
            --text-muted-custom: #94A3B8; /* Custom Light Gray */
            --glass-border: rgba(255, 255, 255, 0.1);
            --danger: #ef4444;
            --success: #22c55e;
            --gradient-main: linear-gradient(135deg, #38BDF8 0%, #818CF8 100%);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            background-color: var(--bg-dark); 
            color: var(--text-main); 
            font-family: 'Outfit', sans-serif; 
            overflow-x: hidden; 
        }

        /* Force Override for Bootstrap Utilities to prevent Black Text */
        .text-muted, .text-secondary {
            color: var(--text-muted-custom) !important;
        }
        
        p, span, small, li, td, th, div, a {
            color: inherit !important;
        }

        /* ==========================================
           COMPONENTS
           ========================================== */
        
        .glass-panel {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        /* Sidebar Styling */
        .sidebar { 
            width: var(--sidebar-width); 
            height: 100vh; 
            position: fixed; 
            top: 0; 
            left: 0; 
            background: var(--bg-sidebar); 
            border-right: 1px solid var(--glass-border); 
            z-index: 1000; 
            transition: transform 0.3s; 
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand { 
            padding: 30px 25px; 
            font-size: 1.5rem; 
            font-weight: 800; 
            color: white;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
        }
        
        .sidebar-brand span { color: var(--primary); }

        .nav-link { 
            color: var(--text-muted-custom); 
            padding: 14px 25px; 
            border-radius: 8px; 
            margin: 4px 15px; 
            transition: all 0.2s; 
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .nav-link:hover, .nav-link.active { 
            background: rgba(56, 189, 248, 0.1); 
            color: var(--primary); 
        }

        .nav-link.active { 
            border-left: 3px solid var(--primary);
        }

        .nav-link i { margin-right: 12px; font-size: 1.1rem; }

        /* Main Content Area */
        .main-content { 
            margin-left: var(--sidebar-width); 
            padding: 30px; 
            transition: margin 0.3s; 
        }

        /* Cards & UI Elements */
        .stat-card { 
            border-left: 4px solid var(--primary); 
            transition: transform 0.2s;
            display: flex;
            align-items: center;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(56, 189, 248, 0.1);
            background: rgba(30, 41, 59, 0.9);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-right: 20px;
            background: rgba(56, 189, 248, 0.1);
            color: var(--primary);
        }

        .stat-card.success { border-left-color: var(--success); }
        .stat-card.success .stat-icon { background: rgba(34, 197, 94, 0.1); color: var(--success); }

        /* Table Styling for Dark Mode */
        .table { 
            color: var(--text-main); 
            vertical-align: middle;
            border-color: var(--glass-border);
        }

        .table thead th { 
            background-color: rgba(255,255,255,0.03); 
            border-bottom: 2px solid var(--glass-border); 
            font-weight: 600;
            color: var(--text-muted-custom);
            text-transform: uppercase;
            font-size: 0.8rem;
            padding: 15px;
        }

        .table tbody tr {
            transition: background 0.2s;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .table tbody tr:hover {
            background: rgba(255,255,255,0.02);
        }

        .table tbody td {
            padding: 15px;
        }

        /* Buttons */
        .btn-primary { 
            background: var(--gradient-main); 
            border: none;
            color: white;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #818CF8 0%, #38BDF8 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(56, 189, 248, 0.3);
        }

        .btn-outline-danger {
            color: var(--danger);
            border-color: var(--glass-border);
        }
        .btn-outline-danger:hover {
            background-color: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--glass-border);
        }
        .btn-outline-primary:hover {
            background: rgba(56, 189, 248, 0.1);
            color: var(--primary);
            border-color: var(--primary);
        }

        /* Form Elements */
        .form-control { 
            background: rgba(0, 0, 0, 0.3); 
            border: 1px solid var(--glass-border); 
            color: white !important; 
            padding: 12px;
        }

        .form-control:focus {
            background: rgba(0, 0, 0, 0.5);
            border-color: var(--primary);
            color: white !important;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
        }

        .form-control::placeholder { color: rgba(255,255,255,0.4) !important; }
        .form-label { color: var(--text-muted-custom) !important; }

        /* Modals */
        .modal-content {
            background: #111827;
            border: 1px solid var(--glass-border);
            color: white;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .modal-header, .modal-footer { border-color: var(--glass-border); }
        .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }

        /* Alerts */
        .alert { border: none; color: white; }
        .alert-success { background: rgba(34, 197, 94, 0.2); border: 1px solid var(--success); color: #86efac; }
        .alert-danger { background: rgba(239, 68, 68, 0.2); border: 1px solid var(--danger); color: #fca5a5; }

        /* Login Wrapper */
        .login-wrapper { 
            position: fixed; 
            inset: 0; 
            background: var(--bg-dark); 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            z-index: 2000; 
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

    <?php if (!isset($_SESSION['logged_in'])): ?>
    <!-- LOGIN VIEW -->
    <div class="login-wrapper">
        <div class="glass-panel p-5" style="width: 100%; max-width: 420px;">
            <div class="text-center mb-4">
                <h3 class="fw-bold" style="color: white; font-family: 'Space Grotesk';">Admin<span class="text-primary">Panel</span></h3>
                <p class="text-muted small">Please sign in to manage your portfolio</p>
            </div>
            <?php if($errorMessage): ?><div class="alert alert-danger py-2 mb-3"><?= $errorMessage ?></div><?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label small">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="admin" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100 py-2 shadow-sm">Secure Login</button>
            </form>
            <div class="text-center mt-4">
                <a href="index.php" class="text-decoration-none text-muted small hover-light">← Back to Website</a>
            </div>
        </div>
    </div>

    <?php else: ?>

    <!-- DASHBOARD VIEW -->
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-grid-fill me-2 text-primary"></i>Dev<span>Flow</span>
        </div>
        <div class="d-flex flex-column mt-4">
            <a href="?section=dashboard" class="nav-link <?= $currentSection == 'dashboard' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="?section=messages" class="nav-link <?= $currentSection == 'messages' ? 'active' : '' ?>">
                <i class="bi bi-envelope"></i> Messages 
                <?php if(count($messages) > 0): ?>
                    <span class="badge bg-danger rounded-pill ms-auto py-1"><?= count($messages) ?></span>
                <?php endif; ?>
            </a>
            <a href="?section=projects" class="nav-link <?= $currentSection == 'projects' ? 'active' : '' ?>">
                <i class="bi bi-collection"></i> Projects
            </a>
        </div>
        <div class="mt-auto p-3 border-top" style="border-color: var(--glass-border) !important;">
            <a href="index.php" class="nav-link mb-2"><i class="bi bi-globe"></i> View Site</a>
            <a href="?action=logout" class="nav-link text-danger"><i class="bi bi-box-arrow-left"></i> Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Mobile Toggle -->
        <div class="d-flex justify-content-between align-items-center mb-4 d-md-none">
            <button class="btn btn-outline-secondary border-0" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list fs-4 text-white"></i>
            </button>
            <span class="fw-bold text-white">Admin Panel</span>
        </div>

        <?php if($successMessage): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $successMessage ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if($currentSection == 'dashboard'): ?>
            <!-- HOME SECTION -->
            <h3 class="fw-bold mb-4" style="font-family: 'Space Grotesk'">Dashboard Overview</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="glass-panel p-4 stat-card h-100">
                        <div class="stat-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small text-uppercase tracking-wider">Total Messages</h6>
                            <h2 class="fw-bold mb-0"><?= count($messages) ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="glass-panel p-4 stat-card success h-100">
                        <div class="stat-icon">
                            <i class="bi bi-collection-fill"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small text-uppercase tracking-wider">Live Projects</h6>
                            <h2 class="fw-bold mb-0"><?= count($projects) ?></h2>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif($currentSection == 'messages'): ?>
            <!-- MESSAGES SECTION -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">Inbox</h3>
                <span class="badge bg-secondary bg-opacity-25 text-secondary border border-secondary"><?= count($messages) ?> Total</span>
            </div>
            <div class="glass-panel overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($messages as $msg): ?>
                            <tr>
                                <td class="text-muted small"><?= date('M j, Y', strtotime($msg['created_at'])) ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($msg['name']) ?></td>
                                <td class="text-muted small"><?= htmlspecialchars($msg['email']) ?></td>
                                <td>
                                    <div class="text-truncate" style="max-width: 250px;"><?= htmlspecialchars(substr($msg['message'], 0, 40)) ?>...</div>
                                </td>
                                <td class="text-end">
                                    <form method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                        <input type="hidden" name="delete_msg" value="<?= $msg['id'] ?>">
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3 border-0">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(count($messages) == 0): ?>
                                <tr><td colspan="5" class="text-center py-5 text-muted">No messages found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php elseif($currentSection == 'projects'): ?>
            <!-- PROJECTS SECTION -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">Manage Projects</h3>
                <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                    <i class="bi bi-plus-lg me-1"></i> Add New Project
                </button>
            </div>
            
            <div class="row g-4">
                <?php foreach($projects as $proj): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="glass-panel h-100 d-flex flex-column">
                        <div style="height: 160px; overflow: hidden;">
                            <img src="<?= htmlspecialchars($proj['image_url']) ?>" class="w-100 h-100" style="object-fit: cover; transition: 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold mb-2"><?= htmlspecialchars($proj['title']) ?></h5>
                            <p class="text-muted small flex-grow-1 mb-3"><?= htmlspecialchars(substr($proj['description'], 0, 80)) ?>...</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top" style="border-color: var(--glass-border) !important;">
                                <a href="<?= htmlspecialchars($proj['link']) ?>" target="_blank" class="btn btn-sm btn-outline-primary border-0">View Live</a>
                                <form method="POST" class="d-inline" onsubmit="return confirm('Delete this project?');">
                                    <input type="hidden" name="delete_proj" value="<?= $proj['id'] ?>">
                                    <button class="btn btn-sm text-danger p-0"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if(count($projects) == 0): ?>
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No projects found. Add one to get started.</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Add Project Modal -->
    <div class="modal fade" id="addProjectModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small">Project Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Image URL</label>
                            <input type="url" name="image_url" class="form-control" placeholder="https://..." required>
                            <small class="text-muted" style="font-size: 0.75rem;">Use a direct image link (Unsplash, Imgur)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Project Link</label>
                            <input type="text" name="link" class="form-control" placeholder="#" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Description</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_project" class="btn btn-primary">Save Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>