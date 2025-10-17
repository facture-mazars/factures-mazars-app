<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Forvis Mazars</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e8eef5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            padding: 50px 40px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-section img {
            height: 50px;
            margin-bottom: 20px;
        }

        .register-title {
            font-size: 1.8rem;
            color: #1A2142;
            font-weight: 600;
            text-align: center;
            margin-bottom: 10px;
        }

        .register-subtitle {
            text-align: center;
            color: #5d657b;
            margin-bottom: 35px;
        }

        .form-label {
            font-weight: 500;
            color: #1A2142;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            padding: 12px 15px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #365CF5;
            box-shadow: 0 0 0 3px rgba(54, 92, 245, 0.1);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        .btn-register {
            background: #365CF5;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            margin-top: 10px;
            cursor: pointer;
        }

        .btn-register:hover {
            background: #2645d4;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(54, 92, 245, 0.3);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
            color: #5d657b;
            font-size: 14px;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #365CF5;
            font-weight: 500;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #5d657b;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #365CF5;
        }

        @media (max-width: 576px) {
            .register-container {
                padding: 40px 25px;
            }
        }
    </style>
</head>
<body>

    <a href="{{ url('/') }}" class="back-link">
        ← Retour à l'accueil
    </a>

    <div class="register-container">
        <div class="logo-section">
            <img src="{{ asset('assets/images/logo/mazars.png') }}" alt="Forvis Mazars">
            <h1 class="register-title">Inscription</h1>
            <p class="register-subtitle">Créez votre compte consultant</p>
        </div>

        <form action="{{ route('register.save')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nom" class="form-label">Nom complet</label>
                <input type="text" name="nom" id="nom" class="form-control @error('nom')is-invalid @enderror" placeholder="Entrez votre nom" value="{{ old('nom') }}" required>
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="numero" class="form-label">Numéro matricule</label>
                <input type="text" name="numero" id="numero" class="form-control @error('numero')is-invalid @enderror" placeholder="Entrez votre numéro" value="{{ old('numero') }}" required>
                @error('numero')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" class="form-control @error('mdp')is-invalid @enderror" placeholder="Créez un mot de passe" required>
                @error('mdp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mdp_confirmation" class="form-label">Confirmation du mot de passe</label>
                <input type="password" name="mdp_confirmation" id="mdp_confirmation" class="form-control @error('mdp_confirmation')is-invalid @enderror" placeholder="Confirmez votre mot de passe" required>
                @error('mdp_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-register">Créer mon compte</button>
        </form>

        <div class="divider">
            <span>ou</span>
        </div>

        <div class="login-link">
            <a href="{{ route('login') }}">Déjà un compte ? Se connecter</a>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
