<?php
// admin/login.php
require_once 'config.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        $_SESSION['login_time'] = time();
        
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | DRIYUM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Fredoka+One&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        .logo-font { font-family: 'Fredoka One', cursive; }
        .bg-cream { background-color: #FFFBEB; }
        .bg-yellow { background-color: #24fb93ff; }
        .text-yellow { color: #24fb93ff; }
        .border-yellow { border-color: #24fb93ff; }
        
        /* Floating Elements */
        .floating-element {
            position: absolute;
            z-index: 0;
            opacity: 0.1;
        }
        
        .chip-1 {
            animation: floatChip1 15s ease-in-out infinite;
            font-size: 80px;
            color: rgba(4, 202, 27, 1);
        }
        
        .chip-2 {
            animation: floatChip2 20s ease-in-out infinite;
            font-size: 60px;
            color: rgba(4, 202, 27, 1);
        }
        
        .chip-3 {
            animation: floatChip3 25s ease-in-out infinite;
            font-size: 50px;
            color: #24fb93ff;
        }
        
        @keyframes floatChip1 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(40px, -30px) rotate(15deg); }
            66% { transform: translate(-30px, 40px) rotate(-10deg); }
        }
        
        @keyframes floatChip2 {
            0%, 100% { transform: translate(0, 0) rotate(45deg); }
            50% { transform: translate(-50px, 30px) rotate(75deg); }
        }
        
        @keyframes floatChip3 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, 50px) scale(1.3); }
        }
        
        /* Glass Morphism */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        /* Input Focus */
        .input-focus:focus {
            border-color: #24fb93ff;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
        }
        
        /* Button Hover */
        .btn-hover {
            transition: all 0.3s ease;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(251, 191, 36, 0.3);
        }
        
        /* Error Animation */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-cream text-gray-900 min-h-screen flex items-center justify-center p-4">
    
    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="floating-element chip-1" style="top: 10%; left: 5%;">🍟</div>
        <div class="floating-element chip-2" style="top: 20%; right: 8%;">🌶️</div>
        <div class="floating-element chip-3" style="bottom: 15%; left: 10%;">🧀</div>
        <div class="floating-element chip-1" style="bottom: 25%; right: 15%;">🍿</div>
        <div class="floating-element chip-2" style="top: 50%; left: 20%;">🥨</div>
    </div>

    <!-- Login Container -->
    <div class="relative z-10 w-full max-w-md">
        <div class="glass-card rounded-3xl p-8">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="logo-font text-4xl text-yellow mb-2">DRIYUM</div>
                <p class="text-gray-600">Admin Portal</p>
            </div>
            
            <!-- Error Message -->
            <?php if ($error): ?>
                <div id="errorMessage" class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-6 text-center shake">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <!-- Login Form -->
            <form method="POST" action="" id="loginForm">
                <div class="space-y-6">
                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-gray-700 text-sm font-medium mb-2">
                            <i class="fas fa-user mr-2 text-yellow"></i>Username
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="username" 
                                name="username" 
                                required 
                                placeholder="Enter admin username"
                                value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                                class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl input-focus focus:outline-none bg-white/50"
                            >
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-gray-700 text-sm font-medium mb-2">
                            <i class="fas fa-lock mr-2 text-yellow"></i>Password
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required 
                                placeholder="Enter password"
                                class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl input-focus focus:outline-none bg-white/50"
                            >
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-key"></i>
                            </div>
                            <button type="button" id="togglePassword" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-yellow">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" 
                            id="submitBtn"
                            class="w-full bg-yellow hover:bg-yellow-600 text-gray-900 font-bold py-4 px-8 rounded-xl btn-hover transition-all duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                    </button>
                </div>
            </form>
            
            <!-- Back Link -->
            <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                <a href="../index.php" class="text-gray-600 hover:text-yellow transition flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Main Site
                </a>
            </div>
            
            <!-- Security Notice -->
            <div class="mt-6 p-4 bg-yellow/10 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-shield-alt text-yellow mt-1 mr-3"></i>
                    <p class="text-sm text-gray-600">
                        This area is restricted to authorized personnel only. All activities are logged.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
            
            // Form submission enhancement
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            
            loginForm.addEventListener('submit', function() {
                // Add loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Signing In...';
                submitBtn.disabled = true;
            });
            
            // Auto focus on username
            document.getElementById('username').focus();
            
            // Remove error message after 5 seconds
            const errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.opacity = '0';
                    errorMessage.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        errorMessage.style.display = 'none';
                    }, 500);
                }, 5000);
            }
            
            // Add floating animation to chips on hover
            const chips = document.querySelectorAll('.floating-element');
            chips.forEach(chip => {
                chip.addEventListener('mouseenter', function() {
                    this.style.opacity = '0.3';
                });
                
                chip.addEventListener('mouseleave', function() {
                    this.style.opacity = '0.1';
                });
            });
        });
    </script>
</body>
</html>

