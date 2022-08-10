<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/superadmin-class.php';
include_once 'controller/select-settings-coniguration-controller.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('../../public/superadmin/signin');
}

$stmt = $superadmin_home->runQuery("SELECT * FROM superadmin WHERE superadminId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['superadminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


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
	<title>Account Information</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar" class="hide">
		<a href="#" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;SVNHS</a>
		<ul class="side-menu">
			<li><a href="home"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="#"><i class='bx bxs-user-pin icon' ></i> Students <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="enrolled-students-data">Data</a></li>
					<li><a href="add-students">Add Students</a></li>
				</ul>
			</li>
			<li>
				<a href=""><i class='bx bxs-user-account icon' ></i> Teachers <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="teachers-data">Data</a></li>
					<li><a href="add-teachers">Add Teachers</a></li>
				</ul>
			</li>
            <li>
				<a href="#"><i class='bx bxs-user icon' ></i> Admin <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="admin-data">Data</a></li>
					<li><a href="add-admin">Add Admin</a></li>
				</ul>
			</li>

			<li class="divider" data-text="Academic Programs">Academic Programs</li>
			<li>
				<a href="#"><i class='bx bxs-notepad icon' ></i>Programs<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="programs-list">List</a></li>
                    <li><a href="add-programs">Add Programs</a></li>
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
				<span><?php echo $row['name']; ?></i></span>
			</div>	
			<div class="profile">
				<img src="../../src/img/<?php echo $profile ?>" alt="">
				<ul class="profile-link">
					<li><a href=""><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="settings"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="authentication/superadmin-signout" class="btn-signout"><i class='bx bxs-log-out-circle' ></i> Signout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Profile</h1>
            <ul class="breadcrumbs">
				<li><a href="home" >Home</a></li>
				<li class="divider">|</li>
                <li><a href="" class="active">Profile</a></li>

			</ul>

			<!-- PROFILE CONFIGURATION -->

            <section class="profile-form">
				<div class="header"></div>
				<div class="profile">
					<div class="profile-img">
						<img src="../../src/img/<?php echo $profile ?>" alt="logo">

						<a href="controller/delete-profile-controller.php" class="delete"><i class='bx bxs-trash'></i></a>
						<button class="btn-success change" onclick="edit()"><i class='bx bxs-edit'></i> Edit Profile</button>
						<button class="btn-success change" onclick="avatar()"><i class='bx bxs-user'></i> Change Avatar</button>
						<button class="btn-success change" onclick="password()"><i class='bx bxs-key'></i> Change Password</button>

					</div>
					
					<div id="Edit">
					<form action="controller/update-profile-controller.php" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

							<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Edit Profile<p>Last update: <?php  echo $superadmin_profile_last_update  ?></p></label>

							<div class="col-md-12">
								<label for="name" class="form-label">Name<span> *</span></label>
								<input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="Name" id="name" required value="<?php  echo $superadmin_name  ?>">
								<div class="invalid-feedback">
								Please provide a Old Password.
								</div>
							</div>

							<div class="col-md-12">
								<label for="email" class="form-label">Email<span> *</span></label>
								<input type="email" class="form-control" autocapitalize="off" autocomplete="off" name="Email" id="email" required value="<?php  echo $superadmin_email  ?>">
								<div class="invalid-feedback">
								Please provide a valid Email.
								</div>
							</div>

							<div class="col-md-12" style="opacity: 0;">
								<label for="sname" class="form-label">Old Password<span> *</span></label>
								<input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="SName" id="sname" required value="<?php  echo $system_name  ?>">
								<div class="invalid-feedback">
								Please provide a Old Password.
								</div>
							</div>

						</div>

						<div class="addBtn">
							<button disabled type="submit" class="primary" name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
						</div>
					</form>
					</div>

					<div id="avatar" style="display: none;">
					<form action="controller/update-profile-avatar-controller.php" method="POST" enctype="multipart/form-data" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

							<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-user'></i> Change Avatar<p>Last update: <?php  echo $superadmin_profile_last_update  ?></p></label>

							<div class="col-md-12">
								<label for="logo" class="form-label">Upload Logo<span> *</span></label>
								<input type="file" class="form-control" name="Logo" id="logo" style="height: 33px ;" required>
								<div class="invalid-feedback">
								Please provide a Logo.
								</div>
							</div>

							<div class="col-md-12" style="opacity: 0;">
								<label for="email" class="form-label">Default Email<span> *</span></label>
								<input type="email" class="form-control" autocapitalize="off" autocomplete="off" name="" id="email" required value="<?php  echo $system_email  ?>">
								<div class="invalid-feedback">
								Please provide a valid Email.
								</div>
							</div>

							<div class="col-md-12" style="opacity: 0; padding-bottom: 1.3rem;">
								<label for="sname" class="form-label">Old Password<span> *</span></label>
								<input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="" id="sname" required value="<?php  echo $system_name  ?>">
								<div class="invalid-feedback">
								Please provide a Old Password.
								</div>
							</div>

						</div>

						<div class="addBtn">
							<button type="submit" class="primary" name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
						</div>
					</form>
					</div>

					<div id="password" style="display: none;">
					<form action="controller/update-password-controller.php" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

							<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-key'></i> Change Password<p>Last update: <?php  echo $superadmin_profile_last_update  ?></p></label>

							<div class="col-md-12">
								<label for="old_pass" class="form-label">Old Password<span> *</span></label>
								<input type="password" class="form-control" autocapitalize="on" autocomplete="off"  name="Old" id="old_pass" required>
								<div class="invalid-feedback">
								Please provide a Old Password.
								</div>
							</div>

							<div class="col-md-12">
								<label for="new_pass" class="form-label">New Password<span> *</span></label>
								<input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="New" id="new_pass" required>
								<div class="invalid-feedback">
								Please provide a New Password.
								</div>
							</div>

							<div class="col-md-12">
								<label for="confirm_pass" class="form-label">Confirm Password<span> *</span></label>
								<input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="Confirm" id="confirm_pass" required>
								<div class="invalid-feedback">
								Please provide a Confirm Password.
								</div>
							</div>

						</div>

						<div class="addBtn">
							<button type="submit" class="btn-primary" name="btn-update-password" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
						</div>
					</form>
					</div>
                </div>
            </section>		
		</main>
		<!-- MAIN -->
	</section>
	<!-- END NAVBAR -->


	<script src="../../src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../../src/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="../../src/js/dashboard.js"></script>

	<script>
		

		// Form
		(function () {
			'use strict'
			var forms = document.querySelectorAll('.needs-validation')
			Array.prototype.slice.call(forms)
			.forEach(function (form) {
				form.addEventListener('submit', function (event) {
				if (!form.checkValidity()) {
					event.preventDefault()
					event.stopPropagation()
				}

				form.classList.add('was-validated')
				}, false)
			})
		})();

		// Buttons Profile


		function edit(){
			document.getElementById('Edit').style.display = 'block';
			document.getElementById('password').style.display = 'none';
			document.getElementById('avatar').style.display = 'none';
		}

		function avatar(){
			document.getElementById('avatar').style.display = 'block';
			document.getElementById('Edit').style.display = 'none';
			document.getElementById('password').style.display = 'none';
		}

		function password(){
			document.getElementById('password').style.display = 'block';
			document.getElementById('avatar').style.display = 'none';
			document.getElementById('Edit').style.display = 'none';
		}

		//Delete Profile

		$('.delete').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				text: "Do you want to delete?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
				document.location.href = href;
				}
			});
		})

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

		//numbers only----------------------------------------------------------------------------------------------------->
		$('.numbers').keypress(function(e) {
		var x = e.which || e.keycode;
		if ((x >= 48 && x <= 57) || x == 8 ||
			(x >= 35 && x <= 40) || x == 46)
			return true;
		else
			return false;
		});
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