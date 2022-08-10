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

    $advisoryId          = $_GET['advisoryId'];    
    $program            = $_GET['program'];
    $section            = $_GET['section'];   
    $year_level         = $_GET['year_level'];
    $school_year        = $_GET['school_year'];

    $pdoQuery = "SELECT * FROM advisory_$advisoryId WHERE LRN = :LRN";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(array(":LRN"=>$LRN,));
    $row = $pdoResult->fetch(PDO::FETCH_ASSOC);

    $pdoQuery = "SELECT * FROM student_advisory WHERE LRN = :LRN AND program = :program AND year_level = :year_level";
    $pdoResult3 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult3->execute(array(":LRN" => $LRN, ":program" => $program, ":year_level" => $year_level));
    $pdoResult3->fetch(PDO::FETCH_ASSOC);

    if($pdoResult->rowCount() > 0){
        $_SESSION['status_title'] = "Oops!";
        $_SESSION['status'] = "LRN is already registered. Please try another one.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 100000;
        header("Location: ../advisory?id=$advisoryId");
    }
    else if ($pdoResult3->rowCount() > 0){
        $_SESSION['status_title'] = "Oops!";
        $_SESSION['status'] = "Student is already have a section. Please try another one.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 100000;
        header("Location: ../advisory?id=$advisoryId");
    }else{

    $pdoQuery = "INSERT INTO advisory_$advisoryId
        (
            advisoryId,
            LRN, 
            studentId,
            last_name,
            first_name,
            middle_name,
            section_name,
            program, 
            year_level, 
            school_year 
        ) 
    VALUES 
        (
            :advisoryId,
            :LRN, 
            :studentId,
            :last_name,
            :first_name,
            :middle_name,
            :section_name,
            :program, 
            :year_level, 
            :school_year 
        ) LIMIT 1 ";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute
    (
        array
        ( 
            ":advisoryId"          =>$advisoryId,
            ":LRN"                =>$LRN,
            ":studentId"          =>$studentId,
            ":last_name"          =>$last_name,
            ":first_name"         =>$first_name,
            ":middle_name"        =>$middle_name,
            ":section_name"       =>$section,
            ":program"            =>$program,
            ":year_level"         =>$year_level,
            ":school_year"        =>$school_year,

        )
      );

      if($pdoResult2){

        $pdoQuery = "INSERT INTO student_advisory
        (
            advisoryId,
            LRN, 
            studentId,
            last_name,
            first_name,
            middle_name,
            section_name,
            program, 
            year_level, 
            school_year 
        ) 
    VALUES 
        (
            :advisoryId,
            :LRN, 
            :studentId,
            :last_name,
            :first_name,
            :middle_name,
            :section_name,
            :program, 
            :year_level, 
            :school_year 
        ) LIMIT 1 ";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute
    (
        array
        ( 
            ":advisoryId"          =>$advisoryId,
            ":LRN"                =>$LRN,
            ":studentId"          =>$studentId,
            ":last_name"          =>$last_name,
            ":first_name"         =>$first_name,
            ":middle_name"        =>$middle_name,
            ":section_name"       =>$section,
            ":program"            =>$program,
            ":year_level"         =>$year_level,
            ":school_year"        =>$school_year,

        )
      );

      }

      $_SESSION['status_title'] = "Success!";
      $_SESSION['status'] = "Student is now enrolled to this subject!";
      $_SESSION['status_code'] = "success";
      $_SESSION['status_timer'] = 40000;
      header("Location: ../advisory?id=$advisoryId");
    }
  
?>