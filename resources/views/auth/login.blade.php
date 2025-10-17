<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Forvis Mazars</title>

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

        .login-container {
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

        .login-title {
            font-size: 1.8rem;
            color: #1A2142;
            font-weight: 600;
            text-align: center;
            margin-bottom: 10px;
        }

        .login-subtitle {
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

        .btn-login {
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

        .btn-login:hover {
            background: #2645d4;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(54, 92, 245, 0.3);
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
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

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #365CF5;
            font-weight: 500;
            text-decoration: none;
        }

        .register-link a:hover {
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

        .form-check {
            padding-left: 1.5em;
        }

        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            margin-top: 0.15em;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #365CF5;
            border-color: #365CF5;
        }

        .form-check-input:focus {
            border-color: #365CF5;
            box-shadow: 0 0 0 3px rgba(54, 92, 245, 0.1);
        }

        .form-check-label {
            color: #1A2142;
            font-size: 14px;
            cursor: pointer;
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 40px 25px;
            }
        }
    </style>
</head>
<body>

    <a href="{{ url('/') }}" class="back-link">
        ← Retour à l'accueil
    </a>

    <div class="login-container">
        <div class="logo-section">
            <img src="{{ asset('assets/images/logo/mazars.png') }}" alt="Forvis Mazars">
            <h1 class="login-title">Connexion</h1>
            <p class="login-subtitle">Accédez à votre espace de gestion</p>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.action')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="numero" class="form-label">Numéro matricule</label>
                <input type="text" name="numero" id="numero" class="form-control" placeholder="Entrez votre numéro" autocomplete="username" list="saved-numbers" required>
                <datalist id="saved-numbers">
                </datalist>
            </div>

            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Entrez votre mot de passe" autocomplete="current-password" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label class="form-check-label" for="remember">
                    Se souvenir de moi
                </label>
            </div>

            <button type="submit" class="btn-login">Se connecter</button>
        </form>

        <div class="divider">
            <span>ou</span>
        </div>

        <div class="register-link">
            <a href="{{ route('register') }}">Créer un compte</a>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script>
        // Charger les identifiants sauvegardés
        document.addEventListener('DOMContentLoaded', function() {
            const numeroInput = document.getElementById('numero');
            const mdpInput = document.getElementById('mdp');
            const rememberCheckbox = document.getElementById('remember');
            const datalist = document.getElementById('saved-numbers');
            const form = document.querySelector('form');

            // Récupérer les identifiants sauvegardés depuis localStorage
            const savedCredentials = JSON.parse(localStorage.getItem('savedCredentials') || '{}');

            // Remplir le datalist avec les numéros sauvegardés
            Object.keys(savedCredentials).forEach(numero => {
                const option = document.createElement('option');
                option.value = numero;
                datalist.appendChild(option);
            });

            // Remplir automatiquement le mot de passe quand on sélectionne un numéro
            numeroInput.addEventListener('input', function() {
                const numero = this.value.trim();
                if (savedCredentials[numero]) {
                    mdpInput.value = savedCredentials[numero];
                    rememberCheckbox.checked = true;
                }
            });

            // Sauvegarder les identifiants quand le formulaire est soumis avec "Se souvenir de moi" coché
            form.addEventListener('submit', function() {
                if (rememberCheckbox.checked) {
                    const numero = numeroInput.value.trim();
                    const mdp = mdpInput.value;
                    if (numero && mdp) {
                        savedCredentials[numero] = mdp;
                        localStorage.setItem('savedCredentials', JSON.stringify(savedCredentials));
                    }
                }
            });
        });
    </script>
</body>
</html>
