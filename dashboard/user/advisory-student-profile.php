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

$advisoryId     = $_GET['advisoryId'];
$Id             = $_GET['id'];

$pdoQuery = "SELECT * FROM advisory_$advisoryId WHERE Id = :id";
$pdoResult1 = $pdoConnect->prepare($pdoQuery);
$pdoExec1 = $pdoResult1->execute(array(":id"=>$Id));
$student = $pdoResult1->fetch(PDO::FETCH_ASSOC);

$studentId      = 	$student['LRN'];
$year_level		=	$student['year_level'];

$pdoQuery = "SELECT * FROM student WHERE LRN = :LRN";
$pdoResult2 = $pdoConnect->prepare($pdoQuery);
$pdoExec2 = $pdoResult2->execute(array(":LRN"=>$studentId));
$student_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

$LRN                 		= $student_data["LRN"];
$studentId                 	= $student_data["studentId"];
$programID                 	= $student_data["program"];
$first_name                 = $student_data["first_name"];
$middle_name                = $student_data["middle_name"];
$last_name                  = $student_data["last_name"];
$sex                        = $student_data["sex"];
$birth_date                 = $student_data["birth_date"];
$age                        = $student_data["age"];
$place_of_birth             = $student_data["place_of_birth"];
$civil_status               = $student_data["civil_status"];
$nationality                = $student_data["nationality"];
$religion                   = $student_data["religion"];
$phone_number               = $student_data["phone_number"];
$email                      = $student_data["email"];
$province                   = $student_data["province"];
$city                       = $student_data["city"];
$barangay                   = $student_data["barangay"];
$street                   	= $student_data["street"];
$mother_first_name          = $student_data["mother_first_name"];
$mother_middle_name        	= $student_data["mother_middle_name"];
$mother_last_name           = $student_data["mother_last_name"];
$mother_phone_number        = $student_data["mother_phone_number"];
$father_first_name          = $student_data["father_first_name"];
$father_middle_name        	= $student_data["father_middle_name"];
$father_last_name           = $student_data["father_last_name"];
$father_phone_number        = $student_data["father_phone_number"];
$sex                        = $student_data["sex"];
$emergency_contact_person   = $student_data["emergency_contact_person"];
$emergency_address          = $student_data["emergency_address"];
$emergency_mobile_number    = $student_data["emergency_mobile_number"];
$created_at                 = $student_data["created_at"];
$updated_at                 = $student_data["updated_at"];

$pdoQuery = "SELECT * FROM academic_programs WHERE programID = :id";
$pdoResult3 = $pdoConnect->prepare($pdoQuery);
$pdoExec3 = $pdoResult3->execute(array(":id"=>$programID));
$program_data = $pdoResult3->fetch(PDO::FETCH_ASSOC);

