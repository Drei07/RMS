<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}

$userId = $_GET["Id"];



if(isset($_POST['btn-update'])){

    $Position                      = trim($_POST['Position']);
    $EmployeeId                    = trim($_POST['EmployeeId']);

    $pdoQuery = "UPDATE admin SET employeeId=:employeeId, adminPosition=:adminPosition WHERE userId= $userId";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
    ":employeeId"               =>$EmployeeId,
    ":adminPosition"         =>$Position,

    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Admin profile succesfully updated";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header("Location: ../Admin-profile?id=$EmployeeId");

}
else{

    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header("Location: ../Admin-profile?id=$EmployeeId");
    
    
}

?>