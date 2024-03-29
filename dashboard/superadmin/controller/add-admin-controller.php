<?php
require_once '../../admin/authentication/admin-class.php';

$reg_admin = new ADMIN();

if(isset($_POST['btn-register'])) {

    $employeeId     = trim($_POST['EmployeeId']);
    $position       = trim($_POST['Position']);
    $first_name     = trim($_POST['FName']);
    $middle_name    = trim($_POST['MName']);
    $last_name      = trim($_POST['LName']);
    $email          = trim($_POST['Email']);

    // Generate Password
    $varchar = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shuffle = str_shuffle($varchar);
    $upass          = substr($shuffle,0,8);

    // Token Generator
    $tokencode      = md5(uniqid(rand()));

    $stmt = $reg_admin->runQuery("SELECT * FROM admin WHERE adminEmail=:email_id");
    $stmt->execute(array(":email_id"=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Email Existed
    if($stmt->rowCount() > 0)
    {
      $_SESSION['status_title'] = "Oops!";
      $_SESSION['status'] = "Email already taken. Please try another one.";
      $_SESSION['status_code'] = "error";
      $_SESSION['status_timer'] = 100000;
    }
    else
    {
        if($reg_admin->register($employeeId,$position,$first_name,$middle_name,$last_name,$email,$upass,$tokencode))
        {   
        $id = $reg_admin->lasdID();  
        $key = base64_encode($id);
        $id = $key;
        
        $message = "     
            Hello sir/maam $last_name,
            <br /><br />
            Welcome to San Vicente National High School Management System!
            <br /><br />
            Email:<br />$email
            Password:<br />$upass
            <br /><br />
            <a href='https://localhost/RMS/public/admin/verify?id=$id&code=$tokencode'>Click HERE to Verify your Account!</a>
            <br /><br />
            Thanks,";
            
        $subject = "Verify Email";
            
            $reg_admin->send_mail($email,$message,$subject,$smtp_email,$smtp_password,$system_name);
            $_SESSION['status_title'] = "Success!";
            $_SESSION['status'] = "Please check the Email to verify the account.";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_timer'] = 40000;
            header('Location: ../add-admin');
        }
        else
        {

            $_SESSION['status_title'] = "Sorry !";
            $_SESSION['status'] = "Something went wrong, please try again!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 10000000;
            header('Location: ../add-admin');

        }
    }
      

}

?>