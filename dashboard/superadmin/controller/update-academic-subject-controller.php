<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}

$subjectId      = $_GET["subjectId"];
$Id             = $_GET["id"];


if(isset($_POST['btn-register'])) {

    $YLevel                      = trim($_POST['YLevel']);
    $Semester                    = trim($_POST['Semester']);
    $SName                       = trim($_POST['SName']);
    $SubjetcType                 = trim($_POST['Subject_type']);


    $pdoQuery = "UPDATE subjects_$subjectId SET year_level=:year_level, semester=:semester, subject_type=:subject_type, subject_name=:subject_name  WHERE subjectId =" . $_GET['id'];
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute
    (
        array
        ( 
            ":year_level"           =>$YLevel,
            ":semester"             =>$Semester,
            ":subject_type"         =>$SubjetcType,
            ":subject_name"         =>$SName,

        )
      );

      $_SESSION['status_title'] = "Success!";
      $_SESSION['status'] = "Academic Program Subjects successfully updated!";
      $_SESSION['status_code'] = "success";
      $_SESSION['status_timer'] = 40000;
      header("Location: ../academic-subjects?id=$subjectId");
  
}
else
{
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header("Location: ../academic-subjects?id=$subjectId");

}

?>