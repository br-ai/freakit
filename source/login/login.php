<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

                $email = mysqli_real_escape_string(connect(), $_POST['email']);
                $password = mysqli_real_escape_string(connect(), $_POST['password']);

                $query = "SELECT id, email, password FROM users WHERE email = '$email'";
                $result = mysqli_query(connect(), $query);

                if ($result) {
                    $rowCount = mysqli_num_rows($result);

                    if ($rowCount == 1) {
                        $row = mysqli_fetch_assoc($result);

                        // Vérifier le mot de passe
                        if (password_verify($password, $row['password'])) {
                            // Mot de passe correct, création de la session
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['email'] = $row['email'];

                            // Rediriger vers la page d'accueil ou toute autre page souhaitée
                            header("Location: ../home/home.php");
                            exit();
                        } else {
                            // Mot de passe incorrect
                            $error_message = "Mot de passe incorrect.";
                        }
                    } else {
                        // Aucun utilisateur trouvé dans la base de données
                        $error_message = "Aucun utilisateur trouvé avec cet email.";
                    }
                } else {
                    // Erreur lors de l'exécution de la requête
                    $error_message = "Erreur lors de la vérification des informations d'identification : " . mysqli_error(connect());
                }

                // Afficher le message d'erreur s'il y en a un
                $error_message = "Email ou Mot de passe incorrect";
                echo '<div style="display: block; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; background-color: #ff0000; color: #fff; border-radius: 15px; z-index: 9999; text-align: center;">' . htmlentities($error_message) . '</div>';
            }
            ?>




                <div class="card border-0">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="mb-4">
                                        <h3 class="h4 font-weight-bold text-theme">Connectez vous</h3>
                                        
                                    </div>
                                    <div class="social-title ">Connectez vous avec vos reseaux sociaux</div>
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
                                    
    
                                    <form action="login.php" method="post">
                                        <div class="form-group">
                                            <label for="email">Email <span class="required_form">*</span></label>
                                            <input type="email" required name="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-5">
                                            <label for="password">Mot de passe <span class="required_form">*</span></label>
                                            <input type="password" name="password" required class="form-control" id="password">
                                        </div>
                                        <button type="submit" class="btn btn-success w-100">Se Connecter</button>
                                        
                                    </form>
                                    
                                </div>
                                <div class="connexion_link">
                                    <a href="reset_password.php" class="forgot-link float-right text-primary">Mot de passe oublié?</a>
                                    <p class="text-muted text-center mt-3 mb-0">Pas encore inscrit? <a href="avatar.html" class="text-primary ml-1">Inscrivez vous</a></p>
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
    
</body>
</html>