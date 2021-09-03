<?php 
	include "../connect_db/connection.php";
	include "common.php";
 ?>
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title" style="font-weight: bold;">Feedback</h3>

					<div class="row">

						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-body">
									<table class="table table-hover">

										<thead>
											<tr>
												<th>User</th>
												<th>Star</th>
												<th>Feedback</th>
											</tr>
										</thead>

										<tbody>
											<?php 

											$sql = "SELECT * FROM feedback";
									    	$result = mysqli_query($connection, $sql);
									    	$feedbacks = mysqli_fetch_all($result, MYSQLI_ASSOC);

											foreach($feedbacks as $feedback)
											{?>
												<tr>

													<td><?php echo htmlspecialchars($feedback['username']); ?></td>
													<td><?php echo htmlspecialchars($feedback['star']); ?></td>
													<td>
														<?php

															if($feedback['comment'] == '')
															{
																echo htmlspecialchars('No comment');
															}
															else
															{
																echo htmlspecialchars($feedback['comment']); 
															}
														 	
														 ?>
													 	
													 </td>
												</tr>

												
											<?php } ?>
											

										</tbody>
									</table>
								</div>
							</div>
							<!-- END TABLE HOVER -->
						</div>
					</div>

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
