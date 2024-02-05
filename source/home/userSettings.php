
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>

    


                <div class="card">
                <div class="panel-body inf-content">
    <div class="row">
    <?php

                        
        // include 'functions.php';

        $user_id = getIdFromEmail();
        $query = "SELECT * FROM users WHERE id = '$user_id'";
        $result = mysqli_query(connect(), $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {

        ?>
        <div class="col-md-4">
            <img alt="" style="width:600px;" title="" class="img-circle img-thumbnail isTooltip" src="../login/<?php echo  $row['avatar'] ?>" data-original-title="Usuario"> 
            <ul title="Ratings" class="list-inline ratings text-center">

                <li><a href="#">(<?php
              $user_id = getIdFromEmail();

              $query = "SELECT COUNT(*) as forumCount FROM forum WHERE user_creator_id = $user_id";
              
              $result_count_forum = mysqli_query(connect(), $query);
          
              if ($result_count_forum && $row1 = mysqli_fetch_assoc($result_count_forum)) {
                  echo $row1['forumCount'];
              }
          
              
          
          ?>) Forums</a></li>

                <li><a href="#">(<?php
              $user_id = getIdFromEmail();

   
              $query = "SELECT COUNT(*) as friendCount FROM friends WHERE (user_id_1 = $user_id OR user_id_2 = $user_id) AND status = 'accepted'";
              
              $result_count_friend = mysqli_query(connect(), $query);
          
              if ($result && $row2 = mysqli_fetch_assoc($result_count_friend)) {
                  echo $row2['friendCount'];
              }
          
              
          
          ?>) Amis</a></li>
                
            </ul>
        </div>
        <div class="col-md-6">
            
            <div class="table-responsive">
            <table class="table table-user-information">
                <tbody>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-asterisk text-primary"></span>
                                Pseudo                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                        <?php echo $row['pseudo']; ?>     
                        </td>
                    </tr>
                    <tr>    
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-user  text-primary"></span>    
                                Email                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                        <?php echo $row['email']; ?>     
                        </td>
                    </tr>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-cloud text-primary"></span>  
                                Banniere                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                        <?php echo $row['banner']; ?>  
                        </td>
                    </tr>

                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                Membre depuis                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                        <?php echo $row['date_joined']; ?> 
                        </td>
                    </tr>


                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-eye-open text-primary"></span> 
                                Role                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                        <?php echo $row['role']; ?>
                        </td>
                    </tr>
                   
                    
                                                        
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
                                <?php
                                                }
                                    } else {
                                        echo "Erreur : " . mysqli_error($connexion);
                                    }

                                    mysqli_close($connexion);
                                    ?>

    <div class="actionButton">
    <button type="submit" class="btn btn-success w-33" id="submitButton" ><i class="fa fa-pencil" aria-hidden="true"></i> Modifier le profil</button>
    <button type="submit" class="btn btn-danger w-33" id="submitButton" disabled><i class="fa fa-ban" aria-hidden="true"></i> Desactiver le compte</button>
    <a href="../login/logout.php"><button type="submit" class="btn btn-danger w-33" id="submitButton" ><i class="fa fa-sign-out" aria-hidden="true"></i> Deconnexion</button></a>
    </div>
                                        
                                        
                </div><!-- end card -->

                <?php include '../base/footer.php';?>
            