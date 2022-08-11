<?php
//call the autoload
include_once  __DIR__.'/../../database/dbconfig2.php';



require '../vendor2/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$inputFileName = 'SF9.xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

$First_currentContentRowCore = 7;
$First_currentContentRowApplied = 16;

$Second_currentContentRowCore = 29;
$Second_currentContentRowApplied = 38;
 
// REPORT CARD DATA-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$programId      = $_GET['programId'];
$LRN            = $_GET['LRN'];
$year_level     = $_GET['year_level'];

if($year_level == "Grade11"){
    $student_year_level = "11";
}
else if ($year_level == "Grade12"){
    $student_year_level = "12";
}

// STUDENT DATA---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$pdoQuery = "SELECT * FROM student WHERE LRN = :LRN LIMIT 1";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":LRN" => $LRN));
$student_data = $pdoResult->fetch(PDO::FETCH_ASSOC);

$student_last_name      =  $student_data['last_name'];
$student_firt_name      =  $student_data['first_name'];
$student_middle_name    =  $student_data['middle_name'];

$student_name           =   ($student_last_name).", ".($student_firt_name)." ".($student_middle_name);
$student_age            =   $student_data['age'];
$student_sex            =   $student_data['sex'];
$student_grade          =   $student_year_level;

// ACADEMIC PROGRAMS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$pdoQuery = "SELECT * FROM academic_programs WHERE programID = :id";
$pdoResult2 = $pdoConnect->prepare($pdoQuery);
$pdoExec2 = $pdoResult2->execute(array(":id"=>$programId));
$program_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

$student_program = $program_data['programs'];

// STUDENT SECTION---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$pdoQuery = "SELECT * FROM student_advisory WHERE LRN = :LRN LIMIT 1";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":LRN" => $LRN));
$advisory_student_data = $pdoResult->fetch(PDO::FETCH_ASSOC);

$section_name       = $advisory_student_data['section_name'];
$school_year        = $advisory_student_data['school_year'];

// ADVISER INFORMATION---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$advisory            = $advisory_student_data['advisoryId'];

$pdoQuery = "SELECT * FROM advisory WHERE advisoryId = :advisoryId LIMIT 1";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":advisoryId" => $advisory));
$advisory_data = $pdoResult->fetch(PDO::FETCH_ASSOC);

$adviser    =   $advisory_data['teacherId'];

$pdoQuery = "SELECT * FROM user WHERE uniqueID = :uniqueID LIMIT 1";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":uniqueID" => $adviser));
$adviser_data = $pdoResult->fetch(PDO::FETCH_ASSOC);

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

// STUDENT INFORMATION TO REPORT CARD-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$file_name      =      ($student_last_name)."-".($student_firt_name)."-".($student_middle_name); 

$sheet = $spreadsheet->getSheetByName('Front')
    ->setCellValue('Q8', $student_name)
    ->setCellValue('Q9', $student_age)
    ->setCellValue('U9', $student_sex)
    ->setCellValue('X9', $LRN)
    ->setCellValue('Q10', $student_grade)
    ->setCellValue('R12', $student_program)
    ->setCellValue('V10', $section_name)
    ->setCellValue('R11', $school_year)
    ->setCellValue('W19', $adviser_name)

;

// FIRST SEMESTER-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$pdoQuery = "SELECT * FROM subjects_$programId WHERE subject_type = :subject_type AND semester = :semester AND year_level = :year_level ORDER BY subject_name";
$pdoResult1 = $pdoConnect->prepare($pdoQuery);
$pdoResult1->execute(array(":subject_type" => "Core Subjects", ":semester" => "First Semester", ":year_level" => $year_level));

