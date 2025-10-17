<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forvis Mazars - Gestion de Facturation</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: white;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar */
        .navbar-custom {
            background: white;
            padding: 1.5rem 4rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            border-bottom: 1px solid #efefef;
        }

        .navbar-logo {
            height: 55px;
        }

        .nav-menu {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn-nav {
            color: #1A2142;
            padding: 8px 20px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 14px;
        }

        .btn-nav:hover {
            background: #f8f9fa;
            color: #1A2142;
        }

        .btn-nav-primary {
            background: #365CF5;
            color: white;
            border: 1px solid #365CF5;
        }

        .btn-nav-primary:hover {
            background: #2645d4;
            color: white;
            border-color: #2645d4;
        }

        /* Hero */
        .hero {
            padding: 120px 20px 100px;
            background: linear-gradient(135deg, #f0f4f8 0%, #e8eef5 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, rgba(54, 92, 245, 0.1) 0%, rgba(54, 92, 245, 0.05) 100%);
            border-radius: 50%;
            z-index: 0;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, rgba(54, 92, 245, 0.05) 0%, transparent 100%);
            border-radius: 50%;
            z-index: 0;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: left;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 3.2rem;
            font-weight: 700;
            color: #1A2142;
            margin-bottom: 25px;
            letter-spacing: -1.5px;
            line-height: 1.1;
        }

        .hero p {
            font-size: 1.2rem;
            color: #5d657b;
            max-width: 650px;
            line-height: 1.7;
        }

        /* Features */
        .features {
            padding: 100px 20px;
            background: white;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .features::before {
            content: '';
            position: absolute;
            top: 20%;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(54, 92, 245, 0.03) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 40px;
            margin-top: 60px;
            position: relative;
            z-index: 1;
        }

        .feature-card {
            padding: 0;
            text-align: left;
            transition: all 0.3s;
            position: relative;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-card h3 {
            font-size: 1.3rem;
            color: #1A2142;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .feature-card p {
            color: #5d657b;
            line-height: 1.7;
            font-size: 0.95rem;
        }

        .section-title {
            font-size: 2rem;
            color: #1A2142;
            font-weight: 600;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .section-subtitle {
            color: #5d657b;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }

        /* Footer */
        .footer {
            background: #1A2142;
            padding: 60px 20px 30px;
            color: white;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .footer p {
            color: #9ca3af;
            margin: 0;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .navbar-custom {
                padding: 1rem 1.5rem;
            }

            .nav-menu {
                gap: 10px;
            }

            .btn-nav {
                padding: 6px 15px;
                font-size: 13px;
            }

            .hero {
                padding: 80px 20px 60px;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1.05rem;
            }

            .features {
                padding: 60px 20px;
            }

            .features-grid {
                gap: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <img src="{{ asset('assets/images/logo/mazars.png') }}" alt="Forvis Mazars" class="navbar-logo">

            <div class="nav-menu">
                <a href="{{ route('login') }}" class="btn-nav">Connexion</a>
                <a href="{{ route('register') }}" class="btn-nav btn-nav-primary">Créer un compte</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-content">
            <h1>Gestion de Facturation</h1>
            <p>Plateforme de gestion complète dédiée aux missions d'audit et de conseil. Gérez vos clients, chantiers, facturations et encaissements en toute simplicité.</p>
        </div>
    </section>

    <!-- Features -->
    <section class="features">
        <h2 class="section-title">Fonctionnalités</h2>
        <p class="section-subtitle">Les outils essentiels pour votre gestion</p>

        <div class="features-grid">
            <div class="feature-card">
                <h3>Suivi des Missions</h3>
                <p>Gérez vos chantiers avec budgétisation, allocation des équipes et suivi des ressources en temps réel.</p>
            </div>

            <div class="feature-card">
                <h3>Facturation</h3>
                <p>Créez et suivez vos factures par chantier avec division en tranches de paiement personnalisables.</p>
            </div>

            <div class="feature-card">
                <h3>Encaissement</h3>
                <p>Suivi complet des paiements avec clôture automatique des missions une fois les objectifs atteints.</p>
            </div>

            <div class="feature-card">
                <h3>Rapports & Analytics</h3>
                <p>Tableaux de bord détaillés et rapports financiers pour une analyse approfondie de vos missions.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>© 2025 Forvis Mazars - Gestion de Facturation</p>
        </div>
    </footer>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
