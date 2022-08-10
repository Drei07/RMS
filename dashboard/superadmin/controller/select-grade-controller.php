<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}

$LRN = $_GET['StudentLRN'];
$programID = $_GET['programID'];
?>
<table>
    <thead>
    <tr>
        <td colspan="3" rowspan="3">Course </td>
        <td colspan="2" rowspan="1">Quarter</td>
        <td rowspan="2"> First<br>Semester<br>Final Grade </td>
    </tr>
    <tr>
        <td rowspan="1"> 1 </td> 	
        <td rowspan="1"> 2 </td> 		
    </tr>
    </thead>
    <tbody>
    <!-- GRADE CORE SUBJECTS -->
    <tr>
        <td colspan="6" class="subject-type" >Core Subjects</td>
    </tr>
    <?php

        $pdoQuery = "SELECT * FROM subjects_$programID WHERE subject_type = :subject_type AND semester = :semester AND year_level = :year_level";
        $pdoResult1 = $pdoConnect->prepare($pdoQuery);
        $pdoResult1->execute(array(":subject_type" => "Core Subjects", ":semester" => "First Semester", ":year_level" => "Grade11"));

        while($subject_data = $pdoResult1->fetch(PDO::FETCH_ASSOC)){
    ?>
    
    <tr>
        <td colspan="3" class="subject-name"><?php echo $subject_data['subject_name'] ?></td>
        
        <?php

            $subjectId = $subject_data['subjectId'];

            $pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId";
            $pdoResult2 = $pdoConnect->prepare($pdoQuery);
            $pdoResult2->execute
            (array(
                ":LRN" 			=> $LRN, 
                ":program" 		=> $programID, 
                ":subjectId" 	=> $subjectId
            ));

            if($pdoResult2->rowCount() == 0){
        ?>

            <td> </td>
            <td> </td>
            <td> </td>

        <?php

            }

            else {

            while($subject_grade_data_first = $pdoResult2->fetch(PDO::FETCH_ASSOC)){

                $Q1 = $subject_grade_data_first['subject_grade_Q1'];
                $Q2 = $subject_grade_data_first['subject_grade_Q2'];

                $Q1_Q2 = ($Q1) + ($Q2);
                $semester = $Q1_Q2 / 2;
                $roundoff = round($semester);

                if ($Q1 == NULL)
                {
                    $final_grade = '';
                
                }
                else if ($Q2 == NULL)
                {
                    $final_grade = '';
                }
                else
                {
                    $final_grade = $roundoff;
                }
        ?>
            <td><?php echo $Q1 ?></td>
            <td><?php echo $Q2 ?></td>	
            <td><?php echo $final_grade ?></td>	

        <?php
            }
            }

        ?>
    </tr>
    <?php
        }

    ?>
    <!--END GRADE CORE SUBJECTS -->

    <!-- GRADE APPLIED SUBJECTS -->
    <tr>
        <td colspan="6" class="subject-type" >Applied Subjects</td>
    </tr>
    <?php

        $pdoQuery = "SELECT * FROM subjects_$programID WHERE subject_type = :subject_type AND semester = :semester AND year_level = :year_level";
        $pdoResult3 = $pdoConnect->prepare($pdoQuery);
        $pdoResult3->execute(array(":subject_type" => "Applied Subjects", ":semester" => "First Semester", ":year_level" => "Grade11"));

        while($subject_data = $pdoResult3->fetch(PDO::FETCH_ASSOC)){
    ?>
    
    <tr>
        <td colspan="3" class="subject-name"><?php echo $subject_data['subject_name'] ?></td>
        
        <?php

            $subjectId = $subject_data['subjectId'];

            $pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId";
            $pdoResult4 = $pdoConnect->prepare($pdoQuery);
            $pdoResult4->execute
            (array(
                ":LRN" 			=> $LRN, 
                ":program" 		=> $programID, 
                ":subjectId" 	=> $subjectId
            ));

            if($pdoResult4->rowCount() == 0){
        ?>

            <td> </td>
            <td> </td>
            <td> </td>

        <?php

            }

            else {

            while($subject_grade_data_first = $pdoResult2->fetch(PDO::FETCH_ASSOC)){

                $Q1 = $subject_grade_data_first['subject_grade_Q1'];
                $Q2 = $subject_grade_data_first['subject_grade_Q2'];

                $Q1_Q2 = ($Q1) + ($Q2);
                $semester = $Q1_Q2 / 2;
                $roundoff = round($semester);

                if ($Q1 == NULL)
                {
                    $final_grade = '';
                
                }
                else if ($Q2 == NULL)
                {
                    $final_grade = '';
                }
                else
                {
                    $final_grade = $roundoff;
                }
        ?>
            <td><?php echo $Q1 ?></td>
            <td><?php echo $Q2 ?></td>	
            <td><?php echo $final_grade ?></td>	

        <?php
            }
            }

        ?>
    </tr>
    <?php
        }

    ?>
    <!--END GRADE APPLIED SUBJECTS -->

    <!-- GRADE SPECIALIZED SUBJECTS -->
    <tr>
        <td colspan="6" class="subject-type" >Specialized Subjects</td>
    </tr>
    <?php

        $pdoQuery = "SELECT * FROM subjects_$programID WHERE subject_type = :subject_type AND semester = :semester AND year_level = :year_level";
        $pdoResult3 = $pdoConnect->prepare($pdoQuery);
        $pdoResult3->execute(array(":subject_type" => "Specialized Subjects", ":semester" => "First Semester", ":year_level" => "Grade11"));

        while($subject_data = $pdoResult3->fetch(PDO::FETCH_ASSOC)){
    ?>
    
    <tr>
        <td colspan="3" class="subject-name"><?php echo $subject_data['subject_name'] ?></td>
        
        <?php

            $subjectId = $subject_data['subjectId'];

            $pdoQuery = "SELECT * FROM student_enrolled_subjects WHERE LRN = :LRN AND program = :program AND subjectId = :subjectId";
            $pdoResult4 = $pdoConnect->prepare($pdoQuery);
            $pdoResult4->execute
            (array(
                ":LRN" 			=> $LRN, 
                ":program" 		=> $programID, 
                ":subjectId" 	=> $subjectId
            ));

            if($pdoResult4->rowCount() == 0){
        ?>

            <td> </td>
            <td> </td>
            <td> </td>

        <?php

            }

            else {

            while($subject_grade_data_first = $pdoResult2->fetch(PDO::FETCH_ASSOC)){

                $Q1 = $subject_grade_data_first['subject_grade_Q1'];
                $Q2 = $subject_grade_data_first['subject_grade_Q2'];

                $Q1_Q2 = ($Q1) + ($Q2);
                $semester = $Q1_Q2 / 2;
                $roundoff = round($semester);

                if ($Q1 == NULL)
                {
                    $final_grade = '';
                
                }
                else if ($Q2 == NULL)
                {
                    $final_grade = '';
                }
                else
                {
                    $final_grade = $roundoff;
                }
        ?>
            <td><?php echo $Q1 ?></td>
            <td><?php echo $Q2 ?></td>	
            <td><?php echo $final_grade ?></td>	

        <?php
            }
            }

        ?>
    </tr>
    <?php
        }

    ?>
    <!--END GRADE SPECIALIZED SUBJECTS -->
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5" class="footer">General Average for the First Semester</td>
        <td colspan="2">55.95 </td>
    </tr>
</table>