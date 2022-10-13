<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}


    $requestId = $_GET['requestId'];
    $classId    = $_GET['classId'];
    $LRN        = $_GET['LRN'];

    $pdoQuery = 'UPDATE request_edit_grade SET status=:status WHERE requestId=:requestId';;
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
    ":status"                =>"decline",
    ":requestId"             =>$requestId,

    )
    );

    if($pdoResult){

        $pdoQuery = "UPDATE class_$classId SET edit_grade=:edit_grade WHERE LRN=:LRN";;
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult->execute(
        array
        ( 
        ":edit_grade"      =>"decline",
        ":LRN"             =>$LRN,
    
        )
        );


    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Request has been decline!";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header('Location: ../request');
    }


?>