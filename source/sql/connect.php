<?php
function connect() { mysql://mysql:d556b1840b66b3a821be@vps.orbitafrica.org:8723/freakit
$server = 'vps.orbitafrica.org';
$bdd    = 'freakit';
$user   = 'root';
$pwd    = '00d4ab47689600e72ba9';
$port    = 8723; //par defaut WAMP - MAMP ::: root


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