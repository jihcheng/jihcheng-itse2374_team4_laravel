<?php
session_start();
date_default_timezone_set('America/North_Dakota/Center');

$user_email=$_POST['user_email'];
$user_password=$_POST['user_password'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User Login</title>
<meta name="description" content="User Login">
<style>
table, th, td {
  border: 1px solid;
  border-collapse: collapse;
}
</style>
</head>
<body>
<h1 style="margin-left: 15px;">User login Verification</h1>
<?php
$Table_name='"ITSE-2374-APP-4"."USER_LIST"';
$host_name='dpg-cn3qb5qcn0vc738pmp7g-a.oregon-postgres.render.com';
$db_name='inew2374250spring24';
$user_name='inew2374250spring24_user';
$password='4i2U9tzMVYLGbj7ePpxmiyHr4oIflMf1';

$db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");

$result = pg_query($db,"SELECT * FROM $Table_name where email='".$user_email."' and password='".$user_password."' LIMIT 1");

if (pg_num_rows($result) == 0) {
    echo "<div style=\"margin-left: 15px; color: red; font-size: 150%\">Hi, there is no record for email/password you just entered. <br>Please make sure you entered the correct email/password.
        <br>If you have not registered, please register via 'New User Registration' option. Thanks.</div>";
} else {
    $row = pg_fetch_assoc($result);
    if ($row['validation_status']=='NO') {
        echo "<div style=\"margin-left: 15px; color: red; font-size: 150%\">User: " .$row['first_name'].' '. $row['last_name'].', Email: '. $row['email'].',  
        Please check your email and follow the instructions to complete registration first.</div>';
        echo "<br />\n";
        exit();
    } else {
        echo "<div style=\"margin-left: 15px; color: green; font-size: 150%\">User: " .$row['first_name'].' '. $row['last_name'].', Email: '. $row['email'].',  
        completed registration.</div>';
    }
}
?>

</body>
</html>
















