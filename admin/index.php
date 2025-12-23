<?php
// admin/index.php
require_once 'config.php';
requireLogin();

$conn = initializeDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | DRIYUM Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --deep-forest: #064E3B;
            --dark-emerald: #022C22;
            --fresh-leaf: #22C55E;
            --soft-cream: #ECFDF5;
            --gold-accent: #D4AF37;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(165deg, #011a14 0%, var(--dark-emerald) 30%, var(--deep-forest) 100%);
            color: var(--soft-cream);
            min-height: 100vh;
        }

        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }

        /* Header */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding: 20px 0;
            border-bottom: 1px solid var(--glass-border);
        }

        .logo-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--soft-cream), var(--gold-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 4px;
        }

        .logo-section p {
            font-size: 0.9rem;
            opacity: 0.7;
            letter-spacing: 0.1em;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .username {
            opacity: 0.8;
            font-size: 0.9rem;
        }

        .btn-logout {
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.3);
            color: #fca5a5;
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-logout:hover {
            background: rgba(220, 38, 38, 0.2);
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .dashboard-card {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            border-color: var(--gold-accent);
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            opacity: 0.8;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--soft-cream);
        }

        .card-value {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--soft-cream), var(--fresh-leaf));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
            margin-bottom: 10px;
        }

        .card-description {
            opacity: 0.7;
            font-size: 0.9rem;
        }

        /* Quick Actions */
        .quick-actions {
            margin-top: 50px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 30px;
            background: linear-gradient(135deg, var(--soft-cream), var(--gold-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .action-card {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .action-card:hover {
            transform: translateY(-5px);
            border-color: var(--fresh-leaf);
            background: rgba(34, 197, 94, 0.05);
        }

        .action-icon {
            font-size: 2rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .action-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--soft-cream);
        }

        .action-description {
            opacity: 0.7;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .admin-container {
                padding: 20px;
            }
            
            .admin-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Header -->
        <div class="admin-header">
            <div class="logo-section">
                <h1>DRIYUM Admin</h1>
                <p>Dashboard</p>
            </div>
            <div class="user-section">
                <div class="username">
                    Welcome, <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?>
                </div>
                <a href="logout.php" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>

        <!-- Dashboard Stats -->
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-icon">📊</div>
                <h3 class="card-title">Total Subscribers</h3>
                <?php
                if ($conn) {
                    $result = $conn->query("SELECT COUNT(*) as total FROM subscribers WHERE status = 'active'");
                    $total = $result->fetch_assoc()['total'] ?? 0;
                    echo '<div class="card-value">' . $total . '</div>';
                } else {
                    echo '<div class="card-value">0</div>';
                }
                ?>
                <p class="card-description">Active newsletter subscribers</p>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">🚀</div>
                <h3 class="card-title">Today's Growth</h3>
                <?php
                if ($conn) {
                    $result = $conn->query("SELECT COUNT(*) as today FROM subscribers WHERE DATE(subscribed_at) = CURDATE() AND status = 'active'");
                    $today = $result->fetch_assoc()['today'] ?? 0;
                    echo '<div class="card-value">' . $today . '</div>';
                } else {
                    echo '<div class="card-value">0</div>';
                }
                ?>
                <p class="card-description">New subscribers today</p>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">📈</div>
                <h3 class="card-title">Growth Rate</h3>
                <div class="card-value">↑ 24%</div>
                <p class="card-description">Month over month growth</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2 class="section-title">Quick Actions</h2>
            <div class="actions-grid">
                <a href="subscribers.php" class="action-card">
                    <div class="action-icon">👥</div>
                    <h3 class="action-title">Manage Subscribers</h3>
                    <p class="action-description">View, manage, and export subscriber list</p>
                </a>

                <a href="../index.php" class="action-card">
                    <div class="action-icon">🌐</div>
                    <h3 class="action-title">View Website</h3>
                    <p class="action-description">Visit the main DRIYUM website</p>
                </a>

                <a href="#" class="action-card" onclick="alert('Coming Soon!')">
                    <div class="action-icon">⚙️</div>
                    <h3 class="action-title">Settings</h3>
                    <p class="action-description">Configure admin settings and preferences</p>
                </a>

                <a href="#" class="action-card" onclick="alert('Coming Soon!')">
                    <div class="action-icon">📊</div>
                    <h3 class="action-title">Analytics</h3>
                    <p class="action-description">View detailed analytics and reports</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>