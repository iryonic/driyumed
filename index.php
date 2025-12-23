<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <title>DRIYUM | Healthy Snacks</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --deep-forest: #064E3B;
            --dark-emerald: #022C22;
            --fresh-leaf: #22C55E;
            --soft-cream: #ECFDF5;
            --off-white: #FEFCE8;
            --gold-accent: #D4AF37;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.08);
            
            /* Responsive spacing */
            --space-xs: clamp(0.5rem, 1.5vw, 0.75rem);
            --space-sm: clamp(0.75rem, 2vw, 1rem);
            --space-md: clamp(1rem, 3vw, 1.5rem);
            --space-lg: clamp(1.5rem, 4vw, 2.5rem);
            --space-xl: clamp(2rem, 6vw, 4rem);
            --space-2xl: clamp(3rem, 8vw, 6rem);
            --space-3xl: clamp(4rem, 10vw, 8rem);
            
            /* Responsive typography */
            --text-xs: clamp(0.75rem, 2vw, 0.875rem);
            --text-sm: clamp(0.875rem, 2.5vw, 1rem);
            --text-base: clamp(1rem, 3vw, 1.125rem);
            --text-lg: clamp(1.125rem, 3.5vw, 1.25rem);
            --text-xl: clamp(1.25rem, 4vw, 1.5rem);
            --text-2xl: clamp(1.5rem, 5vw, 2rem);
            --text-3xl: clamp(1.75rem, 6vw, 2.5rem);
            --text-4xl: clamp(2rem, 7vw, 3rem);
            --text-5xl: clamp(2.5rem, 8vw, 4rem);
            --text-6xl: clamp(3rem, 10vw, 6rem);
            --text-7xl: clamp(3.5rem, 12vw, 8rem);
            
            /* Responsive containers */
            --container-sm: 100%;
            --container-md: min(100%, 48rem);
            --container-lg: min(100%, 64rem);
            --container-xl: min(100%, 80rem);
            --container-2xl: min(100%, 90rem);
            
            /* Breakpoints as custom properties for JS */
            --breakpoint-mobile: 480px;
            --breakpoint-tablet: 768px;
            --breakpoint-desktop: 1024px;
            --breakpoint-wide: 1440px;
        }

        /* Reset with mobile-first approach */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 100%;
            scroll-behavior: smooth;
            -webkit-text-size-adjust: 100%;
            -moz-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            font-size: var(--text-base);
            line-height: 1.6;
            background: 
                radial-gradient(ellipse at 80% 20%, rgba(34, 197, 94, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 20% 80%, rgba(6, 78, 59, 0.12) 0%, transparent 50%),
                linear-gradient(165deg, #011a14 0%, #022C22 30%, #064E3B 70%, #0a3d2e 100%);
            color: var(--soft-cream);
            min-height: 100vh;
            min-height: 100dvh;
            overflow-x: hidden;
            position: relative;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }

        /* Ultra-responsive container system */
        .container {
            width: var(--container-sm);
            margin: 0 auto;
            padding: 0 var(--space-md);
            position: relative;
            z-index: 2;
        }

        @media (min-width: 640px) {
            .container {
                width: var(--container-md);
                padding: 0 var(--space-lg);
            }
        }

        @media (min-width: 768px) {
            .container {
                width: var(--container-lg);
                padding: 0 var(--space-xl);
            }
        }

        @media (min-width: 1024px) {
            .container {
                width: var(--container-xl);
                padding: 0 var(--space-2xl);
            }
        }

        @media (min-width: 1280px) {
            .container {
                width: var(--container-2xl);
            }
        }

        /* Responsive background patterns */
        .luxury-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(212, 175, 55, 0.03) 1px, transparent 1px),
                radial-gradient(circle at 75% 75%, rgba(34, 197, 94, 0.02) 1px, transparent 1px);
            background-size: clamp(40px, 10vw, 80px) clamp(40px, 10vw, 80px);
            opacity: 0.4;
            z-index: 0;
            pointer-events: none;
        }

        /* Responsive leaf particles */
        .leaf-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        .leaf {
            position: absolute;
            width: clamp(20px, 8vw, 40px);
            height: clamp(20px, 8vw, 40px);
            opacity: 0;
            background: 
                radial-gradient(circle at 30% 30%, var(--fresh-leaf) 0%, transparent 70%),
                linear-gradient(45deg, transparent 40%, var(--gold-accent) 100%);
            clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
            animation: leafFloat 25s linear infinite;
        }

        @keyframes leafFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.2;
            }
            90% {
                opacity: 0.2;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Ultra-responsive logo */
        .logo-masterpiece {
            width: clamp(140px, 30vw, 220px);
            height: clamp(140px, 30vw, 220px);
            margin: 0 auto var(--space-2xl);
            position: relative;
            perspective: 1000px;
        }

        .logo-orb {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            animation: logoFloat 6s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0) rotateX(5deg);
            }
            50% {
                transform: translateY(-20px) rotateX(-5deg);
            }
        }

        .logo-outer-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border: clamp(1px, 0.2vw, 2px) solid rgba(212, 175, 55, 0.3);
            border-radius: 50%;
            box-shadow: 
                0 0 clamp(30px, 8vw, 60px) rgba(34, 197, 94, 0.2),
                inset 0 0 clamp(20px, 5vw, 40px) rgba(212, 175, 55, 0.1);
            animation: ringRotate 20s linear infinite;
        }

        @keyframes ringRotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .logo-inner-glow {
            position: absolute;
            width: 85%;
            height: 85%;
            border-radius: 50%;
            background: radial-gradient(circle, var(--fresh-leaf) 0%, transparent 70%);
            filter: blur(clamp(15px, 3vw, 30px));
            opacity: 0.5;
            animation: pulseGlow 4s ease-in-out infinite;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes pulseGlow {
            0%, 100% {
                opacity: 0.3;
                transform: translate(-50%, -50%) scale(0.95);
            }
            50% {
                opacity: 0.6;
                transform: translate(-50%, -50%) scale(1.05);
            }
        }

        .logo-core {
            position: absolute;
            width: 75%;
            height: 75%;
            border-radius: 50%;
            background:beige;
            display: flex;
            align-items: center;
            justify-content: center;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 
                0 clamp(10px, 3vw, 20px) clamp(30px, 8vw, 60px) rgba(0, 0, 0, 0.4),
                inset 0 clamp(1px, 0.3vw, 2px) clamp(2px, 0.6vw, 4px) rgba(255, 255, 255, 0.1),
                inset 0 clamp(-1px, -0.3vw, -2px) clamp(2px, 0.6vw, 4px) rgba(0, 0, 0, 0.5);
        }

        .logo-img {
            width: 60%;
            height: auto;
            max-width: 100px;
           
            opacity: 0.95;
        }

        /* Ultra-responsive hero section */
        .hero-masterpiece {
            text-align: center;
            padding: var(--space-2xl) 0 var(--space-3xl);
            position: relative;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-6xl);
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: var(--space-lg);
            position: relative;
            display: inline-block;
            line-height: 1.1;
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: var(--text-5xl);
            }
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--off-white) 0%, var(--gold-accent) 30%, var(--fresh-leaf) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .hero-title::after {
            content: '';
            position: absolute;
            bottom: clamp(-5px, -1vw, -10px);
            left: 15%;
            width: 70%;
            height: clamp(1px, 0.2vw, 2px);
            background: linear-gradient(90deg, transparent, var(--gold-accent), transparent);
        }

        @media (max-width: 768px) {
            .hero-title::after {
                left: 10%;
                width: 80%;
            }
        }

        .hero-tagline {
            font-size: var(--text-xl);
            font-weight: 300;
            letter-spacing: 0.1em;
            max-width: min(90%, 700px);
            margin: var(--space-2xl) auto 0;
            line-height: 1.6;
            opacity: 0.9;
            position: relative;
            padding: var(--space-lg);
        }

        @media (max-width: 480px) {
            .hero-tagline {
                font-size: var(--text-lg);
                padding: var(--space-md);
                letter-spacing: 0.05em;
            }
        }

        .tagline-border {
            position: absolute;
            width: 100%;
            height: 100%;
            border: clamp(0.5px, 0.1vw, 1px) solid rgba(212, 175, 55, 0.2);
            border-radius: clamp(10px, 3vw, 20px);
            pointer-events: none;
        }

        /* Ultra-responsive countdown grid */
        .countdown-masterpiece {
            padding: var(--space-3xl) 0;
            position: relative;
        }

        .countdown-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: var(--text-3xl);
            font-weight: 600;
            margin-bottom: var(--space-3xl);
            letter-spacing: 0.05em;
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }

        @media (max-width: 768px) {
            .countdown-title {
                font-size: var(--text-2xl);
                margin-bottom: var(--space-2xl);
            }
        }

        .countdown-title::before,
        .countdown-title::after {
            content: '';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: var(--text-2xl);
            opacity: 0.5;
        }

        .countdown-title::before {
            content: '⏳';
            left: clamp(-40px, -8vw, -60px);
        }

        .countdown-title::after {
            content: '✨';
            right: clamp(-40px, -8vw, -60px);
        }

        @media (max-width: 480px) {
            .countdown-title::before,
            .countdown-title::after {
                display: none;
            }
        }

        .countdown-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--space-md);
            max-width: min(95%, 1000px);
            margin: 0 auto;
        }

        @media (max-width: 1024px) {
            .countdown-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--space-lg);
            }
        }

        @media (max-width: 480px) {
            .countdown-grid {
                grid-template-columns: 1fr;
                gap: var(--space-md);
                max-width: min(90%, 300px);
            }
        }

        .time-unit {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: clamp(16px, 4vw, 28px);
            padding: var(--space-xl);
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: clamp(120px, 25vw, 200px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .nav{
            margin: 100px ;
            color: var(--soft-cream);
            text-decoration: none;
            font-size: var(--text-base);
            border: 1px solid var(--soft-cream);
            padding: var(--space-sm) var(--space-md);
            border-radius: clamp(8px, 2vw, 12px);
            transition: background 0.3s, color 0.3s;
            
        }

        @media (max-width: 480px) {
            .time-unit {
                padding: var(--space-lg);
                min-height: 100px;
            }
        }

        .time-unit::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(212, 175, 55, 0.05), transparent);
            opacity: 0;
            transition: opacity 0.5s;
        }

        .time-unit:hover {
            transform: translateY(-15px) scale(1.02);
            border-color: rgba(212, 175, 55, 0.3);
            box-shadow: 
                0 clamp(15px, 4vw, 30px) clamp(30px, 8vw, 60px) rgba(0, 0, 0, 0.4),
                0 0 clamp(40px, 10vw, 80px) rgba(34, 197, 94, 0.15);
        }

        @media (hover: none) {
            .time-unit:hover {
                transform: none;
            }
        }

        .time-number {
            font-size: var(--text-5xl);
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            background: linear-gradient(135deg, var(--off-white), var(--gold-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
            margin-bottom: var(--space-xs);
            position: relative;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .time-number {
                font-size: var(--text-4xl);
            }
        }

        @media (max-width: 480px) {
            .time-number {
                font-size: var(--text-3xl);
            }
        }

        .time-label {
            font-size: var(--text-sm);
            text-transform: uppercase;
            letter-spacing: 0.2em;
            opacity: 0.7;
            position: relative;
            z-index: 1;
            margin-top: var(--space-xs);
        }

        @media (max-width: 480px) {
            .time-label {
                font-size: var(--text-xs);
                letter-spacing: 0.15em;
            }
        }

        /* Newsletter Section Styles */
        .newsletter-masterpiece {
            padding: var(--space-3xl) 0;
            position: relative;
        }

        .newsletter-container {
            max-width: min(95%, 800px);
            margin: 0 auto;
            position: relative;
        }

        .newsletter-form {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: clamp(24px, 6vw, 36px);
            padding: var(--space-2xl);
            position: relative;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .newsletter-form {
                padding: var(--space-xl);
            }
        }

        @media (max-width: 480px) {
            .newsletter-form {
                padding: var(--space-lg);
            }
        }

        .newsletter-form::before {
            content: '';
            position: absolute;
            top: -100%;
            left: -100%;
            width: 300%;
            height: 300%;
            background: conic-gradient(transparent, rgba(212, 175, 55, 0.1), transparent 30%);
            animation: rotate 8s linear infinite;
        }

        .newsletter-content {
            position: relative;
            z-index: 2;
        }

        .newsletter-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-4xl);
            font-weight: 600;
            text-align: center;
            margin-bottom: var(--space-md);
            background: linear-gradient(135deg, var(--off-white), var(--gold-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        @media (max-width: 768px) {
            .newsletter-title {
                font-size: var(--text-3xl);
            }
        }

        .newsletter-subtitle {
            text-align: center;
            font-size: var(--text-lg);
            opacity: 0.8;
            margin-bottom: var(--space-xl);
            max-width: min(90%, 600px);
            margin-left: auto;
            margin-right: auto;
        }

        .form-row {
            display: flex;
              flex-direction: column;
            gap: var(--space-md);
            margin-bottom: var(--space-lg);
        }

       

        .form-input {
            flex: 1;
            position: relative;
        }

        .form-input input {
            width: 100%;
            padding: 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: clamp(12px, 3vw, 16px);
            color: var(--soft-cream);
            font-size: var(--text-base);
            transition: all 0.3s ease;
        }

        .form-input input:focus {
            outline: none;
            border-color: var(--gold-accent);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-input input.error {
            border-color: #ef4444;
        }

        .btn-subscribe {
            background: linear-gradient(135deg, var(--gold-accent), var(--fresh-leaf));
            border: none;
            padding: 20px 14px ;
            border-radius: clamp(12px, 3vw, 16px);
            color: var(--dark-emerald);
            font-size: var(--text-base);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-subscribe:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
        }

        .btn-subscribe:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .form-message {
            text-align: center;
            padding: var(--space-md);
            border-radius: clamp(8px, 2vw, 12px);
            font-size: var(--text-base);
            transition: all 0.3s ease;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
        }

        .form-message.show {
            opacity: 1;
            visibility: visible;
        }

        .form-message.success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #86efac;
        }

        .form-message.error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .form-message.info {
            background: rgba(250, 204, 21, 0.1);
            border: 1px solid rgba(250, 204, 21, 0.3);
            color: #fde68a;
        }

        .privacy-note {
            text-align: center;
            font-size: var(--text-xs);
            opacity: 0.6;
            margin-top: var(--space-md);
        }

        /* Ultra-responsive about section */
        .about-masterpiece {
            padding: var(--space-3xl) 0;
            position: relative;
        }

        .about-container {
            max-width: min(95%, 1000px);
            margin: 0 auto;
            position: relative;
        }

        .about-header {
            text-align: center;
            margin-bottom: var(--space-3xl);
        }

        .about-main-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-5xl);
            font-weight: 700;
            margin-bottom: var(--space-lg);
            background: linear-gradient(135deg, var(--off-white), var(--fresh-leaf));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.1;
        }

        .admin-login {
        
 
            color: var(--soft-cream);
            text-decoration: none;
            font-size: var(--text-sm);
           
            padding: var(--space-sm) var(--space-md);
            border-radius: clamp(8px, 2vw, 12px);
            transition: background 0.3s, color 0.3s;
        }
        @media (max-width: 768px) {
            .about-main-title {
                font-size: var(--text-4xl);
            }
        }

        @media (max-width: 480px) {
            .about-main-title {
                font-size: var(--text-3xl);
            }
        }

        .about-subtitle {
            font-size: var(--text-xl);
            font-weight: 300;
            letter-spacing: 0.1em;
            opacity: 0.8;
            max-width: min(90%, 600px);
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .about-subtitle {
                font-size: var(--text-lg);
                letter-spacing: 0.05em;
            }
        }

        .about-content-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--space-2xl);
            margin-bottom: var(--space-3xl);
        }

        @media (max-width: 768px) {
            .about-content-grid {
                grid-template-columns: 1fr;
                gap: var(--space-xl);
                margin-bottom: var(--space-2xl);
            }
        }

        .about-card {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: clamp(20px, 5vw, 32px);
            padding: var(--space-xl);
            position: relative;
            overflow: hidden;
            min-height: clamp(250px, 50vw, 400px);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .about-card {
                padding: var(--space-lg);
                min-height: 300px;
            }
        }

        @media (max-width: 480px) {
            .about-card {
                padding: var(--space-md);
                min-height: 250px;
            }
        }

        .about-card::before {
            content: '';
            position: absolute;
            top: -100%;
            left: -100%;
            width: 300%;
            height: 300%;
            background: conic-gradient(transparent, rgba(212, 175, 55, 0.1), transparent 30%);
            animation: rotate 8s linear infinite;
        }

        .about-card-content {
            position: relative;
            z-index: 2;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-3xl);
            font-weight: 600;
            margin-bottom: var(--space-lg);
            color: var(--off-white);
            line-height: 1.2;
        }

        @media (max-width: 768px) {
            .card-title {
                font-size: var(--text-2xl);
                margin-bottom: var(--space-md);
            }
        }

        @media (max-width: 480px) {
            .card-title {
                font-size: var(--text-xl);
            }
        }

        .card-text {
            font-size: var(--text-lg);
            line-height: 1.7;
            opacity: 0.9;
            font-weight: 300;
        }

        @media (max-width: 768px) {
            .card-text {
                font-size: var(--text-base);
                line-height: 1.6;
            }
        }

        .highlight {
            color: var(--gold-accent);
            font-weight: 500;
        }

        .about-values {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: var(--space-lg);
            margin-top: var(--space-3xl);
        }

        @media (max-width: 768px) {
            .about-values {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--space-md);
                margin-top: var(--space-2xl);
            }
        }

        @media (max-width: 480px) {
            .about-values {
                grid-template-columns: 1fr;
                gap: var(--space-md);
            }
        }

        .value-item {
            text-align: center;
            padding: var(--space-xl);
            background: rgba(255, 255, 255, 0.02);
            border-radius: clamp(16px, 4vw, 24px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: transform 0.3s;
        }

        @media (max-width: 768px) {
            .value-item {
                padding: var(--space-lg);
            }
            .countdown-title {
                left: 15%;
            }
        }

        @media (max-width: 480px) {
            .value-item {
                padding: var(--space-md);
            }
        }

        .value-item:hover {
            transform: translateY(-10px);
            border-color: rgba(34, 197, 94, 0.2);
        }

        @media (hover: none) {
            .value-item:hover {
                transform: none;
            }
        }

        .value-icon {
            font-size: var(--text-4xl);
            margin-bottom: var(--space-md);
            opacity: 0.8;
        }

        @media (max-width: 480px) {
            .value-icon {
                font-size: var(--text-3xl);
                margin-bottom: var(--space-sm);
            }
        }

        .value-title {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-xl);
            margin-bottom: var(--space-sm);
            color: var(--off-white);
            line-height: 1.2;
        }

        @media (max-width: 480px) {
            .value-title {
                font-size: var(--text-lg);
            }
        }

        .value-description {
            opacity: 0.8;
            line-height: 1.6;
            font-size: var(--text-sm);
        }

        @media (max-width: 480px) {
            .value-description {
                font-size: var(--text-xs);
            }
        }

        /* Ultra-responsive footer */
        .footer-masterpiece {
            text-align: center;
            padding: var(--space-3xl) 0;
            position: relative;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            margin-top: var(--space-3xl);
        }

        .footer-content {
            max-width: min(95%, 600px);
            margin: 0 auto;
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: var(--text-3xl);
            font-weight: 700;
            margin-bottom: var(--space-md);
            color: var(--off-white);
            letter-spacing: 0.1em;
        }

        @media (max-width: 480px) {
            .footer-logo {
                font-size: var(--text-2xl);
            }
        }

        .footer-tagline {
            font-size: var(--text-lg);
            opacity: 0.7;
            margin-bottom: var(--space-lg);
            letter-spacing: 0.1em;
        }

        @media (max-width: 480px) {
            .footer-tagline {
                font-size: var(--text-base);
                letter-spacing: 0.05em;
            }
        }

        .footer-copyright {
            font-size: var(--text-sm);
            opacity: 0.5;
            letter-spacing: 0.1em;
            margin-top: var(--space-lg);
            margin-bottom: 30px;
        }

        @media (max-width: 480px) {
            .footer-copyright {
                font-size: var(--text-xs);
            }
        }

        .nature-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-sm);
            margin-top: var(--space-xl);
            padding: var(--space-md) var(--space-lg);
            background: rgba(34, 197, 94, 0.1);
            border-radius: clamp(25px, 6vw, 50px);
            border: 1px solid rgba(34, 197, 94, 0.2);
            font-size: var(--text-base);
            flex-wrap: wrap;
        }

        @media (max-width: 480px) {
            .nature-badge {
                padding: var(--space-sm) var(--space-md);
                font-size: var(--text-sm);
                gap: var(--space-xs);
            }
        }

        /* Ultra-responsive animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Performance optimizations */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        /* Touch device optimizations */
        @media (hover: none) and (pointer: coarse) {
            .time-unit,
            .value-item {
                transition: none;
            }
            
            .time-unit:active,
            .value-item:active {
                transform: scale(0.98);
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            :root {
                --soft-cream: #FFFFFF;
                --off-white: #FFFFFF;
            }
            
            body {
                background: var(--dark-emerald);
            }
            
            .luxury-pattern {
                display: none;
            }
        }

        /* Dark mode support (already dark, but for consistency) */
        @media (prefers-color-scheme: dark) {
            /* Already optimized for dark */
        }

        /* Print styles */
        @media print {
            .luxury-pattern,
            .leaf-container,
            .logo-glow,
            .tagline-border,
            .time-unit::before,
            .about-card::before {
                display: none;
            }
            
            body {
                background: white !important;
                color: black !important;
            }
            
            .container {
                max-width: 100% !important;
                padding: 0 !important;
            }
            
            .time-unit,
            .about-card,
            .value-item {
                border: 1px solid #ccc !important;
                background: white !important;
                box-shadow: none !important;
                break-inside: avoid;
            }
            
            .hero-title span,
            .time-number,
            .about-main-title {
                background: none !important;
                -webkit-text-fill-color: black !important;
                color: black !important;
            }
        }

        /* Custom scrollbar with responsive sizing */
        ::-webkit-scrollbar {
            width: clamp(8px, 2vw, 12px);
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-emerald);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(var(--deep-forest), var(--fresh-leaf));
            border-radius: clamp(3px, 1vw, 6px);
            border: 2px solid var(--dark-emerald);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(var(--fresh-leaf), var(--gold-accent));
        }

        /* Safe area insets for notched devices */
        @supports (padding: max(0px)) {
            .container {
                padding-left: max(var(--space-md), env(safe-area-inset-left));
                padding-right: max(var(--space-md), env(safe-area-inset-right));
            }
            
            .hero-masterpiece {
                padding-top: max(var(--space-2xl), env(safe-area-inset-top));
            }
            
            .footer-masterpiece {
                padding-bottom: max(var(--space-3xl), env(safe-area-inset-bottom));
            }
        }
    </style>
