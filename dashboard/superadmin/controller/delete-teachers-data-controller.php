<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}



    $pdoQuery = "DELETE FROM user where userId =" . $_GET['Id'];
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute();

        $_SESSION['status_title'] = "success!";
        $_SESSION['status'] = "Teachers account successfully deleted";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_timer'] = 100000;
        header('Location: ../teachers-data');
        $pdoConnect = null;

?>