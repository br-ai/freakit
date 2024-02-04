
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>
<div class="card">
        <?php
            $id = mysqli_real_escape_string(connect(), $_GET['id']);
            $query = "SELECT * FROM users WHERE id = '$id'";
            $resultats = mysqli_query(connect(), $query);

            if ($result) {
                while ($rows = mysqli_fetch_assoc($resultats)) {

            ?>

            <div class="card-body pb-0">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="text-center border-end">
                            <img src="../login/<?php echo $rows['avatar']; ?>" class="img-fluid avatar-xxl rounded-circle" alt="">
                            <h4 class="text-primary font-size-20 mt-3 mb-2"><?php echo $rows['pseudo']; ?></h4>
                            <?php 
                            $user_id_1 = getIdFromEmail();
                            $resultat = getFriendshipStatus($user_id_1, $rows['id']);
                            if ($resultat == 'accepted'){
                                echo '<h6 class="text-muted font-size-13 mb-2">⭐ Ami ⭐</h6>';
                            }
                            if ($resultat == 'pending'){
                                echo '
                                <button type="submit" class="btn btn-success w-70" disabled><i class="fa fa-spinner"></i> En attente </button>';
                            }
                            elseif ($resultat == 'Non ami'){
                                echo '<form action="addFriend.php" method="post">
                                <input type="hidden" name="user_id_2" value="' . $rows['id'] . '">
                                <button type="submit" class="btn btn-success w-70"><i class="fa fa-plus"></i> Ajouter ami</button>
                                </form>';
                                
                            }
                
                            elseif ($resultat == 'rejected'){
                                echo '
                                <button type="submit" class="btn btn-success w-70" disabled><i class="fa fa-ban"></i> Refusé </button>';
                            }
                            else{
                                echo '
                                ';
                            }
                            ?>
                            
                        </div>
                    </div><!-- end col -->
                    <div class="col-md-9">
                        <div class="ms-3">
                            <div>
                                <h4 class="card-title mb-2">Bannière</h4>
                                <p class="mb-0 text-muted"><?php echo $rows['banner']; ?></p>
                            </div>
                            <div class="row my-4">
                                <div class="col-md-12">
                                    <div>
                                        <p class="text-muted mb-2 fw-medium"><i class="mdi mdi-email-outline me-2"></i><?php echo $rows['email']; ?>
                                        </p>
                                        <p class="text-muted fw-medium mb-0"><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo $rows['date_joined']; ?>
                                        </p>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                         
                            
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end card body -->
           
        </div><!-- end card -->



                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <div class="flex-1">
                                    <h4 class="card-title mb-4">Les Forums de <?php echo $rows['pseudo']; ?> 🔥</h4>
                                </div>
                            </div>
                            <?php
                                                }
                                    } else {
                                        echo "Erreur : " . mysqli_error($connexion);
                                    }

                                    mysqli_close($connexion);
                                    ?>
        
                            <div class="row" id="all-projects">
                            <?php
                                    // include '../sql/connect.php';
                                    $user_id = mysqli_real_escape_string(connect(), $_GET['id']);
                                    $connexion = connect();

                                    $query = "SELECT * FROM forum WHERE user_creator_id = '$user_id' ORDER BY date_created DESC";


                                    $result = mysqli_query($connexion, $query);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                
                                    ?>
                                    
                                <div class="col-md-6" id="project-items-<?php echo $row['id']; ?>" onclick="location.href='forumDetails?forum_id=<?php echo $row['id']; ?>'">

                                



                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex mb-3">
                                                <div class="flex-grow-1 align-items-start">
                                                    <div>
                                                        <h6 class="mb-0 text-muted">
                                                            <?php if ($row['status']=='en cours'){
                                                               echo '<i class="mdi mdi-circle-medium text-success fs-3 align-middle"></i>'; 
                                                            }
                                                            else{
                                                               echo '<i class="mdi mdi-circle-medium text-danger fs-3 align-middle"></i>'; 
                                                            }
                                                            ?>
                                                            <span class="team-date"><?php
                                                            $now = new DateTime();
                                                            $dateCreated = DateTime::createFromFormat('Y-m-d H:i:s', $row['date_created']);
                                                            $interval = $now->diff($dateCreated);

                                                            if ($interval->h == 0) {
                                                                echo "Créé maintenant";
                                                            } else {
                                                                echo 'Créé il y a ' . $interval->format("%a jours, %h heures");
                                                            }
                                                        ?></span>
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="dropdown ms-2">
                                                    <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
        
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal" data-bs-target=".bs-example-new-project" onclick="editProjects('project-items-1')"><i class="fa fa-share" aria-hidden="true"></i> Partager</a>
                                                        <a class="dropdown-item" href="javascript: void(0);"> <i class="fa fa-ban" aria-hidden="true"></i> Signaler</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item delete-item" onclick="deleteProjects('project-items-1')" data-id="project-items-1" href="javascript: void(0);"> <i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</a>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="mb-4">
                                                <h5 class="mb-1 font-size-17 team-title"><?php echo $row['title']; ?></h5>
                                                <p class="text-muted mb-0 team-description"><?php echo $row['message']; ?> </p>
                                            </div>
                                            <?php
                                                // Supposons que $row soit le résultat de votre requête pour récupérer les informations du forum

                                                // Récupérez les informations de l'utilisateur correspondant à user_creator_id
                                                $userQuery = "SELECT pseudo FROM users WHERE id = " . $row['user_creator_id'];
                                                $userResult = mysqli_query($connexion, $userQuery);

                                                // Vérifiez si la requête a réussi
                                                if ($userResult) {
                                                    $userData = mysqli_fetch_assoc($userResult);
                                                    $pseudo = $userData['pseudo'];
                                                } else {
                                                    // Gérez l'erreur en conséquence
                                                    $pseudo = "Utilisateur inconnu";
                                                }
                                                ?>

                                                <p class="text-sm"><span class="op-6" style="color: grey;">Crée par</span>  <a class="text-black-underline" href="#"><?php echo $pseudo; ?></a></p>

                                            
                                                <?php
                                                // fais une requete qui recupere les commetaires d'un forum
                                                $commentQuery = "SELECT count(*) as commentCount FROM comments WHERE forum_id = " . $row['id'];
                                                $commentResult = mysqli_query($connexion, $commentQuery);

                                               
                                               
                                               
                                                if ($commentResult) {
                                                    $commentData = mysqli_fetch_assoc($commentResult);
                                                    $commentCount = $commentData['commentCount'];

                                                    // Détermine le nombre d'étoiles en fonction du nombre de commentaires
                                                    if ($commentCount >= 0 && $commentCount < 10) {
                                                        $starRating = 0;
                                                    } elseif ($commentCount >= 10 && $commentCount < 20) {
                                                        $starRating = 1;
                                                    } elseif ($commentCount >= 20 && $commentCount < 50) {
                                                        $starRating = 2;
                                                    } elseif ($commentCount >= 50 && $commentCount < 100) {
                                                        $starRating = 3;
                                                    } elseif ($commentCount >= 100 && $commentCount < 5000) {
                                                        $starRating = 4;
                                                    } elseif ($commentCount >= 5000) {
                                                        $starRating = 5;
                                                    }

                                                    
                                                } else {
                                                    // Gérez l'erreur en conséquence
                                                    echo "Erreur lors de la récupération des commentaires.";
                                                }

                                                
                                                ?>

                      



                                            <div class="details">
                                                
                                                    <?php 
                                                    echo '<div class="details_item"><i class="fa fa-star"></i> ' . $starRating . ' stars</div>';
                                                    echo '<div class="details_item"><i class="fa fa-comments" aria-hidden="true"></i> ' . $commentCount . ' comments</div>';
                                      
                                                    ?>

                                    
                                                <!-- <div class="details_item">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>284 vues
                                                </div>
                                    
                                                 -->
                                            </div>
                                            <br>

                                            <div class="d-flex">
                                                <div class="avatar-group float-start flex-grow-1 task-assigne">

                                                <?php
                                                // Faire une requête qui récupère les commentaires d'un forum
                                                $commentQuery = "SELECT * FROM comments WHERE forum_id = ?";
                                                $commentStmt = mysqli_prepare($connexion, $commentQuery);
                                                mysqli_stmt_bind_param($commentStmt, "i", $row['id']);
                                                mysqli_stmt_execute($commentStmt);
                                                $commentResult = mysqli_stmt_get_result($commentStmt);

                                                // Vérifier si la requête a réussi
                                                while ($comment = mysqli_fetch_assoc($commentResult)) {
                                                    // Faire une requête pour récupérer l'avatar de l'utilisateur
                                                    $userQuery = "SELECT avatar FROM users WHERE id = ?";
                                                    $userStmt = mysqli_prepare($connexion, $userQuery);
                                                    mysqli_stmt_bind_param($userStmt, "i", $comment['user_id']);
                                                    mysqli_stmt_execute($userStmt);
                                                    $userResult = mysqli_stmt_get_result($userStmt);

                                                    // Vérifier si la requête a réussi
                                                    if ($user = mysqli_fetch_assoc($userResult)) {
                                                        ?>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-<?= $comment['user_id'] ?>" aria-label="<?= $user['avatar'] ?>" data-bs-original-title="<?= $user['avatar'] ?>">
                                                                <img src="../login/<?= $user['avatar'] ?>" alt="" class="rounded-circle avatar-sm"> 
                                                            </a>
                                                        </div>
                                                        
                                                        <?php
                                                    }
                                                }

                                                // Fermer les déclarations préparées
                                                mysqli_stmt_close($commentStmt);
                                                // mysqli_stmt_close($userStmt);
                                                ?>


                                                </div><!-- end avatar group -->
                                                <div class="align-self-end">
                                                    <?php if ($row['status'] == 'en cours'){
                                                        echo '<span class="badge badge-soft-success p-2 team-status">' . $row['status'] . ' </span>';
                                                    }
                                                    else{ 
                                                     echo '<span class="badge badge-soft-danger p-2 team-status">' . $row['status'] . '</span>'; }
                                                     ?>
                                                </div>
                                            </div>
                                        </div><!-- end cardbody -->
                                    </div><!-- end card -->
                                    

                                </div><!-- end col -->
                                
                                <?php
                                                }
                                    } else {
                                        echo "Erreur : " . mysqli_error($connexion);
                                    }

                                    mysqli_close($connexion);
                                    ?>
                                
                            </div><!-- end row -->
                        </div><!-- end tab pane -->
                        
                    </div>
                </div><!-- end card -->
                <?php include '../base/footer.php';?>