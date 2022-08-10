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

$profile_user 	= $row['userProfile'];

$classId = $_GET['id'];

$pdoQuery = "SELECT * FROM classes WHERE classId = :classId LIMIT 1";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":classId" => $classId));
$class_data = $pdoResult->fetch(PDO::FETCH_ASSOC);

$class_code     = $class_data['class_code'];
$class_color    = $class_data['class_color'];
$class_program 	= $class_data['program'];
$class_subject 	= $class_data['subject_name'];
$class_year		=$class_data['year_level'];

if($class_year == "Grade11"){
	$location = "G11-subject-class";
}
else if($class_year == "Grade12")
{
	$location = "G12-subject-class";
}

$pdoQuery = "SELECT * FROM subjects_$class_program WHERE subjectId = :subjectId LIMIT 1";
$pdoResult2 = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult2->execute(array(":subjectId" => $class_subject));
$subject_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

$subject_name	=	$subject_data['subject_name'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../../src/img/<?php echo $logo ?>">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
	<link rel="stylesheet" href="../../src/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../src/node_modules/boxicons/css/boxicons.min.css">
	<link rel="stylesheet" href="../../src/node_modules/aos/dist/aos.css">
    <link rel="stylesheet" href="../../src/css/admin.css?v=<?php echo time(); ?>">
	<title>Class | <?php echo $class_code ?></title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar" class="hide">
		<a href="#" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;SVNHS</a>
		<ul class="side-menu">
			<li><a href="home"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="Class">Class</li>
			<li>
				<a href="#"><i class='bx bxs-chalkboard icon' ></i> Advisory <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="G11-advisory-class">G11-Advisory</a></li>
					<li><a href="G12-advisory-class">G12-Advisory</a></li>
				</ul>
			</li>
			<li>
				<a href="#" class="active"><i class='bx bxs-chalkboard icon' ></i> Subject <i class='bx bx-chevron-right icon-right' ></i></a>
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
			<h1 class="title"><?php echo $class_code ?>	- <label><?php echo $subject_name ?></label></h1>
            <ul class="breadcrumbs">
				<li><a href="home" >Home</a></li>
                <li class="divider">|</li>
				<li><a href=<?php echo $location ?>>List</a></li>
				<li class="divider">|</li>
				<li><a href="" class="active">Class Data</a></li>
			</ul>
            <div class="level">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#classModal" style="background-color: <?php echo $class_color ?>;"><i class='bx bxs-plus-circle'></i> Add Student</button>
            </div>

            <section class="data-table">

                <div class="searchBx">
                    <input type="input" placeholder="search LRN . . . . . " class="search numbers" inputmode="numeric" name="search_box2" id="search_box2"><button class="searchBtn" style="background-color: <?php echo $class_color ?>;"><i class="bx bx-search icon"></i></button>
                </div>

                <div class="table">
                <div id="student-data-table">
                </div>

            </section>
		</main>
		<!-- MAIN -->
	</section>

    <!-- MODALS -->
	<div class="class-modal">
		<div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content" style="height: 700px;">
				<div class="header"></div>
					<div class="modal-header">
						<h5 class="modal-title" id="classModalLabel">Add Student</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
					<section class="data-table">
						<div class="searchBx">
							<input type="input" placeholder="search LRN. . . . . " class="search numbers"  inputmode="numeric" name="search_box" id="search_box"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
						</div>

						<div class="table">
						<div id="student-data">
						</div>
					</section>
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

		//numbers only
		$('.numbers').keypress(function(e) {
		var x = e.which || e.keycode;
		if ((x >= 48 && x <= 57) || x == 8 ||
			(x >= 35 && x <= 40) || x == 46)
			return true;
		else
			return false;
		});

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

        //live search---------------------------------------------------------------------------------------//
        $(document).ready(function(){

        load_data(1);

        function load_data(page, query = '')
        {
        $.ajax({
            url:"data-table/student-data-table.php?classId=<?php echo $classId ?>",
            method:"POST",
            data:{page:page, query:query},
            success:function(data)
            {
            $('#student-data').html(data);
            }
        });
        }

        $(document).on('click', '.page-link', function(){
        var page = $(this).data('page_number');
        var query = $('#search_box').val();
        load_data(page, query);
        });

        $('#search_box').keyup(function(){
        var query = $('#search_box').val();
        load_data(1, query);
        });

        });

		//live search 2---------------------------------------------------------------------------------------//
        $(document).ready(function(){

		load_data2(1);

		function load_data2(page, query = '')
		{
		$.ajax({
			url:"data-table/class-student-data-table.php?classId=<?php echo $classId ?>",
			method:"POST",
			data:{page:page, query:query},
			success:function(data)
			{
			$('#student-data-table').html(data);
			}
		});
		}

		$(document).on('click', '.page-link', function(){
		var page = $(this).data('page_number');
		var query = $('#search_box2').val();
		load_data2(page, query);
		});

		$('#search_box2').keyup(function(){
		var query = $('#search_box2').val();
		load_data2(1, query);
		});

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