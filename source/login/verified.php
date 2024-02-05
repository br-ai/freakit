<?php
session_start();
include '../sql/connect.php';

if (isset($_GET['code'])) {
    $verificationCode = mysqli_real_escape_string(connect(), $_GET['code']);
    
    $query = "SELECT * FROM users WHERE verificationCode = '$verificationCode'";
    $result = mysqli_query(connect(), $query);

    if ($result) {
        $rowCount = mysqli_num_rows($result);

        if ($rowCount == 1) {
    
        $user = mysqli_fetch_assoc($result);
        $userId = $user['id'];

        $updateQuery = "UPDATE users SET verified = 1 WHERE id = $userId";
        $updateResult = mysqli_query(connect(), $updateQuery);

        if ($updateResult) {
            header("Location: ../home/home.php");
        } else {
            echo "Erreur lors de la vérification du compte : " . mysqli_error(connect());
        }
    }
    }
     
    else {
        echo "Code de vérification invalide ou compte déjà vérifié.";
    }
} else {
    echo "Code de vérification manquant dans l'URL.";
}
?>
