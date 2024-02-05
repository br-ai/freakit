
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>
<?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        

        $user_id_1 = getIdFromEmail();
        $user_id_2 = $_POST['user_id_2'];

        if ($user_id_1 == $user_id_2) {
            $error = "Un utilisateur ne peut s'ajouter comme ami";
            echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';
        }
    
        $connexion = connect();
    
        $user_id_1 = mysqli_real_escape_string($connexion, $user_id_1);
        $user_id_2 = mysqli_real_escape_string($connexion, $user_id_2);

        if (areFriends($user_id_1, $user_id_2)) {
            $error = "Erreur : Une relation d'amitié existe déjà entre ces utilisateurs.";
            echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';
        }

        $query = "INSERT INTO friends (user_id_1, user_id_2, status) VALUES ('$user_id_1', '$user_id_2', 'pending')";
        $result = mysqli_query($connexion, $query);
    
        if ($result) {
            $success = "Votre demande d amitié a été trasnféré avec success";
            echo '<script type="text/javascript">window.location.href = "successPage.php?success='. $success . '";</script>';
        } else {
            $error = mysqli_error($connexion);
            echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';
        }

    

    }
    ?>
