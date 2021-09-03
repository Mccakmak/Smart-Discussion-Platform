<?php include "common.php" ?>


		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title" style="font-weight: bold;">User Influence Ranks</h3>

					<div class="row">

						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-body">
									<table class="table table-hover">
										
										<?php 

											$total_inf_rank = unserialize(file_get_contents('../matrixes/total_inf_rank.bin'));

											arsort($total_inf_rank);


										 ?>

										<thead>
											<tr>
												<th>User</th>
												<th>Influence Score</th>
											</tr>
										</thead>

										<tbody>
											<?php 
											$crown = 1;
											foreach ($total_inf_rank as $user => $score)
											{?>
												<tr>

													<td><?php echo htmlspecialchars($user); ?></td>
													<td>

														<?php 
														if($crown==1)
														{ ?>
															<img src="assets/img/crown.svg" style = " width: 18px; height: 17.6px; margin-right: 12px; filter: invert(77%) sepia(78%) saturate(1330%) hue-rotate(358deg) brightness(105%) contrast(106%); margin-bottom: 8px;">
														<?php } 
														else if($crown==2)
														{?>

															<img src="assets/img/crown.svg" style = " width: 18px; height: 17.6px; margin-right: 12px; filter: invert(94%) sepia(0%) saturate(764%) hue-rotate(183deg) brightness(112%) contrast(51%); margin-bottom: 8px;">

														<?php  }

														else if($crown==3)
														{?>
															<img src="assets/img/crown.svg" style = " width: 18px; height: 17.6px; margin-right: 12px; filter: invert(20%) sepia(93%) saturate(2059%) hue-rotate(34deg) brightness(98%) contrast(98%); margin-bottom: 8px;">
														<?php } ?>

														<?php echo htmlspecialchars($score); 

														$crown +=1;

													?></td>

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
