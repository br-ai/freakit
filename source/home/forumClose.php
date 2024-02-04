
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>

                                    <?php 
                                    
                                        $user_id = getIdFromEmail();
                                        $forum_id = mysqli_real_escape_string(connect(), $_GET['forum_id']);
                                        $connexion = connect();


                                        $query = "SELECT * FROM forum WHERE id = '$forum_id'";

                                        $queryResult = mysqli_query($connexion, $query);

                                        if ($queryResult) {
                                            $resu = mysqli_fetch_assoc($queryResult);
                                            $id_creator_user = $resu['user_creator_id'];

                                        }

                                        if ($user_id == $id_creator_user){
                                            $queryUpdate = "UPDATE forum SET status = 'Cloture' WHERE id = '$forum_id'";
                                            $resultUpdate = mysqli_query($connexion, $queryUpdate);

                                            if ($resultUpdate) {
                                            
                                                $success = "Le forum a été bien cloturé";
                                                 echo '<script type="text/javascript">window.location.href = "successPage.php?success='. $success . '";</script>';
                                            } else {
                                                // Erreur lors de l'enregistrement
                                                
                                                $error = mysqli_error($connexion);
                                                echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';
        
                                                // echo 'error ' . mysqli_error($connexion) . '';
                                                
                                                
                                            }

                                        }

                                        else{
                                            $error = "Vous n'avez pas les droits pour le faire";
                                                echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';
        
                                        }
    
                                        // Fermeture de la connexion
                                        mysqli_close($connexion);
                                    
                                    ?>