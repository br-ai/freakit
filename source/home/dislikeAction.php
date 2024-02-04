
<?php include '../base/navbar.php'; ?>
<?php include '../base/body.php'; ?>

    <?php

    $user_id = getIdFromEmail();
    $comment_id = mysqli_real_escape_string(connect(), $_GET['comment_id']);
    $connexion = connect();


    $query = "INSERT INTO dislikes (comment_id, user_id) VALUES ('$comment_id','$user_id')";

    $queryResult = mysqli_query($connexion, $query);

    if ($queryResult) {
        $success = "Vous n'approuvez pas ce commentaire";
        echo '<script type="text/javascript">window.location.href = "successPage.php?success=' . $success . '";</script>';
    } else {
        $error = "Vous avez deja desapprouvé ce commentaire";
        echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';
    }



    // Fermeture de la connexion
    mysqli_close($connexion);

    ?>