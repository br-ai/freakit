
<?php include '../base/navbar.php';?>
<?php include '../base/body.php';?>
                                       

                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <div class="flex-1">
                                    <h4 class="card-title mb-4 green_success_color">Felicitation 🎉</h4>
                                </div>
                            </div>
        
                            <section class="mail-seccess section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 offset-lg-3 col-12">
				<!-- Error Inner -->
				<div class="success-inner">
					<h1><i class="fa fa-check green_success_color"></i><span class="green_success_color">Reussi</span></h1>
					<p style="color:black;">Bravo tout s'est bien deroulé! <br> <code class="">  <?php $success = mysqli_real_escape_string(connect(), $_GET['success']); 
                    echo $success;?> </code> <br></p>
					<a href="home.php" class="btn btn-primary btn-lg">Home</a>
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
            