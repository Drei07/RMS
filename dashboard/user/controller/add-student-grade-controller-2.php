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


    $classId        = $_GET['classId'];
    $Id             = $_GET['id'];

    $pdoQuery = "SELECT * FROM class_$classId WHERE Id = :Id";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoResult2->execute(array( ":Id"=>$Id));
    $class_data=$pdoResult2->fetch(PDO::FETCH_ASSOC);

    $LRN            = $class_data['LRN'];
    $program        = $class_data['program'];
    $subjectId      = $class_data['subjectId'];


    if(isset($_POST['btn-update-grade-2'])){

        $quarter = trim($_POST['quarter']);
        $subject_grade  = trim($_POST['Grade']);

        if($quarter == "Q2"){

            $pdoQuery = "UPDATE class_$classId SET subject_grade_Q2=:subject_grade WHERE Id =". $_GET['id'];
            $pdoResult = $pdoConnect->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(
            array
            (
                ":subject_grade" => $subject_grade
            ));

            if($pdoExec){

                $pdoQuery = "UPDATE student_enrolled_subjects SET subject_grade_Q2=:subject_grade WHERE classId = :classId AND LRN = :LRN AND program = :program AND subjectId = :subjectId";
                $pdoResult = $pdoConnect->prepare($pdoQuery);
                $pdoExec = $pdoResult->execute(
                array
                (
                    ":subject_grade"    => $subject_grade,
                    ":classId"          => $classId,
                    ":LRN"              => $LRN,
                    ":program"          => $program,
                    ":subjectId"        => $subjectId
    
                ));
            }
    
            $_SESSION['status_title'] = "Success!";
            $_SESSION['status'] = "Grade has been input!";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_timer'] = 40000;
            header("Location: ../class?id=$classId");

        }
        else if ($quarter == "Q4"){

            $pdoQuery = "UPDATE class_$classId SET subject_grade_Q4=:subject_grade WHERE Id =". $_GET['id'];
            $pdoResult = $pdoConnect->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(
            array
            (
                ":subject_grade" => $subject_grade
            ));

            if($pdoExec){

                $pdoQuery = "UPDATE student_enrolled_subjects SET subject_grade_Q4=:subject_grade WHERE classId = :classId AND LRN = :LRN AND program = :program AND subjectId = :subjectId";
                $pdoResult = $pdoConnect->prepare($pdoQuery);
                $pdoExec = $pdoResult->execute(
                array
                (
                    ":subject_grade"    => $subject_grade,
                    ":classId"          => $classId,
                    ":LRN"              => $LRN,
                    ":program"          => $program,
                    ":subjectId"        => $subjectId
    
                ));
            }
    
            $_SESSION['status_title'] = "Success!";
            $_SESSION['status'] = "Grade has been input!";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_timer'] = 40000;
            header("Location: ../class?id=$classId");

        }
    }
    else{

        $_SESSION['status_title'] = "Oops!";
        $_SESSION['status'] = "Something went wrong, please try again!";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 100000;
        header("Location: ../class?id=$classId");

    }


?>