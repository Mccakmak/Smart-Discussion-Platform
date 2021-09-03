<!doctype html>
<html lang="en">

<head>
	<title>Smart Discussion Platform Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	
	<div id="wrapper">




		<!-- NAVBAR -->

		<nav class="navbar navbar-default navbar-fixed-top">

			<div class="navbar-btn">
				<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
			</div>

			<div class="brand" style="padding-bottom: 0px; padding-top:24px;">
				<a  href="follow.php"><p style = " font-size:2.5rem; margin: 0px;">Smart Discussion Platform</p></a>
			</div>

			<div class="container-fluid">


<!-- 				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form>
 -->

				<div class="navbar-btn navbar-btn-right">
					<a class="btn btn-primary update-pro" href="../logout/logout.php"><i class="lnr lnr-exit"></i > <span>Sign out</span></a>
				</div>
				
			</div>
		</nav>

		<!-- END NAVBAR -->




		<!-- LEFT SIDEBAR -->

		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<!-- <li><a href="admin.php" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li> -->

						<li><a href="follow.php" class=""><img src="assets/img/follower.svg" style = " width: 18px; height: 17.6px; margin-right: 12px; filter: invert(82%) sepia(13%) saturate(241%) hue-rotate(173deg) brightness(91%) contrast(81%); margin-bottom: 8px;"></i> <span>Follow relationship</span></a>
						</li>						

						<li><a href="sentiment.php" class=""><img src="assets/img/smile.svg" style = " width: 18px; height: 17.6px; margin-right: 12px; filter: invert(82%) sepia(13%) saturate(241%) hue-rotate(173deg) brightness(91%) contrast(81%); margin-bottom: 8px;"></i> <span>Sentiment</span></a>
						</li>

						<!-- Collapsable  -->
						<li>
							<a href="#subpage_influence" data-toggle="collapse" class="collapsed"><img src="assets/img/crown.svg" style = " width: 18px; height: 17.6px; margin-right: 12px; filter: invert(82%) sepia(13%) saturate(241%) hue-rotate(173deg) brightness(91%) contrast(81%); margin-bottom: 8px;"></i> <span>Influence</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subpage_influence" class="collapse ">
								<ul class="nav">
									<li><a href="subject_influence.php" class="">Subject Influence Rank Matrix</a></li>
								</ul>
								<ul class="nav">
									<li><a href="influence_ranking.php" class="">Total Influence Rank Matrix</a></li>
								</ul>
							</div>
						</li>

						<li>
							<a href="#subpage_trust" data-toggle="collapse" class="collapsed"><img src="assets/img/handshake.svg" style = " width: 18px; height: 17.6px; margin-right: 12px; filter: invert(82%) sepia(13%) saturate(241%) hue-rotate(173deg) brightness(91%) contrast(81%); margin-bottom: 8px;"><span>Trust</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subpage_trust" class="collapse ">
								<ul class="nav">
									<li><a href="trust_ranking.php" class="">Total Trust Rank Matrix</a></li>
								</ul>
							</div>
						</li>


						<li><a href="trend.php" class=""><i class="lnr lnr-chart-bars"></i> <span>Topic Trend</span></a></li>

						<li><a href="admin_feedback.php" class=""><i class="lnr lnr-thumbs-up"></i> <span>Feedback</span></a></li>
						<!-- Collapsable  -->

						
					</ul>
				</nav>
			</div>
		</div>

		<!-- END LEFT SIDEBAR -->