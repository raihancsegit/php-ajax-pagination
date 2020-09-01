<?php 
$con = mysqli_connect("localhost","root","","ajax") or die("Connection Failed");

$page_per_limit = 2;
$page = '';
if(isset($_POST['page_no'])){
$page = $_POST['page_no'];
}else {
    $page = 1;
}
$ofset = ($page-1)*$page_per_limit;

$sql = "SELECT * from student LIMIT {$ofset},{$page_per_limit}";
$result = mysqli_query($con,$sql) or die("Sql Query Failed");

$output = "";
if(mysqli_num_rows($result) > 0){
    $output = '<table border="1" width="100%">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>';

            while($row = mysqli_fetch_assoc($result)){
                $output .= "<tr><td>{$row["id"]}</td> <td>{$row["firstname"]} {$row["lastname"]}</td><td><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td><td><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td></tr>";
            }

            $output .= '</table>';


$alldatasql = "SELECT * from student";
$pagiresult = mysqli_query($con,$alldatasql) or die("Sql Query Failed");
$total_record = mysqli_num_rows($pagiresult);
$total_page = ceil($total_record/$page_per_limit);

$output .= '<div id="pagination">';
for($i = 1; $i<=$total_page;$i++){
    if($i == $page){
        $class_name = "active";
    }else {
        $class_name = "";
    }
    $output .= "<a class='{$class_name}' id='{$i}' href=''>{$i}</a>";
}
$output .= '</div>';

echo $output;

}else {
    echo "No Recode Found";

}