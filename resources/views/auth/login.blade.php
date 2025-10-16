<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('style/material-design-iconic-font.min.css')}}" />
   

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('style/style.css')}}" />
 
</head>
<body>

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                  

                    <div class="signin-form">
                        <h2 class="form-title">Facturation</h2>
                        <form action="{{ route('login.action')}}" method="POST" class="register-form" id="login-form">
                            @csrf
                                @if ($errors->any())
                                   
                                        @foreach ($errors->all() as $error)
                                            <p class="errorlog"> {{ $error }}</p>
                                        @endforeach
                                   
            
                                @endif


                            <div class="form-group">
                                <label for="numero"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="numero" id="numero" placeholder="Numero matricule"/>
                            </div>


                            <div class="form-group">
                                <label for="mdp"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe"/>
                            </div>


                       

                            <div class="form-group form-button">
                                <input type="submit" class="form-submit" value="Se connecter"/>
                            </div>
                        </form>

                       
                        <div class="form-group">
                            
                            <span class="social-label"> <a href="{{ route('register') }}" class="signup-image-link">Créer un compte</a></span>
                             
                          
                         
                  
                           
                         
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
        </div>







</body>
</html>