<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}


if(isset($_POST['btn-register'])) {

    $LRN                            = trim($_POST['LRN']);
    $StudentId                      = trim($_POST['StudentId']);
    $Programs                       = trim($_POST['Programs']);
    $FName                          = trim($_POST['FName']);
    $MName                          = trim($_POST['MName']);
    $LName                          = trim($_POST['LName']);
    $Sex                            = trim($_POST['Sex']);
    $BirthDate                      = trim($_POST['BirthDate']);
    $Age                            = trim($_POST['Age']);
    $PBirth                         = trim($_POST['PBirth']);
    $CStatus                        = trim($_POST['CStatus']);
    $Nationality                    = trim($_POST['Nationality']);
    $Religion                       = trim($_POST['Religion']);
    $PNumber                        = trim($_POST['PNumber']);
    $Email                          = trim($_POST['Email']);
    $Province                       = trim($_POST['Province']);
    $City                           = trim($_POST['City']);
    $Barangay                       = trim($_POST['Barangay']);
    $Street                         = trim($_POST['Street']);
    $Mother_FName                   = trim($_POST['Mother-FName']);
    $Mother_MName                   = trim($_POST['Mother-MName']);
    $Mother_LName                   = trim($_POST['Mother-LName']);
    $Mother_PNumber                 = trim($_POST['Mother-PNumber']);
    $Father_FName                   = trim($_POST['Father-FName']);
    $Father_MName                   = trim($_POST['Father-MName']);
    $Father_LName                   = trim($_POST['Father-LName']);
    $Father_PNumber                 = trim($_POST['Father-PNumber']);
    $Emergency_Contact_Person       = trim($_POST['Emergency_Contact_Person']);
    $Emergency_Address              = trim($_POST['Emergency_Address']);
    $Emergency_Mobile_No            = trim($_POST['Emergency_Mobile_No']);

    $pdoQuery = "SELECT * FROM student WHERE LRN = :LRN";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(array(":LRN"=>$LRN,));
    $row = $pdoResult->fetch(PDO::FETCH_ASSOC);

    if($pdoResult->rowCount() > 0){
        $_SESSION['status_title'] = "Oops!";
        $_SESSION['status'] = "LRN is already registered. Please try another one.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 100000;
        header('Location: ../add-students');
    }
    else{

    $pdoQuery = "INSERT INTO student 
        (
            LRN,
            studentId, 
            program,
            first_name, 
            middle_name, 
            last_name, 
            sex, 
            birth_date, 
            age, 
            place_of_birth, 
            civil_status, 
            nationality, 
            religion, 
            phone_number, 
            email, 
            province, 
            city, 
            barangay,
            street,
            mother_first_name,
            mother_middle_name,
            mother_last_name,
            mother_phone_number,
            father_first_name,
            father_middle_name,
            father_last_name,
            father_phone_number,
            emergency_contact_person, 
            emergency_address, 
            emergency_mobile_number
        ) 
    VALUES 
    (
            :LRN,
            :studentId, 
            :program,
            :first_name, 
            :middle_name, 
            :last_name, 
            :sex, 
            :birth_date, 
            :age, 
            :place_of_birth, 
            :civil_status, 
            :nationality, 
            :religion, 
            :phone_number, 
            :email, 
            :province, 
            :city, 
            :barangay,
            :street,
            :mother_first_name,
            :mother_middle_name,
            :mother_last_name,
            :mother_phone_number,
            :father_first_name,
            :father_middle_name,
            :father_last_name,
            :father_phone_number,
            :emergency_contact_person, 
            :emergency_address, 
            :emergency_mobile_number
        )";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute
    (
        array
        ( 
            ":LRN"                      =>$LRN,
            ":studentId"                =>$StudentId,
            ":program"                  =>$Programs,
            ":first_name"               =>$FName,
            ":middle_name"              =>$MName,
            ":last_name"                =>$LName,
            ":sex"                      =>$Sex,
            ":birth_date"               =>$BirthDate,
            ":age"                      =>$Age,
            ":place_of_birth"           =>$PBirth,
            ":civil_status"             =>$CStatus,
            ":nationality"              =>$Nationality, 
            ":religion"                 =>$Religion,
            ":phone_number"             =>$PNumber,
            ":email"                    =>$Email,
            ":province"                 =>$Province,
            ":city"                     =>$City,
            ":barangay"                 =>$Barangay,
            ":street"                   =>$Street,
            ":mother_first_name"        =>$Mother_FName,
            ":mother_middle_name"       =>$Mother_MName,
            ":mother_last_name"         =>$Mother_LName,
            ":mother_phone_number"      =>$Mother_PNumber,
            ":father_first_name"        =>$Father_FName,
            ":father_middle_name"       =>$Father_MName,
            ":father_last_name"         =>$Father_LName,
            ":father_phone_number"      =>$Father_PNumber,
            ":emergency_contact_person" =>$Emergency_Contact_Person,
            ":emergency_address"        =>$Emergency_Address,
            ":emergency_mobile_number"  =>$Emergency_Mobile_No,
        )
      );

      $_SESSION['status_title'] = "Success!";
      $_SESSION['status'] = "Student is now Enrolled";
      $_SESSION['status_code'] = "success";
      $_SESSION['status_timer'] = 40000;
      header('Location: ../add-students');
    }
  
}
else
{
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: ../add-students');

}

?>