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

$UId = $row['userId'];
$uniqueId 		= $row["uniqueID"];
$year_level 	= "Grade12";
$profile_user 	= $row['userProfile']



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
	<title>G12 Advisory</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar" class="hide">
		<a href="#" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;SVNHS</a>
		<ul class="side-menu">
			<li><a href="home" ><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="Class">Class</li>
			<li>
				<a href="#" class="active"><i class='bx bxs-chalkboard icon' ></i> Advisory <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="G11-advisory-class">G11-Advisory</a></li>
					<li><a href="">G12-Advisory</a></li>
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
				<img src="../../src/img/<?php echo $profile_user ?>" alt="">
				<ul class="profile-link">
					<li><a href="profile"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="settings"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="authentication/user-signout" class="btn-signout"><i class='bx bxs-log-out-circle' ></i> Signout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">G11 Advisory</h1>
            <ul class="breadcrumbs">
				<li><a href="home" >Home</a></li>
				<li class="divider">|</li>
				<li><a href="" class="active">List of Advisory</a></li>
			</ul>
			<div class="manage">
				<button type="button" class="btn-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#classModal"><i class='bx bxs-plus-circle'></i> Add Advisory</button>
			</div>

			<div class="info-data">
				<?php

						// $semester = "First Semester";

						$pdoQuery = "SELECT * FROM advisory WHERE year_level = :year_level AND teacherId = :teacherId AND status = :status";
						$pdoResult = $pdoConnect->prepare($pdoQuery);
						$pdoResult->execute(array
						( 
							":year_level"=>$year_level, 
							":teacherId"=>$uniqueId, 
							":status"	=> "active" 
							// ":semester"=>$semester
					));

						while($row=$pdoResult->fetch(PDO::FETCH_ASSOC)) {
							extract($row);

							?>
								<div class="card">
									<div class="head" style="background-color: <?php echo $row['advisory_class_color']; ?>;">
									<a href="controller/delete-class-controller?teacherID=<?php echo $uniqueId?>&id=<?php echo $row['Id'] ?>&year_level=<?php echo $row['year_level'] ?>" class="delete"><i class='bx bxs-trash dot' style="color:<?php echo $row['advisory_class_color']; ?>;"></i></a>
										<div>											
											<h2>SECTION: <?php echo $row['section_name']; ?></h2>
											<?php

												$programID = $row['program'];

												$pdoQuery = "SELECT * FROM academic_programs WHERE programID = :programID";
												$pdoResult2 = $pdoConnect->prepare($pdoQuery);
												$pdoResult2->execute(array(":programID" => $programID));
												$program_data=$pdoResult2->fetch(PDO::FETCH_ASSOC);

											?>
											<p><?php echo $program_data['programs'] ?></p>
										</div>
									</div>
									<div class="card-body" onclick="location.href='advisory?id=<?php echo $row['advisoryId'] ?>';">
										<p style="background-color: <?php echo $row['advisory_class_color']; ?>;">
										<?php

											$advisoryId = $row['advisoryId'];

											$pdoQuery = "SELECT * FROM advisory_$advisoryId";
											$pdoResult3 = $pdoConnect->prepare($pdoQuery);
											$pdoResult3->execute();
									
											$count = $pdoResult3->rowCount();

											echo"$count";

										?>
										</p>
									</div>
									<div class="card-footer">
										<p>S.Y. <?php echo $row['school_year']; ?></p>
									</div>
								</div>
							<?php
						}
				?>	
			</div>
		</main>
		<!-- MAIN -->
	</section>

	<!-- MODALS -->
	<div class="class-modal">
		<div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
				<div class="header"></div>
					<div class="modal-header">
						<h5 class="modal-title" id="classModalLabel">Add Advisory</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
							<form action="controller/add-advisory-controller.php" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
								<div class="row gx-5 needs-validation">

									<div class="col-md-6" style="display: none;">
										<label for="teacherId" class="form-label">Teacher ID</label>
										<input type="text" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="TeacherID" value="<?php echo $uniqueId  ?>" id="teacherId">
									</div>

									<div class="col-md-6">
										<label for="programs" class="form-label">Programs<span> *</span></label>
										<select class="form-select form-control programs"  name="Programs"  autocapitalize="on" maxlength="6" autocomplete="off" id="programs" required>
										<option selected>Select Programs</option>
											<?php
												$pdoQuery = "SELECT * FROM academic_programs";
												$pdoResult = $pdoConnect->prepare($pdoQuery);
												$pdoResult->execute();
												
													while($academic_programs=$pdoResult->fetch(PDO::FETCH_ASSOC)){
														?>
														<option value="<?php echo $academic_programs['programID']; ?>">
														<?php echo $academic_programs['programs'] ?></option>
														<?php
													}
											?>
										</select>
										<div class="invalid-feedback">
											Please select a valid Programs.
										</div>
                           			</div>

									<div class="col-md-6" style="display: none;">
										<label for="yearLevel" class="form-label">Year Level</label>
										<input type="text" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="YearLevel" value="<?php echo $year_level  ?>" id="yearLevel">
									</div>

									<div class="col-md-6">
										<label for="shool_year" class="form-label">School Year<span> *</span></label>
										<select class="form-select form-control"  name="school_year"  autocapitalize="on" maxlength="6" autocomplete="off" id="shool_year" required>
										<option selected disabled value="">School Year</option>
											<?php
												$pdoQuery = "SELECT * FROM school_year";
												$pdoResult = $pdoConnect->prepare($pdoQuery);
												$pdoResult->execute();
												
												
													while($year=$pdoResult->fetch(PDO::FETCH_ASSOC)){
														?>
														<option value="<?php echo ($year['year_from']).("-").($year['year_to']); ?>">S.Y. 
																<?php echo ($year['year_from']).("-").($year['year_to']); ?></option>
														<?php
													}
											?>
										</select>
										<div class="invalid-feedback">
											Please select a valid School Year.
										</div>
                           			</div>

									<div class="col-md-6">
										<label for="section_name" class="form-label">Section Name</label>
										<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="section_name" id="section_name" required placeholder="eg. BABAGE">
										<div class="invalid-feedback">
										Please provide a Class Code.
										</div>
									</div>

									<div class="col-md-6">
										<label for="color" class="form-label">Header Colors<span> *</span></label>
										<select class="form-select form-control"  name="Color"  autocapitalize="on" maxlength="6" autocomplete="off" id="color" required>
										<option selected disabled value="">Select Colors</option>
											<?php
												$pdoQuery = "SELECT * FROM class_color";
												$pdoResult = $pdoConnect->prepare($pdoQuery);
												$pdoResult->execute();
												
													while($colors=$pdoResult->fetch(PDO::FETCH_ASSOC)){
														?>
														<option value="<?php echo $colors['color_id']; ?>">
														<?php echo $colors['color_name'] ?></option>
														<?php
													}
											?>
										</select>
										<div class="invalid-feedback">
											Please select a valid Colors.
										</div>
                           			</div>

								</div>

								<div class="addBtn">
									<button type="submit" class="btn-primary" name="btn-register-class" id="btn-register" onclick="return IsEmpty(); sexEmpty();">Add</button>
								</div>
							</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END MODALS -->
	<!-- END NAVBAR -->


	<script src="../../src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../../src/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="../../src/js/dashboard.js"></script>

	<script>
		// Form---------------------------------------------------------------------------------------
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

		// Signout---------------------------------------------------------------------------------------
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