while($first_subject_data_core = $pdoResult1->fetch(PDO::FETCH_ASSOC)){

    $sheet = $spreadsheet->getSheetByName('Grade 11-12')
        ->setCellValue('A'.$First_currentContentRowCore, $first_subject_data_core['subject_name']);

        $subjectId = $first_subject_data_core['subjectId'];

        $pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId";
        $pdoResult2 = $pdoConnect->prepare($pdoQuery);
        $pdoResult2->execute
        (array(
            ":LRN" 			=> $LRN, 
            ":program" 		=> $programId, 
            ":subjectId" 	=> $subjectId
        ));

        while($subject_grade_data_first = $pdoResult2->fetch(PDO::FETCH_ASSOC)){
    
        $sheet = $spreadsheet->getSheetByName('Grade 11-12')
        ->setCellValue('E'.$First_currentContentRowCore, $subject_grade_data_first['subject_grade_Q1'])
        ->setCellValue('F'.$First_currentContentRowCore, $subject_grade_data_first['subject_grade_Q2'])
        ->setCellValue('G'.$First_currentContentRowCore, $subject_grade_data_first['final_subject_grade_1st_sem']);

        }

        $First_currentContentRowCore++;


}

$pdoQuery = "SELECT * FROM subjects_$programId WHERE (subject_type = 'Specialized Subjects' OR subject_type = 'Applied Subjects') AND semester = :semester AND year_level = :year_level ORDER BY subject_name";
$pdoResult3 = $pdoConnect->prepare($pdoQuery);
$pdoResult3->execute(array(":semester" => "First Semester", ":year_level" => $year_level));

while($first_subject_data_applied = $pdoResult3->fetch(PDO::FETCH_ASSOC)){

    $sheet = $spreadsheet->getSheetByName('Grade 11-12')
        ->setCellValue('A'.$First_currentContentRowApplied, $first_subject_data_applied['subject_name']);

        $subjectId = $first_subject_data_applied['subjectId'];

        $pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId";
        $pdoResult4 = $pdoConnect->prepare($pdoQuery);
        $pdoResult4->execute
        (array(
            ":LRN" 			=> $LRN, 
            ":program" 		=> $programId, 
            ":subjectId" 	=> $subjectId
        ));

        while($subject_grade_data_first = $pdoResult4->fetch(PDO::FETCH_ASSOC)){
    
        $sheet = $spreadsheet->getSheetByName('Grade 11-12')
        ->setCellValue('E'.$First_currentContentRowApplied, $subject_grade_data_first['subject_grade_Q1'])
        ->setCellValue('F'.$First_currentContentRowApplied, $subject_grade_data_first['subject_grade_Q2'])
        ->setCellValue('G'.$First_currentContentRowApplied, $subject_grade_data_first['final_subject_grade_1st_sem']);

        }

        $First_currentContentRowApplied++;
}
        //SUM OF FINAL GRADES

        $pdoQuery = "SELECT SUM(final_subject_grade_1st_sem) as total FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND year_level = :year_level AND semester = :semester";
        $pdoResult5 = $pdoConnect->prepare($pdoQuery);
        $pdoResult5->execute
        (array(
            ":LRN" 			=> $LRN,  
            ":program" 		=> $programId, 
            ":year_level" 	=> $year_level,
            ":semester"     => "First Semester"
        ));

         $sum = $pdoResult5->fetch(PDO::FETCH_ASSOC);
         $total = $sum['total'];

        $pdoQuery = "SELECT * FROM subjects_$programId WHERE year_level = :year_level AND semester = :semester";
        $pdoResult6 = $pdoConnect->prepare($pdoQuery);
        $pdoResult6->execute(array(":year_level" => $year_level,":semester" => "First Semester"));

        $count = $pdoResult6->rowCount();

        $divide = $total / $count;
        $final_grade_1st_sem = round($divide);
        
        $sheet = $spreadsheet->getSheetByName('Grade 11-12')
        ->setCellValue('G24', $final_grade_1st_sem);


