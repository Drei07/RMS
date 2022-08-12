<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/user-class.php';


$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('');
}

$classId        = $_GET['classId'];
$studentLRN     = $_GET['LRN'];
$Id             = $_GET['Id'];


    $pdoQuery = "DELETE FROM class_$classId WHERE LRN =" . $_GET['LRN'];
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute();

        $_SESSION['status_title'] = "success!";
        $_SESSION['status'] = "Student account successfully deleted";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_timer'] = 100000;
        header("Location: ../class?id=$classId");


        if($pdoResult){

            $pdoQuery = "DELETE FROM student_enrolled_subjects WHERE LRN = :LRN AND classId = :classId";
            $pdoResult2 = $pdoConnect->prepare($pdoQuery);
            $pdoResult2->execute(array(":LRN" => $studentLRN, ":classId" => $classId));
        
                $_SESSION['status_title'] = "success!";
                $_SESSION['status'] = "Student account successfully deleted";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_timer'] = 100000;
                header("Location: ../class?id=$classId");

        }
        $pdoConnect = null;
?>