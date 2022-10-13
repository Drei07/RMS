<table class="table table-bordered table-hover">
<?php

require_once '../authentication/superadmin-class.php';
include_once '../../../database/dbconfig2.php';

$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('../../');
}


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
SELECT * FROM request_edit_grade WHERE status = :status
";
$output = '';
if($_POST['query'] != '')
{
  $query .= '
  AND requestId LIKE "%'.str_replace(' ', '%', $_POST['query']).'%"
  ';
}

$query .= 'ORDER BY Id DESC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $pdoConnect->prepare($query);
$statement->execute(array(":status" => "pending"));
$total_data = $statement->rowCount();

$statement = $pdoConnect->prepare($filter_query);
$statement->execute(array(":status" => "pending"));
$total_filter_data = $statement->rowCount();

if($total_data > 0)
{
$output = '

    <thead>
    <th>REQUEST ID</th>
    <th>REQUEST</th>
    <th>STATUS</th>
    <th>DATE</th>
    <th>ACTION</th>
    </thead>
';
  while($row=$statement->fetch(PDO::FETCH_ASSOC))
  {
    $output .= '
    <tr>
      <td>'.$row["requestId"].'</td>
      <td>Request for edit the grade</td>
      <td>'. ($row['status']=="pending" ? '<p class="btn-warning N">Pending</p>' :  '<p class="btn-success Y">Active</p>') . '</td>
      <td>'.$row["created_at"].'</td>
      <td>
      <button type="button" class="btn-success request"> <a href="controller/approve-request-controller?classId='.$row["classId"].'&LRN='.$row["LRN"].'&requestId='.$row["requestId"].'" class="approved">Approved</a></button>&nbsp;&nbsp;&nbsp;
      <button type="button" class="btn-danger request"> <a href="controller/decline-request-controller?classId='.$row["classId"].'&LRN='.$row["LRN"].'&requestId='.$row["requestId"].'" class="decline">Decline</i></a></button>
      </td>

    </tr>
    ';
  }
}
else
{
  echo '<h1>No Request Found</h1>';
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
$('.approved').on('click', function(e){
  e.preventDefault();
  const href = $(this).attr('href')

        swal({
        title: "Approved?",
        text: "Do you want to approved this request?",
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

$('.decline').on('click', function(e){
  e.preventDefault();
  const href = $(this).attr('href')

        swal({
        title: "Decline?",
        text: "Do you want to decline this request?",
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