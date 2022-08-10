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


    if(isset($_POST['programs_id']))
    {
        $programs = $_POST['programs_id'];

        ?>
            <select name="Semester">
                <option value="">Select.....</option>
                <option value="First Semester">First Semester</option>
                <option value="Second Semester">Second Semester</option>
            </select>
        <?php
    }

    if(isset($_POST['programs_id_value']) && isset($_POST['semester_id']))
    {
        $programs_id_result = $_POST['programs_id_value'];
        $semester_id        = $_POST['semester_id'];
        $year_level         = $_GET['year_level'];

        $pdoQuery = "SELECT * FROM subjects_$programs_id_result WHERE semester=:semester AND year_level=:year_level";
        $pdoResult3 = $pdoConnect->prepare($pdoQuery);
        $pdoResult3->execute(array(":semester"=>$semester_id, ":year_level"=>$year_level));
        ?>
            <select name="Subject">
                <option value="">Select.....</option>
                <?php
                    while($programs_subject=$pdoResult3->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $programs_subject['subjectId']; ?>">
                        <?php echo $programs_subject['subject_name'] ?></option>
                        <?php
                    }
                ?>
            </select>
        <?php
    }
?>