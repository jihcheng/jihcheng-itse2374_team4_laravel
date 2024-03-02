<?php
//call from index_left.php
session_start();
date_default_timezone_set('America/North_Dakota/Center');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User List</title>
<meta name="description" content="List All User Accounts">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.4.0/paper/bootstrap.min.css">
<style>
table, th, td {
  border: 1px solid;
  border-collapse: collapse;
}
</style>
</head>
<body>

<h4 style="margin-left: 15px;">List of all users in the table<?php echo ' as '.(date('l jS \of F Y h:i:s A'))?></h4>
<?php

$host_name='dpg-cn3qb5qcn0vc738pmp7g-a.oregon-postgres.render.com';
$db_name='inew2374250spring24';
$user_name='inew2374250spring24_user';
$password='4i2U9tzMVYLGbj7ePpxmiyHr4oIflMf1';
$Table_name='"ITSE-2374-APP-4"."USER_LIST"';
$db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");



$result = pg_query($db,"SELECT * FROM $Table_name order by first_name");
echo "<table class=\"table-hover\" style=\"margin-left: 15px;\">";
echo "<tr>
<th style=\"background:lightblue; color:black; \">ID</th>
<th style=\"background:lightblue; color:black; \">Name</th>
<th style=\"background:lightblue; color:black; \">Email</th>
<th style=\"background:lightblue; color:black; \">Validated</th>";
// echo "<th style=\"background:lightblue; color:black; \">Password</th>";
echo "<th style=\"background:lightblue; color:black; \">Last_Update</th></tr>";

$i=1;
while($row=pg_fetch_assoc($result)){
    $bk_color=($row['validation_status']=='NO')?'lightgray':'Bisque';
    echo "<tr style=\"background:$bk_color\">";
    echo "<td style=\"color:black; \" align='left' width='20'>" . $i . "</td>";
    echo "<td style=\"color:black; \" align='left' width='200'>" . $row['first_name'] .' '.$row['last_name'] . "</td>";
    echo "<td style=\"color:black; \" align='left' width='200'>" . $row['email'] . "</td>";
    echo "<td style=\"color:black; \" align='left' width='100'>" . $row['validation_status'] . "</td>";
    //echo "<td style=\"color:black; \" align='left' width='100'>" . $row['password'] . "</td>";
    echo "<td style=\"color:black; \" align='left' width='150'>" . $row['last_update'] . "</td>";
    echo "</tr>";
    $i=$i+1;
    }
echo "</table>";

pg_free_result($result);
pg_close($db);
?>

</body>
</html>