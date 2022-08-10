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


$subjectId      = $_GET["subjectId"];
$Id             = $_GET["id"];

$pdoQuery = "SELECT * FROM subjects_$subjectId WHERE subjectId =" . $_GET['id'];
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array());
$subjects_profile = $pdoResult->fetch(PDO::FETCH_ASSOC);

$subject_name      =$subjects_profile['subject_name'];
$subject_semester  =$subjects_profile['semester'];
$subject_type      =$subjects_profile['subject_type'];
$year_level         =$subjects_profile['year_level'];

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
	<title>Add Subjects</title>
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
					<li><a href="profile"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="settings"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="authentication/superadmin-signout" class="btn-signout"><i class='bx bxs-log-out-circle' ></i> Signout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Add Subject</h1>
            <ul class="breadcrumbs">
				<li><a href="home" >Home</a></li>
				<li class="divider">|</li>
				<li><a href="programs-list">List</a></li>
                <li class="divider">|</li>
				<li><a href="academic-subjects?id=<?php echo $subject ?>">Subjects</a></li>
                <li class="divider">|</li>
				<li><a href="" class="active">Edit Subject</a></li>
			</ul>
            <section class="data-form">
				<div class="header"></div>
				<div class="registration">
					<form action="controller/update-academic-subject-controller?subjectId=<?php echo $subjectId ?>&id=<?php echo $Id ?>" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

                        	<div class="col-md-6">
                                <label for="year_level" class="form-label">Year Level<span> *</span></label>
                                <select class="form-select form-control"  name="YLevel"  autocapitalize="on"  autocomplete="off" id="year_level" required>
                                <option selected  value="<?php echo $year_level ?>"><?php echo $year_level ?></option>
                                <option value="Grade11">Grade 11</option>
                                <option value="Grade12 ">Grade 12</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Year Level.
                                </div>
                            </div>

							<div class="col-md-6">
                                <label for="semester" class="form-label">Semester<span> *</span></label>
                                <select class="form-select form-control"  name="Semester"  autocapitalize="on"  autocomplete="off" id="semester" required>
                                <option selected  value="<?php echo $subject_semester ?>"><?php echo $subject_semester ?></option>
                                <option value="First Semester">First Semester</option>
                                <option value="Second Semester">Second Semester</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Semester.
                                </div>
                            </div>

							<div class="col-md-6">
								<label for="subject_name" class="form-label">Subject Name<span> *</span></label>
								<input type="text" class="form-control" autocapitalize="on" value="<?php echo $subject_name ?>"  autocomplete="off" name="SName" id="subject_name" required>
								<div class="invalid-feedback">
								Please provide a Subject Name.
								</div>
							</div>

							<div class="col-md-6">
                                <label for="subject_type" class="form-label">Subject Type<span> *</span></label>
                                <select class="form-select form-control"  name="Subject_type"  autocapitalize="on"  autocomplete="off" id="subject_type" required>
                                <option selected  value="<?php echo $subject_type ?>"><?php echo $subject_type ?></option>
                                <option value="Core Subjects">Core Subjects</option>
                                <option value="Applied Subjects">Applied Subjects</option>
								<option value="Specialized Subjects">Specialized Subjects</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Subject Type.
                                </div>
                            </div>

						</div>

						<div class="addBtn">
							<button type="submit" class="btn-primary" name="btn-register" id="btn-register" onclick="return IsEmpty(); sexEmpty();">Update</button>
						</div>
					</form>
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