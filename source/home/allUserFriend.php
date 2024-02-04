
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>
                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <div class="flex-1">
                                    <h4 class="card-title mb-4">Vos Amis :
                                    <?php 
                                   

                                   $user_id = getIdFromEmail();

                                   // Requête pour obtenir le nombre d'amis d'un utilisateur
                                   $query = "SELECT COUNT(*) as friendCount FROM friends WHERE (user_id_1 = $user_id OR user_id_2 = $user_id) AND status = 'accepted'";
                                   
                                   $count = mysqli_query(connect(), $query);
                               
                                   if ($count && $rows = mysqli_fetch_assoc($count)) {
                                       echo $rows['friendCount'];
                                   }
                                    ?></h4>
                                </div>
                            </div>
        
                            <div class="row" id="all-projects">
                                        <?php
            $user_id = getIdFromEmail();
            $connexion = connect();

            // Récupérer tous les amis de l'utilisateur
            $queryFriends = "SELECT user_id_1, user_id_2 FROM friends WHERE (user_id_1 = $user_id OR user_id_2 = $user_id) AND status = 'accepted'";
            $resultFriends = mysqli_query($connexion, $queryFriends);

            if ($resultFriends) {
                while ($rowFriends = mysqli_fetch_assoc($resultFriends)) {
                    // Récupérer les informations de chaque ami
                    $friend_id = ($rowFriends['user_id_1'] == $user_id) ? $rowFriends['user_id_2'] : $rowFriends['user_id_1'];
                    
                    $queryUserInfo = "SELECT * FROM users WHERE id = '$friend_id'";
                    $resultUserInfo = mysqli_query($connexion, $queryUserInfo);

                    if ($resultUserInfo && $rowUserInfo = mysqli_fetch_assoc($resultUserInfo)) {
                        ?>
                        <div class="col mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <?php 
                                    echo '<img src="../login/' . $rowUserInfo['avatar'] . '" style="width:100px;" alt="user" class="img-fluid img-thumbnail rounded-circle">';
                                    ?>
                                    <h5 class="card-title"><?php echo $rowUserInfo['pseudo']; ?></h5>
                                    <p class="text-secondary mb-1"><?php echo $rowUserInfo['banner']; ?></p>
                                    <p class="text-muted font-size-sm">Membre depuis le : <?php echo $rowUserInfo['date_joined']; ?></p>
                                </div>
                                <div class="card-footer card-footers">
                                    <a href="userProfil.php?id=<?php echo $rowUserInfo['id']; ?>" class="user_profil_button">Voir profil</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                echo "Erreur : " . mysqli_error($connexion);
            }

            mysqli_close($connexion);
            ?>

<!-- end card -->

<!-- Nouvelle demande d'amitié -->
<hr>





                <div class="card" style="background-color: aliceblue;">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <div class="flex-1">
                                    <h4 class="card-title mb-4" style="color:black;background-color:aquamarine;">Vos Demandes d'amitié :
                                    <?php 
                                   

                                   $user_id = getIdFromEmail();

                                   // Requête pour obtenir le nombre d'amis d'un utilisateur
                                   $query = "SELECT COUNT(*) as friendCount FROM friends WHERE (user_id_1 = $user_id OR user_id_2 = $user_id) AND status = 'pending'";
                                   
                                   $count = mysqli_query(connect(), $query);
                               
                                   if ($count && $rows = mysqli_fetch_assoc($count)) {
                                       echo $rows['friendCount'];
                                   }
                                    ?></h4>
                                </div>
                            </div>
        
                            <div class="row" id="all-projects">
                                        <?php
            $user_id = getIdFromEmail();
            $connexion = connect();

            // Récupérer tous les amis de l'utilisateur
            $queryFriends = "SELECT user_id_1, user_id_2 FROM friends WHERE user_id_2 = $user_id AND status = 'pending'";
            $resultFriends = mysqli_query($connexion, $queryFriends);

            if ($resultFriends) {
                
                while ($rowFriends = mysqli_fetch_assoc($resultFriends)) {
                    // Récupérer les informations de chaque ami
                    $friend_id = ($rowFriends['user_id_1'] == $user_id) ? $rowFriends['user_id_2'] : $rowFriends['user_id_1'];
                    
                    $queryUserInfo = "SELECT * FROM users WHERE id = '$friend_id'";
                    $resultUserInfo = mysqli_query($connexion, $queryUserInfo);

                    if ($resultUserInfo && $rowUserInfo = mysqli_fetch_assoc($resultUserInfo)) {
                        ?>
                        <div class="col mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <?php 
                                    echo '<img src="../login/' . $rowUserInfo['avatar'] . '" style="width:100px;" alt="user" class="img-fluid img-thumbnail rounded-circle">';
                                    ?>
                                    <h5 class="card-title"><?php echo $rowUserInfo['pseudo']; ?></h5>
                                    <p class="text-secondary mb-1"><?php echo $rowUserInfo['banner']; ?></p>
                                    <p class="text-muted font-size-sm">Membre depuis le : <?php echo $rowUserInfo['date_joined']; ?></p>
                                </div>
                                <div class="card-footer card-footers">
                                <a href="userAcceptFriend.php?id=<?php echo $rowUserInfo['id']; ?>"><button type="" class="btn btn-success w-70"><i class="fa fa-check"></i> Accepter </button></a>
                                    <a href="userProfil.php?id=<?php echo $rowUserInfo['id']; ?>" class="user_profil_button">Voir profil</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                echo "Erreur : " . mysqli_error($connexion);
            }

            mysqli_close($connexion);
            ?>



























                <?php include '../base/footer.php';?>