<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/user-class.php';


$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('');
}

    $G11              = "Grade11";
    $G12              = "Grade12";

    $year_level       = $_GET['year_level'];


    $pdoQuery = "UPDATE classes SET status=:status WHERE Id=". $_GET['id'];
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
    ":status"      => "disabled",
    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Class has succesfully removed";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    
    if($year_level == $G11)
    {
        header('Location: ../G11-subject-class');
    }
    elseif($year_level == $G12)
    {
        header('Location: ../G12-subject-class');
    }


?>