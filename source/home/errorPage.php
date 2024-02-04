
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>
                                       

                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <div class="flex-1">
                                    <h4 class="card-title mb-4 red_error_color">Oups ❌</h4>
                                </div>
                            </div>
        
                            <section class="mail-seccess section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3 col-12">
				<!-- Error Inner -->
				<div class="success-inner">
					<h1><i class="fa fa-times red_error_color"></i><span class="red_error_color">Echec</span></h1>
					<p style="color:black;">Quelque chose ne s'est pas passé comme prévu! voici l'erreur <br> <code class="error_from_bd">  <?php $error = mysqli_real_escape_string(connect(), $_GET['error']); 
                    echo $error;?> </code> <br> réesayer svp</p>
					<a href="contact.php" class="btn btn-primary btn-lg">Contacter l'assistance</a>
				</div>
				<!--/ End Error Inner -->
			</div>
		</div>
	</div>
</section>
                                
                            </div><!-- end row -->
                        </div><!-- end tab pane -->
                        
                    </div>
                </div><!-- end card -->

                <?php include '../base/footer.php';?>
            