
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>
                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <div class="flex-1">
                                    <h4 class="card-title mb-4">
                                    <?php 
                                    
                                        $user_id_1 = getIdFromEmail();
                                        $user_id_2 = mysqli_real_escape_string(connect(), $_GET['id']);
                                        $connexion = connect();
                            
                                        
                                        // Nouvelle requête pour obtenir le nombre de résultats
                                        $queryFriends = "UPDATE friends SET status = 'accepted' WHERE ((user_id_1 = $user_id_1 AND user_id_2 = $user_id_2) OR 
                                        (user_id_1 = $user_id_2 AND user_id_2 = $user_id_1))";
                                        $resultFriends = mysqli_query($connexion, $queryFriends);
                                        
                                        if (mysqli_query($connexion, $query)) {
                                            
                                            $success = "vous etes maintenant amis!";
                                            echo '<script type="text/javascript">window.location.href = "successPage.php?success='. $success . '";</script>';
                                        } else {
                                            // Erreur lors de l'enregistrement
                                            
                                            $error = mysqli_error($connexion);
                                            echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';
    
                                            // echo 'error ' . mysqli_error($connexion) . '';
                                            
                                            
                                        }
    
                                        // Fermeture de la connexion
                                        mysqli_close($connexion);
                                    
                                    ?>