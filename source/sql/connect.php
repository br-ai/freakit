<?php
function connect() {
$server = 'vps.orbitafrica.org';
$bdd    = 'freakit';
$user   = 'mysql';
$pwd    = 'a745f45df04f27ce4b9d';
$port    = 7007; //par defaut WAMP - MAMP ::: root


$connect = mysqli_connect($server, $user, $pwd, $bdd, $port);
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