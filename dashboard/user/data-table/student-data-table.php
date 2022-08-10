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

$pdoQuery = "SELECT * FROM classes WHERE classId =:classId LIMIT 1";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array("classId" => $classID));
$class_data = $pdoResult->fetch(PDO::FETCH_ASSOC);

$program            = $class_data['program'];
$subjectId          = $class_data['subject_name'];   
$year_level         = $class_data['year_level'];
$semester           = $class_data['semester'];
$school_year        = $class_data['school_year'];


function get_total_row($pdoConnect)
{

}

$total_record = get_total_row($pdoConnect);

$page = 1;
if(isset($_POST['page']))
{
  $start = ($_POST['page']);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

$query = "
SELECT * FROM student 
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

    <thead>
    <th>LRN</th>
    <th>NAME</th>
    <th>PROGRAM</th>
    <th>ACTION</th>
    </thead>
';
  while($row=$statement->fetch(PDO::FETCH_ASSOC))
  {
    $programID = $row['program'];

    $pdoQuery = "SELECT * FROM academic_programs WHERE programID = :programID";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute(array(":programID" => $programID));

    if($program_data = $pdoResult2->fetch(PDO::FETCH_ASSOC))
    {
      $program_name = $program_data['programs'];
    }


    $output .= '
    <tr>
      <td>'.$row["LRN"].'</td>
      <td>'.$row["last_name"].',&nbsp;&nbsp;'.$row["first_name"].'&nbsp;&nbsp;&nbsp;'.$row["middle_name"].'</td>
      <td>'.$program_name.'</td>
      <td><button type="button" class="btn btn-primary V"> <a href="controller/add-class-student-controller?LRN='.$row['LRN'].'&studentId='.$row['studentId'].'&classId='.$classID.'&program='.$program.'&subjectId='.$subjectId.'&year_level='.$year_level.'&semester='.$semester.'&school_year='.$school_year.' " class=""><i class="bx bx-plus"></i> Add</a></button></td>
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