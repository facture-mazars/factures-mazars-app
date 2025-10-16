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
                        <h2 class="form-title">Inscription</h2>
                        <form action="{{ route('register.save')}}" method="POST" class="register-form" id="login-form">
                        @csrf


                        <div class="form-group">
                                <label for="nom"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nom" class="@error('nom')is-invalid @enderror" id="nom" placeholder="Nom utilisateur"/>
                                @error('nom')
                                    <span class="errorlog"> {{ $message }} </span>
                                @enderror
                        </div>

                            <div class="form-group">
                                <label for="numero"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="numero" class="@error('numero')is-invalid @enderror" id="numero" placeholder="Numero matricule"/>
                                @error('numero')
                                    <span class="errorlog"> {{ $message }} </span>
                                 @enderror
                            </div>



                            <div class="form-group">
                                <label for="mdp"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="mdp" class="@error('mdp')is-invalid @enderror" id="mdp" placeholder="Mot de passe"/>
                                @error('mdp')
                                    <span class="errorlog"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="mdp_confirmation"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="mdp_confirmation" class="@error('mdp_confirmation')is-invalid @enderror" id="mdp_confirmation" placeholder="Confirmation mot de passe"/>
                                @error('mdp_confirmation')
                                    <span class="errorlog"> {{ $message }} </span>
                                @enderror
                            </div>


                          


                            <div class="form-group form-button">
                                <input type="submit" class="form-submit" value="Valider"/>
                            </div>
                        </form>

                       
                        <div class="form-group">
                            
                            <span class="social-label"> <a href="{{ route('login') }}" class="signup-image-link">Déjà un compte ?</a></span>
                           
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
        </div>

</body>
</html>
