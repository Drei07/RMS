<?php
//call the autoload
include_once  __DIR__.'/../../database/dbconfig2.php';

require '../vendor2/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$inputFileName = 'SF10.xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

// REPORT CARD DATA-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$LRN  = $_GET['LRN'];
$programId      = $_GET['programId'];

// LEARNERS INFORMATION---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$pdoQuery = "SELECT * FROM student WHERE LRN = :LRN LIMIT 1";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":LRN" => $LRN));
$student_data = $pdoResult->fetch(PDO::FETCH_ASSOC);

$student_last_name      =  $student_data['last_name'];
$student_firt_name      =  $student_data['first_name'];
$student_middle_name    =  $student_data['middle_name'];

$student_birthdate      =  $student_data['birth_date'];
$convert_birthdate      =  date("d/m/Y", strtotime($student_birthdate));

$student_age            =   $student_data['age'];
$student_sex            =   $student_data['sex'];

$sheet = $spreadsheet->getSheetByName('FRONT')
        ->setCellValue('F8', $student_last_name)//Student Lastname
        ->setCellValue('Y8', $student_firt_name)//Student Firstname
        ->setCellValue('AZ8', $student_middle_name)//Student Middlename
        ->setCellValue('C9', $LRN)//Student LRN
        ->setCellValue('AA9', $convert_birthdate)//Student Birth Date
        ->setCellValue('AN9', $student_sex)//Student Student Sex
;

// STRATING ROWS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//G11
$G11_first_sem_currentRow   = 31;//Start of the Row for 1st Semester G11
$G11_second_sem_currentRow  = 74;//Start of the Row for 2nd Semester G11

//G12
$G12_first_sem_currentRow   = 11;//Start of the Row for 1st Semester G12
$G12_second_sem_currentRow  = 54;//Start of the Row for 2nd Semester G12

// SCHOLASTIC RECORD GRADE 11 (FIRST SEMESTER)---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    $pdoQuery = "SELECT * FROM subjects_$programId WHERE  semester = :semester AND year_level = :year_level 
                    ORDER BY (
                        CASE subject_type
                        WHEN 'Core Subjects' THEN 1 
                        WHEN 'Applied Subjects' THEN 2
                        WHEN 'Specialized Subjects' THEN 3
                        END ) ASC";
    $pdoResult1 = $pdoConnect->prepare($pdoQuery);
    $pdoResult1->execute(array(":semester" => "First Semester", ":year_level" => "Grade11"));

    while($first_sem_subject_data = $pdoResult1->fetch(PDO::FETCH_ASSOC)){

        if($first_sem_subject_data['subject_type'] == "Core Subjects"){
            
            $subject_type = "Core";

        }
        else if($first_sem_subject_data['subject_type'] == "Applied Subjects"){

            $subject_type = "Applied";

        }
        else if($first_sem_subject_data['subject_type'] == "Specialized Subjects"){

            $subject_type = "Specialized";

        }

        $sheet = $spreadsheet->getSheetByName('FRONT')
            ->setCellValue('A'.$G11_first_sem_currentRow, $subject_type)//Type of Subject
            ->setCellValue('I'.$G11_first_sem_currentRow, $first_sem_subject_data['subject_name']);//Subject Name

            $subjectId = $first_sem_subject_data['subjectId'];

            $pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId";
            $pdoResult2 = $pdoConnect->prepare($pdoQuery);
            $pdoResult2->execute
            (array(
                ":LRN" 			=> $LRN, 
                ":program" 		=> $programId, 
                ":subjectId" 	=> $subjectId
            ));

            while($subject_grade_data_first = $pdoResult2->fetch(PDO::FETCH_ASSOC)){

                if($subject_grade_data_first['final_subject_grade_1st_sem'] <=74){

                    $remarks = "FAILED";

                }
                else if($subject_grade_data_first['final_subject_grade_1st_sem'] >=75){

                    $remarks = "PASSED";

                }
                else if($subject_grade_data_first['final_subject_grade_1st_sem'] == NULL){
                    
                    $remarks = "";

                }
        
            $sheet = $spreadsheet->getSheetByName('FRONT')
                ->setCellValue('AT'.$G11_first_sem_currentRow, $subject_grade_data_first['subject_grade_Q1'])//Grade for Quarter 1, 1st Semester
                ->setCellValue('AY'.$G11_first_sem_currentRow, $subject_grade_data_first['subject_grade_Q2'])//Grade for Quarter 2. 2nd Semester
                ->setCellValue('BD'.$G11_first_sem_currentRow, $subject_grade_data_first['final_subject_grade_1st_sem'])//Final Grade for 1st Semester
                ->setCellValue('BI'.$G11_first_sem_currentRow, $remarks);//First Semester Remarks
            }

            $G11_first_sem_currentRow++;
    }

