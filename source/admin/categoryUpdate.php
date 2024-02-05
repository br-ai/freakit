<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="../icon.png" sizes="180x180">
</head>

<body>
    <?php
    session_start();
    include '../sql/connect.php';
    if (isset($_SESSION['email'])) {
        $email = mysqli_real_escape_string(connect(), $_SESSION['email']);

        // Requête pour récupérer des informations supplémentaires à partir de la table users
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query(connect(), $query);

        if ($result) {
            $user = mysqli_fetch_assoc($result);

            if ($user['role'] != 'admin') {
                header("Location: ../login/login.php");
            }
        } else {
            // Gestion de l'erreur de requête
            echo "Erreur lors de la récupération des informations d'utilisateur : " . mysqli_error(connect());
        }
    } else {
        // L'utilisateur n'est pas connecté
        header("Location: ../login/login.php");
    }
    ob_end_flush(); ?>

    <?php




    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // include 'functions.php';

        include '../home/functions.php';

        $connexion = connect();

        $user_admin = getIdFromEmail();

        $category_id = mysqli_real_escape_string(connect(), $_POST['category_id']);
        // Récupération des données du formulaire
        $nom = mysqli_real_escape_string(connect(), $_POST['nom']);


        $connexion = connect();
        // Requête d'insertion
        $query = "UPDATE category set name = '$nom' WHERE id = '$category_id'";


        if (mysqli_query($connexion, $query)) {

            $query = "INSERT INTO adminactions (user_admin, action) VALUES ('$user_admin', 'a modifier la category $category_id')";


            // Exécution de la requête
            if (mysqli_query($connexion, $query)) {

                $success = "action inseré";
            } else {

                $error = mysqli_error($connexion);
                echo $error;
                // echo 'error ' . mysqli_error($connexion) . '';


            }

            echo "Votre category a été modifié avec success";
            echo '<a href="category.php"> retour </a>';
        } else {
            // Erreur lors de l'enregistrement
            // header("Location: errorPage.php");
            $error = mysqli_error($connexion);
            echo $error;

            // echo 'error ' . mysqli_error($connexion) . '';


        }

        // Fermeture de la connexion
        mysqli_close($connexion);
    }
    ?>




    <!-- Header -->
    <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
        <div class="container bootstrap snippets bootdey">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-toggle"></span>
                </button>
                <a class="navbar-brand" href="#">Freakit</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
                            <i class="glyphicon glyphicon-user"></i> <?php echo $user['pseudo'] ?> </a>
                        <ul id="g-account-menu" class="dropdown-menu" role="menu">

                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /container -->
    </div>
    <!-- /Header -->

    <!-- Main -->
    <div class="container bootstrap snippets bootdey">

        <!-- upper section -->
        <div class="row">
            <div class="col-md-3">
                <!-- left -->
                <a href="#"><strong><i class="glyphicon glyphicon-briefcase"></i> <?php echo $user['pseudo']?></strong></a>
                <hr>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="home.php"><i class="glyphicon glyphicon-flash"></i> Dashboard</a></li>
                    <li><a href="users.php"><i class="glyphicon glyphicon-user"></i> Users</a></li>
                    <li><a href="forums.php"><i class="glyphicon glyphicon-list-alt"></i> Forums</a></li>
                    <li><a href="category.php" class="active"><i class="glyphicon glyphicon-book"></i> Category</a></li>
                    <li><a href="actions.php"><i class="glyphicon glyphicon-briefcase"></i> Actions</a></li>

                </ul>

                <a href="../login/logout.php"><button type="submit" class="btn btn-danger w-33" id="submitButton"><i class="fa fa-sign-out" aria-hidden="true"></i> Deconnexion</button></a>

                <hr>

            </div><!-- /span-3 -->
            <div class="col-md-9">
                <!-- column 2 -->
                <a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>
                <hr>
                <div class="row">
                    <!-- center left-->
                    <div class="col-md-12">
                        <div class="well"><?php
                        $connexion = connect();
                        // fais une requete qui recupere les actions d'un forum
                        $actionsQuery = "SELECT * FROM adminactions ORDER BY date_created DESC LIMIT 4";
                        $resultat = mysqli_query($connexion, $actionsQuery);



                        if ($resultat) {
                            while ($row = mysqli_fetch_assoc($resultat)) {

                        ?>

                <?php echo $row['user_admin']; ?> <?php echo $row['action']; ?><span class="badge pull-right"><?php echo $row['date_created']; ?></span><br><?php }} ?>

                        </div>

                        <hr>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Vue globale <a href="categoryAdd.php" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><span class="fa fa-plus"></span> Ajouter une category</a></h4>
                            </div>

                            <?php
                            $category_id = mysqli_real_escape_string(connect(), $_GET['category_id']);
                            $query = "SELECT * FROM category WHERE id = '$category_id'";

                            $queryResult = mysqli_query($connexion, $query);

                            if ($queryResult) {
                                $resu = mysqli_fetch_assoc($queryResult);
                               
                                $an_name = $resu['name'];
                                

                            }
                            ?>
                            <form action="categoryUpdate.php?category_id=<?php echo $category_id;?>" class="form" method="post">

                                <div class="form-group">


                                    Nom <input value=<?php echo $an_name?> id="nom" name="nom" placeholder="Le nom de la category" class="form-control" type="text" required>
                                    <input type="hidden" name="category_id" value=<?php echo $category_id;?>>

                                </div><!-- End name input -->


                                <p><button type="submit" class="btn btn-success w-100" id="submitButton">Modifier</button></p>

                            </form>




                        </div><!--/panel-body-->
                    </div><!--/panel-->

                </div><!--/col-->


            </div><!--/row-->
        </div><!--/col-span-9-->
    </div><!--/row-->
    <!-- /upper section -->
    </div><!--/container-->
    <!-- /Main -->


</body>

</html>