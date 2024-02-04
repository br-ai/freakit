<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="../icon.png" sizes="180x180">
</head>
<body>

    <div class="navbar">
        <div class="nav_logo">
            <img src="../freakit.png" alt="logo" title="logo"/>
        </div>

        <div class="nav_link">
            

            <div class="nav_link_item">
                <i class="fa fa-user" aria-hidden="true"></i> Aide
            </div>

            <div class="nav_link_item">
                <i class="fa fa-th-list" aria-hidden="true"></i> Confidentialité
            </div>

            <div class="nav_link_item">
                <i class="fa fa-cog" aria-hidden="true"></i> Cgu
            </div>
        </div>

        <div class="nav_search">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Recherche...">
                <i class="fa fa-search search-icon"></i>
              </div>
        </div>

        <div class="burger_icon" id="burger_icon">
            
            <svg xmlns="http://www.w3.org/2000/svg" height="24" fill="#0d90c3" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
            <div class="dropdown">
                <div class="nav_link_item">Aide</div>
                <div class="nav_link_item">Confidentialité</div>
                <div class="nav_link_item">CGU</div>
            </div>
        </div>
        

    </div>
   
    <div id="main-wrapper" class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">


          





                <div class="card border-0">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="mb-4">
                                        <h3 class="h4 font-weight-bold text-theme">Renitialiser votre mot de passe</h3>
                                        
                                    </div>
                                    
                                   
    
                                    <h6 class="h5 mb-4">Bienvenue</h6>

                                    <form action="reset_password3.php" method="post">
                                        


                                        <div class="form-group">
                                            <label for="password1">Mot de passe <span class="required_form">*</span></label>
                                            <input required type="password" name="password1" class="form-control" id="password1">
                                        </div>

                                        <div class="form-group mb-5">
                                            <label for="password2">Confirmez votre mot de passe <span class="required_form">*</span></label>
                                            <input required type="password" name="password2" class="form-control" oninput="validatePasswords()" id="password2">
                                            <p id="passwordError" class="error-message"></p>
                                        </div>

                                        <?php
                                        session_start();
                                        include '../sql/connect.php';

                                        if (isset($_GET['code'])) {
                                            $verificationCode = mysqli_real_escape_string(connect(), $_GET['code']);
                                             
                                            echo '<input type="hidden" name="verificationCode" value="' . $verificationCode . '">';
                                        }
                                        ?>

                                        

                                        <button type="submit" class="btn btn-success w-100" id="submitButton" disabled>Renitialiser</button>
                                        
                                        <p class="text-muted text-center mt-3 mb-0">déjà inscrit? <a href="login.php" class="text-primary ml-1">Connectez vous</a></p>
    
                                    </form>
                                </div>
                            </div>
    
                            <div class="col-lg-6 d-none d-lg-inline-block">
                                <div class="account-block rounded-right">
                                    <div class="overlay rounded-right"></div>
                                    <div class="account-testimonial">
                                        <h4 class="text-white mb-4">Tous ce que vous voulez !</h4>
                                        <p class="lead text-white">Rejoignez des milliers de personnes pour echanger sur des sujets du quotidien</p>
                                        <p>6t</p>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
    
                <!-- end row -->
    
            </div>
            <!-- end col -->
        </div>
        <!-- Row -->
    </div>




    <div class="area">
        <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
        </ul>
    </div>
    <script>
        document.getElementById('burger_icon').addEventListener('click', function() {
            var dropdown = document.querySelector('.burger_icon .dropdown');
            dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
        });
    </script>

<script>
    function validateAvatar() {
        var avatarInput = document.getElementById('avatarInput');
        var fileName = avatarInput.value;

        // Vérifie si le fichier est une image PNG et commence par "Myava"
        if (/\bMyAvatar.*\.png$/i.test(fileName)) {
            // Fichier valide
            alert("Fichier valide : " + fileName);
        } else {
            // Fichier invalide, réinitialise le champ
            alert("Veuillez sélectionner votre avatar telechargé précedenment");
            avatarInput.value = '';
        }
    }
</script>
<script>
    function validatePasswords() {
        var password1 = document.getElementById('password1').value;
        var password2 = document.getElementById('password2').value;
        var passwordError = document.getElementById('passwordError');
        var submitButton = document.getElementById('submitButton');

        if (password1 !== password2) {
            passwordError.innerHTML = "Les mots de passe ne correspondent pas.";
            submitButton.disabled = true;
        } else {
            passwordError.innerHTML = "";
            submitButton.disabled = false;
        }
    }
</script>


    
</body>
</html>