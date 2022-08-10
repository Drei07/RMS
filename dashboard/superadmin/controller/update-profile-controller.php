<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}

if(isset($_POST['btn-update'])){

    $name                      = trim($_POST['Name']);
    $email                      = trim($_POST['Email']);

    $pdoQuery = 'UPDATE superadmin SET name=:name, email=:email WHERE superadminId=1';;
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 

    ":name"               =>$name,
    ":email"                =>$email,

    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Profile succesfully updated";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header('Location: ../profile');

}
else{

    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: ../profile');
    
    
}

?>