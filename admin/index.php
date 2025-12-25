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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Fredoka+One&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        .logo-font { font-family: 'Fredoka One', cursive; }
        .bg-cream { background-color: #FFFBEB; }
        .bg-green { background-color: #24fb93ff; }
        .text-green { color: #24fb93ff; }
        .border-green { border-color: #24fb93ff; }
        
        /* Floating Elements */
        .floating-element {
            position: fixed;
            z-index: 0;
            opacity: 0.05;
        }
        
        .data-1 {
            animation: floatData1 15s ease-in-out infinite;
            font-size: 60px;
            color: rgba(4, 202, 27, 1);
        }
        
        .data-2 {
            animation: floatData2 20s ease-in-out infinite;
            font-size: 50px;
            color: rgba(4, 202, 27, 1);
        }
        
        @keyframes floatData1 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -20px) rotate(10deg); }
            66% { transform: translate(-20px, 30px) rotate(-5deg); }
        }
        
        @keyframes floatData2 {
            0%, 100% { transform: translate(0, 0) rotate(45deg); }
            50% { transform: translate(-40px, 20px) rotate(60deg); }
        }
        
        /* Glass Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        /* Card Hover Effects */
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(251, 191, 36, 0.15);
        }
        
        .action-card {
            transition: all 0.3s ease;
        }
        
        .action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(251, 191, 36, 0.1);
        }
        
        /* Chart Colors */
        .chart-bar {
            background: linear-gradient(to top, #24fb93ff, #F59E0B);
            transition: height 0.5s ease;
        }
        
        /* Status Badges */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-active {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
        }
        
        .status-pending {
            background: rgba(251, 191, 36, 0.1);
            color: #d97706;
        }
        
        /* Loading Animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .loading-pulse {
            animation: pulse 1.5s infinite;
        }
    </style>
</head>
<body class="bg-cream text-gray-900 min-h-screen">
    
    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="floating-element data-1" style="top: 10%; left: 5%;">📊</div>
        <div class="floating-element data-2" style="top: 20%; right: 8%;">📈</div>
        <div class="floating-element data-1" style="bottom: 15%; left: 10%;">👥</div>
        <div class="floating-element data-2" style="bottom: 25%; right: 15%;">🚀</div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10">
        <!-- Header -->
        <nav class="glass-card sticky top-0 z-50 border-b border-green/20">
            <div class="container mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <div class="flex items-center space-x-4">
                        <div class="logo-font text-2xl text-green">DRIYUM</div>
                        <div class="text-sm text-gray-600">Admin Dashboard</div>
                    </div>
                    
                    <!-- User Info -->
                    <div class="flex items-center space-x-6">
                        <div class="text-right hidden md:block">
                            <div class="font-medium text-gray-900"><?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?></div>
                            <div class="text-xs text-gray-500">Administrator</div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <!-- Notification Bell -->
                            <button class="relative p-2 text-gray-600 hover:text-green transition">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                            
                            <!-- Logout -->
                            <a href="logout.php" 
                               class="bg-green hover:bg-green-600 text-gray-900 font-medium py-2 px-4 rounded-lg transition flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar & Main Content -->
        <div class="container mx-auto px-6 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar -->
                <div class="lg:w-1/5">
                    <div class="glass-card rounded-2xl p-6 mb-6">
                        <nav class="space-y-2">
                            <a href="index.php" class="flex items-center space-x-3 p-3 rounded-lg bg-green/10 text-green font-medium">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="subscribers.php" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-green/5 text-gray-700 hover:text-green transition">
                                <i class="fas fa-users"></i>
                                <span>Subscribers</span>
                                <?php if ($conn): 
                                    $result = $conn->query("SELECT COUNT(*) as count FROM subscribers");
                                    $count = $result->fetch_assoc()['count'] ?? 0;
                                ?>
                                    <span class="ml-auto bg-green/20 text-green text-xs px-2 py-1 rounded-full">
                                        <?php echo $count; ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-green/5 text-gray-700 hover:text-green transition">
                                <i class="fas fa-chart-line"></i>
                                <span>Analytics</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-green/5 text-gray-700 hover:text-green transition">
                                <i class="fas fa-cog"></i>
                                <span>Settings</span>
                            </a>
                            <a href="../index.php" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-green/5 text-gray-700 hover:text-green transition">
                                <i class="fas fa-external-link-alt"></i>
                                <span>View Site</span>
                            </a>
                        </nav>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="glass-card rounded-2xl p-6">
                        <h3 class="font-bold text-gray-900 mb-4">System Status</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Database</span>
                                <span class="status-badge status-active">Connected</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Last Login</span>
                                <span class="text-sm text-gray-900"><?php echo date('M d, Y'); ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Uptime</span>
                                <span class="text-sm text-gray-900">100%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:w-4/5">
                    <!-- Welcome Banner -->
                    <div class="glass-card rounded-2xl p-6 mb-8 bg-gradient-to-r from-green-50 to-green-100 border border-green/30">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 mb-2">
                                    Welcome back, <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?>!
                                </h1>
                                <p class="text-gray-600">Here's what's happening with your DRIYUM platform today.</p>
                            </div>
                            <div class="text-4xl">👋</div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Total Subscribers -->
                        <div class="stat-card glass-card rounded-2xl p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-green/20 flex items-center justify-center">
                                    <i class="fas fa-users text-2xl text-green"></i>
                                </div>
                                <div class="text-right">
                                    <?php
                                    if ($conn) {
                                        $result = $conn->query("SELECT COUNT(*) as total FROM subscribers WHERE status = 'active'");
                                        $total = $result->fetch_assoc()['total'] ?? 0;
                                        echo '<div class="text-3xl font-bold text-gray-900">' . $total . '</div>';
                                    } else {
                                        echo '<div class="text-3xl font-bold text-gray-900">0</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <h3 class="font-medium text-gray-900 mb-2">Total Subscribers</h3>
                            <p class="text-sm text-gray-600">Active newsletter subscribers</p>
                        </div>

                        <!-- Today's Growth -->
                        <div class="stat-card glass-card rounded-2xl p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-chart-line text-2xl text-green-600"></i>
                                </div>
                                <div class="text-right">
                                    <?php
                                    if ($conn) {
                                        $result = $conn->query("SELECT COUNT(*) as today FROM subscribers WHERE DATE(subscribed_at) = CURDATE() AND status = 'active'");
                                        $today = $result->fetch_assoc()['today'] ?? 0;
                                        echo '<div class="text-3xl font-bold text-gray-900">' . $today . '</div>';
                                    } else {
                                        echo '<div class="text-3xl font-bold text-gray-900">0</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <h3 class="font-medium text-gray-900 mb-2">Today's Growth</h3>
                            <p class="text-sm text-gray-600">New subscribers today</p>
                        </div>

                        <!-- Growth Rate -->
                        <div class="stat-card glass-card rounded-2xl p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-arrow-up text-2xl text-blue-600"></i>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-green-600">+24%</div>
                                </div>
                            </div>
                            <h3 class="font-medium text-gray-900 mb-2">Growth Rate</h3>
                            <p class="text-sm text-gray-600">Month over month</p>
                        </div>

                        <!-- Engagement -->
                        <div class="stat-card glass-card rounded-2xl p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-heart text-2xl text-purple-600"></i>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-gray-900">89%</div>
                                </div>
                            </div>
                            <h3 class="font-medium text-gray-900 mb-2">Engagement</h3>
                            <p class="text-sm text-gray-600">Average open rate</p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <a href="subscribers.php" class="action-card glass-card rounded-2xl p-6 text-center hover:bg-green/5 transition">
                                <div class="w-16 h-16 rounded-xl bg-green/20 flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-users text-2xl text-green"></i>
                                </div>
                                <h3 class="font-medium text-gray-900 mb-2">Manage Subscribers</h3>
                                <p class="text-sm text-gray-600">View and manage all subscribers</p>
                            </a>

                            <a href="export.php?type=csv" class="action-card glass-card rounded-2xl p-6 text-center hover:bg-green/5 transition">
                                <div class="w-16 h-16 rounded-xl bg-green-100 flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-file-export text-2xl text-green-600"></i>
                                </div>
                                <h3 class="font-medium text-gray-900 mb-2">Export Data</h3>
                                <p class="text-sm text-gray-600">Export subscribers to CSV</p>
                            </a>

                            <a href="../index.php" target="_blank" class="action-card glass-card rounded-2xl p-6 text-center hover:bg-green/5 transition">
                                <div class="w-16 h-16 rounded-xl bg-blue-100 flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-eye text-2xl text-blue-600"></i>
                                </div>
                                <h3 class="font-medium text-gray-900 mb-2">View Website</h3>
                                <p class="text-sm text-gray-600">Visit the live site</p>
                            </a>

                            <a href="#" onclick="alert('Coming Soon!')" class="action-card glass-card rounded-2xl p-6 text-center hover:bg-green/5 transition">
                                <div class="w-16 h-16 rounded-xl bg-purple-100 flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-cog text-2xl text-purple-600"></i>
                                </div>
                                <h3 class="font-medium text-gray-900 mb-2">Settings</h3>
                                <p class="text-sm text-gray-600">Configure system settings</p>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="glass-card rounded-2xl p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-900">Recent Subscribers</h2>
                            <a href="subscribers.php" class="text-green hover:text-green-600 font-medium text-sm">
                                View All <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-4 text-sm text-gray-600 font-medium">Email</th>
                                        <th class="text-left py-3 px-4 text-sm text-gray-600 font-medium">Date</th>
                                        <th class="text-left py-3 px-4 text-sm text-gray-600 font-medium">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($conn) {
                                        $result = $conn->query("SELECT email, subscribed_at, status FROM subscribers ORDER BY subscribed_at DESC LIMIT 5");
                                        while ($row = $result->fetch_assoc()):
                                    ?>
                                        <tr class="border-b border-gray-100 hover:bg-green/5">
                                            <td class="py-3 px-4">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-full bg-green/20 flex items-center justify-center mr-3">
                                                        <i class="fas fa-user text-green text-sm"></i>
                                                    </div>
                                                    <span class="font-medium"><?php echo htmlspecialchars($row['email']); ?></span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4 text-sm text-gray-600">
                                                <?php echo date('M d, Y', strtotime($row['subscribed_at'])); ?>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="status-badge <?php echo $row['status'] == 'active' ? 'status-active' : 'bg-gray-100 text-gray-600'; ?>">
                                                    <?php echo ucfirst($row['status']); ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php 
                                        endwhile;
                                        $result->free();
                                    } else {
                                        echo '<tr><td colspan="3" class="py-8 text-center text-gray-500">No data available</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update current time
            function updateTime() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('en-US', { 
                    hour: '2-digit', 
                    minute: '2-digit',
                    hour12: true 
                });
                const dateString = now.toLocaleDateString('en-US', { 
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                
                // You could update a time element if you add one
            }
            
            // Update time every minute
            updateTime();
            setInterval(updateTime, 60000);
            
            // Add click effects to cards
            const cards = document.querySelectorAll('.stat-card, .action-card');
            cards.forEach(card => {
                card.addEventListener('mousedown', function() {
                    this.style.transform = 'scale(0.98)';
                });
                
                card.addEventListener('mouseup', function() {
                    this.style.transform = '';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                });
            });
            
            // Floating element interactions
            const floatingElements = document.querySelectorAll('.floating-element');
            floatingElements.forEach(el => {
                el.addEventListener('mouseenter', function() {
                    this.style.opacity = '0.2';
                });
                
                el.addEventListener('mouseleave', function() {
                    this.style.opacity = '0.05';
                });
            });
            
            // Notification bell animation
            const notificationBell = document.querySelector('.fa-bell').parentElement;
            let bellAnimation = false;
            
            notificationBell.addEventListener('click', function() {
                if (!bellAnimation) {
                    bellAnimation = true;
                    this.style.transform = 'rotate(20deg)';
                    setTimeout(() => {
                        this.style.transform = 'rotate(-20deg)';
                        setTimeout(() => {
                            this.style.transform = '';
                            bellAnimation = false;
                        }, 200);
                    }, 200);
                }
            });
        });
    </script>
</body>
</html>