<table class="table table-bordered table-hover">
<?php

require_once '../authentication/user-class.php';
include_once '../../../database/dbconfig2.php';

$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('../../');
}

$classID = $_GET['classId'];


$pdoQuery = "SELECT * FROM classes WHERE classId = :classId";
$pdoResult2 = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult2->execute(array(":classId" => $classID));
$class_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

$class_color = $class_data['class_color'];


function get_total_row($pdoConnect)
{

}
$page = 1;
if(isset($_POST['page']))
{
  $start = $_POST['page'];
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

$query = "
SELECT * FROM class_$classID
";
$output = '';
if($_POST['query'] != '')
{
  $query .= '
  WHERE LRN LIKE "%'.str_replace(' ', '%', $_POST['query']).'%"
  ';
}

$query .= 'ORDER BY last_name ASC ';


$statement = $pdoConnect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

if($total_data > 0)
{

$output = '

    <thead style="--bs-table-bg: '.$class_color.';">
    <th>LRN</th>
    <th>STUDENT ID</th>
    <th>NAME</th>
    <th>PROGRAM</th>
    <th>REMARKS</th>
    <th>ACTION</th>
    </thead>
';
  while($row=$statement->fetch(PDO::FETCH_ASSOC))
  {
    $student_id = $row['LRN'];
    $ID = $row['Id'];
    $subjectId = $row['subjectId'];
    $student_program = $row['program'];

    $pdoQuery = "SELECT * FROM student WHERE LRN = :LRN";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute(array(":LRN" => $student_id));

    if($student_data = $pdoResult2->fetch(PDO::FETCH_ASSOC))
    {

        $studentId      = $student_data['studentId'];
        $first_name     = $student_data['first_name'];
        $middle_name    = $student_data['middle_name'];
        $last_name      = $student_data['last_name'];
        $sex            = $student_data['sex'];
        $birth_date     = $student_data['birth_date'];
        $phone_number   = $student_data['phone_number'];
        $programId          = $student_data['program'];

        $pdoQuery = "SELECT * FROM academic_programs WHERE programID = :programID";
        $pdoResult2 = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult2->execute(array(":programID" => $programId));
        $program_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

        $program = $program_data['programs'];
    }

    $student_semester = $row['semester'];

    if($student_semester == "First Semester"){

      $student_grade_1 = $row['subject_grade_Q1'];
      $student_grade_2 = $row['subject_grade_Q2'];

      $grade = ($student_grade_1) + ($student_grade_2);
      $semester_grade = $grade / 2;

      $final_semester_grade = round($semester_grade);

      if ($student_grade_1 == NULL)
      {
        $remarks = '<p>----</p>';
    
      }
      else if ($student_grade_2 == NULL)
      {
        $remarks = '<p>----</p>';
      }
      else
      {
        if($final_semester_grade <= 74)
        {
          $remarks = '<p class="failed">Failed!</p>';
        }
        else if($final_semester_grade >= 75)
        {
          $remarks = '<p class="passed">Passed!</p>';
        }

        $pdoQuery = "UPDATE class_$classID SET final_subject_grade_1st_sem = :final_subject_grade WHERE Id = :ID";
        $pdoResult5 = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult5->execute(
        array
        (
            ":final_subject_grade" => $final_semester_grade,
            ":ID" => $ID
        ));

        if($pdoResult5){

          $pdoQuery = "UPDATE student_enrolled_subjects SET final_subject_grade_1st_sem=:subject_grade WHERE classId = :classId AND LRN = :LRN AND program = :program AND subjectId = :subjectId";
          $pdoResult = $pdoConnect->prepare($pdoQuery);
          $pdoExec = $pdoResult->execute(
          array
          (
              ":subject_grade"    => $final_semester_grade,
              ":classId"          => $classID,
              ":LRN"              => $student_id,
              ":program"          => $student_program,
              ":subjectId"        => $subjectId

          ));

        }
        
      }  
    }
    else if ($student_semester == "Second Semester")
    {
      $student_grade_1 = $row['subject_grade_Q3'];
      $student_grade_2 = $row['subject_grade_Q4'];

      $grade = ($student_grade_1) + ($student_grade_2);
      $semester_grade = $grade / 2;

      $final_semester_grade = round($semester_grade);

      if ($student_grade_1 == NULL)
      {
        $remarks = '<p>----</p>';
    
      }
      else if ($student_grade_2 == NULL)
      {
        $remarks = '<p>----</p>';
      }
      else
      {
        if($final_semester_grade <= 74)
        {
          $remarks = '<p class="failed">Failed</p>';
        }
        else if($final_semester_grade >= 75)
        {
          $remarks = '<p class="passed">Passed</p>';
        }

        $pdoQuery = "UPDATE class_$classID SET final_subject_grade_2nd_sem = :final_subject_grade WHERE Id = :ID";
        $pdoResult6 = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult6->execute(
        array
        (
            ":final_subject_grade" => $final_semester_grade,
            ":ID" => $ID
        ));

        if($pdoResult6){

          $pdoQuery = "UPDATE student_enrolled_subjects SET final_subject_grade_2nd_sem=:subject_grade WHERE classId = :classId AND LRN = :LRN AND program = :program AND subjectId = :subjectId";
          $pdoResult = $pdoConnect->prepare($pdoQuery);
          $pdoExec = $pdoResult->execute(
          array
          (
              ":subject_grade"    => $final_semester_grade,
              ":classId"          => $classID,
              ":LRN"              => $student_id,
              ":program"          => $student_program,
              ":subjectId"        => $subjectId

          ));

        }

      }
      
    }

    $output .= '
    <tr>
      <td>'.$row["LRN"].'</td>
      <td>'.$row["studentId"].'</td>
      <td>'.$last_name.',&nbsp;&nbsp;'.$first_name.'&nbsp;&nbsp;&nbsp;'.$middle_name.'</td>
      <td>'.$program.'</td>
      <td>'.$remarks.'</td>
      <td><button type="button" class="btn btn-primary V" style="background-color: '.$class_color.'; border-color: '.$class_color.';"> <a href="class-student-profile?id='.$row["Id"].'&classId='.$classID.'" class="view"><i class="bx bx-low-vision"></i></a></button></td>
    </tr>
    ';
  }
}
else
{
  echo '<h1>No Data Found</h1>';
}

$output .= '
</table>
<div align="center">
  <ul class="pagination">
';
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>

<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
<script>


</script>
</table>