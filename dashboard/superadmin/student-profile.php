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


$student_Id = $_GET["id"];
$GRADE11 = "Grade11";
$GRADE12 = "Grade12";

$pdoQuery = "SELECT * FROM student WHERE userId = :id";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":id"=>$student_Id));
$student = $pdoResult->fetch(PDO::FETCH_ASSOC);

$LRN                 		= $student["LRN"];
$studentId                 	= $student["studentId"];
$programID                 	= $student["program"];
$first_name                 = $student["first_name"];
$middle_name                = $student["middle_name"];
$last_name                  = $student["last_name"];
$sex                        = $student["sex"];
$birth_date                 = $student["birth_date"];
$age                        = $student["age"];
$place_of_birth             = $student["place_of_birth"];
$civil_status               = $student["civil_status"];
$nationality                = $student["nationality"];
$religion                   = $student["religion"];
$phone_number               = $student["phone_number"];
$email                      = $student["email"];
$province                   = $student["province"];
$city                       = $student["city"];
$barangay                   = $student["barangay"];
$street                   	= $student["street"];
$mother_first_name          = $student["mother_first_name"];
$mother_middle_name        	= $student["mother_middle_name"];
$mother_last_name           = $student["mother_last_name"];
$mother_phone_number        = $student["mother_phone_number"];
$father_first_name          = $student["father_first_name"];
$father_middle_name        	= $student["father_middle_name"];
$father_last_name           = $student["father_last_name"];
$father_phone_number        = $student["father_phone_number"];
$sex                        = $student["sex"];
$emergency_contact_person   = $student["emergency_contact_person"];
$emergency_address          = $student["emergency_address"];
$emergency_mobile_number    = $student["emergency_mobile_number"];
$created_at                 = $student["created_at"];
$updated_at                 = $student["updated_at"];

