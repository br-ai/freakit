<?php
session_start();
include '../sql/connect.php';
include '../home/functions.php';

if (isset($_GET['forum_id'])) {
   
    $forum_id = mysqli_real_escape_string(connect(), $_GET['forum_id']); // reucpere l'id passé en GET
    $user_admin = getIdFromEmail();
    $connexion = connect();

    $query = "SELECT * FROM users WHERE id = '$user_admin'";

    $queryResult = mysqli_query($connexion, $query);

    if ($queryResult) {
        $resu = mysqli_fetch_assoc($queryResult);
        $user_admin = $resu['role'];
        $user_admin_id = $resu['id'];
    }

    if ($user_admin == 'admin') {

        $deleteQuery = "DELETE FROM forum WHERE id = $forum_id";
        $result = mysqli_query($connexion, $deleteQuery);

        if ($result) {

            $query = "INSERT INTO adminactions (user_admin, action) VALUES ('$user_admin_id', 'a supprimé le forum $forum_id')";

            if (mysqli_query($connexion, $query)) {

                $success = "action inseré";
            } else {

                $error = mysqli_error($connexion);
                echo $error;

            }
            echo "forum supprimé avec succès.";
            echo '<a href="forums.php"> retour </a>';
        } else {
            echo "Erreur lors de la suppression du forum : " . mysqli_error($connexion);
        }
    } else {
        echo '<a href="../login/login.php"> connectez vous </a>';
    }
} else {
    echo "ID non spécifié dans la requête.";
}

mysqli_close(connect());
