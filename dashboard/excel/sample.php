<?php
// SCHOLASTIC RECORD GRADE 12 (FIRST SEMESTER)---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$pdoQuery = "SELECT * FROM subjects_$programId WHERE  semester = :semester AND year_level = :year_level 
ORDER BY (
    CASE subject_type
    WHEN 'Core Subjects' THEN 1 
    WHEN 'Applied Subjects' THEN 2
    WHEN 'Specialized Subjects' THEN 3
    END ) ASC";
$pdoResult13 = $pdoConnect->prepare($pdoQuery);
$pdoResult13->execute(array(":semester" => "First Semester", ":year_level" => "Grade12"));

while($first_sem_subject_data = $pdoResult13->fetch(PDO::FETCH_ASSOC)){

if($first_sem_subject_data['subject_type'] == "Core Subjects"){

$subject_type = "Core";

}
else if($first_sem_subject_data['subject_type'] == "Applied Subjects"){

$subject_type = "Applied";

}
else if($first_sem_subject_data['subject_type'] == "Specialized Subjects"){

$subject_type = "Specialized";

}

$sheet = $spreadsheet->getSheetByName('BACK')
->setCellValue('A'.$G12_first_sem_currentRow, $subject_type)//Type of Subject
->setCellValue('I'.$G12_first_sem_currentRow, $first_sem_subject_data['subject_name']);//Subject Name

$subjectId = $first_sem_subject_data['subjectId'];

$pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId";
$pdoResult14 = $pdoConnect->prepare($pdoQuery);
$pdoResult14->execute
(array(
":LRN" 			=> $LRN, 
":program" 		=> $programId, 
":subjectId" 	=> $subjectId
));

while($subject_grade_data_first = $pdoResult14->fetch(PDO::FETCH_ASSOC)){

if($subject_grade_data_first['final_subject_grade_1st_sem'] <=74){

$remarks = "FAILED";

}
else if($subject_grade_data_first['final_subject_grade_1st_sem'] >=75){

$remarks = "PASSED";

}
else if($subject_grade_data_first['final_subject_grade_1st_sem'] == NULL){

$remarks = "";

}

$sheet = $spreadsheet->getSheetByName('BACK')
->setCellValue('AT'.$G12_first_sem_currentRow, $subject_grade_data_first['subject_grade_Q1'])//Grade for Quarter 1, 1st Semester
->setCellValue('AY'.$G12_first_sem_currentRow, $subject_grade_data_first['subject_grade_Q2'])//Grade for Quarter 2. 2nd Semester
->setCellValue('BD'.$G12_first_sem_currentRow, $subject_grade_data_first['final_subject_grade_1st_sem'])//Final Grade for 1st Semester
->setCellValue('BI'.$G12_first_sem_currentRow, $remarks);//First Semester Remarks
}

$G12_first_sem_currentRow++;
}

// SUM OF THE FINAL GRADES 1ST SEMESTER---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$pdoQuery = "SELECT SUM(final_subject_grade_1st_sem) as total FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND year_level = :year_level AND semester = :semester";
$pdoResult15 = $pdoConnect->prepare($pdoQuery);
$pdoResult15->execute
(array(
":LRN" 			=> $LRN,  
":program" 		=> $programId, 
":year_level" 	=> "Grade12",
":semester"     => "First Semester"
));

$sum_1st_sem       = $pdoResult15->fetch(PDO::FETCH_ASSOC);
$total_1st_sem     = $sum_1st_sem['total'];

$pdoQuery = "SELECT * FROM subjects_$programId WHERE year_level = :year_level AND semester = :semester";
$pdoResult16 = $pdoConnect->prepare($pdoQuery);
$pdoResult16->execute(array(":year_level" => "Grade12",":semester" => "First Semester"));

$count_1st_sem = $pdoResult16->rowCount();

$divide_1st_sem = $total_1st_sem / $count_1st_sem;
$final_grade_1st_sem = round($divide_1st_sem);

if($final_grade_1st_sem <=74){

$remarks = "FAILED";

}
else if($final_grade_1st_sem >=75){

$remarks = "PASSED";

}
else if($final_grade_1st_sem == NULL){

$remarks = "";

}

$sheet = $spreadsheet->getSheetByName('BACK')
->setCellValue('BD23', $final_grade_1st_sem)//Final Grade 1st Semester
->setCellValue('BI23', $remarks);//Final Remarks 1st Semester

// STUDENT SECTION---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$pdoQuery = "SELECT * FROM student_advisory WHERE LRN = :LRN LIMIT 1";
$pdoResult17 = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult17->execute(array(":LRN" => $LRN));
$advisory_student_data = $pdoResult17->fetch(PDO::FETCH_ASSOC);

$section_name       = $advisory_student_data['section_name'];
$school_year        = $advisory_student_data['school_year'];

// ACADEMIC PROGRAMS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$pdoQuery = "SELECT * FROM academic_programs WHERE programID = :id";
$pdoResult18 = $pdoConnect->prepare($pdoQuery);
$pdoExec2 = $pdoResult18->execute(array(":id"=>$programId));
$program_data = $pdoResult18->fetch(PDO::FETCH_ASSOC);

$student_program = $program_data['programs'];


// ADVISER AND CLASS INFORMATION---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$advisory = $advisory_student_data['advisoryId'];

$pdoQuery = "SELECT * FROM advisory WHERE advisoryId = :advisoryId LIMIT 1";
$pdoResult19 = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult19->execute(array(":advisoryId" => $advisory));
$advisory_data = $pdoResult19->fetch(PDO::FETCH_ASSOC);

$adviser    =   $advisory_data['teacherId'];