$pdoQuery = "SELECT * FROM academic_programs WHERE programID = :id";
$pdoResult2 = $pdoConnect->prepare($pdoQuery);
$pdoExec2 = $pdoResult2->execute(array(":id"=>$programID));
$program_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

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
			<li><a href="home"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="#" class="active"><i class='bx bxs-user-pin icon' ></i> Students <i class='bx bx-chevron-right icon-right' ></i></a>
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
			<li><a href="request"><i class='bx bxs-paper-plane icon' ></i> Request</a></li>
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
			<h1 class="title">Student Profile</h1>
            <ul class="breadcrumbs">
				<li><a href="home" >Home</a></li>
				<li class="divider">|</li>
                <li><a href="enrolled-students-data" >Student Data</a></li>
                <li class="divider">|</li>
                <li><a href="" class="active">Profile</a></li>

			</ul>

			<a href="controller/print-verify-controller?programId=<?php echo $programID?>&LRN=<?php echo $LRN ?>" class="print"><i class='bx bx-printer printer'></i></a>

			<!-- GRADE 11 REPORT CARD -->

			<section class="data-form">
				<div class="header" style="height: 50px;">
					Grade 11
				</div>
				<div class="registration" >

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
							$pdoResult1->execute(array(":subject_type" => "Core Subjects", ":semester" => "First Semester", ":year_level" => "Grade11"));

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
							$pdoResult3->execute(array( ":semester" => "First Semester", ":year_level" => "Grade11"));

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
							$pdoResult1->execute(array(":subject_type" => "Core Subjects", ":semester" => "Second Semester", ":year_level" => "Grade11"));

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
							$pdoResult3->execute(array( ":semester" => "Second Semester", ":year_level" => "Grade11"));

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
			<br><br>	

			<!-- GRADE 12 REPORT CARD -->

			<section class="data-form">
				<div class="header" style="height: 50px;">
					Grade 12
				</div>
				<div class="registration" >
				
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
							$pdoResult1->execute(array(":subject_type" => "Core Subjects", ":semester" => "First Semester", ":year_level" => "Grade12"));

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
							$pdoResult3->execute(array( ":semester" => "First Semester", ":year_level" => "Grade12"));

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
							$pdoResult1->execute(array(":subject_type" => "Core Subjects", ":semester" => "Second Semester", ":year_level" => "Grade12"));

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
							$pdoResult3->execute(array( ":semester" => "Second Semester", ":year_level" => "Grade12"));

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
									$Q2 = $subject_grade_data_first['subject_grade_Q3'];
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
						<button class="delete2"><a href="controller/delete-student-data-controller.php?Id=<?php echo $student_Id ?>" class="btn-delete">Delete Account</a></button>
						<button class="btn-success change" onclick="overview()"><i class='bx bx-info-square'></i> Overview</button>


					</div>

					<form action="controller/update-student-data-controller.php?id=<?php echo $student_Id ?>" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

                        <label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Student Information<p>Last update: <?php  echo $updated_at ?></p></label>

							<div class="col-md-6">
								<label for="lrn" class="form-label">LRN<span> *</span></label>
								<input disabled type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $LRN ?>" autocomplete="off" name="LRN" id="lrn"  >
								<div class="invalid-feedback">
								Please provide a LRN.
								</div>
							</div>

							<div class="col-md-6">
								<label for="studentid" class="form-label">Student ID<span> *</span></label>
								<input  type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $studentId ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="StudentId" id="studentid" >
								<div class="invalid-feedback">
								Please provide a Student ID.
								</div>
							</div>


							<div class="col-md-6">
								<label for="first_name" class="form-label">First Name<span> *</span></label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $first_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="FName" id="first_name"  required>
								<div class="invalid-feedback">
								Please provide a First Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="middle_name" class="form-label">Middle Name</label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $middle_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="MName" id="middle_name" >
								<div class="invalid-feedback">
								Please provide a Middle Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="last_name" class="form-label">Last Name<span> *</span></label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $last_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="LName" id="last_name"  required >
								<div class="invalid-feedback">
								Please provide a Last Name.
								</div>
							</div>

                            <div class="col-md-6">
                                <label for="sex" class="form-label">Sex<span> *</span></label>
                                <select class="form-select form-control"  name="Sex"  autocapitalize="on" maxlength="6" autocomplete="off" id="sex" required>
                                <option selected value="<?php echo $sex ?>"><?php echo $sex ?></option>
                                <option value="MALE">MALE</option>
                                <option value="FEMALE ">FEMALE</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Sex.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="birthdate" class="form-label">Birth Date<span> *</span></label>
                                <input type="date" class="form-control" value="<?php echo $birth_date ?>" autocapitalize="off" autocomplete="off" name="BirthDate" id="birthdate" maxlength="10" pattern="^[a-zA-Z0-9]+@gmail\.com$"  required placeholder="Ex: mm/dd/yyyy" onkeyup="getAgeVal(0)" onblur="getAgeVal(0);">
                                <div class="invalid-feedback">
                                Please provide a Birth Date.
                                </div>
                            </div>

                            <div class="col-md-6" style="display: none;">
                                <label for="age" class="form-label">Age<span style="font-size:9px; color:red;">( auto-generated )</span></label>
                                <input type="number" class="form-control" value="<?php echo $age ?>" autocapitalize="off" autocomplete="off"  name="Age" id="age" required >
                                <div class="invalid-feedback">
                                Please provide your Age.
                                </div>
                            </div>

							<div class="col-md-6">
								<label for="Pbirth" class="form-label">Place Of Birth</label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $place_of_birth ?>" autocapitalize="on" maxlength="20" autocomplete="off" name="PBirth" id="Pbirth" >
								<div class="invalid-feedback">
								Please provide a Place of Birth.
								</div>
							</div>

                            <div class="col-md-6">
                                <label for="CivilStatus" class="form-label">Civil Status<span> *</span></label>
                                <select class="form-select form-control"  name="CStatus"  autocapitalize="on" maxlength="6" autocomplete="off" id="CivilStatus" required>
                                <option selected value="<?php echo $civil_status ?>" ><?php echo $civil_status ?></option>
                                <option value="SINGLE">SINGLE</option>
                                <option value="MARRIED">MARRIED</option>
                                <option value="SEPERATED">SEPERATED</option>
                                <option value=">WIDOW/WIDOWER">WIDOW/WIDOWER</option>
                                <option value="ANULLED">ANULLED</option>
                                <option value="SOLO PARENT">SOLO PARENT</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Civil Status.
                                </div>
                            </div>

                            <div class="col-md-6">
								<label for="nationality" class="form-label">Nationality<span> *</span></label>
								<input type="text" class="form-control country-select" value="<?php echo $nationality ?>" autocapitalize="on" maxlength="20" autocomplete="off" name="Nationality" id="nationality"  required>
								<div class="invalid-feedback">
								Please provide a Nationality.
								</div>
							</div>

                            <div class="col-md-6">
                                <label for="religion" class="form-label">Religion<span> *</span></label>
                                <select class="form-select form-control"  name="Religion"  autocapitalize="on" maxlength="6" autocomplete="off" id="religion" required>
                                <option selected value="<?php echo $religion ?>"><?php echo $religion ?></option>
								<option value="ROMAN CATHOLIC">Roman Catholic</option>
                                <option value="INC">INC</option>
                                <option value="CHRISTIAN">Christian</option>
                                <option value="ISLAM">Islam</option>
                                <option value="BUDDHISM">Buddhism</option>
                                <option value="PROTESTANT">Protestant</option>
                                <option value="METHODIST">Methodist</option>
                                <option value="ADVENTIST">Adventist</option>
                                <option value="INDEPENDENT">independent</option>
                                <option value="EVANGELICAL">Evangelical</option>
                                <option value="JENOVAH'S-WINESSES">Jehovah's-Witnesses</option>
                                <option value="JIL">JIL</option>
                                <option value="LUTHERAN">Lutheran</option>
                                <option value="ORTHODOX">Orthodox</option>
                                <option value="PENTECOSTAL">Pentecostal</option>
                                <option value="PRESBYTERIANISM">Presbyterianism</option>
                                <option value="LATTER-DAY">Latter-Day</option>
                                <option value="UCCP">UCCP</option>
                                <option value="KJC">KJC</option>
                                <option value="BAPTIST">Baptist</option>
                                <option value="ANGELICAN-EPISCOPALIAN">Angelican-Episcopalian</option>
                                <option value="OTHERS">Others</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Religion.
                                </div>
                            </div>

							<div class="col-md-6" >
								<label for="phone_number" class="form-label">Phone Number</label>
								<div class="input-group flex-nowrap">
								<span class="input-group-text" id="addon-wrapping">+63</span>
								<input type="text" class="form-control numbers" value="<?php echo $phone_number ?>"  autocapitalize="off" inputmode="numeric" autocomplete="off" name="PNumber" id="phone_number" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
								</div>
							</div>
							
							<div class="col-md-6">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control" value="<?php echo $email ?>" autocapitalize="off" autocomplete="off" name="Email" id="email" placeholder="Ex. juan@email.com">
								<div class="invalid-feedback">
								Please provide a valid Email.
								</div>
							</div>
                            <!-- Residential Address -->
                            <label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Residential Address</label>
                            
                            <div class="col-md-6">
                                <label for="province" class="form-label">Province<span> *</span></label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $province ?>" autocapitalize="on"  autocomplete="off" name="Province" id="province" required>
                                <div class="invalid-feedback">
                                    Please select a valid Province.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label">City/Municipality<span> *</span></label>
                                <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $city ?>" autocapitalize="on"  autocomplete="off" name="City" id="city" required>
                                <div class="invalid-feedback">
                                    Please select a valid City.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="barangay" class="form-label">Barangay<span> *</span></label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $barangay ?>" autocapitalize="on"  autocomplete="off" name="Barangay" id="barangay" required>
                                <div class="invalid-feedback">
                                    Please select a valid Barangay.
                                </div>
                            </div>

							<div class="col-md-6">
                                <label for="street" class="form-label">Street</label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $street ?>"  autocomplete="off" name="Street" id="street" >
                                <div class="invalid-feedback">
                                    Please select a valid Street.
                                </div>
                            </div>

							<!-- Mother Information -->
							<label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Mother Information<span> (maiden name)</span></label>

							<div class="col-md-6">
								<label for="mother_first_name" class="form-label">First Name</label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $mother_first_name ?>" autocomplete="off" name="Mother-FName" id="mother_first_name" >
								<div class="invalid-feedback">
								Please provide a First Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="mother_middle_name" class="form-label">Middle Name</label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $mother_middle_name ?>" autocomplete="off" name="Mother-MName" id="mother_middle_name" >
								<div class="invalid-feedback">
								Please provide a Middle Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="mother_last_name" class="form-label">Last Name</label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $mother_last_name ?>" autocomplete="off" name="Mother-LName" id="mother_last_name"  >
								<div class="invalid-feedback">
								Please provide a Last Name.
								</div>
							</div>

							<div class="col-md-6" >
								<label for="mother_phone_number" class="form-label">Phone Number</label>
								<div class="input-group flex-nowrap">
								<span class="input-group-text" id="addon-wrapping">+63</span>
								<input type="text" class="form-control numbers" value="<?php echo $mother_phone_number ?>"  autocapitalize="off" inputmode="numeric" autocomplete="off" name="Mother-PNumber" id="mother_phone_number" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
								</div>
							</div>

							<!-- Father Information -->
							<label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Father Information</label>

							<div class="col-md-6">
								<label for="father_first_name" class="form-label">First Name</label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $father_first_name ?>" autocomplete="off" name="Father-FName" id="father_first_name"  >
								<div class="invalid-feedback">
								Please provide a First Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="father_middle_name" class="form-label">Middle Name</label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $father_middle_name ?>" autocomplete="off" name="Father-MName" id="father_middle_name" >
								<div class="invalid-feedback">
								Please provide a Middle Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="father_last_name" class="form-label">Last Name</label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $father_last_name ?>" autocomplete="off" name="Father-LName" id="father_last_name"   >
								<div class="invalid-feedback">
								Please provide a Last Name.
								</div>
							</div>

							<div class="col-md-6" >
								<label for="father_phone_number" class="form-label">Phone Number</label>
								<div class="input-group flex-nowrap">
								<span class="input-group-text" id="addon-wrapping">+63</span>
								<input type="text" class="form-control numbers" value="<?php echo $father_phone_number ?>"  autocapitalize="off" inputmode="numeric" autocomplete="off" name="Father-PNumber" id="father_phone_number" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
								</div>
							</div>

                            <!-- Emergency Information -->
                            <label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Emergency Information</label>

                            <div class="col-md-6">
								<label for="ECP" class="form-label">Emergency Contact Person</label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $emergency_contact_person ?>" autocapitalize="on"  autocomplete="off" name="Emergency_Contact_Person" id="ECP" >
								<div class="invalid-feedback">
								Please provide a Emergency Contact Person.
								</div>
							</div>

                            <div class="col-md-6">
								<label for="EAddress" class="form-label">Emergency Address</label>
								<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $emergency_address ?>" autocapitalize="on"  autocomplete="off" name="Emergency_Address" id="EAddress" >
								<div class="invalid-feedback">
								Please provide a Emergency Address.
								</div>
							</div>

                            <div class="col-md-6">
								<label for="EMN" class="form-label">Emergency Mobile No.</label>
								<div class="input-group flex-nowrap">
								<span class="input-group-text" id="addon-wrapping">+63</span>
								<input type="text" class="form-control numbers" value="<?php echo $emergency_mobile_number ?>"  autocapitalize="off" inputmode="numeric" autocomplete="off" name="Emergency_Mobile_No" id="EMN" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
								</div>
							</div>

							<!-- Select Program -->
							<label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Select Program</label>	
							
							<div class="col-md-6">
								<label for="programs" class="form-label">Programs<span> *</span></label>
								<select class="form-select form-control"  name="Programs"  autocomplete="off" id="programs" required>
								<option selected value="<?php echo $programID ?>"><?php echo $program ?></option>
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
						</div>

						<div class="addBtn">
                            <button type="button" onclick="location.href='enrolled-students-data'" class="back">Back</button>
							<button type="submit" class="primary" name="btn-register" id="btn-register" onclick="return IsEmpty(); sexEmpty();">Submit</button>
						</div>
					</form>
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

        // Country Selector
        $("#nationality").countrySelect({
            defaultCountry:"ph",
            defaultStyling:"inside",
            responsiveDropdown:true
        });

        //Delete Profile

		$('.btn-delete').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				title: "Delete?",
				text: "Are you sure do you want to delete?",
				icon: "warning",
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

		// Print
		$('.print').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				title: "Print SF10?",
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

		//numbers only
		$('.numbers').keypress(function(e) {
		var x = e.which || e.keycode;
		if ((x >= 48 && x <= 57) || x == 8 ||
			(x >= 35 && x <= 40) || x == 46)
			return true;
		else
			return false;
		});

        //birthdate
        function formatDate(date){
            var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');

        }

        function getAge(dateString){
            var birthdate = new Date().getTime();
            if (typeof dateString === 'undefined' || dateString === null || (String(dateString) === 'NaN')){
            birthdate = new Date().getTime();
            }
            birthdate = new Date(dateString).getTime();
            var now = new Date().getTime();
            var n = (now - birthdate)/1000;
            if (n < 604800){
            var day_n = Math.floor(n/86400);
            if (typeof day_n === 'undefined' || day_n === null || (String(day_n) === 'NaN')){
                return '';
            }else{
                return day_n + '' + (day_n > 1 ? '' : '') + '';
            }
            } else if (n < 2629743){
            var week_n = Math.floor(n/604800);
            if (typeof week_n === 'undefined' || week_n === null || (String(week_n) === 'NaN')){
                return '';
            }else{
                return week_n + '' + (week_n > 1 ? '' : '') + '';
            }
            } else if (n < 31562417){
            var month_n = Math.floor(n/2629743);
            if (typeof month_n === 'undefined' || month_n === null || (String(month_n) === 'NaN')){
                return '';
            }else{
                return month_n + ' ' + (month_n > 1 ? '' : '') + '';
            }
            }else{
            var year_n = Math.floor(n/31556926);
            if (typeof year_n === 'undefined' || year_n === null || (String(year_n) === 'NaN')){
                return year_n = '';
            }else{
                return year_n + '' + (year_n > 1 ? '' : '') + '';
            }
            }
        }
        function getAgeVal(pid){
            var birthdate = formatDate(document.getElementById("birthdate").value);
            var count = document.getElementById("birthdate").value.length;
            if (count=='10'){
            var age = getAge(birthdate);
            var str = age;
            var res = str.substring(0, 1);
            if (res =='-' || res =='0'){
                document.getElementById("birthdate").value = "";
                document.getElementById("age").value = "";
                $('#birthdate').focus();
                return false;
            }else{
                document.getElementById("age").value = age;
            }
            }else{
            document.getElementById("age").value = "";
            return false;
            }
        };

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