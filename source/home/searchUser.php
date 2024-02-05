
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>
                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <div class="flex-1">
                                    <h4 class="card-title mb-4">Votre recherche :
                                    <?php 
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                        $search_input = $_POST['search_input'];
                                    $connexion = connect();
                            
                                        
                           
                                        $countQuery = "SELECT COUNT(*) as count FROM users WHERE pseudo LIKE '%$search_input%'";
                                        $countResult = mysqli_query($connexion, $countQuery);
                                        
                                        if ($countResult) {
                                            $countRow = mysqli_fetch_assoc($countResult);
                                            $count = $countRow['count'];
                                            
                                            echo $search_input . ' (' . $count . ' résultats)';
                                        } else {
                                            echo "Erreur lors de la récupération du nombre de résultats.";
                                        }
                                    } else {
                                        echo "Aucun résultat trouvé.";
                                    }
                                    ?></h4>
                                </div>
                            </div>
        
                            <div class="row" id="all-projects">
                            <?php
                                    // include '../sql/connect.php';

                                    $connexion = connect();



                                    $query = "SELECT * FROM users WHERE pseudo LIKE '%$search_input%' ORDER BY date_joined DESC";


                                    $result = mysqli_query($connexion, $query);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                
                                    ?>
                                <div class="col mb-3">
          <div class="card">
            
            <div class="card-body text-center">
            <?php 
              echo '<img src="../login/' . $row['avatar'] . '" style="width:100px;" alt="user" class="img-fluid img-thumbnail rounded-circle">';
              ?>
              <h5 class="card-title"><?php echo $row['pseudo']; ?></h5>
              <p class="text-secondary mb-1"><?php echo $row['banner']; ?></p>
              <p class="text-muted font-size-sm">Membre depuis le : <?php echo $row['date_joined']; ?></p>
            </div>
            <div class="card-footer card-footers">
            <?php 
            // require 'functions.php';

            $user_id_1 = getIdFromEmail();
            $resultat = getFriendshipStatus($user_id_1, $row['id']);


            if ($resultat == 'pending'){
                echo '
                <button type="submit" class="btn btn-success w-70" disabled><i class="fa fa-spinner"></i> En attente </button>';
            }
            elseif ($resultat == 'accepted'){
                echo '
                <button type="submit" class="btn btn-success w-70" disabled><i class="fa fa-check"></i> deja ami </button>';
            }
            elseif ($resultat == 'Non ami'){
                echo '<form action="addFriend.php" method="post">
                <input type="hidden" name="user_id_2" value="' . $row['id'] . '">
                <button type="submit" class="btn btn-success w-70"><i class="fa fa-plus"></i> Ajouter ami</button>
                </form>';
                
            }

            elseif ($resultat == 'rejected'){
                echo '
                <button type="submit" class="btn btn-success w-70" disabled><i class="fa fa-ban"></i> Refusé </button>';
            }
            else{
                echo '
                <button type="submit" class="btn btn-success w-70" disabled><i class="fa fa-ban"></i> vous meme </button>';
            }
            
            ?>

            <!-- <button type="" class="btn btn-success w-70"><i class="fa fa-plus"></i> Ajouter ami</button> -->
                                        
              <!-- <button class="btn btn-light btn-sm bg-white has-icon btn-block" type="button"> ajouter</button> -->
              <a href="userProfil.php?id=<?php echo $row['id']; ?>" class="user_profil_button">Voir profil</a>
            </div>
          </div>
        </div>

                                
        <?php
                                                }
                                    } else {
                                        echo "Erreur : " . mysqli_error($connexion);
                                    }

                                    mysqli_close($connexion);
                                    ?>
                <?php include '../base/footer.php';?>