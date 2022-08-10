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
    $num = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);

    $pdoQuery = "INSERT INTO academic_programs (programId, programs, strand, acronym) 
                    VALUES (:programId, :programs, :strand, :acronym)";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute
    (
        array
        ( 
            ":programs"                =>$Programs,
            ":strand"                  =>$Strand,
            ":acronym"                 =>$Acronym,
            ":programId"               =>$num,

        )
      );

      $_SESSION['status_title'] = "Success!";
      $_SESSION['status'] = "Academic Program successfully added!";
      $_SESSION['status_code'] = "success";
      $_SESSION['status_timer'] = 40000;
      header('Location: ../add-programs');

      if($pdoExec){
        $sql =  "CREATE TABLE subjects_$num(
            subjectId INT(145) AUTO_INCREMENT PRIMARY KEY,
            year_level VARCHAR(125) NULL,
            semester VARCHAR(125) NULL,
            subject_type VARCHAR(125) NULL,
            subject_name VARCHAR(125) NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
        )";
      }

      $Result = $pdoConnect->prepare($sql);
      $Exec = $Result->execute();

  
}
else
{
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: ../add-programs');

}

?>