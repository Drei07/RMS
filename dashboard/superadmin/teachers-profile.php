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


$uniqueId = $_GET["id"];

$pdoQuery = "SELECT * FROM user WHERE uniqueID = :id";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":id"=>$uniqueId));
$employee = $pdoResult->fetch(PDO::FETCH_ASSOC);

$employee_id = $employee["userId"];
$employeeId = $employee["employeeId"];
$employee_profile = $employee["userProfile"];
$employee_Lname = $employee["userLast_Name"];
$employee_Fname = $employee["userFirst_Name"];
$employee_Mname = $employee["userMiddle_Name"];
$employee_PNumber = $employee["userPhone_Number"];
$employee_Email = $employee["userEmail"];
$employee_position = $employee["userPosition"];
$employee_status = $employee["userStatus"];
$employee_unique_id = $employee["uniqueID"];
$employee_last_update = $employee["updated_at"];

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
	<title>Teachers Profile</title>
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
				<a href="" class="active"><i class='bx bxs-user-account icon' ></i> Teachers <i class='bx bx-chevron-right icon-right' ></i></a>
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
			<h1 class="title">Teachers Profile</h1>
            <ul class="breadcrumbs">
				<li><a href="home" >Home</a></li>
				<li class="divider">|</li>
                <li><a href="teachers-data" >Teachers Data</a></li>
                <li class="divider">|</li>
                <li><a href="" class="active">Profile</a></li>

			</ul>

			<!-- PROFILE CONFIGURATION -->

            <section class="profile-form">
				<div class="header"></div>
				<div class="profile">
					<div class="profile-img">
						<img src="../../src/img/<?php echo $employee_profile ?>" alt="logo">
                        <h5><?php echo $employee_Lname?>, <?php echo $employee_Fname?> <?php echo $employee_Mname?></h5>
                        <p><?php echo $employeeId ?></p>
                        <h7><?php echo $employee_position ?></h7>
                        <?php
                         echo ($employee_status=="N" ? '<button class="N">Pending</button>' :  '<button class="Y">Active</button>')
                        ?>
						<button class="delete2"><a href="controller/delete-teachers-data-controller.php?Id=<?php echo $employee_id ?>" class="btn-delete">Delete Account</a></button>
						<button class="btn-success change" onclick="overview()"><i class='bx bx-info-square'></i> Overview</button>

					</div>

					<form action="controller/update-teachers-data-controller.php?Id=<?php echo $employee_id ?>" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

							<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Teacher Information<p>Last update: <?php  echo $employee_last_update  ?></p></label>

							<div class="col-md-6">
								<label for="first_name" class="form-label">First Name<span> *</span></label>
								<input disabled disabled type="text" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="FName" id="first_name" placeholder="<?php echo $employee_Fname ?>" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required>
								<div class="invalid-feedback">
								Please provide a First Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="middle_name" class="form-label">Middle Name</label>
								<input disabled type="text" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="MName" id="middle_name" placeholder="<?php echo $employee_Mname ?>" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
								<div class="invalid-feedback">
								Please provide a Middle Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="last_name" class="form-label">Last Name<span> *</span></label>
								<input disabled type="text" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="LName" id="last_name" placeholder="<?php echo $employee_Lname ?>" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required >
								<div class="invalid-feedback">
								Please provide a Last Name.
								</div>
							</div>

							<div class="col-md-6" >
								<label for="phone_number" class="form-label">Phone Number<span> *</span></label>
								<div class="input-group flex-nowrap">
								<span class="input-group-text" id="addon-wrapping">+63</span>
								<input disabled type="text" class="form-control numbers"  autocapitalize="off" inputmode="numeric" autocomplete="off" name="PNumber" id="phone_number" placeholder="<?php echo $employee_PNumber ?>" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required placeholder="10-digit number">
								</div>
							</div>

                            <div class="col-md-12">
								<label for="email" class="form-label">Email<span> *</span></label>
								<input disabled type="email" class="form-control" autocapitalize="off" autocomplete="off" name="Email" id="email" required placeholder="<?php echo $employee_Email ?>">
								<div class="invalid-feedback">
								Please provide a valid Email.
								</div>
							</div>

							<div class="col-md-6">
								<label for="position" class="form-label">Position<span> *</span></label>
								<input  type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocapitalize="on" maxlength="20" autocomplete="off" name="Position" id="position" value="<?php echo $employee_position ?>" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required>
								<div class="invalid-feedback">
								Please provide a Position
								</div>
							</div>
							
							<div class="col-md-6">
								<label for="employee_id" class="form-label">Employee ID<span> *</span></label>
								<input  type="text" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="EmployeeId" id="employee_id" value="<?php echo $employeeId ?>" required >
								<div class="invalid-feedback">
								Please provide a Employee ID.
								</div>
							</div>

							<div class="col-md-6" style="opacity: 0;">
								<label for="employee_id" class="form-label">Employee ID<span> *</span></label>
								<input  type="text" class="form-control" >
								<div class="invalid-feedback">
								Please provide a Employee ID.
								</div>
							</div>


						</div>

						<div class="addBtn">
                            <button type="button" onclick="location.href='teachers-data'" class="back">Back</button>
							<button type="submit" class="btn-primary add" name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
						</div>
					</form>

                </div>
            </section>
			
			<section class="data-form">
				<div class="header"></div>
					<div class="registration">
						<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> G11 Subjects</label>
						<section class="data-table">
							<div class="searchBx">
								<input type="input" placeholder="Search Subject. . . . . " class="search numbers"  inputmode="numeric" name="search_box-g11" id="search_box"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
							</div>

							<div class="table">
							<div id="G11-data">
							</div>
						</section>
					</div>
                </div>
            </section>

			<section class="data-form">
				<div class="header"></div>
					<div class="registration">
						<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> G12 Subjects</label>
						<section class="data-table">
							<div class="searchBx">
								<input type="input" placeholder="Search Subject. . . . . " class="search numbers"  inputmode="numeric" name="search_box_g12" id="search_box_g12"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
							</div>

							<div class="table">
							<div id="G12-data">
							</div>
						</section>
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

		//live search G11---------------------------------------------------------------------------------------//
		$(document).ready(function(){

		load_data(1);

		function load_data(page, query = '')
		{
		$.ajax({
			url:"data-table/teachers-subjects-G11-table.php?uniqueId=<?php echo $employee_unique_id ?>",
			method:"POST",
			data:{page:page, query:query},
			success:function(data)
			{
			$('#G11-data').html(data);
			}
		});
		}

		$(document).on('click', '.page-link', function(){
		var page = $(this).data('page_number');
		var query = $('#search_box-g11').val();
		load_data(page, query);
		});

		$('#search_box-g11').keyup(function(){
		var query = $('#search_box-g11').val();
		load_data(1, query);
		});

		});
		

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

		//live search G12---------------------------------------------------------------------------------------//
		$(document).ready(function(){

		load_data2(1);

		function load_data2(page, query = '')
		{
		$.ajax({
			url:"data-table/teachers-subjects-G12-table.php?uniqueId=<?php echo $employee_unique_id ?>",
			method:"POST",
			data:{page:page, query:query},
			success:function(data)
			{
			$('#G12-data').html(data);
			}
		});
		}

		$(document).on('click', '.page-link', function(){
		var page = $(this).data('page_number');
		var query = $('#search_box-g12').val();
		load_data2(page, query);
		});

		$('#search_box-g12').keyup(function(){
		var query = $('#search_box-g12').val();
		load_data2(1, query);
		});

		});


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
	
		//Delete Profile

		$('.btn-delete').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				text: "Are you sure do you want to delete?",
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