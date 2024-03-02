<?php
//Call from story05_write_msg.php
session_start();
date_default_timezone_set('America/North_Dakota/Center');

$receiver_name=$_POST['receiver_name'];
$author_email=$_POST['author_email'];

$receiver_full_name = explode(" ", $receiver_name);

$receiver_first_name=$receiver_full_name[0]; 
$receiver_last_name=$receiver_full_name[1]; 

$post_message=$_POST['post_message'];
$last_update=date("Ymd") . '-' .date("His");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Write a post to database</title>
<meta name="description" content="User Login">
<style>
table, th, td {
  border: 1px solid;
  border-collapse: collapse;
}
</style>
</head>
<body>

<?php
$Table_name='"ITSE-2374-APP-4"."USER_LIST"';
$host_name='dpg-cn3qb5qcn0vc738pmp7g-a.oregon-postgres.render.com';
$db_name='inew2374250spring24';
$user_name='inew2374250spring24_user';
$password='4i2U9tzMVYLGbj7ePpxmiyHr4oIflMf1';

$db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");
$result = pg_query($db,"SELECT * FROM $Table_name where email='".$author_email."'");
while ($row = pg_fetch_row($result)) {
        $author_first_name=$row[1];     
        $author_last_name=$row[2];  
        $author_email=$row[3];                   
}
pg_free_result($result);
pg_close($db);

$db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");
$result = pg_query($db,"SELECT * FROM $Table_name where first_name='".$receiver_first_name."' and last_name='".$receiver_last_name."'");
while ($row = pg_fetch_row($result)) {
        $receiver_first_name=$row[1];     
        $receiver_last_name=$row[2];  
        $receiver_email=$row[3];                   
}
pg_free_result($result);
pg_close($db);

echo "<br>From: $receiver_first_name $receiver_last_name, $receiver_email";
echo "<br>To: $author_first_name $author_last_name, $author_email";
echo "<br>Message: $post_message";

#---------------------------Save Message to database ----------------------------------------------
$Table_name='"ITSE-2374-APP-4"."INDIVIDUAL_MESSAGE"';
$db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");

$result = pg_query($db,"INSERT into $Table_name (author_first_name, author_last_name, author_email, receiver_first_name, receiver_last_name, receiver_email, post_message, last_update) VALUES ('$author_first_name', '$author_last_name', '$author_email','$receiver_first_name', '$receiver_last_name', '$receiver_email', '$post_message', '$last_update')");

pg_free_result($result);
pg_close($db);


#---------------------------Display All messages from the author to this receiver ----------------------------------------------
$db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");
$result = pg_query($db,"SELECT * FROM $Table_name where author_email='".$author_email."' and receiver_email='" .$receiver_email."' order by last_update desc ");

echo "<h4 style=\"margin-left: 15px;\">List of all messages from $author_first_name $author_last_name to $receiver_first_name $receiver_last_name </h4>";
echo "<table style=\"margin-left: 15px;\"><thead>";
echo "<tr>
    <th style=\"background:lightblue;\">ID</th>
    <th style=\"background:lightblue;\">Author</th><th style=\"background:lightblue;\">Receiver</th><th style=\"background:lightblue;\">Message</th>
    <th style=\"background:lightblue;\">Last_Update</th></tr></thead><tbody>";
            
$i=1;            
while ($row = pg_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td align='left' width='20'>" . $i . "</td>";
    echo "<td align='left' width='100'>" . $row['author_first_name'] .' '.$row['author_last_name'] . "</a></td>";
    echo "<td align='left' width='100'>" . $row['receiver_first_name'] .' '.$row['receiver_last_name'] . "</a></td>";
    echo "<td align='left' width='300'>" . $row['post_message'] . "</td>";
    echo "<td align='left' width='150'>" . $row['last_update'] . "</td>";
    echo "</tr>";
    $i=$i+1;
    } 
pg_free_result($result);
pg_close($db);             
?>
</tbody>
</table>
</body>
</html>