</head>
<body>
    <!-- Luxury Background Elements -->
    <div class="luxury-pattern" aria-hidden="true"></div>
    <div class="leaf-container" id="leafContainer" aria-hidden="true"></div>

    <div class="container">
        <!-- Ultimate Hero Section -->
        <section class="hero-masterpiece fade-in">
            <div class="logo-masterpiece">
                <div class="logo-orb">
                    <div class="logo-outer-ring" aria-hidden="true"></div>
                    <div class="logo-inner-glow" aria-hidden="true"></div>
                    <div class="logo-core">
                        <!-- Replace with actual logo URL -->
                        <img src="logo.png" 
                             alt="DRIYUM Premium Health Snacks Logo" class="logo-img" loading="eager">
                    </div>
                </div>
            </div>
            
            <h1 class="hero-title fade-in">
                <span>LAUNCHING SOON</span>
            </h1>
            
            <div class="hero-tagline fade-in">
                <div class="tagline-border" aria-hidden="true"></div>
                Experience nature's purest luxury. Where premium health snacks meet unparalleled excellence.
            </div>
        </section>

        <!-- Ultimate Countdown -->
        <!-- <section class="countdown-masterpiece fade-in" aria-labelledby="countdown-title">
            <h2 id="countdown-title" class="countdown-title fade-in">Countdown to Excellence</h2>
            
            <div class="countdown-grid">
                <div class="time-unit" data-unit="days" role="timer" aria-live="polite">
                    <div class="time-number" id="days">00</div>
                    <div class="time-label">DAYS</div>
                </div>
                <div class="time-unit" data-unit="hours" role="timer" aria-live="polite">
                    <div class="time-number" id="hours">00</div>
                    <div class="time-label">HOURS</div>
                </div>
                <div class="time-unit" data-unit="minutes" role="timer" aria-live="polite">
                    <div class="time-number" id="minutes">00</div>
                    <div class="time-label">MINUTES</div>
                </div>
                <div class="time-unit" data-unit="seconds" role="timer" aria-live="polite">
                    <div class="time-number" id="seconds">00</div>
                    <div class="time-label">SECONDS</div>
                </div>
            </div>
        </section> -->

        <!-- Newsletter Subscription Section -->
        <section class="newsletter-masterpiece fade-in" aria-labelledby="newsletter-title">
            <div class="newsletter-container">
                <div class="newsletter-form">
                    <div class="newsletter-content">
                        <h2 id="newsletter-title" class="newsletter-title fade-in">
                            Join Our Exclusive Launch List
                        </h2>
                        <p class="newsletter-subtitle fade-in">
                            Be among the first to experience DRIYUM. Get early access, special offers, 
                            and wellness tips delivered to your inbox.
                        </p>
                        
                        <form id="newsletterForm" class="fade-in">
                            <div class="form-row">
                                <div class="form-input">
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           placeholder="Enter your email address" 
                                           required
                                           aria-label="Email address">
                                </div>
                                <button type="submit" class="btn-subscribe" id="subscribeBtn">
                                    Notify Me at Launch
                                </button>
                            </div>
                            
                            <div id="formMessage" class="form-message" aria-live="polite">
                                <!-- Messages will appear here -->
                            </div>
                            
                            <p class="privacy-note">
                                We respect your privacy. Unsubscribe at any time. No spam ever.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ultimate About Us Section -->
        <section class="about-masterpiece fade-in" aria-labelledby="about-title">
            <div class="about-container">
                <div class="about-header fade-in">
                    <h2 id="about-title" class="about-main-title">Our Essence</h2>
                    <p class="about-subtitle">Crafting Perfection from Nature's Bounty</p>
                </div>

                <div class="about-content-grid">
                    <div class="about-card fade-in">
                        <div class="about-card-content">
                            <h3 class="card-title">The DRIYUM Promise</h3>
                            <p class="card-text">
                                <span class="highlight">DRIYUM</span> transcends the ordinary, redefining premium health snacks through uncompromising quality. 
                                Each product is a masterpiece of nature, meticulously sourced from the world's finest orchards and processed with artisanal care. 
                                We believe true luxury lies in purity, and every bite should be an experience that nourishes both body and soul.
                            </p>
                        </div>
                    </div>

                    <div class="about-card fade-in">
                        <div class="about-card-content">
                            <h3 class="card-title">Nature's Alchemy</h3>
                            <p class="card-text">
                                Our proprietary <span class="highlight">GentleDri™</span> technology preserves nature's essence while enhancing flavor and nutrition. 
                                We combine ancient drying wisdom with modern innovation to create snacks that retain maximum vitamins, antioxidants, 
                                and natural sweetness. Every DRIYUM creation is a testament to our commitment to authenticity and excellence.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="about-values fade-in">
                    <div class="value-item">
                        <div class="value-icon" aria-hidden="true">🌿</div>
                        <h4 class="value-title">Pure Sourcing</h4>
                        <p class="value-description">Partnering with ethical growers worldwide for the finest organic ingredients</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon" aria-hidden="true">✨</div>
                        <h4 class="value-title">Artisan Craft</h4>
                        <p class="value-description">Hand-selected, small-batch production ensuring premium quality control</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon" aria-hidden="true">🌍</div>
                        <h4 class="value-title">Sustainable Luxury</h4>
                        <p class="value-description">Eco-conscious packaging and carbon-neutral operations</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ultimate Footer -->
        <footer class="footer-masterpiece fade-in">
            <div class="footer-content">
                <div class="footer-logo">DRIYUM</div>
                <p class="footer-tagline">Elevating Wellness Through Nature's Finest</p>
                
                <div class="nature-badge">
                    <span aria-hidden="true">🌱</span>
                    <span>Crafted by Nature, Perfected by Passion</span>
                </div>
                
                <p class="footer-copyright">© <?php
