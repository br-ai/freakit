
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>

<?php
                      

                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                       

                                        // Récupération des données du formulaire
                                        $forum_id = mysqli_real_escape_string(connect(), $_POST['forum_id']); // Échapper les données pour éviter les attaques par injection SQL
                                        $user_id = getIdFromEmail();
                                        $message = mysqli_real_escape_string(connect(), $_POST['message']) ;

                                        
                                        // Gérer l'upload de l'image

                                        

                                        if (basename($_FILES["image"]["name"]) != "") {

                                            $target_dir = "image_comments/";
                                            $target_file = $target_dir . basename($_FILES["image"]["name"]);
                                            $uploadOk = 1;
                                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                        
                                            if ($_FILES["image"]["size"] > 500000) {
                                                
                                                $uploadOk = 0;
                                                $error = "Désolé, votre fichier est trop volumineux.";
                                                echo '<script type="text/javascript">window.location.href = "errorPage.php?success='. $error . '";</script>';
                                            }

                                            
                                            

                                            
                                            if ($uploadOk == 0) {
                                                
                                                $error = "Désolé, votre fichier n'a pas été téléchargé.";
                                                echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';
                                            
                                            } else {
                                                if ($_FILES["image"]["size"] > 0 && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                                    echo "Le fichier " . basename($_FILES["image"]["name"]) . " a été téléchargé.";
                                                } else {
                                                    
                                                }
                                            }
                                        }

                                        else {
                                            $target_file = Null;
                                        }




                                        // Connexion à la base de données
                                        $connexion = connect();

                                        // Requête d'insertion
                                        $query = "INSERT INTO comments (forum_id, user_id, comment, image) VALUES ('$forum_id', '$user_id', '$message', '$target_file')";

                                        // Exécution de la requête
                                        if (mysqli_query($connexion, $query)) {
                                            // Enregistrement réussi, création de la session
                                            $success = "Votre message a été publié sur le forum";
                                            echo '<script type="text/javascript">window.location.href = "successPage.php?success='. $success . '";</script>';
                                            
                                        } else {
                                            // Erreur lors de l'enregistrement
                                          
                                            $error = mysqli_error($connexion);
                                            echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';
                                        }

                                        // Fermeture de la connexion
                                        mysqli_close($connexion);
                                    }
                                    ?>