$pdoQuery = "SELECT * FROM user WHERE uniqueID = :uniqueID LIMIT 1";
$pdoResult20 = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult20->execute(array(":uniqueID" => $adviser));
$adviser_data = $pdoResult20->fetch(PDO::FETCH_ASSOC);

$adviser_last_name      = $adviser_data['userLast_Name'];
$adviser_first_name     = $adviser_data['userFirst_Name'];
$middle_name            = $adviser_data['userMiddle_Name'];

if($middle_name == NULL){
$adviser_middle_name    = "";
}
else{
$adviser_middle_name    = ($middle_name[0]).".";
}
$adviser_name           =  ($adviser_first_name)." ".($adviser_middle_name)." ".($adviser_last_name);

$sheet = $spreadsheet->getSheetByName('BACK')
//First Semester
->setCellValue('G5', $student_program)// Student Subject
->setCellValue('AS5', $section_name)//Student Section
->setCellValue('BA4', $school_year)//Subject School Year
->setCellValue('A29', $adviser_name)//Adviser Name

//Second Semester
->setCellValue('G48', $student_program)// Student Subject
->setCellValue('AS48', $section_name)//Student Section
->setCellValue('BA46', $school_year)//Subject School Year
->setCellValue('A72', $adviser_name);//Adviser Name

// SCHOLASTIC RECORD GRADE 12 (2ND SEMESTER)---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$pdoQuery = "SELECT * FROM subjects_$programId WHERE  semester = :semester AND year_level = :year_level 
ORDER BY (
CASE subject_type
WHEN 'Core Subjects' THEN 1 
WHEN 'Applied Subjects' THEN 2
WHEN 'Specialized Subjects' THEN 3
END ) ASC";
$pdoResult21 = $pdoConnect->prepare($pdoQuery);
$pdoResult21->execute(array(":semester" => "Second Semester", ":year_level" => "Grade12"));

while($second_sem_subject_data = $pdoResult21->fetch(PDO::FETCH_ASSOC)){

if($second_sem_subject_data['subject_type'] == "Core Subjects"){

$subject_type = "Core";

}
else if($second_sem_subject_data['subject_type'] == "Applied Subjects"){

$subject_type = "Applied";

}
else if($second_sem_subject_data['subject_type'] == "Specialized Subjects"){

$subject_type = "Specialized";

}

$sheet = $spreadsheet->getSheetByName('BACK')
->setCellValue('A'.$G12_second_sem_currentRow, $subject_type)//Type of Subject
->setCellValue('I'.$G12_second_sem_currentRow, $second_sem_subject_data['subject_name']);//Subject Name

$subjectId = $second_sem_subject_data['subjectId'];

$pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId";
$pdoResult22 = $pdoConnect->prepare($pdoQuery);
$pdoResult22->execute
(array(
":LRN" 			=> $LRN, 
":program" 		=> $programId, 
":subjectId" 	=> $subjectId
));

while($subject_grade_data_second = $pdoResult22->fetch(PDO::FETCH_ASSOC)){

if($subject_grade_data_second['final_subject_grade_2nd_sem'] <=74){

$remarks = "FAILED";

}
else if($subject_grade_data_second['final_subject_grade_2nd_sem'] >=75){

$remarks = "PASSED";

}
else if($subject_grade_data_second['final_subject_grade_2nd_sem'] == NULL){

$remarks = "";

}

$sheet = $spreadsheet->getSheetByName('BACK')
->setCellValue('AT'.$G12_second_sem_currentRow, $subject_grade_data_second['subject_grade_Q3'])//Grade for Quarter 1, 3rd Semester
->setCellValue('AY'.$G12_second_sem_currentRow, $subject_grade_data_second['subject_grade_Q4'])//Grade for Quarter 2. 4rth Semester
->setCellValue('BD'.$G12_second_sem_currentRow, $subject_grade_data_second['final_subject_grade_2nd_sem'])//Final Grade for 2nd Semester
->setCellValue('BI'.$G12_second_sem_currentRow, $remarks);//Second Semester Remarks
}

$G12_second_sem_currentRow++;
}

// SUM OF THE FINAL GRADES 2nd SEMESTER---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$pdoQuery = "SELECT SUM(final_subject_grade_2nd_sem) as total FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND year_level = :year_level AND semester = :semester";
$pdoResul23 = $pdoConnect->prepare($pdoQuery);
$pdoResul23->execute
(array(
":LRN" 			=> $LRN,  
":program" 		=> $programId, 
":year_level" 	=> "Grade12",
":semester"     => "Second Semester"
));

$sum_2nd_sem       = $pdoResul23->fetch(PDO::FETCH_ASSOC);
$total_2nd_sem     = $sum_2nd_sem['total'];

$pdoQuery = "SELECT * FROM subjects_$programId WHERE year_level = :year_level AND semester = :semester";
$pdoResult12 = $pdoConnect->prepare($pdoQuery);
$pdoResult12->execute(array(":year_level" => "Grade12",":semester" => "Second Semester"));

$count_2nd_sem = $pdoResult12->rowCount();

$divide_2nd_sem = $total_2nd_sem / $count_2nd_sem;
$final_grade_2nd_sem = round($divide_2nd_sem);

if($final_grade_2nd_sem <=74){

$remarks = "FAILED";

}
else if($final_grade_2nd_sem >=75){

$remarks = "PASSED";

}
else if($final_grade_2nd_sem == NULL){

$remarks = "";

}

$sheet = $spreadsheet->getSheetByName('BACK')
->setCellValue('BD66', $final_grade_2nd_sem)//Final Grade 2nd Semester
->setCellValue('BI66', $remarks);//Final Remarks 2nd Semester


?>