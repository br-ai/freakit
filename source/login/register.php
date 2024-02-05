<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                
            <?php
                                    session_start();

                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        include '../sql/connect.php';

                
                                        $pseudo = mysqli_real_escape_string(connect(), $_POST['pseudo']); // Échapper les données pour éviter les attaques par injection SQL
                                        $email = mysqli_real_escape_string(connect(), $_POST['email']);
                                        $birthday = $_POST['birthday'];
                                        $banner = mysqli_real_escape_string(connect(), $_POST['banner']);
                                        $password1 = $_POST['password1'];
        
                                        $target_dir = "user_avatar/";
                                        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
                                        $uploadOk = 1;
                                        

                                        $verificationCode = uniqid();

                                        
                                        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                                            
                                        } else {
                                            
                                            echo '<div style="display: block;
                                            position: fixed;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%);
                                            padding: 67px;
                                            background-color: #ff0000;
                                            color: #fff;
                                            border-radius: 15px;
                                            z-index: 9999;
                                            text-align: center;">Désolé, une erreur s\'est produite lors du téléchargement de votre fichier. Réesayer</div>';
                                            exit();
                                        }
                                        
                                       
                                 
                                        $check_username_query = "SELECT * FROM users WHERE pseudo = '$pseudo'";
                                        $check_username_result = mysqli_query(connect(), $check_username_query);

                                        // ...
                                        if (mysqli_num_rows($check_username_result) > 0) {
                                            // Le pseudo est déjà utilisé, renvoyer une erreur
                                            echo '<div style="display: block;
                                            position: fixed;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%);
                                            padding: 67px;
                                            background-color: #ff0000;
                                            color: #fff;
                                            border-radius: 15px;
                                            z-index: 9999;
                                            text-align: center;">Le pseudo \'' . $pseudo . '\' est déjà utilisé. Veuillez choisir un autre pseudo.</div>';
           
                                            exit();
                                        }

                                    
                                        $check_email_query = "SELECT * FROM users WHERE email = '$email'";
                                        $check_email_result = mysqli_query(connect(), $check_email_query);

                                        // ...
                                        if (mysqli_num_rows($check_email_result) > 0) {
                                            // L'email est déjà utilisée, renvoyer une erreur
                                            echo '<div style="display: block;
                                            position: fixed;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%);
                                            padding: 67px;
                                            background-color: #ff0000;
                                            color: #fff;
                                            border-radius: 15px;
                                            z-index: 9999;
                                            text-align: center;">email \'' . $email . '\' est déjà utilisé. Veuillez choisir un autre email.</div>';
           
                                            exit();
                                        }

                                 
                                        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

                                    
                                        $connexion = connect();

                                        // Requête d'insertion
                                        $query = "INSERT INTO users (pseudo, email, birthday, banner, avatar, password, verificationCode) VALUES ('$pseudo', '$email', '$birthday', '$banner', '$target_file', '$hashed_password', '$verificationCode')";

                                        // Exécution de la requête
                                        if (mysqli_query($connexion, $query)) {
                                          
                                            $_SESSION['email'] = $email;
                                            


                                            $confirmationLink = "localhost/freakit/source/login/verified.php?code=$verificationCode";
                                            $headers = "From: brandonsitedjeya@gmail.com";

                                            $message = "Merci de cliquer sur le lien suivant pour vérifier votre compte : $confirmationLink";
                                            mail($email, "Confirmation de compte", $message, $headers);


                                            echo '<div style="display: block;
                                            position: fixed;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%);
                                            padding: 67px;
                                            background-color: #7fff35;
                                            color: #fff;
                                            border-radius: 15px;
                                            z-index: 9999;
                                            text-align: center;"><section class="mail-seccess section">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-6 offset-lg-3 col-12">
                                                        <!-- Error Inner -->
                                                        <div class="success-inner">
                                                            <h1><i class="fa fa-envelope"></i><span> Verifier votre adresse mail!</span></h1>
                                                            <p>Activer votre compte en cliquant sur le lien par mail. ou bien copier le et coller dans un navigateur</p>
                                                            
                                                        </div>
                                                        <!--/ End Error Inner -->
                                                    </div>
                                                </div>
                                            </div>
                                        </section> </div>';
                                            // header("Location: ../home/home.php");
                                            exit();
                                        } else {
                                            // Erreur lors de l'enregistrement
                                          
                                            echo '<div style="display: block;
                                            position: fixed;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%);
                                            padding: 67px;
                                            background-color: #ff0000;
                                            color: #fff;
                                            border-radius: 15px;
                                            z-index: 9999;
                                            text-align: center;">Erreur lors de enregistrement' . mysqli_error($connexion) . '</div>';
                                            exit();
                                        }

                                        // Fermeture de la connexion
                                        mysqli_close($connexion);
                                    }
                                    ?>



                <div class="card border-0">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="mb-4">
                                        <h3 class="h4 font-weight-bold text-theme">2. Inscrivez vous</h3>
                                        
                                    </div>
                                    <div class="social-title ">Inscrivez vous avec vos reseaux sociaux</div>
                                    <div class="social-buttons">
                                        <a href="" class="button-facebook">
                                            <i class="social-icon fa fa-facebook"></i>
                                        </a>
                                        
                                        <a href="" class="button-google">
                                            <i class="social-icon fa fa-google"></i>
                                        </a>

                                        <a href="" class="button-facebook">
                                            <i class="social-icon fa fa-linkedin"></i>
                                        </a>
                                    </div>
                                   
    
                                    <h6 class="h5 mb-4">Bienvenue</h6>

                                    <form action="register.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="pseudo">Pseudo <span class="required_form">*</span></label>
                                            <input pattern=".{3,25}" title="Le pseudo doit avoir entre 3 et 25 caractères." required type="pseudo" id="pseudo" name="pseudo" class="form-control" id="pseudo">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email <span class="required_form">*</span></label>
                                            <input required type="email" name="email" class="form-control" id="email">
                                        </div>

                                        <div class="form-group">
                                            <label for="birthday">Date de naissance <span class="required_form">*</span></label>
                                            <input required type="date" max="2012-01-01" name="birthday" class="form-control" id="birthday">
                                        </div>

                                        <div class="form-group">
                                            <label for="bannerTextarea">Banner <span class="required_form">*</span></label>
                                            <textarea name="banner" required rows="3" cols="10" class="form-control" id="bannerTextarea" placeholder="Exemple de banniere : Lazy people are the most intelligent 😴"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="avatarInput">Avatar</label>
                                            <input required name="avatar" type="file" class="form-control" id="avatarInput" accept=".png" onchange="validateAvatar()">
                                        </div>
                                        

                                        <div class="form-group">
                                            <label for="password1">Mot de passe <span class="required_form">*</span></label>
                                            <input required type="password" name="password1" class="form-control" id="password1">
                                        </div>

                                        <div class="form-group mb-5">
                                            <label for="password2">Confirmez votre mot de passe <span class="required_form">*</span></label>
                                            <input required type="password" name="password2" class="form-control" oninput="validatePasswords()" id="password2">
                                            <p id="passwordError" class="error-message"></p>
                                        </div>

                                        <button type="submit" class="btn btn-success w-100" id="submitButton" disabled>S'inscrire</button>
                                        
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