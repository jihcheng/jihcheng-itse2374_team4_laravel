<?php
session_start();
date_default_timezone_set('America/North_Dakota/Center');

$validation_code=$_GET['validation_code'];
$last_update=date("Ymd") . '-' .date("His");


// ==================PHP Method =================================================
$Table_name='"ITSE-2374-APP-4"."USER_LIST"';
$host_name='dpg-cn3qb5qcn0vc738pmp7g-a.oregon-postgres.render.com';
$db_name='inew2374250spring24';
$user_name='inew2374250spring24_user';
$password='4i2U9tzMVYLGbj7ePpxmiyHr4oIflMf1';

$db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");

$result = pg_query($db, "UPDATE $Table_name SET validation_status = 'YES', last_update='" .$last_update . "' WHERE validation_code = '".$validation_code."'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User List</title>
<meta name="description" content="User Information.">
<style>
table, th, td {
  border: 1px solid;
  border-collapse: collapse;
}
</style>
</head>
<body>
<h1>List of all users in the table</h1>
<?php

$host_name='dpg-cn3qb5qcn0vc738pmp7g-a.oregon-postgres.render.com';
$db_name='inew2374250spring24';
$user_name='inew2374250spring24_user';
$password='4i2U9tzMVYLGbj7ePpxmiyHr4oIflMf1';
$Table_name='"ITSE-2374-APP-4"."USER_LIST"';
$db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");

$result = pg_query($db,"SELECT * FROM $Table_name");
echo "<table><tr style=\"text-align:center;\"><td style=\"background:lightblue;\">ID</td>
<td style=\"background:lightblue;\">Name</td><td style=\"background:lightblue;\">Email</td><td style=\"background:lightblue;\">Validated</td>
<td style=\"background:lightblue;\">Last_Update</td></tr>";
$i=1;
while($row=pg_fetch_assoc($result)){
    echo "<tr>";
    echo "<td align='left' width='20'>" . $i . "</td>";
    echo "<td align='left' width='200'>" . $row['first_name'] .' '.$row['last_name'] . "</td>";
    echo "<td align='left' width='200'>" . $row['email'] . "</td>";
    echo "<td align='center' width='100'>" . $row['validation_status'] . "</td>";
    echo "<td align='center' width='150'>" . $row['last_update'] . "</td>";
    echo "</tr>";
    $i=$i+1;
    }
echo "</table>";
pg_free_result($result);
pg_close($db);
?>

</body>
</html>
















