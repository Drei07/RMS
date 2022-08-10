<table class="table table-bordered table-hover">
<?php

require_once '../authentication/superadmin-class.php';
include_once '../../../database/dbconfig2.php';

$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('../../');
}

$uniqueID = $_GET['uniqueId'];

function get_total_row($pdoConnect)
{
//   $query = "
//   SELECT * FROM user
//   ";
//   $statement = $pdoConnect->prepare($query);
//   $statement->execute();
//   return $statement->rowCount();
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
SELECT * FROM classes WHERE teacherId = :teacherId AND  year_level = :year_level
";
$output = '';
if($_POST['query'] != '')
{
  $query .= '
  AND Id LIKE "%'.str_replace(' ', '%', $_POST['query']).'%"
  ';
}

$query .= 'ORDER BY Id DESC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $pdoConnect->prepare($query);
$statement->execute(array(":teacherId" => $uniqueID, ":year_level" => "Grade11"));
$total_data = $statement->rowCount();

$statement = $pdoConnect->prepare($filter_query);
$statement->execute(array(":teacherId" => $uniqueID, ":year_level" => "Grade11"));
$total_filter_data = $statement->rowCount();

if($total_data > 0)
{
$output = '

    <thead>
    <th>CLASS ID</th>
    <th>CLASS CODE</th>
    <th>PROGRAM</th>
    <th>SUBJECT NAME</th>
    <th>SEMESTER</th>
    <th>SCHOOL YEAR</th>
    <th>ACTION</th>
    </thead>
';
  while($row=$statement->fetch(PDO::FETCH_ASSOC))
  {


    $progamID = $row['program'];
    $subjectID = $row['subject_name'];

    $pdoQuery = "SELECT * FROM academic_programs WHERE programID = :programID";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute(array(":programID" => $progamID));

    if($program_data = $pdoResult2->fetch(PDO::FETCH_ASSOC)){

        $program_name = $program_data['programs'];
        $program_id    = $program_data['programID'];

        $pdoQuery = "SELECT * FROM subjects_$program_id WHERE subjectId = :subjectID";
        $pdoResult3 = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult3->execute(array(":subjectID" => $subjectID));
        $subject_data = $pdoResult3->fetch(PDO::FETCH_ASSOC);

        $subject_name = $subject_data['subject_name'];


    }
    


    $output .= '
    <tr>
      <td>'.$row["classId"].'</td>
      <td>'.$row["class_code"].'</td>
      <td>'.$program_name.'</td>
      <td>'.$subject_name.'</td>
      <td>'.$row["semester"].'</td>
      <td>S.Y. '.$row["school_year"].'</td>
      <td><button type="button" class="btn btn-primary V"> <a href="teachers-class-student?classId='.$row["classId"].'&code='.$row["class_code"].'  " class="view"><i class="bx bx-low-vision"></i></a></button></td>
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
$('.view').on('click', function(e){
  e.preventDefault();
  const href = $(this).attr('href')

        swal({
        title: "View?",
        text: "Do you want to view more?",
        icon: "info",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          document.location.href = href;
        }
      });
})


</script>
</table>