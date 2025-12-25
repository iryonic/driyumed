<?php
    require_once './admin/config.php';
    $conn = getDBConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIYUM | Coming Soon - Premium Plant-Based Snacks</title>
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
        .border-green { border-color: #12e17dff; }
        
        /* Floating Fruit Animations */
        .floating-fruit {
            position: absolute;
            z-index: 0;
            opacity: 0.7;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));
        }
        .text-beiges{
            color: beige;
        }
        
        .apple {
            animation: floatApple 20s ease-in-out infinite;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, #ff6b6b 0%, #ff4757 100%);
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            box-shadow: 
                inset -10px -10px 20px rgba(0,0,0,0.1),
                inset 10px 10px 20px rgba(255,255,255,0.3);
        }
        
        .banana {
            animation: floatBanana 25s ease-in-out infinite;
            width: 120px;
            height: 60px;
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            border-radius: 60% 40% 40% 60% / 50% 50% 50% 50%;
            transform: rotate(45deg);
            box-shadow: 
                inset -8px -8px 15px rgba(0,0,0,0.1),
                inset 8px 8px 15px rgba(255,255,255,0.3);
        }
        
        .kiwi {
            animation: floatKiwi 22s ease-in-out infinite;
            width: 90px;
            height: 90px;
            background: radial-gradient(circle, #78e08f 0%, #38ada9 100%);
            border-radius: 50%;
            box-shadow: 
                inset -8px -8px 15px rgba(0,0,0,0.1),
                inset 8px 8px 15px rgba(255,255,255,0.3);
        }
        
        .kiwi::after {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            width: 20px;
            height: 20px;
            background: #000;
            border-radius: 50%;
            opacity: 0.3;
        }
        
        /* Floating Animations */
        @keyframes floatApple {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(20px, -15px) rotate(5deg); }
            50% { transform: translate(-15px, 10px) rotate(-5deg); }
            75% { transform: translate(10px, -20px) rotate(3deg); }
        }
        
        @keyframes floatBanana {
            0%, 100% { transform: translate(0, 0) rotate(45deg); }
            33% { transform: translate(-25px, 15px) rotate(50deg); }
            66% { transform: translate(20px, -10px) rotate(40deg); }
        }
        
        @keyframes floatKiwi {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(-20px, 15px) scale(1.05); }
            50% { transform: translate(15px, -20px) scale(0.95); }
            75% { transform: translate(-15px, -10px) scale(1.02); }
        }
        
        /* Bounce animation for CTA */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .bounce-animation {
            animation: bounce 2s infinite;
        }
        
        /* Pulse animation for button */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        /* Glass morphism effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-cream text-gray-900 overflow-x-hidden">
    
    <!-- Floating Fruits Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="floating-fruit apple" style="top: 10%; left: 5%;"></div>
        <div class="floating-fruit banana" style="top: 20%; right: 8%;"></div>
        <div class="floating-fruit kiwi" style="bottom: 15%; left: 10%;"></div>
        <div class="floating-fruit apple" style="bottom: 25%; right: 15%; width: 80px; height: 80px;"></div>
        <div class="floating-fruit banana" style="top: 40%; left: 15%; width: 100px; height: 50px;"></div>
        <div class="floating-fruit kiwi" style="top: 60%; right: 20%; width: 70px; height: 70px;"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-10 bg-white/80 backdrop-blur-md shadow-sm border-b border-green/20">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="#" class="logo-font text-3xl text-green">DRIYUM</a>
            <div class="flex items-center space-x-4">
                <a href="admin/login.php" class="text-gray-700 hover:text-green font-medium transition">
                    <i class="fas fa-lock mr-1"></i> Admin
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="relative z-10">
        <!-- Hero Section -->
        <section class="container mx-auto px-4 py-16 md:py-24">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-block mb-6">
                    <span class="bg-green text-gray-900 px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wider">
                        Coming Soon
                    </span>
                </div>
                
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black mb-6 text-gray-900 leading-tight">
                   YOUR NEW HEALTHY
                    <span class="text-green block bounce-animation">HABBIT!</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-gray-700 mb-10 max-w-2xl mx-auto">
                    We're crafting something extraordinary! Premium plant-based snacks that are better for you and tastier than ever.
                </p>
                
                <div class="flex items-center justify-center space-x-4 mb-16">
                    <div class="flex items-center">
                        <i class="fas fa-leaf text-green-500 text-2xl mr-2"></i>
                        <span class="font-semibold">100% Plant-Based</span>
                    </div>
                    <div class="w-2 h-2 bg-green rounded-full"></div>
                    <div class="flex items-center">
                        <i class="fas fa-heart text-red-400 text-2xl mr-2"></i>
                        <span class="font-semibold">Healthy & Delicious</span>
                    </div>
                    <div class="w-2 h-2 bg-green rounded-full"></div>
                    <div class="flex items-center">
                        <i class="fas fa-recycle text-blue-400 text-2xl mr-2"></i>
                        <span class="font-semibold">Eco-Friendly</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Signup Section -->
        <section class="container mx-auto px-4 py-12">
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-green/20">
                    <div class="p-8 md:p-12">
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 rounded-full bg-green/20 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-envelope-open-text text-4xl text-green"></i>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                                Be The First To Know!
                            </h2>
                            <p class="text-gray-600 text-lg">
                                Join our exclusive newsletter and get early access, special offers, and a surprise gift when we launch!
                            </p>
                        </div>
                        
                        <!-- Newsletter Form -->
                        <form id="newsletterForm" class="space-y-4">
                            <div class="relative">
                                <input 
                                    type="email" 
                                    id="emailInput"
                                    placeholder="Enter your email address" 
                                    class="w-full p-4 pl-12 border-2 border-gray-300 rounded-xl focus:border-green focus:outline-none text-lg"
                                    required
                                >
                                <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-xl"></i>
                            </div>
                            
                            <div id="formMessage" class="hidden p-4 rounded-lg"></div>
                            
                            <button 
                                type="submit" 
                                id="submitBtn"
                                class="w-full bg-green hover:bg-green-600 text-gray-900 font-bold py-4 px-8 rounded-xl transition-all duration-300 text-lg  flex items-center justify-center"
                            >
                                <i class="fas fa-gift mr-3"></i>
                                <span>Join to get Notified</span>
                            </button>
                            
                            <p class="text-center text-gray-500 text-sm mt-4">
                                    We Respect Your Privacy <br> No spam, ever.
                            </p>
                        </form>
                        
                        <!-- Stats -->
                        <div class="mt-12 pt-8 border-t border-gray-200">
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <div class="text-3xl font-bold text-green" id="subscriberCount">
                                         <?php
                if ($conn) {
                    $result = $conn->query("SELECT COUNT(*) as today FROM subscribers WHERE DATE(subscribed_at) = CURDATE() AND status = 'active'");
                    $today = $result->fetch_assoc()['today'] ?? 0;
                    echo '<div class="card-value">' . $today . '</div>';
                } 
                ?>
                                    </div>
                                    <div class="text-gray-600 text-sm">Already Joined</div>
                                </div>
                                <div>
                                    <div class="text-3xl font-bold text-green" id="daysLeft">00</div>
                                    <div class="text-gray-600 text-sm">Days To Launch</div>
                                </div>
                                <div>
                                    <div class="text-3xl font-bold text-green" id="earlyAccess">50%</div>
                                    <div class="text-gray-600 text-sm">Early Access Spots</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <section class="container mx-auto px-4 py-16">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Our <span class="text-green">Story</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Born from a passion for delicious, healthy snacks and a commitment to our planet.
                    </p>
                </div>
                
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="space-y-8">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-xl bg-green/20 flex items-center justify-center">
                                    <i class="fas fa-seedling text-green text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Fruits-Powered Goodness</h3>
                                <p class="text-gray-600">
                                    We believe snacks should nourish your body while delighting your taste buds. Every ingredient is carefully selected for both flavor and nutrition.
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-xl bg-green/20 flex items-center justify-center">
                                    <i class="fas fa-globe-americas text-green text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Sustainable from Start to Finish</h3>
                                <p class="text-gray-600">
                                    From eco-friendly packaging to responsible sourcing, we're committed to minimizing our environmental footprint at every step.
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-xl bg-green/20 flex items-center justify-center">
                                    <i class="fas fa-heart text-green text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Crafted with Love</h3>
                                <p class="text-gray-600">
                                    Each recipe is perfected through countless trials, ensuring every crunch delivers maximum flavor and satisfaction.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="bg-gradient-to-br from-green-100 to-green-50 rounded-3xl p-8 card-shadow">
                            <div class="relative">
                                <div class="text-center">
                                    <div class="text-8xl mb-4">🌱</div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
                                    <p class="text-gray-700 text-lg italic">
                                        "To revolutionize snacking by creating irresistibly delicious plant-based treats that are good for you and kind to our planet."
                                    </p>
                                    <div class="mt-6 flex items-center justify-center space-x-2">
                                        <div class="w-3 h-3 bg-green rounded-full"></div>
                                        <div class="w-3 h-3 bg-green rounded-full animate-pulse"></div>
                                        <div class="w-3 h-3 bg-green rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Countdown Timer -->
        <!-- <section class="container mx-auto px-4 py-12">
            <div class="max-w-3xl mx-auto">
                <div class="bg-gradient-to-r from-green-400 to-green-300 rounded-3xl p-8 text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Launching In</h3>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="bg-white/90 rounded-xl p-4">
                            <div class="text-4xl font-bold text-gray-900" id="countdown-days">00</div>
                            <div class="text-gray-600 text-sm">Days</div>
                        </div>
                        <div class="bg-white/90 rounded-xl p-4">
                            <div class="text-4xl font-bold text-gray-900" id="countdown-hours">00</div>
                            <div class="text-gray-600 text-sm">Hours</div>
                        </div>
                        <div class="bg-white/90 rounded-xl p-4">
                            <div class="text-4xl font-bold text-gray-900" id="countdown-minutes">00</div>
                            <div class="text-gray-600 text-sm">Minutes</div>
                        </div>
                        <div class="bg-white/90 rounded-xl p-4">
                            <div class="text-4xl font-bold text-gray-900" id="countdown-seconds">00</div>
                            <div class="text-gray-600 text-sm">Seconds</div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    </main>

    <!-- Footer -->
    <footer class="relative z-10 bg-gray-900 text-white pt-12 pb-8">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h3 class="logo-font text-2xl text-beiges mb-4 flex justify-center items-center gap-2"><img src="logo.png" alt="" width="50"> DRIYUM</h3>
                <p class="text-gray-400 mb-6">Premium plant-based snacks coming soon to revolutionize your snacking experience.</p>
                <div class="flex justify-center space-x-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-green hover:text-gray-900 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-green hover:text-gray-900 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-green hover:text-gray-900 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-center items-center">
                    <div class="text-gray-500 text-sm mb-4 md:mb-0">
                        © <?php
    echo date('Y');
                        ?> DRIYUM. All rights reserved.
                    </div>
                  
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Newsletter Form Submission
        document.getElementById('newsletterForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const email = document.getElementById('emailInput').value;
            const submitBtn = document.getElementById('submitBtn');
            const messageDiv = document.getElementById('formMessage');
            
            // Basic email validation
            if (!validateEmail(email)) {
                showMessage('Please enter a valid email address', 'error');
                return;
            }
            
            // Change button state
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Subscribing...';
            submitBtn.disabled = true;
            
            try {
                // Send to your backend subscribe.php
                const response = await fetch('subscribe.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `email=${encodeURIComponent(email)}`
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showMessage(data.message, 'success');
                    document.getElementById('emailInput').value = '';
                    
                    // Update subscriber count
                    const countElement = document.getElementById('subscriberCount');
                    let currentCount = parseInt(countElement.textContent);
                    countElement.textContent = currentCount + 1;
                    
                    // Update early access spots
                    const spotsElement = document.getElementById('earlyAccess');
                    let spots = parseInt(spotsElement.textContent);
                    if (spots > 10) {
                        spotsElement.textContent = (spots - 1) + '%';
                    }
                } else {
                    showMessage(data.message, 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showMessage('Something went wrong. Please try again.', 'error');
            } finally {
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
        
        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
        
        function showMessage(text, type) {
            const messageDiv = document.getElementById('formMessage');
            messageDiv.textContent = text;
            messageDiv.className = 'p-4 rounded-lg';
            
            if (type === 'success') {
                messageDiv.classList.add('bg-green-100', 'text-green-700', 'border', 'border-green-200');
            } else if (type === 'error') {
                messageDiv.classList.add('bg-red-100', 'text-red-700', 'border', 'border-red-200');
            }
            
            messageDiv.classList.remove('hidden');
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                messageDiv.classList.add('hidden');
            }, 5000);
        }
        
        // Countdown Timer
        function updateCountdown() {
            // Set launch date (30 days from now)
            const launchDate = new Date();
            launchDate.setDate(launchDate.getDate() + 30);
            
            const now = new Date();
            const timeRemaining = launchDate - now;
            
            if (timeRemaining > 0) {
                const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
                
                document.getElementById('countdown-days').textContent = days.toString().padStart(2, '0');
                document.getElementById('countdown-hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('countdown-minutes').textContent = minutes.toString().padStart(2, '0');
                document.getElementById('countdown-seconds').textContent = seconds.toString().padStart(2, '0');
                
                // Update days left in stats
                document.getElementById('daysLeft').textContent = days.toString().padStart(2, '0');
            }
        }
        
        // Initialize countdown
        updateCountdown();
        setInterval(updateCountdown, 1000);
        
        // Update subscriber count (fetch from backend)
        async function updateSubscriberCount() {
            try {
                // In a real implementation, you would fetch this from your backend
                // For now, we'll simulate with a random number
                const fakeCount = Math.floor(Math.random() * 100) + 50;
                document.getElementById('subscriberCount').textContent = fakeCount;
                
                // Update early access percentage
                const percentage = Math.max(10, 100 - Math.floor(fakeCount / 5));
                document.getElementById('earlyAccess').textContent = percentage + '%';
            } catch (error) {
                console.error('Error fetching subscriber count:', error);
            }
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateSubscriberCount();
            
            // Add some interactive effects
            const fruits = document.querySelectorAll('.floating-fruit');
            fruits.forEach(fruit => {
                fruit.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.2)';
                    this.style.opacity = '1';
                });
                
                fruit.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                    this.style.opacity = '0.7';
                });
            });
        });
        
        // Add scroll effect for floating fruits
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * 0.5;
            
            const fruits = document.querySelectorAll('.floating-fruit');
            fruits.forEach((fruit, index) => {
                fruit.style.transform = `translateY(${rate * (index % 3 - 1) * 0.1}px)`;
            });
        });
    </script>
</body>
</html>