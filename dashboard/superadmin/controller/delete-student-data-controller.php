<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}



        $pdoQuery = "UPDATE student SET account_status = :status WHERE userId=". $_GET['Id'];
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult->execute(
        array
        ( 
        ":status"      => "disabled",
        )
        );

        $_SESSION['status_title'] = "success!";
        $_SESSION['status'] = "Student account successfully deleted";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_timer'] = 100000;
        header('Location: ../enrolled-students-data');
        $pdoConnect = null;

?>