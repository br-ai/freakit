<?php
session_start();

include '../sql/connect.php';
include '../home/functions.php';


if (isset($_GET['user_id'])) {
  
    $user_id = mysqli_real_escape_string(connect(), $_GET['user_id']);
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
        // Requête pour supprimer l'utilisateur de la table users
        $deleteQuery = "DELETE FROM users WHERE id = $user_id";
        $result = mysqli_query($connexion, $deleteQuery);

        if ($result) {

            $query = "INSERT INTO adminactions (user_admin, action) VALUES ('$user_admin_id', 'a supprimé utilisateur $user_id')";


            // Exécution de la requête
            if (mysqli_query($connexion, $query)) {

                $success = "action inseré";
            } else {

                $error = mysqli_error($connexion);
                echo $error;
                // echo 'error ' . mysqli_error($connexion) . '';


            }
            echo "Utilisateur supprimé avec succès.";
            echo '<a href="users.php"> retour </a>';
        } else {
            echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($connexion);
        }
    } else {
        echo '<a href="../login/login.php"> connectez vous </a>';;
    }
} else {
    echo "ID non spécifié dans la requête.";
}

// Fermer la connexion à la base de données
mysqli_close(connect());
