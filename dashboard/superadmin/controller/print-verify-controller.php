<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}

$LRN            = $_GET['LRN'];
$programId      = $_GET['programId'];

$pdoQuery = "SELECT * FROM student_advisory WHERE LRN = :LRN";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":LRN" => $LRN));
$student_advisory_data = $pdoResult->fetch(PDO::FETCH_ASSOC);

$pdoQuery = "SELECT * FROM student WHERE LRN = :LRN";
$pdoResult2 = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult2->execute(array(":LRN" => $LRN));
$student_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

$studentID =   $student_data["userId"];

if(empty($student_advisory_data)){
    $_SESSION['status_title'] = "Sorry!";
    $_SESSION['status'] = "Student have no advisory! Please add advisory first to print SF10.";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header("Location: ../student-profile?id=$studentID");
}
else
{
    header("Location: ../../excel/SF10?programId=$programId&LRN=$LRN");
}

?>