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

$G11 = "Grade11";
$G12 = "Grade12";

    if(isset($_POST['btn-register-class']))
    {
        $advisoryID         = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);
        $teacherID          = trim($_POST['TeacherID']);
        $section_name       = trim($_POST['section_name']);
        $program            = trim($_POST['Programs']);
        $year_level         = trim($_POST['YearLevel']);
        $color              = trim($_POST['Color']);
        $school_year        = trim($_POST['school_year']);

        $pdoQuery = "SELECT * FROM advisory WHERE section_name = :section_name AND teacherId = :teacherId AND program = :program AND year_level = :year_level AND school_year = :school_year AND status = :status";
        $pdoResult3 = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult3->execute(array(":section_name"=>$section_name, ":teacherId"=>$teacherID, ":program"=>$program, ":year_level"=>$year_level, ":school_year"=>$school_year,  ":status" => "active"));
        $classes_data = $pdoResult3->fetch(PDO::FETCH_ASSOC);

        if($pdoResult3->rowCount() > 0){
            $_SESSION['status_title'] = "Oops!";
            $_SESSION['status'] = "Advisory Class is already create. Please try another one.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 100000;
            
                    
            if($year_level == $G11)
            {
                header('Location: ../G11-advisory-class');
            }
            elseif($year_level == $G12)
            {
                header('Location: ../G12-advisory-class');
            }
        }
        else
        {

        $pdoQuery = "INSERT INTO advisory (advisoryId, teacherId, section_name, program, year_level, school_year, advisory_class_color) 
                        VALUES (:advisoryId, :teacherId, :section_name, :program, :year_level, :school_year, :advisory_class_color) LIMIT 1";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult->execute
        (array(
            ":advisoryId"               =>$advisoryID,
            ":teacherId"                =>$teacherID,
            ":section_name"             =>$section_name,
            ":program"                  =>$program,
            ":year_level"               =>$year_level,
            ":advisory_class_color"     =>$color,
            ":school_year"              =>$school_year
        ));
        
        $_SESSION['status_title'] = "Success!";
        $_SESSION['status'] = "Advisory has been added!";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_timer'] = 40000;

        if($year_level == $G11)
        {
            header('Location: ../G11-advisory-class');
        }
        elseif($year_level == $G12)
        {
            header('Location: ../G12-advisory-class');
        }


        if($pdoExec){
            $sql =  "CREATE TABLE advisory_$advisoryID(
                Id INT(145) AUTO_INCREMENT PRIMARY KEY,
                advisoryId varchar(145) DEFAULT NULL,
                LRN varchar(145) DEFAULT NULL,
                studentId varchar(145) DEFAULT NULL,
                last_name varchar(145) DEFAULT NULL,
                first_name varchar(145) DEFAULT NULL,
                middle_name varchar(145) DEFAULT NULL,
                section_name varchar(145) DEFAULT NULL,
                program varchar(145) DEFAULT NULL,
                year_level varchar(145) DEFAULT NULL,
                school_year varchar(145) DEFAULT NULL,
                created_at timestamp NOT NULL DEFAULT current_timestamp(),
                updated_at timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
            )";
          }
    
          $Result = $pdoConnect->prepare($sql);
          $Exec = $Result->execute();
        }
    }
    else
    {
        $_SESSION['status_title'] = "Oops!";
        $_SESSION['status'] = "Something went wrong, please try again!";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 100000;
        
        if($year_level == $G11)
        {
            header('Location: ../G11-advisory-class');
        }
        elseif($year_level == $G12)
        {
            header('Location: ../G12-advisory-class');
        }
    }


?>