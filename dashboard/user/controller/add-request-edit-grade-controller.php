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
    $teacherId		= $_GET['teacherId'];
    $studentLRN     = $_GET['LRN'];
    $requestId      = "RID-".(str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT));
    $Id             = $_GET['Id'];

    
    $pdoQuery = "SELECT * FROM request_edit_grade WHERE teacherId = :teacherId AND classId = :classId AND LRN = :LRN AND status = :status";
    $pdoResult1 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult1->execute(
        array
        (
            ":classId"             =>$classId,
            ":LRN"                 =>$studentLRN,
            ":teacherId"           =>$teacherId,
            ":status"              =>"pending",
        )
    );
    $request_data = $pdoResult1->fetch(PDO::FETCH_ASSOC);

    if($pdoResult1->rowCount() > 0){
        $_SESSION['status_title'] = "Oops!";
        $_SESSION['status'] = "You have already have pending request for this student, please wait for the request to accept before making another one. Thank you!";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 100000;
        header("Location: ../class-student-profile?id=$Id&classId=$classId");
    }
    else{
    $pdoQuery = "INSERT INTO request_edit_grade (teacherId, requestId, classId, LRN) 
                    VALUES (:teacherId, :requestId, :classId, :LRN)";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute
    (
        array
        ( 
            ":teacherId"           =>$teacherId,
            ":requestId"           =>$requestId,
            ":classId"             =>$classId,
            ":LRN"                 =>$studentLRN,

        )
      );

      $_SESSION['status_title'] = "Success!";
      $_SESSION['status'] = "Request has been sent, please wait until the superadmin approve the request.";
      $_SESSION['status_code'] = "success";
      $_SESSION['status_timer'] = 40000;
      header("Location: ../class-student-profile?id=$Id&classId=$classId");
    }

?>