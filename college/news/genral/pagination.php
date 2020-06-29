<?php
include '../../includes/database.php';

$record_per_page = 5;
$page = "";
$output = "";

if(isset($_POST["page"]))
{
    $page = $_POST["page"];
}else{
    $page = 1;
}

$start_from = ($page-1)*$record_per_page;

$query = "Select * from news ORDER by id desc LIMIT $start_from,$record_per_page";

$result = mysqli_query($connect,$query);

$count=1;

$output .= "
    <table class='table table-bordered'>
        <thead class='thead-light'>
        <tr>
            <th scope='col'>S.no</th>
            <th scope='col'>Title</th>
            <th scope='col'>Detail</th>
            <th scope='col'>Date</th>
            <th scope='col'>Edit</th>
            <th scope='col'>Delete</th>
        </tr>
    </thead>
"; 
while($row = mysqli_fetch_array($result)){
    $output .='
        <tr>
            <td>'.$count.'</td>
            <td>'.$row["title"].'</td>
            <td>'.$row["detail"].'</td>
            <td>'.$row["date"].'</td>
            <td>
                <a href="edit.php?id='.$row["id"].'">Edit</a>
            </td>
            <td>
                <a href="delete.php?id='.$row["id"].'">Delete</a>
            </td>
        </tr>
    ';

    $count = $count+1;

}

$output .="</table><br /><div align='center'>";

$page_query = "Select * from news ORDER by id desc";
$page_result = mysqli_query($connect,$page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$record_per_page);
for($i=1; $i<=$total_pages; $i++){
    $output .="<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";
}

echo $output;

?>