// SECOND SEMESTER-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    $pdoQuery = "SELECT * FROM subjects_$programId WHERE subject_type = :subject_type AND semester = :semester AND year_level = :year_level ORDER BY subject_name";
    $pdoResult6 = $pdoConnect->prepare($pdoQuery);
    $pdoResult6->execute(array(":subject_type" => "Core Subjects", ":semester" => "Second Semester", ":year_level" =>  $year_level));

    while($second_subject_data_core = $pdoResult6->fetch(PDO::FETCH_ASSOC)){

        $sheet = $spreadsheet->getSheetByName('Grade 11-12')
            ->setCellValue('A'.$Second_currentContentRowCore, $second_subject_data_core['subject_name']);

            $subjectId = $second_subject_data_core['subjectId'];

            $pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId";
            $pdoResult7 = $pdoConnect->prepare($pdoQuery);
            $pdoResult7->execute
            (array(
                ":LRN" 			=> $LRN, 
                ":program" 		=> $programId, 
                ":subjectId" 	=> $subjectId
            ));

            while($subject_grade_data_second = $pdoResult7->fetch(PDO::FETCH_ASSOC)){
        
            $sheet = $spreadsheet->getSheetByName('Grade 11-12')
            ->setCellValue('E'.$Second_currentContentRowCore, $subject_grade_data_second['subject_grade_Q3'])
            ->setCellValue('F'.$Second_currentContentRowCore, $subject_grade_data_second['subject_grade_Q4'])
            ->setCellValue('G'.$Second_currentContentRowCore, $subject_grade_data_second['final_subject_grade_2nd_sem']);

            }

            $Second_currentContentRowCore++;
    }

    $pdoQuery = "SELECT * FROM subjects_$programId WHERE (subject_type = 'Specialized Subjects' OR subject_type = 'Applied Subjects') AND semester = :semester AND year_level = :year_level ORDER BY subject_name";
    $pdoResult8 = $pdoConnect->prepare($pdoQuery);
    $pdoResult8->execute(array(":semester" => "Second Semester", ":year_level" =>  $year_level));

    while($second_subject_data_applied = $pdoResult8->fetch(PDO::FETCH_ASSOC)){

        $sheet = $spreadsheet->getSheetByName('Grade 11-12')
            ->setCellValue('A'.$Second_currentContentRowApplied, $second_subject_data_applied['subject_name']);

            $subjectId = $second_subject_data_applied['subjectId'];

            $pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId ";
            $pdoResult9 = $pdoConnect->prepare($pdoQuery);
            $pdoResult9->execute
            (array(
                ":LRN" 			=> $LRN, 
                ":program" 		=> $programId, 
                ":subjectId" 	=> $subjectId
            ));

            while($subject_grade_data_second = $pdoResult9->fetch(PDO::FETCH_ASSOC)){
        
            $sheet = $spreadsheet->getSheetByName('Grade 11-12')
            ->setCellValue('E'.$Second_currentContentRowApplied, $subject_grade_data_second['subject_grade_Q3'])
            ->setCellValue('F'.$Second_currentContentRowApplied, $subject_grade_data_second['subject_grade_Q4'])
            ->setCellValue('G'.$Second_currentContentRowApplied, $subject_grade_data_second['final_subject_grade_2nd_sem']);

            }

            $Second_currentContentRowApplied++;
    }

           //SUM OF FINAL GRADES

           $pdoQuery = "SELECT SUM(final_subject_grade_2nd_sem) as total FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND year_level = :year_level AND semester = :semester";
           $pdoResult10 = $pdoConnect->prepare($pdoQuery);
           $pdoResult10->execute
           (array(
               ":LRN" 			=> $LRN,  
               ":program" 		=> $programId, 
               ":year_level" 	=> $year_level,
               ":semester"     => "Second Semester"
           ));
   
            $sum = $pdoResult10->fetch(PDO::FETCH_ASSOC);
            $total = $sum['total'];
   
           $pdoQuery = "SELECT * FROM subjects_$programId WHERE year_level = :year_level AND semester = :semester";
           $pdoResult11 = $pdoConnect->prepare($pdoQuery);
           $pdoResult11->execute(array(":year_level" => $year_level,":semester" => "Second Semester"));
   
           $count = $pdoResult11->rowCount();
   
           $divide = $total / $count;
           $final_grade_2nd_sem = round($divide);
           
           $sheet = $spreadsheet->getSheetByName('Grade 11-12')
           ->setCellValue('G46', $final_grade_2nd_sem);




header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="SF9-'.$file_name.'.xlsx"');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
