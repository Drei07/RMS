<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/user-class.php';


$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('');
}

$stmt = $user_home->runQuery("SELECT * FROM user WHERE userId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


    $LRN                = $_GET['LRN'];
    $studentId          = $_GET['studentId'];

    $pdoQuery = "SELECT * FROM student WHERE studentId = :studentId";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute(array(":studentId" => $studentId));
    $student_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

    $first_name     = $student_data['first_name'];
    $middle_name    = $student_data['middle_name'];
    $last_name      = $student_data['last_name'];

    $classId            = $_GET['classId'];    
    $program            = $_GET['program'];
    $subjectId          = $_GET['subjectId'];   
    $year_level         = $_GET['year_level'];
    $semester           = $_GET['semester'];
    $school_year        = $_GET['school_year'];

    $pdoQuery = "SELECT * FROM class_$classId WHERE LRN = :LRN";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(array(":LRN"=>$LRN,));
    $row = $pdoResult->fetch(PDO::FETCH_ASSOC);

    $pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId";
    $pdoResult3 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult3->execute(array(":LRN" => $LRN, ":program" => $program, ":subjectId" => $subjectId));
    $pdoResult3->fetch(PDO::FETCH_ASSOC);

    if($pdoResult->rowCount() > 0){
        $_SESSION['status_title'] = "Oops!";
        $_SESSION['status'] = "LRN is already registered. Please try another one.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 100000;
        header("Location: ../class?id=$classId");
    }
    else if ($pdoResult3->rowCount() > 0){
        $_SESSION['status_title'] = "Oops!";
        $_SESSION['status'] = "Student is already registered in this class. Please try another one.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 100000;
        header("Location: ../class?id=$classId");
    }else{

    $pdoQuery = "INSERT INTO class_$classId
        (
            classId,
            LRN, 
            studentId,
            last_name,
            first_name,
            middle_name,
            program, 
            subjectId, 
            year_level, 
            semester, 
            school_year 
        ) 
    VALUES 
        (
            :classId,
            :LRN, 
            :studentId,
            :last_name,
            :first_name,
            :middle_name,
            :program, 
            :subjectId, 
            :year_level, 
            :semester, 
            :school_year 
        ) LIMIT 1 ";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute
    (
        array
        ( 
            ":classId"            =>$classId,
            ":LRN"                =>$LRN,
            ":studentId"          =>$studentId,
            ":last_name"          =>$last_name,
            ":first_name"         =>$first_name,
            ":middle_name"        =>$middle_name,
            ":program"            =>$program,
            ":subjectId"          =>$subjectId,
            ":year_level"         =>$year_level,
            ":semester"           =>$semester,
            ":school_year"        =>$school_year,

        )
      );

      if($pdoResult2){

        $pdoQuery = "INSERT INTO student_enrolled_subjects
        (
            classId,
            LRN, 
            studentId,
            last_name,
            first_name,
            middle_name,
            program, 
            subjectId, 
            year_level, 
            semester, 
            school_year 
        ) 
    VALUES 
        (
            :classId,
            :LRN, 
            :studentId,
            :last_name,
            :first_name,
            :middle_name,
            :program, 
            :subjectId, 
            :year_level, 
            :semester, 
            :school_year 
        ) LIMIT 1 ";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute
    (
        array
        ( 
            ":classId"            =>$classId,
            ":LRN"                =>$LRN,
            ":studentId"          =>$studentId,
            ":last_name"          =>$last_name,
            ":first_name"         =>$first_name,
            ":middle_name"        =>$middle_name,
            ":program"            =>$program,
            ":subjectId"          =>$subjectId,
            ":year_level"         =>$year_level,
            ":semester"           =>$semester,
            ":school_year"        =>$school_year,

        )
      );

      }

      $_SESSION['status_title'] = "Success!";
      $_SESSION['status'] = "Student is now enrolled to this subject!";
      $_SESSION['status_code'] = "success";
      $_SESSION['status_timer'] = 40000;
      header("Location: ../class?id=$classId");
    }
  
?>