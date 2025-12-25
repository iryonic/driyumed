<?php
// admin/subscribers.php
require_once 'config.php';
requireLogin();

$conn = initializeDatabase();

// Check if database connection is successful
if (!$conn) {
    die('<div style="padding: 20px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; margin: 20px;">
        <h3>Database Connection Error</h3>
        <p>Could not connect to the database. Please check:</p>
        <ol>
            <li>MySQL is running in XAMPP</li>
            <li>Database "driyum_newsletter" exists</li>
            <li>Username/password are correct in config.php</li>
        </ol>
        <p><a href="install.php">Click here to run database setup</a></p>
    </div>');
}

// Handle delete action
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM subscribers WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        
        header('Location: subscribers.php?deleted=1');
        exit;
    }
}

// Handle status toggle
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $id = intval($_GET['toggle']);
    $stmt = $conn->prepare("UPDATE subscribers SET status = IF(status = 'active', 'unsubscribed', 'active') WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        
        header('Location: subscribers.php?toggled=1');
        exit;
    }
}

// Get search query
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where_clause = '';
$params = [];
$types = '';

if ($search) {
    $where_clause = "WHERE email LIKE ? OR ip_address LIKE ?";
    $search_term = "%$search%";
    $params = [$search_term, $search_term];
    $types = 'ss';
}

// Get subscribers with pagination
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Get total count
$total_count = 0;
if ($where_clause) {
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM subscribers $where_clause");
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $total_row = $result->fetch_assoc();
    $total_count = $total_row['total'] ?? 0;
    $stmt->close();
} else {
    $total_result = $conn->query("SELECT COUNT(*) as total FROM subscribers");
    if ($total_result) {
        $total_row = $total_result->fetch_assoc();
        $total_count = $total_row['total'] ?? 0;
        $total_result->free();
    }
}
$total_pages = ceil($total_count / $limit);

// Get subscribers for current page
$subscribers = [];
$query = "SELECT * FROM subscribers $where_clause ORDER BY subscribed_at DESC LIMIT $limit OFFSET $offset";

