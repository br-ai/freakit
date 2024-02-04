
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>

    
                            <?php
            

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    
                                    // include 'functions.php';

                                    $user_id = getIdFromEmail();
                                    $forum_id = mysqli_real_escape_string(connect(), $_POST['forum_id']);
                                    $title = mysqli_real_escape_string(connect(), $_POST['title']); // Échapper les données pour éviter les attaques par injection SQL
                                    $message = mysqli_real_escape_string(connect(), $_POST['message']);
                                    $category = $_POST['category'];

                                    $query = "SELECT * FROM forum WHERE id = '$forum_id'";

                                    $queryResult = mysqli_query($connexion, $query);

                                    if ($queryResult) {
                                        $resu = mysqli_fetch_assoc($queryResult);
                                        $id_creator_user = $resu['user_creator_id'];

                                    }

                                    if ($user_id == $id_creator_user){
                                        $queryUpdate = "UPDATE forum SET title = '$title', message = '$message', category_id = $category WHERE id = '$forum_id'";

                                        $resultUpdate = mysqli_query($connexion, $queryUpdate);

                                        if ($resultUpdate) {
                                        
                                            $success = "Le forum a été bien modifié";
                                            echo '<script type="text/javascript">window.location.href = "successPage.php?success='. $success . '";</script>';
                                        } else {
                                            // Erreur lors de l'enregistrement
                                            
                                            $error = mysqli_error($connexion);
                                            echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';
    
                                            echo 'error ' . mysqli_error($connexion) . '';
                                            
                                            
                                        }

                                    }

                                    else{
                                        $error = "Vous n'avez pas les droits pour le faire";
                                         echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';
    
                                    }

                                }

                                   
                                
                                ?>


                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <div class="flex-1">
                                    <h4 class="card-title mb-4">Modifier votre forum</h4>
                                </div>
                            </div>
        
                            <div class="row" id="all-projects">
                            <section id="contact" class="gray-bg padding-top-bottom">
    	<!-- <div class="container bootstrap snippets bootdey">
            <div class="row"> -->
            <?php
                    $forum_id = mysqli_real_escape_string(connect(), $_GET['forum_id']);
                    $query = "SELECT * FROM forum WHERE id = '$forum_id'";

                    $queryResult = mysqli_query($connexion, $query);

                    if ($queryResult) {
                        $resu = mysqli_fetch_assoc($queryResult);
                        $forum_id = $resu['id'];
                        $an_title = $resu['title'];
                        $an_message = $resu['message'];

                    }
                    ?>
				<form id="Highlighted-form" action="forumUpdate.php?forum_id=<?php echo $forum_id;?>" class="col-sm-12 col-sm-offset-3" method="post" novalidate="">
					



					<div class="form-group">
					  <label class="title" for="contact-name">Title</label>
					  <div class="controls">
						<input id="title" name="title" value=<?php echo $an_title;?> placeholder="Le titre du forum" class="form-control requiredField Highlighted-label"  type="text" required>
						<i class="fa fa-text-width" aria-hidden="true"></i>
					  </div>
					</div><!-- End name input -->
					
					<div class="form-group">
					  <label class="title" for="contact-mail">Categories</label>
					  <div class=" controls">
						<?php 
                            $connexion = connect();
                            $sql = "SELECT id, name FROM category";
                            $result = mysqli_query($connexion, $sql);

                            if ($result->num_rows > 0) {
                                // Créer le formulaire et le select
                                
                                
                                echo "<select required class='form-control requiredField Highlighted-label' id='category' name='category'>";
                                
                                echo "<option value='' selected disabled>Selectionner une category</option>";

                                // Afficher les options du select avec les données de la table "category"
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option name='category' class='form-control requiredField Highlighted-label' value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                            
                                echo "</select>";

                               echo '<i class="fa fa-server" aria-hidden="true"></i>';
                                
                            } else {
                                echo "Aucune catégorie trouvée dans la base de données.";
                            }
                            
                            ?>


						
					  </div>
					</div><!-- End email input -->
					<div class="form-group">
					  <label class="control-label" for="contact-message">Message</label>
						<div class="controls">
							<textarea id="contact-message" name="message" placeholder="Votre message" class="form-control requiredField Highlighted-label"  rows="6"><?php echo $an_message;?></textarea>
							<i class="fa fa-comment"></i>
						</div>
					</div><!-- End textarea -->
                    <input type="hidden" name="forum_id" value=<?php echo $forum_id;?>>
					<p><button type="submit" class="btn btn-success w-100" id="submitButton">Modifier votre forum</button></p>
					<input type="hidden" name="submitted" id="submitted" value="true">	
				</form><!-- End Highlighted-form -->
			<!-- </div>	
		</div>	 -->
	</section>
                                
                            </div><!-- end row -->
                        </div><!-- end tab pane -->
                        
                    </div>
                </div><!-- end card -->

                <?php include '../base/footer.php';?>
            