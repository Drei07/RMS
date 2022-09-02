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
        $classID           = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);
        $teacherID          = trim($_POST['TeacherID']);
        $class_code         = trim($_POST['ClassCode']);
        $class_type         = trim($_POST['ClassType']);
        $program            = trim($_POST['Programs']);
        $year_level         = trim($_POST['YearLevel']);
        $semester           = trim($_POST['Semester']);
        $subject_name       = trim($_POST['Subject']);
        $color              = trim($_POST['Color']);
        $school_year        = trim($_POST['school_year']);

        $pdoQuery = "SELECT * FROM subjects_$program WHERE subjectId = :subjectId";
        $pdoResult2 = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult2->execute(array(":subjectId"=>$subject_name,));
        $subject_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

        $subject_code = $subject_data['subjectId'];

        $pdoQuery = "SELECT * FROM classes WHERE subject_name = :subject_name AND teacherId = :teacherId AND program = :program AND status = :status";
        $pdoResult3 = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult3->execute(array(":subject_name"=>$subject_code, ":teacherId"=>$teacherID, ":program"=>$program, ":status" => "active"));
        $classes_data = $pdoResult3->fetch(PDO::FETCH_ASSOC);

        if($pdoResult3->rowCount() > 0){
            $_SESSION['status_title'] = "Oops!";
            $_SESSION['status'] = "Subject is already create. Please try another one.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 100000;
            
                    
            if($year_level == $G11)
            {
                header('Location: ../G11-subject-class');
            }
            elseif($year_level == $G12)
            {
                header('Location: ../G12-subject-class');
            }
        }
        else
        {

        $pdoQuery = "INSERT INTO classes (classId, teacherId, class_code, class_type, program, year_level, semester, subject_name, school_year, class_color) 
                        VALUES (:classId, :teacherId, :class_code, :class_type, :program, :year_level, :semester, :subject_name, :school_year, :class_color) LIMIT 1";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult->execute
        (array(
            ":classId"          =>$classID,
            ":teacherId"        =>$teacherID,
            ":class_code"       =>$class_code,
            ":class_type"       =>$class_type,
            ":program"          =>$program,
            ":year_level"       =>$year_level,
            ":semester"         =>$semester,
            ":subject_name"     =>$subject_name,
            ":class_color"      =>$color,
            ":school_year"      =>$school_year
        ));
        
        $_SESSION['status_title'] = "Success!";
        $_SESSION['status'] = "Class has been added!";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_timer'] = 40000;

        if($year_level == $G11)
        {
            header('Location: ../G11-subject-class');
        }
        elseif($year_level == $G12)
        {
            header('Location: ../G12-subject-class');
        }


        if($pdoExec){
            $sql =  "CREATE TABLE class_$classID(
                Id INT(145) AUTO_INCREMENT PRIMARY KEY,
                classId varchar(145) DEFAULT NULL,
                LRN varchar(145) DEFAULT NULL,
                studentId varchar(145) DEFAULT NULL,
                last_name varchar(145) DEFAULT NULL,
                first_name varchar(145) DEFAULT NULL,
                middle_name varchar(145) DEFAULT NULL,
                program varchar(145) DEFAULT NULL,
                subjectId varchar(145) DEFAULT NULL,
                year_level varchar(145) DEFAULT NULL,
                semester varchar(145) DEFAULT NULL,
                school_year varchar(145) DEFAULT NULL,
                subject_grade_Q1 varchar(145) DEFAULT NULL,
                subject_grade_Q2 varchar(145) DEFAULT NULL,
                final_subject_grade_1st_sem varchar(145) DEFAULT NULL,
                subject_grade_Q3 varchar(145) DEFAULT NULL,
                subject_grade_Q4 varchar(145) DEFAULT NULL,
                final_subject_grade_2nd_sem varchar(145) DEFAULT NULL,
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
            header('Location: ../G11-subject-class');
        }
        elseif($year_level == $G12)
        {
            header('Location: ../G12-subject-class');
        }
    }


?>