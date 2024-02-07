<?php
    session_start();        
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include '../sql/connect.php';        
            
            $verificationCode = $_POST['verificationCode'];
            $password1 = $_POST['password1'];
            $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

  
            $query = "SELECT * FROM users WHERE verificationCode = '$verificationCode'";
            $result = mysqli_query(connect(), $query);

            if ($result) {
                $rowCount = mysqli_num_rows($result);

                if ($rowCount == 1) {
                    $user = mysqli_fetch_assoc($result);
                    $userId = $user['id'];

                    $updateQuery = "UPDATE users SET password = '$hashed_password' WHERE id = $userId";
                    $updateResult = mysqli_query(connect(), $updateQuery);

                    if ($updateResult) {
                        $_SESSION['email'] = $user['email'];
                        
                        header("Location: ../home/home.php");
                        exit();
                    } else {
                        echo "Erreur lors de la mise à jour du mot de passe : " . mysqli_error(connect());
                    }
                }
            } else {
                echo "Erreur lors de la récupération des résultats : " . mysqli_error(connect());
            }
        } else {
            echo "Code de vérification manquant dans l'URL.";
        }
    
?>