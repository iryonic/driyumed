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

// Get subscribers with pagination
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Get total count
$total_count = 0;
$total_result = $conn->query("SELECT COUNT(*) as total FROM subscribers");
if ($total_result) {
    $total_row = $total_result->fetch_assoc();
    $total_count = $total_row['total'] ?? 0;
    $total_result->free();
}
$total_pages = ceil($total_count / $limit);

// Get subscribers for current page
$subscribers = [];
$query = "SELECT * FROM subscribers ORDER BY subscribed_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

if ($result) {
    $subscribers = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribers | DRIYUM Admin</title>
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

        .nav-links {
            display: flex;
            gap: 15px;
        }

        .nav-link {
            color: var(--soft-cream);
            text-decoration: none;
            opacity: 0.7;
            transition: opacity 0.3s;
            font-size: 0.9rem;
        }

        .nav-link:hover {
            opacity: 1;
            color: var(--gold-accent);
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

        /* Table Container */
        .table-container {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        thead th {
            text-align: left;
            padding: 16px 12px;
            border-bottom: 1px solid var(--glass-border);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.8rem;
            opacity: 0.7;
        }

        tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background 0.3s;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        tbody td {
            padding: 20px 12px;
            vertical-align: middle;
        }

        .email-cell {
            font-weight: 500;
        }

        .date-cell {
            font-size: 0.9rem;
            opacity: 0.7;
            white-space: nowrap;
        }

        .actions-cell {
            white-space: nowrap;
        }

        .btn-delete {
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.3);
            color: #fca5a5;
            padding: 6px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.8rem;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-delete:hover {
            background: rgba(220, 38, 38, 0.2);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .page-link {
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            color: var(--soft-cream);
            text-decoration: none;
            transition: all 0.3s;
        }

        .page-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--gold-accent);
        }

        .page-link.active {
            background: linear-gradient(135deg, var(--gold-accent), var(--fresh-leaf));
            color: var(--dark-emerald);
            font-weight: 600;
        }

        /* Export Section */
        .export-section {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-top: 40px;
        }

        .export-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--soft-cream);
        }

        .export-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-export {
            background: linear-gradient(135deg, var(--gold-accent), var(--fresh-leaf));
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            color: var(--dark-emerald);
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
        }

        /* Success Message */
        .success-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 30px;
            text-align: center;
            color: #86efac;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            opacity: 0.7;
        }

        /* Database Setup Link */
        .setup-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--gold-accent), var(--fresh-leaf));
            color: var(--dark-emerald);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }

        .setup-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
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
            
            .user-section {
                flex-direction: column;
                gap: 15px;
            }
            
            .table-container {
                padding: 20px 15px;
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
                <p>Subscriber Management</p>
            </div>
            <div class="user-section">
                <div class="nav-links">
                    <a href="index.php" class="nav-link">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="subscribers.php" class="nav-link">
                        <i class="fas fa-users"></i> Subscribers
                    </a>
                </div>
                <div class="username">
                    <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?>
                </div>
                <a href="logout.php" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>

        <?php if (isset($_GET['deleted'])): ?>
            <div class="success-message">
                Subscriber deleted successfully
            </div>
        <?php endif; ?>

        <!-- Subscribers Table -->
        <div class="table-container">
            <?php if ($total_count === 0): ?>
                <div class="empty-state">
                    <h3>No subscribers yet</h3>
                    <p>Subscribers will appear here once they sign up on your website.</p>
                    <p>Try submitting a test subscription on the main page.</p>
                    
                    <?php if (!$conn): ?>
                        <p style="color: #fca5a5; margin-top: 20px;">
                            <strong>Database Issue Detected:</strong> The database connection failed.
                        </p>
                        <a href="install.php" class="setup-link">
                            <i class="fas fa-database"></i> Run Database Setup
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email Address</th>
                            <th>Subscription Date</th>
                            <th>IP Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subscribers as $subscriber): ?>
                            <tr>
                                <td><?php echo $subscriber['id']; ?></td>
                                <td class="email-cell"><?php echo htmlspecialchars($subscriber['email']); ?></td>
                                <td class="date-cell">
                                    <?php echo date('M d, Y h:i A', strtotime($subscriber['subscribed_at'])); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($subscriber['ip_address']); ?>
                                </td>
                                <td class="actions-cell">
                                    <a href="?delete=<?php echo $subscriber['id']; ?>" 
                                       class="btn-delete"
                                       onclick="return confirm('Are you sure you want to delete this subscriber?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <div class="pagination">
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="?page=<?php echo $i; ?>" 
                               class="page-link <?php echo $i == $page ? 'active' : ''; ?>">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Export Section -->
        <div class="export-section">
            <h2 class="export-title">Export Subscribers</h2>
            <div class="export-buttons">
                <?php if ($total_count > 0): ?>
                    <a href="export.php?type=csv" class="btn-export">
                        <i class="fas fa-file-csv"></i> Export as CSV
                    </a>
                    <a href="export.php?type=pdf" class="btn-export" onclick="alert('PDF export coming soon!')">
                        <i class="fas fa-file-pdf"></i> Export as PDF
                    </a>
                <?php else: ?>
                    <p style="opacity: 0.7;">No subscribers to export yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Confirm before deletion
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-delete')) {
                if (!confirm('Are you sure you want to delete this subscriber?')) {
                    e.preventDefault();
                }
            }
        });
    </script>
</body>
</html>