echo date("Y");
                ?> DRIYUM Premium Health Snacks. All rights reserved.</p>

                <a href="./admin/index.php" class="admin-login">Admin --> </a>
               
            </div>
        </footer>
    </div>

    <script>
        // Detect device capabilities
        const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const isMobile = window.innerWidth <= 768;
        
        // Set initial animation state
        if (prefersReducedMotion) {
            document.documentElement.style.setProperty('--animation-speed', '0.01ms');
        }
        
        // Create luxury leaf particles with performance optimization
        function createLeaves() {
            const container = document.getElementById('leafContainer');
            if (!container || prefersReducedMotion) return;
            
            // Adjust leaf count based on screen size for performance
            let leafCount;
            if (window.innerWidth < 768) {
                leafCount = 4;
            } else if (window.innerWidth < 1024) {
                leafCount = 6;
            } else {
                leafCount = 8;
            }
            
            // Clear existing leaves
            container.innerHTML = '';
            
            for (let i = 0; i < leafCount; i++) {
                const leaf = document.createElement('div');
                leaf.className = 'leaf';
                leaf.setAttribute('aria-hidden', 'true');
                
                // Random properties with viewport-based calculations
                const size = Math.random() * (isMobile ? 20 : 40) + 20;
                const left = Math.random() * 100;
                const delay = Math.random() * 20;
                const duration = Math.random() * 10 + 25;
                const blur = Math.random() * (isMobile ? 5 : 10);
                
                leaf.style.width = `${size}px`;
                leaf.style.height = `${size}px`;
                leaf.style.left = `${left}%`;
                leaf.style.animationDelay = `${delay}s`;
                leaf.style.animationDuration = `${duration}s`;
                leaf.style.filter = `blur(${blur}px)`;
                
                container.appendChild(leaf);
            }
        }
        
        // Ultimate Countdown Timer for Jan 1, 2026 with timezone support
        function updateUltimateCountdown() {
            const targetDate = new Date('January 5, 2026 00:00:00 GMT+0530').getTime();
            const now = new Date().getTime();
            const difference = targetDate - now;
            
            if (difference > 0) {
                const days = Math.floor(difference / (1000 * 60 * 60 * 24));
                const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((difference % (1000 * 60)) / 1000);
                
                // Animate number changes only if they've changed
                animateNumber('days', days);
                animateNumber('hours', hours);
                animateNumber('minutes', minutes);
                animateNumber('seconds', seconds);
            } else {
                // Launch time reached
                document.querySelectorAll('.time-number').forEach(el => {
                    el.textContent = '00';
                });
                clearInterval(countdownInterval);
            }
        }
        
        // Smooth number animation with performance optimization
        function animateNumber(elementId, newValue) {
            const element = document.getElementById(elementId);
            if (!element) return;
            
            const currentValue = parseInt(element.textContent) || 0;
            
            if (currentValue !== newValue) {
                if (!prefersReducedMotion) {
                    element.style.transform = 'scale(1.1)';
                    setTimeout(() => {
                        element.textContent = newValue.toString().padStart(2, '0');
                        element.style.transform = 'scale(1)';
                    }, 150);
                } else {
                    element.textContent = newValue.toString().padStart(2, '0');
                }
            }
        }
        
        // Newsletter Subscription Handling
        function initNewsletter() {
            const form = document.getElementById('newsletterForm');
            const emailInput = document.getElementById('email');
            const submitBtn = document.getElementById('subscribeBtn');
            const messageDiv = document.getElementById('formMessage');
            
            if (!form) return;
            
            // Clear any existing message on focus
            emailInput.addEventListener('focus', () => {
                clearMessage();
            });
            
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const email = emailInput.value.trim();
                
                // Validate email
                if (!validateEmail(email)) {
                    showMessage('Please enter a valid email address', 'error');
                    emailInput.focus();
                    return;
                }
                
                // Disable form and show loading state
                submitBtn.disabled = true;
                submitBtn.textContent = 'Processing...';
                clearMessage();
                
                try {
                    const formData = new FormData();
                    formData.append('email', email);
                    
                    // Use XMLHttpRequest instead of fetch for better error handling
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'subscribe.php', true);
                    xhr.setRequestHeader('Accept', 'application/json');
                    
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            try {
                                const data = JSON.parse(xhr.responseText);
                                console.log('Response data:', data);
                                
                                if (data.success) {
                                    showMessage(data.message, 'success');
                                    form.reset();
                                } else {
                                    showMessage(data.message, 'error');
                                    emailInput.focus();
                                }
                            } catch (error) {
                                console.error('JSON parse error:', error);
                                showMessage('Server response error. Please try again.', 'error');
                            }
                        } else {
                            showMessage('Server error. Please try again later.', 'error');
                        }
                        
                        // Re-enable form
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Notify Me at Launch';
                    };
                    
                    xhr.onerror = function() {
                        console.error('XHR network error');
                        showMessage('Network connection failed. Please check your internet connection.', 'error');
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Notify Me at Launch';
                    };
                    
                    xhr.send(formData);
                    
                } catch (error) {
                    console.error('Error:', error);
                    showMessage('An unexpected error occurred. Please try again.', 'error');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Notify Me at Launch';
                }
            });
        }
        
        // Validate email format
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        
        // Show message in form
        function showMessage(message, type = 'info') {
            const messageDiv = document.getElementById('formMessage');
            if (!messageDiv) return;
            
            messageDiv.textContent = message;
            messageDiv.className = 'form-message ' + type + ' show';
            
            // Auto-hide success messages after 5 seconds
            if (type === 'success') {
                setTimeout(() => {
                    messageDiv.classList.remove('show');
                }, 5000);
            }
        }
        
        // Clear message
        function clearMessage() {
            const messageDiv = document.getElementById('formMessage');
            if (messageDiv) {
                messageDiv.classList.remove('show');
                setTimeout(() => {
                    messageDiv.textContent = '';
                    messageDiv.className = 'form-message';
                }, 2000);
            }
        }
        
        // Interactive hover effects with touch support
        function initPremiumInteractions() {
            const timeUnits = document.querySelectorAll('.time-unit');
            
            timeUnits.forEach(unit => {
                if (isTouchDevice) {
                    // Touch interactions
                    unit.addEventListener('touchstart', handleTouchStart);
                    unit.addEventListener('touchend', handleTouchEnd);
                } else {
                    // Mouse interactions
                    unit.addEventListener('mouseenter', handleMouseEnter);
                    unit.addEventListener('mouseleave', handleMouseLeave);
                }
            });
            
            function handleMouseEnter(e) {
                if (prefersReducedMotion) return;
                
                const rect = e.currentTarget.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                e.currentTarget.style.setProperty('--mouse-x', `${x}px`);
                e.currentTarget.style.setProperty('--mouse-y', `${y}px`);
                
                createRipple(e.currentTarget, x, y);
            }
            
            function handleMouseLeave() {
                if (prefersReducedMotion) return;
                // Reset styles
            }
            
            function handleTouchStart(e) {
                if (prefersReducedMotion) return;
                
                const touch = e.touches[0];
                const rect = e.currentTarget.getBoundingClientRect();
                const x = touch.clientX - rect.left;
                const y = touch.clientY - rect.top;
                
                e.currentTarget.classList.add('active');
                createRipple(e.currentTarget, x, y);
            }
            
            function handleTouchEnd(e) {
                e.currentTarget.classList.remove('active');
            }
            
            function createRipple(element, x, y) {
                const ripple = document.createElement('div');
                ripple.style.position = 'absolute';
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                ripple.style.width = '0px';
                ripple.style.height = '0px';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'radial-gradient(circle, rgba(212,175,55,0.2) 0%, transparent 70%)';
                ripple.style.transform = 'translate(-50%, -50%)';
                ripple.style.transition = 'all 0.5s ease-out';
                ripple.setAttribute('aria-hidden', 'true');
                
                element.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.style.width = isMobile ? '200px' : '300px';
                    ripple.style.height = isMobile ? '200px' : '300px';
                    ripple.style.opacity = '0';
                }, 10);
                
                setTimeout(() => {
                    if (ripple.parentNode === element) {
                        ripple.remove();
                    }
                }, 600);
            }
        }
        
        // Staggered animations with intersection observer
        function initStaggeredAnimations() {
            if (prefersReducedMotion) {
                document.querySelectorAll('.fade-in').forEach(el => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                });
                return;
            }
            
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '50px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            document.querySelectorAll('.fade-in').forEach((el, index) => {
                el.style.animationDelay = `${index * 0.15}s`;
                observer.observe(el);
            });
        }
        
        // Dynamic background effects with performance throttling
        let lastUpdate = 0;
        function updateDynamicEffects(timestamp) {
            if (prefersReducedMotion || timestamp - lastUpdate < 60000) return;
            
            lastUpdate = timestamp;
            const hour = new Date().getHours();
            const intensity = 0.3 + (Math.sin(hour * Math.PI / 12) * 0.4);
            
            // Update leaf opacity based on time
            const leaves = document.querySelectorAll('.leaf');
            leaves.forEach(leaf => {
                leaf.style.opacity = `${intensity}`;
            });
            
            // Update gradient intensity
            document.body.style.background = `
                radial-gradient(ellipse at 80% 20%, rgba(34, 197, 94, ${0.08 * intensity}) 0%, transparent 50%),
                radial-gradient(ellipse at 20% 80%, rgba(6, 78, 59, ${0.12 * intensity}) 0%, transparent 50%),
                linear-gradient(165deg, #011a14 0%, #022C22 30%, #064E3B 70%, #0a3d2e 100%)
            `;
        }
        
        // Initialize everything
        function initApp() {
            createLeaves();
            initPremiumInteractions();
            initStaggeredAnimations();
            initNewsletter();
            updateUltimateCountdown();
            
            // Update countdown every second with performance optimization
            const countdownInterval = setInterval(updateUltimateCountdown, 1000);
            
            // Update dynamic effects on animation frame
            function animate() {
                updateDynamicEffects(Date.now());
                requestAnimationFrame(animate);
            }
            
            if (!prefersReducedMotion) {
                requestAnimationFrame(animate);
            }
            
            // Handle orientation changes
            window.addEventListener('orientationchange', () => {
                setTimeout(() => {
                    createLeaves();
                }, 300);
            });
        }
        
        // Handle window resize with debouncing
        let resizeTimeout;
        function handleResize() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                createLeaves();
                
                // Update mobile detection
                isMobile = window.innerWidth <= 768;
            }, 250);
        }
        
        // Add mouse move parallax effect with performance optimization
        let mouseX = 0;
        let mouseY = 0;
        let rafId = null;
        
        function handleMouseMove(e) {
            if (prefersReducedMotion || isTouchDevice) return;
            
            mouseX = (e.clientX / window.innerWidth - 0.5) * 20;
            mouseY = (e.clientY / window.innerHeight - 0.5) * 20;
            
            if (!rafId) {
                rafId = requestAnimationFrame(updateParallax);
            }
        }
        
        function updateParallax() {
            const logoOrb = document.querySelector('.logo-orb');
            const pattern = document.querySelector('.luxury-pattern');
            
            if (logoOrb) {
                logoOrb.style.transform = 
                    `translateY(${mouseY}px) rotateX(${mouseY}deg) rotateY(${mouseX}deg)`;
            }
            
            if (pattern) {
                pattern.style.transform = 
                    `translate(${mouseX * 0.5}px, ${mouseY * 0.5}px)`;
            }
            
            rafId = null;
        }
        
        // Load event listeners
        document.addEventListener('DOMContentLoaded', initApp);
        window.addEventListener('resize', handleResize);
        
        if (!isTouchDevice) {
            document.addEventListener('mousemove', handleMouseMove);
        }
        
        // Add loading state management
        document.body.classList.add('loaded');
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowDown' || e.key === 'PageDown') {
                e.preventDefault();
                window.scrollBy({ top: window.innerHeight * 0.8, behavior: 'smooth' });
            } else if (e.key === 'ArrowUp' || e.key === 'PageUp') {
                e.preventDefault();
                window.scrollBy({ top: -window.innerHeight * 0.8, behavior: 'smooth' });
            } else if (e.key === 'Home') {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else if (e.key === 'End') {
                e.preventDefault();
                window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
            }
        });
    </script>
</body>
</html>