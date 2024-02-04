<?php

function getIdFromEmail(){
    $email = mysqli_real_escape_string(connect(), $_SESSION['email']);

    // Requête pour récupérer des informations supplémentaires à partir de la table users
    $query = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query(connect(), $query);

    if ($result) {
        $user_id = mysqli_fetch_assoc($result);

        return $user_id['id'];
    }
    else {
        // Gestion de l'erreur de requête
       return  "Erreur lors de la récupération de id de utilisateur" . mysqli_error(connect());
    }
}


function areFriends($user_id_1, $user_id_2) {
    
    if ($user_id_1 == $user_id_2) {
        return true;
    }

    // Échappez les identifiants pour éviter les injections SQL
    $user_id_1 = mysqli_real_escape_string(connect(), $user_id_1);
    $user_id_2 = mysqli_real_escape_string(connect(), $user_id_2);

    // Requête pour vérifier si les deux utilisateurs sont amis (relation acceptée)
    $query = "SELECT * FROM Friends WHERE 
              ((user_id_1 = $user_id_1 AND user_id_2 = $user_id_2) OR 
               (user_id_1 = $user_id_2 AND user_id_2 = $user_id_1)) AND 
               (status = 'accepted' OR status = 'pending')";
    
    $result = mysqli_query(connect(), $query);

    // Si la requête renvoie des résultats, alors les deux utilisateurs sont amis
    return mysqli_num_rows($result) > 0;
}


function getFriendshipStatus($user_id_1, $user_id_2) {
    if ($user_id_1 == $user_id_2) {
        return "Vous-même";
    }

    // Échappez les identifiants pour éviter les injections SQL
    $user_id_1 = mysqli_real_escape_string(connect(), $user_id_1);
    $user_id_2 = mysqli_real_escape_string(connect(), $user_id_2);

    // Requête pour obtenir le statut de l'amitié
    $query = "SELECT status FROM friends WHERE 
              ((user_id_1 = $user_id_1 AND user_id_2 = $user_id_2) OR 
               (user_id_1 = $user_id_2 AND user_id_2 = $user_id_1))";

    $result = mysqli_query(connect(), $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row['status'];
    }

    // Si la requête ne renvoie pas de résultat, retourner "Non ami"
    return "Non ami";
}


// La partie qui gère le regex et la recherche d'image et de lien

function findImageInComment($comment) {
    // Recherche de la notation spéciale [image='URL_de_l'image']
    $pattern = "/\[image='(.*?)'\]/";
    preg_match_all($pattern, $comment, $matches);

    // Remplacement de chaque occurrence par la balise img correspondante
    foreach ($matches[0] as $key => $match) {
        $imageTag = '<img src="' . $matches[1][$key] . '" alt="Image">';
        $comment = str_replace($match, $imageTag, $comment);
    }

    return $comment;
}

?>