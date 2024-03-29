<table class="table table-bordered table-hover">
<?php

require_once '../authentication/superadmin-class.php';
include_once '../../../database/dbconfig2.php';

$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('../../');
}

$classID = $_GET['classId'];


function get_total_row($pdoConnect)
{

}

$total_record = get_total_row($pdoConnect);
$limit = '20';
$page = 1;
if(isset($_POST['page']))
{
  $start = (($_POST['page'] - 1) * $limit);
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

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $pdoConnect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $pdoConnect->prepare($filter_query);
$statement->execute();
$total_filter_data = $statement->rowCount();

if($total_data > 0)
{
$output = '

    <thead>
    <th>LRN</th>
    <th>STUDENT ID</th>
    <th>NAME</th>
    <th>SEX</th>
    <th>BIRTH-DATE</th>
    <th>PHONE-NUMBER</th>
    <th>PROGRAM</th>
    <th>REMARKS</th>
    <th>ACTION</th>
    </thead>
';
  while($row=$statement->fetch(PDO::FETCH_ASSOC))
  {
    $student_id = $row['studentId'];

    $pdoQuery = "SELECT * FROM student WHERE studentId = :studentId";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute(array(":studentId" => $student_id));

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

    if($row['subject_grade'] == NULL){
        $remarks = '<p>---</p>';
    }
    else if($row['subject_grade'] <= 74){
      $remarks = '<p class="N" style="background-color: red;">Failed</p>';
    }
    else if($row['subject_grade'] >= 75){
      $remarks = '<p class="Y">Passed</p>';
    }

    $output .= '
    <tr>
      <td>'.$row["LRN"].'</td>
      <td>'.$row["studentId"].'</td>
      <td>'.$last_name.',&nbsp;&nbsp;'.$first_name.'&nbsp;&nbsp;&nbsp;'.$middle_name.'</td>
      <td>'.$sex.'</td>
      <td>'.$birth_date.'</td>
      <td>'. ($phone_number== NULL ? '' :  '+63'.$phone_number.'') . '</td>
      <td>'.$program.'</td>
      <td>'.$remarks.'</td>
      <td><button type="button" class="btn btn-primary V"> <a href="class-student-profile?id='.$row["Id"].'&classId='.$classID.'" class="view"><i class="bx bx-low-vision"></i></a></button></td>
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

$total_links = ceil($total_data/$limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if($total_links > 5)
{
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  $page_array[] = '...';
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}

for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only"></span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
    }
    else
    {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if($next_id > $total_links)
    {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
    }
    else
    {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    }
    else
    {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      ';
    }
  }
}

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