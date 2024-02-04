<?php
function connect() {
$server = 'localhost';
$bdd    = 'freakit';
$user   = 'root';
$pwd    = ''; //par defaut WAMP - MAMP ::: root


$connect = mysqli_connect($server, $user, $pwd, $bdd);
            //mysqli_connect(SERVER, LOGIN, PASS, MABDD);
if(!$connect) {
    die('Erreur de connection : ' . mysqli_connect_error());
    exit();
        }
        else {
            return $connect;
        }
}

?>