// SUM OF THE FINAL GRADES 1ST SEMESTER---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $pdoQuery = "SELECT SUM(final_subject_grade_1st_sem) as total FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND year_level = :year_level AND semester = :semester";
        $pdoResult3 = $pdoConnect->prepare($pdoQuery);
        $pdoResult3->execute
        (array(
            ":LRN" 			=> $LRN,  
            ":program" 		=> $programId, 
            ":year_level" 	=> "Grade11",
            ":semester"     => "First Semester"
        ));

         $sum_1st_sem       = $pdoResult3->fetch(PDO::FETCH_ASSOC);
         $total_1st_sem     = $sum_1st_sem['total'];

        $pdoQuery = "SELECT * FROM subjects_$programId WHERE year_level = :year_level AND semester = :semester";
        $pdoResult4 = $pdoConnect->prepare($pdoQuery);
        $pdoResult4->execute(array(":year_level" => "Grade11",":semester" => "First Semester"));

        $count_1st_sem = $pdoResult4->rowCount();

        $divide_1st_sem = $total_1st_sem / $count_1st_sem;
        $final_grade_1st_sem = round($divide_1st_sem);

            if($final_grade_1st_sem <=74){

                $remarks = "FAILED";

            }
            else if($final_grade_1st_sem >=75){

                $remarks = "PASSED";

            }
            else if($final_grade_1st_sem == 0){
                
                $remarks = "";

            }
        
        $sheet = $spreadsheet->getSheetByName('FRONT')
            ->setCellValue('BD43', $final_grade_1st_sem)//Final Grade 1st Semester
            ->setCellValue('BI43', $remarks);//Final Remarks 1st Semester

// STUDENT SECTION---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $pdoQuery = "SELECT * FROM student_advisory WHERE LRN = :LRN LIMIT 1";
        $pdoResult5 = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult5->execute(array(":LRN" => $LRN));
        $advisory_student_data = $pdoResult5->fetch(PDO::FETCH_ASSOC);

        $section_name       = $advisory_student_data['section_name'];
        $school_year        = $advisory_student_data['school_year'];

 // ACADEMIC PROGRAMS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $pdoQuery = "SELECT * FROM academic_programs WHERE programID = :id";
        $pdoResult6 = $pdoConnect->prepare($pdoQuery);
        $pdoExec2 = $pdoResult6->execute(array(":id"=>$programId));
        $program_data = $pdoResult6->fetch(PDO::FETCH_ASSOC);

        $student_program = $program_data['programs'];


// ADVISER AND CLASS INFORMATION---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $advisory = $advisory_student_data['advisoryId'];

        $pdoQuery = "SELECT * FROM advisory WHERE advisoryId = :advisoryId LIMIT 1";
        $pdoResul7 = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResul7->execute(array(":advisoryId" => $advisory));
        $advisory_data = $pdoResul7->fetch(PDO::FETCH_ASSOC);

        $adviser    =   $advisory_data['teacherId'];

        $pdoQuery = "SELECT * FROM user WHERE uniqueID = :uniqueID LIMIT 1";
        $pdoResult8 = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult8->execute(array(":uniqueID" => $adviser));
        $adviser_data = $pdoResult8->fetch(PDO::FETCH_ASSOC);

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

        $sheet = $spreadsheet->getSheetByName('FRONT')
            //First Semester
            ->setCellValue('G25', $student_program)// Student Subject
            ->setCellValue('AS25', $section_name)//Student Section
            ->setCellValue('BA23', $school_year)//Subject School Year
            ->setCellValue('A49', $adviser_name)//Adviser Name
            
            //Second Semester
            ->setCellValue('G68', $student_program)// Student Subject
            ->setCellValue('AS68', $section_name)//Student Section
            ->setCellValue('BA66', $school_year)//Subject School Year
            ->setCellValue('A92', $adviser_name);//Adviser Name

