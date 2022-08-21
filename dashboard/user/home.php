<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/user-class.php';
include_once __DIR__ .'/../superadmin/controller/select-settings-coniguration-controller.php';

$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('../../');
}

$stmt = $user_home->runQuery("SELECT * FROM user WHERE userId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$UId 			= $row['userId'];
$profile_user 	= $row['userProfile'];

$uniqueId 		= $row["uniqueID"];
$Grade11 		= "Grade11";
$Grade12 		= "Grade12";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../../src/img/<?php echo $logo ?>">
	<link rel="stylesheet" href="../../src/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../src/node_modules/boxicons/css/boxicons.min.css">
	<link rel="stylesheet" href="../../src/node_modules/aos/dist/aos.css" />
    <link rel="stylesheet" href="../../src/css/admin.css?v=<?php echo time(); ?>">
	<title>Dashboard</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar" class="hide">
		<a href="#" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;SVNHS</a>
		<ul class="side-menu">
			<li><a href="#" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="Class">Class</li>
			<li>
				<a href="#"><i class='bx bxs-chalkboard icon' ></i> Advisory <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="G11-advisory-class">G11-Advisory</a></li>
					<li><a href="G12-advisory-class">G12-Advisory</a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class='bx bxs-chalkboard icon' ></i> Subject <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="G11-subject-class">G11-Class</a></li>
					<li><a href="G12-subject-class">G12-Class</a></li></li>
				</ul>
			</li>
		</ul>

	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu toggle-sidebar' ></i>

			<a href="#" class="nav-link">
				<i class='bx bxs-bell icon' ></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon' ></i>
				<span class="badge">8</span>
			</a>
			<span class="divider"></span>
			<div class="dropdown">
				<span><?php echo $row['userLast_Name']; ?>, <?php echo $row['userFirst_Name']; ?></i></span>
			</div>	
			<div class="profile">
				<img src="../../src/img/<?php echo $profile_user  ?>" alt="user-profile">
				<ul class="profile-link">
					<li><a href="profile"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="settings"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="authentication/user-signout" class="btn-signout"><i class='bx bxs-log-out-circle' ></i> Signout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
				<!-- MAIN -->
				<main>
			<h1 class="title">Dashboard</h1>
			<ul class="breadcrumbs">
				<li><a href="home" >Home</a></li>
				<li class="divider">|</li>
                <li><a href="" class="active">Dashboard</a></li>
			</ul>
			<div class="dashboard-data">
				<div class="dashboard-card">
					<div class="head">
						<div>
							<?php
								$pdoQuery = "SELECT * FROM classes WHERE year_level = :year_level AND teacherId = :teacherId";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute(array
								( 
									":year_level"=>$Grade11, 
									":teacherId"=>$uniqueId,  
									
								));

								$count = $pdoResult1->rowCount();

								echo
								"
									<h2>$count</h2>
								";
							?>
							<p>G11 Class</p>
						</div>
						<i class='bx bxs-book-reader icon' ></i>
					</div>
					<span class="progress" data-value="40%"></span>				
				</div>
				<div class="dashboard-card">
					<div class="head">
						<div>
							<?php
								$pdoQuery = "SELECT * FROM classes WHERE year_level = :year_level AND teacherId = :teacherId";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute(array
								( 
									":year_level"=>$Grade12, 
									":teacherId"=>$uniqueId,  
									
								));

								$count = $pdoResult1->rowCount();

								echo
								"
									<h2>$count</h2>
								";
							?>
							<p>G12 Class</p>
						</div>
						<i class='bx bxs-book-reader icon' ></i>
					</div>
					<span class="progress" data-value="60%"></span>
				</div>
				<div class="dashboard-card">
					<div class="head">
						<div>
							<?php
								$pdoQuery = "SELECT * FROM student";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute();

								$count = $pdoResult1->rowCount();

								echo
								"
									<h2>$count</h2>
								";
							?> 
							<p>G11 Advisory</p>
						</div>
						<i class='bx bxs-book-reader icon' ></i>
					</div>
					<span class="progress" data-value="30%"></span>
				</div>
				<div class="dashboard-card">
					<div class="head">
						<div>
							<!-- <?php
								$pdoQuery = "SELECT * FROM academic_programs";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute();

								$count = $pdoResult1->rowCount();

								echo
								"
									<h2>$count</h2>
								";
							?> -->
							<p>G12 Advisory</p>
						</div>
						<i class='bx bxs-book-reader icon' ></i>
					</div>
					<span class="progress" data-value="80%"></span>
				</div>
			</div>
			<div class="data">
				<div class="content-data">
					<div class="head">
						<h3>Calendar</h3>
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Save</a></li>
								<li><a href="#">Remove</a></li>
							</ul>
						</div>
					</div>
					<div class="chart">
						<div id="chart"></div>
					</div>
				</div>
				<div class="content-data">
					<div class="head">
						<h3>Chatbox</h3>
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Save</a></li>
								<li><a href="#">Remove</a></li>
							</ul>
						</div>
					</div>
					<div class="chat-box">
						<p class="day"><span>Today</span></p>
						<div class="msg">
							<img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
							<div class="chat">
								<div class="profile">
									<span class="username">Alan</span>
									<span class="time">18:30</span>
								</div>
								<p>Hello</p>
							</div>
						</div>
						<div class="msg me">
							<div class="chat">
								<div class="profile">
									<span class="time">18:30</span>
								</div>
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque voluptatum eos quam dolores eligendi exercitationem animi nobis reprehenderit laborum! Nulla.</p>
							</div>
						</div>
						<div class="msg me">
							<div class="chat">
								<div class="profile">
									<span class="time">18:30</span>
								</div>
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, architecto!</p>
							</div>
						</div>
						<div class="msg me">
							<div class="chat">
								<div class="profile">
									<span class="time">18:30</span>
								</div>
								<p>Lorem ipsum, dolor sit amet.</p>
							</div>
						</div>
					</div>
					<form action="#">
						<div class="form-group">
							<input type="text" placeholder="Type...">
							<button type="submit" class="btn-send"><i class='bx bxs-send' ></i></button>
						</div>
					</form>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- END NAVBAR -->

	<script src="../../src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../../src/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="../../src/js/dashboard.js?v=<?php echo time(); ?>"></script>


	<script>

		// Signout
		$('.btn-signout').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				title: "Signout?",
				text: "Are you sure do you want to signout?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willSignout) => {
				if (willSignout) {
				document.location.href = href;
				}
			});
		})

	</script>

	<!-- SWEET ALERT -->
	<?php

	if(isset($_SESSION['status']) && $_SESSION['status'] !='')
	{
		?>
		<script>
			swal({
			title: "<?php echo $_SESSION['status_title']; ?>",
			text: "<?php echo $_SESSION['status']; ?>",
			icon: "<?php echo $_SESSION['status_code']; ?>",
			button: false,
			timer: <?php echo $_SESSION['status_timer']; ?>,
			});
		</script>
		<?php
		unset($_SESSION['status']);
	}
	?>
</body>
</html>