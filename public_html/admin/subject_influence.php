<?php include "common.php" ?>

		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title" style="font-weight: bold;">Subject Influence Rank Matrix</h3>

					<div class="row">

						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-body">
									<table class="table table-hover">
										
										<?php 

											$rank = unserialize(file_get_contents('../matrixes/rank.bin'));
											$users = unserialize(file_get_contents('../matrixes/users.bin'));
											$topic_types = unserialize(file_get_contents('../matrixes/topic_types.bin'));  

											$first_scores=array();
											$second_scores=array();
											$third_scores=array();


											

											foreach ($topic_types as $topic_type) {
												$ranks = $rank[$topic_type];
												arsort($ranks);	
												$first_scores[$topic_type] = array_values($ranks)[0];
												$second_scores[$topic_type] = array_values($ranks)[1]; 					
												$third_scores[$topic_type] = array_values($ranks)[2]; 					

											}


										 ?>

										<thead>
											<tr>
												<th>User/Topic</th>
												<?php 
													foreach($topic_types as $topic_type)
													{?>
														<th><?php echo htmlspecialchars($topic_type) ?></th>
													<?php } ?>
											</tr>
										</thead>

										<tbody>
											<?php 
											foreach($users as $user)
											{?>
												<tr>
													<td><?php echo htmlspecialchars($user); ?></td>
												<?php

												foreach($topic_types as $topic_type)
												{	
													?>
													<td>
														<?php 

															if($first_scores[$topic_type] == $rank[$topic_type][$user])
															{?>
																<img src="assets/img/crown.svg" style = " width: 18px; height: 17.6px; margin-right: 12px; filter: invert(77%) sepia(78%) saturate(1330%) hue-rotate(358deg) brightness(105%) contrast(106%); margin-bottom: 8px;">
															<?php }
															elseif($second_scores[$topic_type] == $rank[$topic_type][$user])
															{?>
																<img src="assets/img/crown.svg" style = " width: 18px; height: 17.6px; margin-right: 12px; filter: invert(94%) sepia(0%) saturate(764%) hue-rotate(183deg) brightness(112%) contrast(51%); margin-bottom: 8px;">
															<?php }
															elseif($third_scores[$topic_type] == $rank[$topic_type][$user])
															{?>
																<img src="assets/img/crown.svg" style = " width: 18px; height: 17.6px; margin-right: 12px; filter: invert(20%) sepia(93%) saturate(2059%) hue-rotate(34deg) brightness(98%) contrast(98%); margin-bottom: 8px;">
															<?php }																														
															echo htmlspecialchars($rank[$topic_type][$user]); 
														?>
															
													</td>
												<?php } ?>

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
<?php 

 ?>

	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
</body>

</html>