// SCHOLASTIC RECORD GRADE 11 (2ND SEMESTER)---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $pdoQuery = "SELECT * FROM subjects_$programId WHERE  semester = :semester AND year_level = :year_level 
        ORDER BY (
            CASE subject_type
            WHEN 'Core Subjects' THEN 1 
            WHEN 'Applied Subjects' THEN 2
            WHEN 'Specialized Subjects' THEN 3
            END ) ASC";
        $pdoResult9 = $pdoConnect->prepare($pdoQuery);
        $pdoResult9->execute(array(":semester" => "Second Semester", ":year_level" => "Grade11"));

        while($second_sem_subject_data = $pdoResult9->fetch(PDO::FETCH_ASSOC)){

        if($second_sem_subject_data['subject_type'] == "Core Subjects"){

        $subject_type = "Core";

        }
        else if($second_sem_subject_data['subject_type'] == "Applied Subjects"){

        $subject_type = "Applied";

        }
        else if($second_sem_subject_data['subject_type'] == "Specialized Subjects"){

        $subject_type = "Specialized";

        }

        $sheet = $spreadsheet->getSheetByName('FRONT')
        ->setCellValue('A'.$G11_second_sem_currentRow, $subject_type)//Type of Subject
        ->setCellValue('I'.$G11_second_sem_currentRow, $second_sem_subject_data['subject_name']);//Subject Name

        $subjectId = $second_sem_subject_data['subjectId'];

        $pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId";
        $pdoResult10 = $pdoConnect->prepare($pdoQuery);
        $pdoResult10->execute
        (array(
        ":LRN" 			=> $LRN, 
        ":program" 		=> $programId, 
        ":subjectId" 	=> $subjectId
        ));

        while($subject_grade_data_second = $pdoResult10->fetch(PDO::FETCH_ASSOC)){

        if($subject_grade_data_second['final_subject_grade_2nd_sem'] <=74){

        $remarks = "FAILED";

        }
        else if($subject_grade_data_second['final_subject_grade_2nd_sem'] >=75){

        $remarks = "PASSED";

        }
        else if($subject_grade_data_second['final_subject_grade_2nd_sem'] == NULL){

        $remarks = "";

        }

        $sheet = $spreadsheet->getSheetByName('FRONT')
        ->setCellValue('AT'.$G11_second_sem_currentRow, $subject_grade_data_second['subject_grade_Q3'])//Grade for Quarter 1, 3rd Semester
        ->setCellValue('AY'.$G11_second_sem_currentRow, $subject_grade_data_second['subject_grade_Q4'])//Grade for Quarter 2. 4rth Semester
        ->setCellValue('BD'.$G11_second_sem_currentRow, $subject_grade_data_second['final_subject_grade_2nd_sem'])//Final Grade for 2nd Semester
        ->setCellValue('BI'.$G11_second_sem_currentRow, $remarks);//Second Semester Remarks
        }

        $G11_second_sem_currentRow++;
        }

// SUM OF THE FINAL GRADES 2nd SEMESTER---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $pdoQuery = "SELECT SUM(final_subject_grade_2nd_sem) as total FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND year_level = :year_level AND semester = :semester";
        $pdoResult11 = $pdoConnect->prepare($pdoQuery);
        $pdoResult11->execute
        (array(
        ":LRN" 			=> $LRN,  
        ":program" 		=> $programId, 
        ":year_level" 	=> "Grade11",
        ":semester"     => "Second Semester"
        ));

        $sum_2nd_sem       = $pdoResult11->fetch(PDO::FETCH_ASSOC);
        $total_2nd_sem     = $sum_2nd_sem['total'];

        $pdoQuery = "SELECT * FROM subjects_$programId WHERE year_level = :year_level AND semester = :semester";
        $pdoResult12 = $pdoConnect->prepare($pdoQuery);
        $pdoResult12->execute(array(":year_level" => "Grade11",":semester" => "Second Semester"));

        $count_2nd_sem = $pdoResult12->rowCount();

        $divide_2nd_sem = $total_2nd_sem / $count_2nd_sem;
        $final_grade_2nd_sem = round($divide_2nd_sem);

        if($final_grade_2nd_sem <=74){

        $remarks = "FAILED";

        }
        else if($final_grade_2nd_sem >=75){

        $remarks = "PASSED";

        }
        else if($final_grade_2nd_sem == 0){

        $remarks = "";

        }

        $sheet = $spreadsheet->getSheetByName('FRONT')
        ->setCellValue('BD86', $final_grade_2nd_sem)//Final Grade 2nd Semester
        ->setCellValue('BI86', $remarks);//Final Remarks 2nd Semester

//
//
//
//
//
//
//
//
//
//
//
//
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
        else if($final_grade_1st_sem == 0){

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
        else if($final_grade_2nd_sem == 0){

        $remarks = "";

        }

        $sheet = $spreadsheet->getSheetByName('BACK')
        ->setCellValue('BD66', $final_grade_2nd_sem)//Final Grade 2nd Semester
        ->setCellValue('BI66', $remarks);//Final Remarks 2nd Semester




header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="SF10.xlsx"');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