if ($where_clause) {
    $stmt = $conn->prepare($query);
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $subscribers = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $result = $conn->query($query);
    if ($result) {
        $subscribers = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribers | DRIYUM Admin</title>
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
        
        .user-1 {
            animation: floatUser1 15s ease-in-out infinite;
            font-size: 60px;
            color: rgba(4, 202, 27, 1);
        }
        
        .user-2 {
            animation: floatUser2 20s ease-in-out infinite;
            font-size: 50px;
            color: rgba(4, 202, 27, 1);
        }
        
        @keyframes floatUser1 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -20px) rotate(10deg); }
            66% { transform: translate(-20px, 30px) rotate(-5deg); }
        }
        
        @keyframes floatUser2 {
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
        
        /* Table Styles */
        .table-row {
            transition: all 0.2s ease;
        }
        
        .table-row:hover {
            background: rgba(251, 191, 36, 0.05);
        }
        
        /* Status Badges */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-active {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
        }
        
        .status-unsubscribed {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }
        
        /* Action Buttons */
        .action-btn {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }
        
        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.2);
        }
        
        .btn-toggle {
            background: rgba(251, 191, 36, 0.1);
            color: #d97706;
        }
        
        .btn-toggle:hover {
            background: rgba(251, 191, 36, 0.2);
        }
        
        /* Pagination */
        .page-link {
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .page-link:hover {
            background: rgba(251, 191, 36, 0.1);
        }
        
        .page-link.active {
            background: #24fb93ff;
            color: #fff;
        }
        
        /* Search Input */
        .search-input:focus {
            border-color: #24fb93ff;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
        }
        
        /* Export Button */
        .export-btn {
            background: linear-gradient(135deg, #24fb93ff, #0bf55dff);
            transition: all 0.3s ease;
        }
        
        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(72, 251, 36, 0.3);
        }
        
        /* Loading Animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .loading-spinner {
            animation: spin 1s linear infinite;
        }
    </style>
</head>
<body class="bg-cream text-gray-900 min-h-screen">
    
    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="floating-element user-1" style="top: 10%; left: 5%;">👤</div>
        <div class="floating-element user-2" style="top: 20%; right: 8%;">📧</div>
        <div class="floating-element user-1" style="bottom: 15%; left: 10%;">👥</div>
        <div class="floating-element user-2" style="bottom: 25%; right: 15%;">📨</div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10">
        <!-- Header -->
        <nav class="glass-card sticky top-0 z-50 border-b border-green/20">
            <div class="container mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <!-- Logo & Navigation -->
                    <div class="flex items-center space-x-8">
                        <a href="index.php" class="logo-font text-2xl text-green">DRIYUM</a>
                        <div class="hidden md:flex items-center space-x-6">
                            <a href="index.php" class="text-gray-700 hover:text-green transition flex items-center">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                            <a href="subscribers.php" class="text-green font-bold border-b-2 border-green flex items-center">
                                <i class="fas fa-users mr-2"></i>Subscribers
                            </a>
                            <a href="export.php?type=csv" class="text-gray-700 hover:text-green transition flex items-center">
                                <i class="fas fa-file-export mr-2"></i>Export
                            </a>
                        </div>
                    </div>
                    
                    <!-- User Info & Actions -->
                    <div class="flex items-center space-x-4">
                        <div class="text-right hidden md:block">
                            <div class="font-medium text-gray-900"><?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?></div>
                            <div class="text-xs text-gray-500">Administrator</div>
                        </div>
                        <a href="logout.php" 
                           class="bg-green hover:bg-green-600 text-gray-900 font-medium py-2 px-4 rounded-lg transition flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container mx-auto px-6 py-8">
            <!-- Header with Stats -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Subscriber Management</h1>
                        <p class="text-gray-600">Manage all newsletter subscribers and their status</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gray-900"><?php echo $total_count; ?></div>
                            <div class="text-sm text-gray-600">Total Subscribers</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search & Actions Bar -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <!-- Search Form -->
                    <form method="GET" action="" class="flex-1">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="<?php echo htmlspecialchars($search); ?>"
                                   placeholder="Search by email or IP address..."
                                   class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl search-input focus:outline-none bg-white/50">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>
                            <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-green hover:text-green-600">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-3">
                        <?php if ($search): ?>
                            <a href="subscribers.php" class="action-btn btn-toggle flex items-center">
                                <i class="fas fa-times mr-2"></i>Clear Search
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($total_count > 0): ?>
                            <a href="export.php?type=csv<?php echo $search ? '&search=' . urlencode($search) : ''; ?>" 
                               class="export-btn text-gray-900 font-medium py-3 px-6 rounded-xl flex items-center">
                                <i class="fas fa-file-csv mr-2"></i>Export CSV
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Success Messages -->
            <?php if (isset($_GET['deleted'])): ?>
                <div class="bg-green-50 border border-green-200 text-green-600 px-6 py-4 rounded-xl mb-6 flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    Subscriber deleted successfully
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['toggled'])): ?>
                <div class="bg-green-50 border border-green-200 text-green-600 px-6 py-4 rounded-xl mb-6 flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    Subscriber status updated successfully
                </div>
            <?php endif; ?>

            <!-- Subscribers Table -->
            <div class="glass-card rounded-2xl overflow-hidden mb-8">
                <?php if ($total_count === 0): ?>
                    <!-- Empty State -->
                    <div class="p-12 text-center">
                        <div class="w-24 h-24 rounded-full bg-green/20 flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-users text-4xl text-green"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No subscribers yet</h3>
                        <p class="text-gray-600 mb-6">Subscribers will appear here once they sign up on your website.</p>
                        <a href="../index.php" target="_blank" class="inline-flex items-center bg-green hover:bg-green-600 text-gray-900 font-medium py-3 px-6 rounded-xl transition">
                            <i class="fas fa-external-link-alt mr-2"></i>Visit Website
                        </a>
                    </div>
                <?php else: ?>
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-4 px-6 text-sm text-gray-600 font-medium">ID</th>
                                    <th class="text-left py-4 px-6 text-sm text-gray-600 font-medium">Email Address</th>
                                    <th class="text-left py-4 px-6 text-sm text-gray-600 font-medium">Subscription Date</th>
                                    <th class="text-left py-4 px-6 text-sm text-gray-600 font-medium">IP Address</th>
                                    <th class="text-left py-4 px-6 text-sm text-gray-600 font-medium">Status</th>
                                    <th class="text-left py-4 px-6 text-sm text-gray-600 font-medium">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($subscribers as $subscriber): ?>
                                    <tr class="table-row border-b border-gray-100">
                                        <td class="py-4 px-6">
                                            <span class="text-gray-900 font-medium">#<?php echo $subscriber['id']; ?></span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-green/20 flex items-center justify-center mr-3">
                                                    <i class="fas fa-envelope text-green"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900"><?php echo htmlspecialchars($subscriber['email']); ?></div>
                                                    <?php if ($subscriber['user_agent']): ?>
                                                        <div class="text-xs text-gray-500 truncate max-w-xs">
                                                            <?php echo htmlspecialchars(substr($subscriber['user_agent'], 0, 50)); ?>...
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="text-sm text-gray-900"><?php echo date('M d, Y', strtotime($subscriber['subscribed_at'])); ?></div>
                                            <div class="text-xs text-gray-500"><?php echo date('h:i A', strtotime($subscriber['subscribed_at'])); ?></div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-sm text-gray-600"><?php echo htmlspecialchars($subscriber['ip_address']); ?></span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="status-badge <?php echo $subscriber['status'] == 'active' ? 'status-active' : 'status-unsubscribed'; ?>">
                                                <?php echo ucfirst($subscriber['status']); ?>
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center space-x-2">
                                                <a href="?toggle=<?php echo $subscriber['id']; ?>" 
                                                   class="action-btn btn-toggle flex items-center"
                                                   onclick="return confirm('Are you sure you want to toggle this subscriber\'s status?')">
                                                    <i class="fas fa-exchange-alt mr-1"></i> Toggle
                                                </a>
                                                <a href="?delete=<?php echo $subscriber['id']; ?>" 
                                                   class="action-btn btn-delete flex items-center"
                                                   onclick="return confirm('Are you sure you want to delete this subscriber? This action cannot be undone.')">
                                                    <i class="fas fa-trash mr-1"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if ($total_pages > 1): ?>
                        <div class="border-t border-gray-200 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-600">
                                    Showing <?php echo $offset + 1; ?>-<?php echo min($offset + $limit, $total_count); ?> of <?php echo $total_count; ?> subscribers
                                </div>
                                <div class="flex items-center space-x-2">
                                    <?php if ($page > 1): ?>
                                        <a href="?page=<?php echo $page - 1; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>" 
                                           class="page-link flex items-center">
                                            <i class="fas fa-chevron-left mr-2"></i> Previous
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php 
                                    $start_page = max(1, $page - 2);
                                    $end_page = min($total_pages, $page + 2);
                                    
                                    for ($i = $start_page; $i <= $end_page; $i++): 
                                    ?>
                                        <a href="?page=<?php echo $i; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>" 
                                           class="page-link <?php echo $i == $page ? 'active' : ''; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    <?php endfor; ?>
                                    
                                    <?php if ($page < $total_pages): ?>
                                        <a href="?page=<?php echo $page + 1; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>" 
                                           class="page-link flex items-center">
                                            Next <i class="fas fa-chevron-right ml-2"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <!-- Export Section -->
            <?php if ($total_count > 0): ?>
                <div class="glass-card rounded-2xl p-8 text-center bg-gradient-to-r from-green-50 to-green-100 border border-green/30">
                    <div class="max-w-2xl mx-auto">
                        <div class="w-16 h-16 rounded-full bg-green/20 flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-file-export text-3xl text-green"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Export Subscriber Data</h2>
                        <p class="text-gray-600 mb-8">Download your subscriber list in various formats for analysis and backup.</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="export.php?type=csv<?php echo $search ? '&search=' . urlencode($search) : ''; ?>" 
                               class="export-btn text-gray-900 font-medium py-3 px-8 rounded-xl flex items-center">
                                <i class="fas fa-file-csv mr-3"></i>CSV Format
                            </a>
                            <button onclick="alert('PDF export coming soon!')" 
                                    class="bg-gray-900 hover:bg-gray-800 text-white font-medium py-3 px-8 rounded-xl transition flex items-center">
                                <i class="fas fa-file-pdf mr-3"></i>PDF Format
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Confirm all delete actions
            const deleteButtons = document.querySelectorAll('a[href*="delete="]');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Are you sure you want to delete this subscriber? This action cannot be undone.')) {
                        e.preventDefault();
                    }
                });
            });
            
            // Confirm all toggle actions
            const toggleButtons = document.querySelectorAll('a[href*="toggle="]');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Are you sure you want to toggle this subscriber\'s status?')) {
                        e.preventDefault();
                    }
                });
            });
            
            // Search input focus
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.focus();
                
                // Clear search with Escape key
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        this.value = '';
                        this.form.submit();
                    }
                });
            }
            
            // Add loading state to export buttons
            const exportButtons = document.querySelectorAll('.export-btn');
            exportButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner loading-spinner mr-2"></i>Preparing Export...';
                    this.disabled = true;
                    
                    // Reset after 3 seconds (in case download doesn't trigger)
                    setTimeout(() => {
                        this.innerHTML = originalHTML;
                        this.disabled = false;
                    }, 3000);
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
            
            // Auto-hide success messages
            const successMessages = document.querySelectorAll('.bg-green-50');
            successMessages.forEach(message => {
                setTimeout(() => {
                    message.style.opacity = '0';
                    message.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        message.style.display = 'none';
                    }, 500);
                }, 5000);
            });
            
            // Add row hover effects
            const tableRows = document.querySelectorAll('.table-row');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(4px)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>
</html>