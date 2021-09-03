<?php include "common.php" ?>



		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title" style="font-weight: bold;">Sentiment Result Graphs</h3>
					<?php
					  
						// Set the current working directory
						$directory = "../matrixes/sentiments/";
						  
						// Initialize filecount variavle
						$filecount = 0;
						  
						$all_files = glob( $directory ."*" );
						  
/*						if( $all_files ) {
						    $filecount = count($all_files);
						}*/

						$file_no = 1;
						foreach($all_files as $file)
						{	
							$path_parts = pathinfo($file);
							$add_end_div = 'false';
							if($file_no % 3 == 0)
							{
								$add_end_div = 'true';
								?>
								<div class="row">
							<?php }?>

									<div class="col-md-4">
										<div class="panel">
											<div class="panel-heading">
												<h3 class="panel-title"><?php echo htmlspecialchars($path_parts['filename']); ?></h3>
											</div>
											<div class="panel-body">
												<div>
													<img width="300" height="300" src="<?php echo htmlspecialchars($file); ?> ">
												</div>
											</div>
										</div>
									</div>
								<?php 
									if($add_end_div == 'true')
									{?>
										</div>
									<?php } 

							$file_no++;
						}
					  
					?>





					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>

	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
</body>

</html>