$program = $program_data['programs'];



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
    <link rel="stylesheet" href="../../src/css/countrySelect.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../../src/css/admin.css?v=<?php echo time(); ?>">
	<title>Students Profile</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar" class="hide">
		<a href="#" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;SVNHS</a>
		<ul class="side-menu">
			<li><a href="#" ><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
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
			<h1 class="title">Student Profile</h1>
            <ul class="breadcrumbs">
				<li><a href="home" >Home</a></li>
				<li class="divider">|</li>
                <li><a href="advisory?id=<?php echo $advisoryId ?>" >Advisory Data</a></li>
                <li class="divider">|</li>
                <li><a href="" class="active">Profile</a></li>

			</ul>

			<!--REPORT CARD -->

			<section class="data-form">
				<div class="header" style="height: 50px;">
					<?php echo $year_level	 ?>
				</div>
				<div class="registration" >
				
				<a href="../excel/SF9?programId=<?php echo $programID?>&LRN=<?php echo $LRN ?>&year_level=<?php echo $year_level ?>" class="print"><i class='bx bx-printer printer'></i></a>

				<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-report'></i> 1st Semester Report Card</label>

					<table>
						<thead>
						<tr>
							<td colspan="3" rowspan="3">Course </td>
							<td colspan="2" rowspan="1">Quarter</td>
							<td rowspan="2"> First<br>Semester<br>Final Grade </td>
						</tr>
						<tr>
							<td rowspan="1"> 1 </td> 	
							<td rowspan="1"> 2 </td> 		
						</tr>
						</thead>
						<tbody>
						<!-- GRADE CORE SUBJECTS -->
						<tr>
							<td colspan="6" class="subject-type" >Core Subjects</td>
						</tr>
						<?php

							$pdoQuery = "SELECT * FROM subjects_$programID WHERE subject_type = :subject_type AND semester = :semester AND year_level = :year_level ORDER BY subject_name";
							$pdoResult1 = $pdoConnect->prepare($pdoQuery);
							$pdoResult1->execute(array(":subject_type" => "Core Subjects", ":semester" => "First Semester", ":year_level" => $year_level));

							while($subject_data = $pdoResult1->fetch(PDO::FETCH_ASSOC)){
						?>
						
						<tr>
							<td colspan="3" class="subject-name"><?php echo $subject_data['subject_name'] ?></td>
							
							<?php

								$subjectId = $subject_data['subjectId'];

								$pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId LIMIT 1";
								$pdoResult2 = $pdoConnect->prepare($pdoQuery);
								$pdoResult2->execute
								(array(
									":LRN" 			=> $LRN, 
									":program" 		=> $programID, 
									":subjectId" 	=> $subjectId
								));

								if($pdoResult2->rowCount() == 0){
							?>

								<td> </td>
								<td> </td>
								<td> </td>

							<?php

								}

								else {

								while($subject_grade_data_first = $pdoResult2->fetch(PDO::FETCH_ASSOC)){

									$Q1 = $subject_grade_data_first['subject_grade_Q1'];
									$Q2 = $subject_grade_data_first['subject_grade_Q2'];
									$final_quarter = $subject_grade_data_first['final_subject_grade_1st_sem'];

							?>
								<td><?php echo $Q1 ?></td>
								<td><?php echo $Q2 ?></td>	
								<td><?php echo $final_quarter ?></td>	

							<?php
								}
								}

							?>
						</tr>
						<?php
							}

						?>
						<!--END GRADE CORE SUBJECTS -->

						<!--END GRADE APPLIED AND SPECIALIZED SUBJECTS -->
						<tr>
							<td colspan="6" class="subject-type" >Applied Subjects and Specialized Subjects</td>
						</tr>
						<?php

							$pdoQuery = "SELECT * FROM subjects_$programID WHERE (subject_type = 'Specialized Subjects' OR subject_type = 'Applied Subjects') AND semester = :semester AND year_level = :year_level ORDER BY subject_name";
							$pdoResult3 = $pdoConnect->prepare($pdoQuery);
							$pdoResult3->execute(array( ":semester" => "First Semester", ":year_level" => $year_level));

							while($subject_data = $pdoResult3->fetch(PDO::FETCH_ASSOC)){
						?>
						
						<tr>
							<td colspan="3" class="subject-name"><?php echo $subject_data['subject_name'] ?></td>
							
							<?php

								$subjectId = $subject_data['subjectId'];

								$pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId  LIMIT 1";
								$pdoResult4 = $pdoConnect->prepare($pdoQuery);
								$pdoResult4->execute
								(array(
									":LRN" 			=> $LRN, 
									":program" 		=> $programID, 
									":subjectId" 	=> $subjectId
								));

								if($pdoResult4->rowCount() == 0){
							?>

								<td> </td>
								<td> </td>
								<td> </td>

							<?php

								}

								else {

								while($subject_grade_data_first = $pdoResult4->fetch(PDO::FETCH_ASSOC)){

									$Q1 = $subject_grade_data_first['subject_grade_Q1'];
									$Q2 = $subject_grade_data_first['subject_grade_Q2'];
									$final_quarter = $subject_grade_data_first['final_subject_grade_1st_sem'];
							?>
								<td><?php echo $Q1 ?></td>
								<td><?php echo $Q2 ?></td>	
								<td><?php echo $final_quarter ?></td>	

							<?php
								}
								}

							?>
						</tr>
						<?php
							}

						?>
						<!--END GRADE APPLIED AND SPECIALIZED SUBJECTS -->
						</tbody>

					</table>

					<br><br>

					<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-report'></i> 2nd Semester Report Card </label>

					<table>
						<thead>
						<tr>
							<td colspan="3" rowspan="3">Course </td>
							<td colspan="2" rowspan="1">Quarter</td>
							<td rowspan="2"> Second<br>Semester<br>Final Grade </td>
						</tr>
						<tr>
							<td rowspan="1"> 3 </td> 	
							<td rowspan="1"> 4 </td> 		
						</tr>
						</thead>
						<tbody>
						<!-- GRADE CORE SUBJECTS -->
						<tr>
							<td colspan="6" class="subject-type" >Core Subjects</td>
						</tr>
						<?php

							$pdoQuery = "SELECT * FROM subjects_$programID WHERE subject_type = :subject_type AND semester = :semester AND year_level = :year_level ORDER BY subject_name";
							$pdoResult1 = $pdoConnect->prepare($pdoQuery);
							$pdoResult1->execute(array(":subject_type" => "Core Subjects", ":semester" => "Second Semester", ":year_level" => $year_level));

							while($subject_data = $pdoResult1->fetch(PDO::FETCH_ASSOC)){
						?>
						
						<tr>
							<td colspan="3" class="subject-name"><?php echo $subject_data['subject_name'] ?></td>
							
							<?php

								$subjectId = $subject_data['subjectId'];

								$pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId LIMIT 1";
								$pdoResult2 = $pdoConnect->prepare($pdoQuery);
								$pdoResult2->execute
								(array(
									":LRN" 			=> $LRN, 
									":program" 		=> $programID, 
									":subjectId" 	=> $subjectId
								));

								if($pdoResult2->rowCount() == 0){
							?>

								<td> </td>
								<td> </td>
								<td> </td>

							<?php

								}

								else {

								while($subject_grade_data_first = $pdoResult2->fetch(PDO::FETCH_ASSOC)){

									$Q1 = $subject_grade_data_first['subject_grade_Q3'];
									$Q2 = $subject_grade_data_first['subject_grade_Q4'];
									$final_quarter = $subject_grade_data_first['final_subject_grade_2nd_sem'];

							?>
								<td><?php echo $Q1 ?></td>
								<td><?php echo $Q2 ?></td>	
								<td><?php echo $final_quarter ?></td>	

							<?php
								}
								}

							?>
						</tr>
						<?php
							}

						?>
						<!--END GRADE CORE SUBJECTS -->

						<!--END GRADE APPLIED AND SPECIALIZED SUBJECTS -->
						<tr>
							<td colspan="6" class="subject-type" >Applied Subjects and Specialized Subjects</td>
						</tr>
						<?php

							$pdoQuery = "SELECT * FROM subjects_$programID WHERE (subject_type = 'Specialized Subjects' OR subject_type = 'Applied Subjects') AND semester = :semester AND year_level = :year_level ORDER BY subject_name";
							$pdoResult3 = $pdoConnect->prepare($pdoQuery);
							$pdoResult3->execute(array( ":semester" => "Second Semester", ":year_level" => $year_level));

							while($subject_data = $pdoResult3->fetch(PDO::FETCH_ASSOC)){
						?>
						
						<tr>
							<td colspan="3" class="subject-name"><?php echo $subject_data['subject_name'] ?></td>
							
							<?php

								$subjectId = $subject_data['subjectId'];

								$pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId  LIMIT 1";
								$pdoResult4 = $pdoConnect->prepare($pdoQuery);
								$pdoResult4->execute
								(array(
									":LRN" 			=> $LRN, 
									":program" 		=> $programID, 
									":subjectId" 	=> $subjectId
								));

								if($pdoResult4->rowCount() == 0){
							?>

								<td> </td>
								<td> </td>
								<td> </td>

							<?php

								}

								else {

								while($subject_grade_data_first = $pdoResult4->fetch(PDO::FETCH_ASSOC)){

									$Q1 = $subject_grade_data_first['subject_grade_Q3'];
									$Q2 = $subject_grade_data_first['subject_grade_Q4'];
									$final_quarter = $subject_grade_data_first['final_subject_grade_2nd_sem'];
							?>
								<td><?php echo $Q1 ?></td>
								<td><?php echo $Q2 ?></td>	
								<td><?php echo $final_quarter ?></td>	

							<?php
								}
								}

							?>
						</tr>
						<?php
							}

						?>
						<!--END GRADE APPLIED AND SPECIALIZED SUBJECTS -->
						</tbody>

					</table>
                </div>
            </section>

			<!-- PROFILE CONFIGURATION -->

            <section class="profile-form">
				<div class="header"></div>
				<div class="profile">
					<div class="profile-img">
						<img src="../../src/img/profile.png" alt="logo">
                        <h5><?php echo $last_name?>, <?php echo $first_name?> <?php echo $middle_name?></h5>
                        <p><?php echo $studentId ?></p>
                        <h7>Student</h7>
						<button class="btn-success change" onclick="Profile()"><i class='bx bxs-user'></i> Profile</button>

					</div>

                    <div id="profile">
					<form action="" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

                        <label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Student Information<p>Last update: <?php  echo $updated_at ?></p></label>

							<div class="col-md-6">
								<label for="lrn" class="form-label">LRN</label>
								<input disabled  type="text" class="form-control" value="<?php echo $LRN ?>" autocomplete="off">
								<div class="invalid-feedback">
								Please provide a LRN.
								</div>
							</div>

							<div class="col-md-6">
								<label for="studentid" class="form-label">Student ID</label>
								<input disabled type="text" class="form-control" value="<?php echo $studentId ?>" autocapitalize="on" maxlength="15" autocomplete="off">
								<div class="invalid-feedback">
								Please provide a Student ID.
								</div>
							</div>


							<div class="col-md-6">
								<label for="first_name" class="form-label">First Name</label>
								<input disabled type="text" class="form-control" value="<?php echo $first_name ?>" autocapitalize="on" maxlength="15" autocomplete="off">
								<div class="invalid-feedback">
								Please provide a First Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="middle_name" class="form-label">Middle Name</label>
								<input disabled type="text" class="form-control" value="<?php echo $middle_name ?>" autocapitalize="on" maxlength="15" autocomplete="off">
								<div class="invalid-feedback">
								Please provide a Middle Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="last_name" class="form-label">Last Name</label>
								<input disabled type="text" class="form-control" value="<?php echo $last_name ?>" autocapitalize="on" maxlength="15" autocomplete="off">
								<div class="invalid-feedback">
								Please provide a Last Name.
								</div>
							</div>

                            <div class="col-md-6">
                                <label for="sex" class="form-label">Sex</label>
								<input disabled type="text" class="form-control" value="<?php echo $sex ?>" autocapitalize="on" maxlength="15" autocomplete="off">
                                <div class="invalid-feedback">
                                    Please select a valid Sex.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="birthdate" class="form-label">Birth Date</label>
                                <input disabled type="date" class="form-control" value="<?php echo $birth_date ?>" autocapitalize="off" autocomplete="off"  maxlength="10" pattern="^[a-zA-Z0-9]+@gmail\.com$"  required placeholder="Ex: mm/dd/yyyy" onkeyup="getAgeVal(0)" onblur="getAgeVal(0);">
                                <div class="invalid-feedback">
                                Please provide a Birth Date.
                                </div>
                            </div>

                            <div class="col-md-6" style="display: none;">
                                <label for="age" class="form-label">Age<span style="font-size:9px; color:red;">( auto-generated )</span></label>
                                <input disabled type="number" class="form-control" value="<?php echo $age ?>" autocapitalize="off" autocomplete="off"   required >
                                <div class="invalid-feedback">
                                Please provide your Age.
                                </div>
                            </div>

							<div class="col-md-6">
								<label for="Pbirth" class="form-label">Place Of Birth</label>
								<input disabled type="text" class="form-control" value="<?php echo $place_of_birth ?>" autocapitalize="on" maxlength="20" autocomplete="off">
								<div class="invalid-feedback">
								Please provide a Place of Birth.
								</div>
							</div>

                            <div class="col-md-6">
                                <label for="CivilStatus" class="form-label">Civil Status</label>
								<input disabled type="text" class="form-control" value="<?php echo $civil_status ?>" autocapitalize="on" maxlength="15" autocomplete="off">
                                <div class="invalid-feedback">
                                    Please select a valid Civil Status.
                                </div>
                            </div>

                            <div class="col-md-6">
								<label for="nationality" class="form-label">Nationality</label>
								<input disabled type="text" class="form-control country-select" value="<?php echo $nationality ?>" autocapitalize="on" maxlength="20" autocomplete="off" >
								<div class="invalid-feedback">
								Please provide a Nationality.
								</div>
							</div>

                            <div class="col-md-6">
                                <label for="religion" class="form-label">Religion</label>
								<input disabled type="text" class="form-control country-select" value="<?php echo $religion ?>" autocapitalize="on" maxlength="20" autocomplete="off" >
                                <div class="invalid-feedback">
                                    Please select a valid Religion.
                                </div>
                            </div>

							<div class="col-md-6" >
								<label for="phone_number" class="form-label">Phone Number</label>
								<div class="input-group flex-nowrap">
								<span class="input-group-text" id="addon-wrapping">+63</span>
								<input disabled type="text" class="form-control numbers" value="<?php echo $phone_number ?>"  autocapitalize="off" inputmode="numeric" autocomplete="off"  minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
								</div>
							</div>
							
							<div class="col-md-6">
								<label for="email" class="form-label">Email</label>
								<input disabled type="email" class="form-control" value="<?php echo $email ?>" autocapitalize="off" autocomplete="off"  placeholder="Ex. juan@email.com">
								<div class="invalid-feedback">
								Please provide a valid Email.
								</div>
							</div>
                            <!-- Residential Address -->
                            <label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Residential Address</label>
                            
                            <div class="col-md-6">
                                <label for="province" class="form-label">Province</label>
								<input disabled type="text" class="form-control" value="<?php echo $province ?>" autocapitalize="on"  autocomplete="off"  required>
                                <div class="invalid-feedback">
                                    Please select a valid Province.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label">City/Municipality</label>
                                <input disabled type="text" class="form-control" value="<?php echo $city ?>" autocapitalize="on"  autocomplete="off"  required>
                                <div class="invalid-feedback">
                                    Please select a valid City.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="barangay" class="form-label">Barangay</label>
								<input disabled type="text" class="form-control" value="<?php echo $barangay ?>" autocapitalize="on"  autocomplete="off"  required>
                                <div class="invalid-feedback">
                                    Please select a valid Barangay.
                                </div>
                            </div>

							<div class="col-md-6">
                                <label for="street" class="form-label">Street</label>
								<input disabled type="text" class="form-control" value="<?php echo $street ?>"  autocomplete="off"  >
                                <div class="invalid-feedback">
                                    Please select a valid Street.
                                </div>
                            </div>

							<!-- Mother Information -->
							<label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Mother Information<span> (maiden name)</span></label>

							<div class="col-md-6">
								<label for="mother_first_name" class="form-label">First Name</label>
								<input disabled type="text" class="form-control" value="<?php echo $mother_first_name ?>" autocomplete="off"   >
								<div class="invalid-feedback">
								Please provide a First Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="mother_middle_name" class="form-label">Middle Name</label>
								<input disabled type="text" class="form-control" value="<?php echo $mother_middle_name ?>" autocomplete="off"  >
								<div class="invalid-feedback">
								Please provide a Middle Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="mother_last_name" class="form-label">Last Name</label>
								<input disabled type="text" class="form-control" value="<?php echo $mother_last_name ?>" autocomplete="off"  >
								<div class="invalid-feedback">
								Please provide a Last Name.
								</div>
							</div>

							<div class="col-md-6" >
								<label for="mother_phone_number" class="form-label">Phone Number</label>
								<div class="input-group flex-nowrap">
								<span class="input-group-text" id="addon-wrapping">+63</span>
								<input disabled type="text" class="form-control numbers" value="<?php echo $mother_phone_number ?>"  autocapitalize="off" inputmode="numeric" autocomplete="off"  minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
								</div>
							</div>

							<!-- Father Information -->
							<label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Father Information</label>

							<div class="col-md-6">
								<label for="father_first_name" class="form-label">First Name</label>
								<input disabled type="text" class="form-control" value="<?php echo $father_first_name ?>" autocomplete="off"   required>
								<div class="invalid-feedback">
								Please provide a First Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="father_middle_name" class="form-label">Middle Name</label>
								<input disabled type="text" class="form-control" value="<?php echo $father_middle_name ?>" autocomplete="off"  >
								<div class="invalid-feedback">
								Please provide a Middle Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="father_last_name" class="form-label">Last Name</label>
								<input disabled type="text" class="form-control" value="<?php echo $father_last_name ?>" autocomplete="off" >
								<div class="invalid-feedback">
								Please provide a Last Name.
								</div>
							</div>

							<div class="col-md-6" >
								<label for="father_phone_number" class="form-label">Phone Number</label>
								<div class="input-group flex-nowrap">
								<span class="input-group-text" id="addon-wrapping">+63</span>
								<input disabled type="text" class="form-control numbers" value="<?php echo $father_phone_number ?>"  autocapitalize="off" inputmode="numeric" autocomplete="off"  minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
								</div>
							</div>

                            <!-- Emergency Information -->
                            <label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Emergency Information</label>

                            <div class="col-md-6">
								<label for="ECP" class="form-label">Emergency Contact Person</label>
								<input disabled type="text" class="form-control" value="<?php echo $emergency_contact_person ?>" autocapitalize="on"  autocomplete="off"  >
								<div class="invalid-feedback">
								Please provide a Emergency Contact Person.
								</div>
							</div>

                            <div class="col-md-6">
								<label for="EAddress" class="form-label">Emergency Address</label>
								<input disabled type="text" class="form-control" value="<?php echo $emergency_address ?>" autocapitalize="on"  autocomplete="off"  >
								<div class="invalid-feedback">
								Please provide a Emergency Address.
								</div>
							</div>

                            <div class="col-md-6">
								<label for="EMN" class="form-label">Emergency Mobile No.</label>
								<div class="input-group flex-nowrap">
								<span class="input-group-text" id="addon-wrapping">+63</span>
								<input disabled type="text" class="form-control numbers" value="<?php echo $emergency_mobile_number ?>"  autocapitalize="off" inputmode="numeric" autocomplete="off"  minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
								</div>
							</div>

							<!-- Select Program -->
							<label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Select Program</label>	
							
							<div class="col-md-6">
								<label for="programs" class="form-label">Programs</label>
								<input disabled type="text" class="form-control" value="<?php echo $program ?>" autocapitalize="on"  autocomplete="off"  >
								<div class="invalid-feedback">
									Please select a valid Programs.
								</div>
							</div>
						</div>

						<div class="addBtn">
                            <button type="button" onclick="location.href='advisory?id=<?php echo $advisoryId ?>'" class="back">Back</button>
						</div>
					</form>
                    </div>
                </div>
            </section>		
		</main>
		<!-- MAIN -->
	</section>
	<!-- END NAVBAR -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
	<script src="../../src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../src/js/countrySelect.min.js"></script>
	<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
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

        // button

        //Delete Profile

		$('.btn-delete').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				title: "Delete?",
				text: "Are you sure do you want to delete?",
				icon: "Warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
				document.location.href = href;
				}
			});
		})

		// Print
		$('.print').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				title: "Print?",
				text: "Are you sure do you want to print this report card?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willSignout) => {
				if (willSignout) {
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

		//numbers only
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