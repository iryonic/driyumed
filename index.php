<?php
    require_once './admin/config.php';
    $conn = getDBConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found | DRIVUM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Fredoka+One&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        .logo-font { font-family: 'Fredoka One', cursive; }
        .bg-cream { background-color: #FFFBEB; }
        .bg-green { background-color: #19dc7eff; }
        .text-green { color: #18cd75ff; }
        
        .fruit-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>
<body class="bg-cream text-gray-900 min-h-screen flex flex-col">
    <!-- Navigation
    <nav class="bg-white/80 backdrop-blur-md shadow-sm border-b border-green/20">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
                        <a href="#" class="logo-font w-screen  text-3xl text-green flex  m-auto justify-centerx"><img src="singlelogo.png" alt="Driyum Logo" width="110"></a>

          
            </a>
        </div>
    </nav> -->

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center px-4">
        <div class="text-center max-w-2xl">
            <!-- Animated Fruit -->
            <div class="fruit-animation text-8xl mb-8">
                <div class="relative inline-block">
                    <div class="w-32 h-32 bg-gradient-to-br from-red-300 to-red-400 rounded-full flex items-center justify-center shadow-lg">
                        <div class="text-5xl text-white">404</div>
                    </div>
                    <div class="absolute -top-4 -right-4 w-10 h-10 bg-green rounded-full"></div>
                    <div class="absolute -bottom-4 -left-4 w-8 h-8 bg-yellow-400 rounded-full"></div>
                </div>
            </div>

            <!-- Error Message -->
            <h1 class="text-5xl md:text-6xl font-black mb-6">
                Oops! <span class="text-green">Page Not Found</span>
            </h1>
            
            <p class="text-xl text-gray-600 mb-10 max-w-lg mx-auto">
                The page you're looking will be avialable at 10pm Today ! 
              
            </p>

          

           
        </div>
    </main>

    

    <script>
        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            const fruit = document.querySelector('.fruit-animation');
            
            fruit.addEventListener('mouseenter', () => {
                fruit.style.animationDuration = '2s';
            });
            
            fruit.addEventListener('mouseleave', () => {
                fruit.style.animationDuration = '6s';
            });
        });
    </script>
</body>
</html>