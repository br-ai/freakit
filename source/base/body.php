



<div class="container">
    <div class="row">

        <div class="col-lg-3 sidebar">
        
            <div class="profile-card">
            <?php
            ob_start();
                session_start();
                include '../sql/connect.php';
                include '../home/functions.php';
                // Vérifiez si l'utilisateur est connecté
                if (isset($_SESSION['email'])) {
                    $email = mysqli_real_escape_string(connect(), $_SESSION['email']);

                    // Requête pour récupérer des informations supplémentaires à partir de la table users
                    $query = "SELECT * FROM users WHERE email = '$email'";
                    $result = mysqli_query(connect(), $query);

                    if ($result) {
                        $user = mysqli_fetch_assoc($result);

                        // Affichez les informations récupérées
                        echo '<div class="profile_image">';
                        echo '<img src="../login/' . $user['avatar'] . '" alt="user" class="profile-photo">';
                        echo '<h5><a href="#" class="text-white">' . $user['pseudo'] . '</a></h5>';
                        echo '<a href="#" class="text-white">' . $user['banner'] . '</a>';
                        echo '</div>';
                    } else {
                        // Gestion de l'erreur de requête
                        echo "Erreur lors de la récupération des informations d'utilisateur : " . mysqli_error(connect());
                    }
                } else {
                    // L'utilisateur n'est pas connecté
                    header("Location: ../login/login.php");
                }ob_end_flush();?>
              </div><!--profile card ends-->
            <ul class="nav-news-feed">
            <?php
            $filename = basename($_SERVER["SCRIPT_FILENAME"]);

            function isActivePage($pageName) {
                global $filename;
                return ($filename == $pageName) ? 'active_sidebar' : '';
            }
            ?>

            <!-- Ensuite, dans votre HTML, vous pouvez utiliser la fonction isActivePage() pour déterminer la classe active : -->

            <a href="home.php"><li class="<?= isActivePage('home.php') ?>"><i class="fa fa-list-alt icon1"></i> Home</li></a>
            <a href="allUserForum.php"><li class="<?= isActivePage('allUserForum.php') ?>"><i class="fa fa-comments icon6"></i> Mes forums</li></a>
            <a href="allUserFriend.php"><li class="<?= isActivePage('allUserFriend.php') ?>"><i class="fa fa-users icon3"></i><div>Amis 
              (<?php
              $user_id = getIdFromEmail();

              // Requête pour obtenir le nombre d'amis d'un utilisateur
              $query = "SELECT COUNT(*) as friendCount FROM friends WHERE (user_id_1 = $user_id OR user_id_2 = $user_id) AND status = 'accepted'";
              
              $result = mysqli_query(connect(), $query);
          
              if ($result && $row = mysqli_fetch_assoc($result)) {
                  echo $row['friendCount'];
              }
          
              
          
          ?>)
            </div></li></a>
            <!-- <li><i class="fa fa-comments icon4"></i><div><a href="#">Messages</a></div></li> -->
            <li><i class="fa fa-bell icon5"></i><div><a href="#">Notifications</a></div></li>
            <a href="userSettings.php"><li class="<?= isActivePage('userSettings.php') ?>"><i class="fa fa-user icon6"></i><div>Mon Profil</div></li></a>

            
            </ul><!--news-feed links ends-->
            <div id="chat-block">

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

              <div class="title">Chat online</div>
              <ul class="online-users list-inline">
              <?php 
                                    echo '<li><a href="userProfil?id='.$rowUserInfo['id'].'" title="Sophia Lee"><img src="../login/' . $rowUserInfo['avatar'] . '" alt="user" class="img-responsive profile-photo"><span class="online-dot"></span></a></li>';
                                    ?>

              </ul>
              <?php
                    }
                }
            } else {
                echo "Erreur : " . mysqli_error($connexion);
            }

            mysqli_close($connexion);
            ?>
            </div>
            <!--chat block ends-->
            
        </div>
        
        


        <div class="col-lg-9">
            

            <div class="row text-left mb-2">
                <div class="col-lg-6 mb-3 mb-sm-0">
                  <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" style="width: 100%;">

                  <?php 
                    $connexion = connect();
                    $sql = "SELECT id, name FROM category";
                    $result = mysqli_query($connexion, $sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <form id="categoryForm" action="filterForum.php" method="get">
                            <select name="category" class="form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" onchange="document.getElementById('categoryForm').submit()">
                            echo "<option value='' selected disabled>Filtrer par Categories</option>";
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </form>
                        <?php
                    } else {
                        echo "Aucune catégorie trouvée dans la base de données.";
                    }
                    ?>

                  </div>
                </div>
                <div class="col-lg-6 text-lg-right">
                  <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50" style="width: 100%;">
                            
                    <div class="search-container">
                        <form action="searchForum.php" method='post'>
                        <div class="search_form">
                        <input type="text" name="search_input" class="search-input" placeholder="Recherche...">
                        <button type="submit" class="btn submit_button"><i class="fa fa-search search-icon"></i>Chercher</button>
                        <!-- <button type="submit" class="btn btn-success w-10" id="submitButton"><i class="fa fa-search search-icon"></i>Rechercher</button> -->
                        </div>
                        </form>
                    </div>
                            
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 mb-2 mt-2">
                    <button onclick="location.href='createForum.php'" class="btn btn-success w-100"><i class="fa fa-plus"></i> Créer un sujet</button>
                </div>
              </div>


