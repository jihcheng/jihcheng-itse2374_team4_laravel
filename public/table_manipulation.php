<?php
//PHP method to manipulate table
session_start();
date_default_timezone_set('America/North_Dakota/Center');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User List</title>
<meta name="description" content="PostGreSQL table manipulation">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.4.0/paper/bootstrap.min.css">
<style>
table, th, td {
  border: 1px solid;
  border-collapse: collapse;
}
</style>
</head>
<body>

<h4 style="margin-left: 15px;">PostGreSQL table manipulation</h4>
<?php

$host_name='dpg-cn3qb5qcn0vc738pmp7g-a.oregon-postgres.render.com';
$db_name='inew2374250spring24';
$user_name='inew2374250spring24_user';
$password='4i2U9tzMVYLGbj7ePpxmiyHr4oIflMf1';
$db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");

//-----------------Change table name accordingly--------------------------------------------
$Table_name='"ITSE-2374-APP-4"."GROUP_LIST"'; //Update this table name for new table
//-----------------To create a new table ----------------------------------------

$result = pg_query($db,"CREATE TABLE IF NOT EXISTS $Table_name (
    id SERIAL PRIMARY KEY,
    GROUP_NAME CHARACTER VARYING(30) NOT NULL UNIQUE,
    OWNER_EMAIL CHARACTER VARYING(100) NOT NULL ,
    MEMBER_EMAIL CHARACTER VARYING(11000) NOT NULL ,
    DATE_CREATE VARCHAR (20) NOT NULL,
    DATE_LAST_UPDATE VARCHAR (20) NOT NULL);");

//-----------------To drop a table----------------------------------------
// $result = pg_query($db,"DROP TABLE $Table_name");

//-----------------To delete data in a table----------------------------------------
// $result = pg_query($db,"DELETE FROM $Table_name where 1=1");

pg_free_result($result);
pg_close($db);

?>
</body>
</html>