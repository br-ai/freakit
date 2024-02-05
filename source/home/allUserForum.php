
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>
                <div class="card">
                    

                                <div class="card-body">
                                

                                    <div class="table-responsive project-list">
                                        <table class="table project-table table-centered table-nowrap">
                                            <thead>

                                                <tr>
                                                    
                                                    <th scope="col">Forums</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Participants</th>
                                                    <th scope="col">Statistiques</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                  

                                    $connexion = connect();
                                    $user_id = getIdFromEmail();

                                    $query = "SELECT * FROM forum WHERE user_creator_id = '$user_id'";

                                    $result = mysqli_query($connexion, $query);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                
                                    ?>
                                                <tr>
                                                    
                                                     <td><a href='forumDetails.php?forum_id=<?php echo $row['id']; ?>'><?php echo $row['title']; ?></a></td>
                                                    <td><?php echo $row['date_created']; ?></td>
                                                    <?php
                                                    if ($row['status'] == 'en cours'){
                                                        echo'<td>
                                                        <span class="text-success font-12"><i class="mdi mdi-checkbox-blank-circle mr-1"></i>'.$row['status'].'</span>
                                                    </td>';
                                                        
                                                    }

                                                    else{
                                                        echo'<td>
                                                        <span class="text-danger font-12"><i class="mdi mdi-checkbox-blank-circle mr-1"></i>'.$row['status'].'</span>
                                                    </td>';
                                                    }

                                                    ?>
                                                    
                                                    <td>
                                                        <div class="team">

                                                        <?php
                                                            // une rerquete preparée
                                                            $commentQuery = "SELECT * FROM comments WHERE forum_id = ?";
                                                            $commentStmt = mysqli_prepare($connexion, $commentQuery);
                                                            mysqli_stmt_bind_param($commentStmt, "i", $row['id']);
                                                            mysqli_stmt_execute($commentStmt);
                                                            $commentResult = mysqli_stmt_get_result($commentStmt);

                          
                                                            while ($comment = mysqli_fetch_assoc($commentResult)) {
                                                               
                                                                $userQuery = "SELECT avatar FROM users WHERE id = ?";
                                                                $userStmt = mysqli_prepare($connexion, $userQuery);
                                                                mysqli_stmt_bind_param($userStmt, "i", $comment['user_id']);
                                                                mysqli_stmt_execute($userStmt);
                                                                $userResult = mysqli_stmt_get_result($userStmt);
                                                                if ($user = mysqli_fetch_assoc($userResult)) {
                                                        ?>




                                                            <a href="javascript: void(0);" class="team-member" data-toggle="tooltip" data-placement="top" title="" data-original-title="Roger Drake">
                                                                <img src="../login/<?= $user['avatar'] ?>" class="rounded-circle avatar-xse" alt="" />
                                                            </a>

                                                            <?php
                                                    }
                                                }
                                                
                                                mysqli_stmt_close($commentStmt);
                                           
                                                ?>

                                                            
                                                        </div>
                                                    </td>
                                                    <td>

                                                    <?php
                                          
                                                $commentQuery = "SELECT count(*) as commentCount FROM comments WHERE forum_id = " . $row['id'];
                                                $commentResult = mysqli_query($connexion, $commentQuery);

                                                

                                               
                                               
                                                if ($commentResult) {
                                                    $commentData = mysqli_fetch_assoc($commentResult);
                                                    $commentCount = $commentData['commentCount']; 
                                                } else {
                                                  
                                                    echo "Erreur lors de la récupération des commentaires.";
                                                }

                                                
                                                ?>

                                            <div class="details">
                                                
                                                <?php 
                                                
                                                echo '<div class="details_item"><i class="fa fa-comments" aria-hidden="true"></i> ' . $commentCount . ' comments</div>';
                                                
                                                ?>

                                
                                            <!-- <div class="details_item">
                                                <i class="fa fa-eye" aria-hidden="true"></i>284 vues
                                            </div>
                                
                                             -->
                                                </div>
                                                    </td>

                                                    <td>
                                                        <div class="action">

                                                        <?php
                                                    if ($row['status'] == 'en cours'){
                                                        echo'<a href="forumUpdate?forum_id='.$row['id'].'" class="text-success mr-4" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"> <i class="fa fa-pencil h5 m-0"></i></a>
                                                        <a href="forumClose?forum_id='.$row['id'].'" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close" onclick="return confirm()"> <i class="fa fa-remove h5 m-0"></i></a>';
                                                        
                                                    }

                                                    else{
                                                        echo'';
                                                    }

                                                    ?>
                                                            
                                                        </div>
                                                    </td>
                                                </tr>



                                                <tr>
                                                <?php
                                                }
                                    } else {
                                        echo "Erreur : " . mysqli_error($connexion);
                                    }

                                    mysqli_close($connexion);
                                    ?>
                                                    
                                                    

                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end project-list -->

                                </div>
                            </div>
                        
                    <!-- end row -->
                <!-- </div>

                </div>

                </div> -->


                <?php include '../base/footer.php';?>