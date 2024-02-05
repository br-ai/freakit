

            <?php

            session_start();
            
            include '../sql/connect.php';
            include '../home/functions.php';

            $user_admin = getIdFromEmail();
            $forum_id = mysqli_real_escape_string(connect(), $_GET['forum_id']);
            $connexion = connect();




            $query = "SELECT * FROM users WHERE id = '$user_admin'";

            $queryResult = mysqli_query($connexion, $query);

            if ($queryResult) {
                $resu = mysqli_fetch_assoc($queryResult);
                $user_admin = $resu['role'];
                $user_admin_id = $resu['id'];
            }

            if ($user_admin == 'admin') {
                $queryUpdate = "UPDATE forum SET status = 'Cloture' WHERE id = '$forum_id'";
                $resultUpdate = mysqli_query($connexion, $queryUpdate);

                if ($resultUpdate) {

                    $query = "INSERT INTO adminactions (user_admin, action) VALUES ('$user_admin_id', 'a fermer le forum  $forum_id')";
                    
                    if (mysqli_query($connexion, $query)) {

                        $success = "action inseré";
                    } else {

                        $error = mysqli_error($connexion);
                        echo $error;
                        


                    }
                    echo "Le forum a été bien cloturé";
                    echo '<a href="forums.php"> retour </a>';
                } else {
                    
                    $error = mysqli_error($connexion);
                    echo $error;
                    echo '<a href="forums.php"> retour </a>';
                }
            } else {
                $error = "Vous n'avez pas les droits pour le faire";
                echo $error;
                echo '<a href="forums.php"> retour </a>';
            }

            // Fermeture de la connexion
            mysqli_close($connexion);

            ?>