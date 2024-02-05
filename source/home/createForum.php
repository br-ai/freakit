
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>

    
                            <?php
            

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    
                               

                                    $user_id = getIdFromEmail();

                              
                                    $title = mysqli_real_escape_string(connect(), $_POST['title']);
                                    $message = mysqli_real_escape_string(connect(), $_POST['message']);
                                    $category = $_POST['category'];

                                    $connexion = connect();
                                   
                                    $query = "INSERT INTO forum (user_creator_id, category_id, title, message) VALUES ('$user_id', '$category', '$title', '$message')";

                                   
                                    if (mysqli_query($connexion, $query)) {
                                        
                                        // echo '<meta http-equiv="refresh" content="0;url=successPage.php">';
                                        $success = "Votre forum a été creé avec success";
                                        echo '<script type="text/javascript">window.location.href = "successPage.php?success='. $success . '";</script>';
                                    } else {
                                        // erreur lors de l'enregistrement
                                        // header("Location: errorPage.php");
                                        $error = mysqli_error($connexion);
                                        echo '<script type="text/javascript">window.location.href = "errorPage.php?error=' . $error . '";</script>';

                                        // echo 'error ' . mysqli_error($connexion) . '';
                                        
                                        
                                    }

                                    // Fermeture de la connexion
                                    mysqli_close($connexion);
                                }
                                ?>
                                    
                                    


                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <div class="flex-1">
                                    <h4 class="card-title mb-4">Créer votre forum</h4>
                                </div>
                            </div>
        
                            <div class="row" id="all-projects">
                            <section id="contact" class="gray-bg padding-top-bottom">
    	<!-- <div class="container bootstrap snippets bootdey">
            <div class="row"> -->
				<form id="Highlighted-form" action="createForum.php" class="col-sm-12 col-sm-offset-3" method="post" novalidate="">
					
					<div class="form-group">
					  <label class="title" for="contact-name">Title</label>
					  <div class="controls">
						<input id="title" name="title" placeholder="Le titre du forum" class="form-control requiredField Highlighted-label"  type="text" required>
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
                              
                                
                                
                                echo "<select class='form-control requiredField Highlighted-label' id='category' name='category'>";
                                
                                echo "<option value='' selected disabled>Selectionner une category</option>";

                               
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
							<textarea id="contact-message" name="message" placeholder="Votre message" class="form-control requiredField Highlighted-label"  rows="6"></textarea>
							<i class="fa fa-comment"></i>
						</div>
					</div><!-- End textarea -->
					<p><button type="submit" class="btn btn-success w-100" id="submitButton">Creer votre forum</button></p>
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
            