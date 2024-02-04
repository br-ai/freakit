
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>
                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <div class="flex-1">
                                    <h4 class="card-title mb-4">Forum 🔥</h4>
                                </div>
                            </div>
        
                            <div class="row" id="all-projects">
                            <?php
                                    // include '../sql/connect.php';
                                    $forum_id = mysqli_real_escape_string(connect(), $_GET['forum_id']);
                                    $connexion = connect();

                                    $query = "SELECT * FROM forum WHERE id = '$forum_id'";

                                    $result = mysqli_query($connexion, $query);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                
                                    ?>


<div class="col-md-12">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class=" m-b-5">
                                    
                                    <h2><?php echo $row['title']?></h2>
                                </div>
                                <p><?php echo $row['message']?></p>

                                <?php
                                if ($row['status'] == 'en cours'){
                                    echo'Status: <span class="label label-primary">'.$row['status'].'</span>';
                                    
                                }

                                else{
                                    echo'Status: <span class="label label-secondary">'.$row['status'].'</span>';
                                }

                                ?>
                                    

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <dl class="dl-horizontal">

                                    <dt>Crée par:</dt> <dd>
                                    <?php
                                                // Supposons que $row soit le résultat de votre requête pour récupérer les informations du forum

                                                // Récupérez les informations de l'utilisateur correspondant à user_creator_id
                                                $userQuery = "SELECT * FROM users WHERE id = " . $row['user_creator_id'];
                                                $userResult = mysqli_query($connexion, $userQuery);

                                                // Vérifiez si la requête a réussi
                                                if ($userResult) {
                                                    $userData = mysqli_fetch_assoc($userResult);
                                                    $pseudo = $userData['pseudo'];
                                                    $avatar = $userData['avatar'];
                                                    $id = $userData['id'];
                                                    $banner = $userData['banner'];
                                                } else {
                                                    // Gérez l'erreur en conséquence
                                                    $pseudo = "Utilisateur inconnu";
                                                }
                                                ?>
                                               <a href='userProfil.php?id=<?php echo $id?>'> <?php echo $pseudo?> <img src="../login/<?php echo $avatar; ?>" class="img-fluid avatar-xse rounded-circle" alt=""></a></dd>
                                    <dt>Commentaires:</dt> <dd>
                                    <?php
                                                // fais une requete qui recupere les commetaires d'un forum
                                                $commentQuery = "SELECT count(*) as commentCount FROM comments WHERE forum_id = " . $row['id'];
                                                $commentResult = mysqli_query($connexion, $commentQuery);

                                                

                                                if ($commentResult) {
                                                    $commentData = mysqli_fetch_assoc($commentResult);
                                                    $commentCount = $commentData['commentCount'];
                                                    
                                                } else {
                                                    // Gérez l'erreur en conséquence
                                                    echo "Erreur lors de la récupération des commentaires.";
                                                }

                                                
                                                ?>
                                    <?php echo $commentCount?></dd>
                                    
                                </dl>
                            </div>
                            <div class="col-lg-7" id="cluster_info">
                                <dl class="dl-horizontal">

                                    <dt>Crée le :</dt> <dd><?php echo $row['date_created']?></dd>
                                    
                                    <dt>Participants:</dt>
                                    <dd class="project-people">

                                    <?php
                                                // Faire une requête qui récupère les commentaires d'un forum
                                                $commentQuery = "SELECT * FROM comments WHERE forum_id = ?";
                                                $commentStmt = mysqli_prepare($connexion, $commentQuery);
                                                mysqli_stmt_bind_param($commentStmt, "i", $row['id']);
                                                mysqli_stmt_execute($commentStmt);
                                                $commentResult = mysqli_stmt_get_result($commentStmt);

                                                // Vérifier si la requête a réussi
                                                while ($comment = mysqli_fetch_assoc($commentResult)) {
                                                    // Faire une requête pour récupérer l'avatar de l'utilisateur
                                                    $userQuery = "SELECT avatar FROM users WHERE id = ?";
                                                    $userStmt = mysqli_prepare($connexion, $userQuery);
                                                    mysqli_stmt_bind_param($userStmt, "i", $comment['user_id']);
                                                    mysqli_stmt_execute($userStmt);
                                                    $userResult = mysqli_stmt_get_result($userStmt);

                                                    // Vérifier si la requête a réussi
                                                    if ($user = mysqli_fetch_assoc($userResult)) {
                                                        ?>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-<?= $comment['user_id'] ?>" aria-label="<?= $user['avatar'] ?>" data-bs-original-title="<?= $user['avatar'] ?>">
                                                                <img src="../login/<?= $user['avatar'] ?>" alt="" class="rounded-circle avatar-sm"> 
                                                            </a>
                                                        </div>
                                                        
                                                        <?php
                                                    }
                                                }
                                                mysqli_stmt_close($commentStmt);
                                                // mysqli_stmt_close($userStmt);
                                                ?>
                                    
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <dl class="dl-horizontal">
                                    <dt>Message :</dt>
                                    <dd>
                                        
                                    <?php echo $row['message']?>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row m-t-sm">
                            <div class="col-lg-12">
                            <div class="panel blank-panel">
                            <div class="panel-heading">
                                <div class="panel-options">
                                   
                                </div>
                            </div>

                            <div class="panel-body">

                            <div class="tab-content">
                            <div class="tab-pane active" id="tab-1">
                                <div class="feed-activity-list">

                                <?php
                                    // include '../sql/connect.php';

                                    $connexion = connect();

                                    $query = "SELECT * FROM comments WHERE forum_id = '" . $row['id'] . "'";


                                    $resultats_comments = mysqli_query($connexion, $query);

                                    if ($result) {
                                        while ($row_comments = mysqli_fetch_assoc($resultats_comments)) {
                
                                    ?>

                                    <div class="feed-element">
                                        <a href="userProfil?id=<?php echo $row_comments['user_id']?>" class="pull-left">
                                        <?php
                                                // Supposons que $row soit le résultat de votre requête pour récupérer les informations du forum

                                                // Récupérez les informations de l'utilisateur correspondant à user_creator_id
                                                $userQuerye = "SELECT * FROM users WHERE id = " . $row_comments['user_id'];
                                                $userResulte = mysqli_query($connexion, $userQuerye);

                                                // Vérifiez si la requête a réussi
                                                if ($userResulte) {
                                                    $userDatae = mysqli_fetch_assoc($userResulte);
                                                    $pseudoe = $userDatae['pseudo'];
                                                    $avatare = $userDatae['avatar'];
                                                    $id = $userDatae['id'];
                                                    $bannere = $userDatae['banner'];
                                                } else {
                                                    // Gérez l'erreur en conséquence
                                                    $pseudo = "Utilisateur inconnu";
                                                }
                                                ?>
                                            <img alt="image" class="img-circle" src="../login/<?php echo $avatare ?>">
                                        </a>
                                        <div class="media-body ">
                                            
                                            <strong><?php echo $pseudoe ?></strong> à publié un commentaire<br>
                                            <small class="text-muted"><?php echo $row_comments['date_created']?></small>
                                            <div class="well">
                                                Re :  <?php echo $row['message']?>
                                            </div>
                                        </div>
                                        <div class="user_comment_div">
                                            <p> <?php $commentWithImages = findImageInComment($row_comments['comment']); echo $commentWithImages; ?><br>
                                                <?php 
                                                if ($row_comments['image']){
                                                   echo '<img alt="image" class="img-comment" src="'.$row_comments['image'].'">';
                                                }
                                                ?>
                                                  
                                            </p>
                                            
                                            <p class="banner_show"># <?php echo $bannere; ?></p>
                                        </div>
                                        <div class="actions">
                                        <?php
                                                // fais une requete qui recupere les commetaires d'un forum
                                                $likesQuery = "SELECT count(*) as likesCount FROM likes WHERE comment_id = " . $row_comments['id'];
                                                $likesResult = mysqli_query($connexion, $likesQuery);

                                                $dislikesQuery = "SELECT count(*) as dislikesCount FROM dislikes WHERE comment_id = " . $row_comments['id'];
                                                $dislikesResult = mysqli_query($connexion, $dislikesQuery);


                                               
                                               
                                                if ($likesResult) {
                                                    $likesData = mysqli_fetch_assoc($likesResult);
                                                    $likesCount = $likesData['likesCount'];

                                           
                                                    
                                                } else {
                                                    // Gérez l'erreur en conséquence
                                                    $error = mysqli_error($connexion);
                                                    echo $error;
                                                }

                                                if ($dislikesResult) {
                                                    $dislikesData = mysqli_fetch_assoc($dislikesResult);
                                                    $dislikesCount = $dislikesData['dislikesCount'];

                                           
                                                    
                                                } else {
                                                    // Gérez l'erreur en conséquence
                                                    echo "Erreur lors de la récupération des commentaires.";
                                                }

                                                
                                                ?>

                                                <?php 
                                                    echo '<a href="likeAction.php?comment_id='.$row_comments['id'].'" class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> ' . $likesCount . ' </a>';
                                                    echo '<a href="dislikeAction.php?comment_id='.$row_comments['id'].'" class="btn btn-xs btn-white"><i class="fa fa-thumbs-down" aria-hidden="true"></i> ' . $dislikesCount . '</a>';
                                                    
                                                    ?>
                                                
                                        </div>
                                    </div>

                                    <?php
                                                }
                                    } else {
                                        echo "Erreur : " . mysqli_error($connexion);
                                    }

                                    mysqli_close($connexion);
                                    ?>

                                    

                                   
                                </div>
                                <div class="chat-footer">
                                  
                                        
                                        <?php 
                                        if ($row['status'] == 'en cours'){
                                            echo '<form action="addComment.php" method="post" enctype="multipart/form-data">
                                             <textarea name="message" placeholder="Votre message ici..." required class="send-message-text"></textarea>
                                            <label class="upload-file">
                                            <input type="hidden" name="forum_id" value="' . $row['id'] . '">
                                            <input name="image" type="file" class="form-control" id="avatarInput" accept="image/*">
                                                <i class="fa fa-paperclip"></i>
                                            </label>
                                            <button type="submit" class="send-message-button btn-info"> <i class="fa fa-send"></i> </button>
                                            </form>';
                                        }

                                        else {
                                            echo 'le forum est cloturé';
                                        }
                                        ?>
                                        
                                 
                                </div>

                            </div>
                            
                            </div>

                            </div>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


        <?php
                                                }
                                    } else {
                                        echo "Erreur : " . mysqli_error($connexion);
                                    }

                                 
                                    ?>
                                
                </div><!-- end card -->
                <?php include '../base/footer.php';?>