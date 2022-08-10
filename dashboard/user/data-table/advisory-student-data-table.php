<table class="table table-bordered table-hover">
<?php

require_once '../authentication/user-class.php';
include_once '../../../database/dbconfig2.php';

$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('../../');
}

$advisoryId = $_GET['advisoryId'];


$pdoQuery = "SELECT * FROM advisory WHERE advisoryId = :advisoryId";
$pdoResult2 = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult2->execute(array(":advisoryId" => $advisoryId));
$class_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

$class_color = $class_data['advisory_class_color'];


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
SELECT * FROM advisory_$advisoryId
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
    <th>ACTION</th>
    </thead>
';
  while($row=$statement->fetch(PDO::FETCH_ASSOC))
  {
    $student_id = $row['LRN'];
    $ID = $row['Id'];
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

 
    $output .= '
    <tr>
      <td>'.$row["LRN"].'</td>
      <td>'.$row["studentId"].'</td>
      <td>'.$last_name.',&nbsp;&nbsp;'.$first_name.'&nbsp;&nbsp;&nbsp;'.$middle_name.'</td>
      <td>'.$program.'</td>
      <td><button type="button" class="btn btn-primary V" style="background-color: '.$class_color.'; border-color: '.$class_color.';"> <a href="advisory-student-profile?id='.$row["Id"].'&advisoryId='.$advisoryId.'" class="view"><i class="bx bx-low-vision"></i></a></button></td>
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