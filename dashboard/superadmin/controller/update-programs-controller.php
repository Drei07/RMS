<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}


if(isset($_POST['btn-register'])) {

    $Programs                      = trim($_POST['AProgram']);
    $Acronym                       = trim($_POST['Acronym']);
    $Strand                       = trim($_POST['Strand']);


    $pdoQuery = "UPDATE academic_programs SET programs=:programs, strand=:strand, acronym=:acronym  WHERE id =" . $_GET['id'];
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute
    (
        array
        ( 
            ":programs"                =>$Programs,
            ":strand"                  =>$Strand,
            ":acronym"                 =>$Acronym,


        )
      );

      $_SESSION['status_title'] = "Success!";
      $_SESSION['status'] = "Academic Program successfully updated!";
      $_SESSION['status_code'] = "success";
      $_SESSION['status_timer'] = 40000;
      header('Location: ../manage-program');
  
}
else
{
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: ../manage-program');

}

?>