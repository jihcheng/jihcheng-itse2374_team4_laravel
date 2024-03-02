<?php
//Call from story05_popup_menu.php
//Reference: https://www.youtube.com/watch?v=3JrBdurwlXo
//Reference: https://github.com/mervick/emojionearea

date_default_timezone_set('America/North_Dakota/Center');
$receiver_name=$_GET['name'];
$author_email=$_GET['author_email'];

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

echo "To: $receiver_name <br>";
echo "From: $author_first_name $author_last_name<br>";

?>


<html>
<head>
<title>Post a message</title>
<link rel="stylesheet" href="emojionearea-master/dist/emojionearea.min.css"> 
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous">
</script>
<script src="emojionearea-master/dist/emojionearea.min.js"></script>

</head>
<body>
<form action="story05_save_msg.php" method="POST" name="form2" target="_self" >
    <textarea id="post_area" style="display: none;" name="post_message"></textarea>
    <input type="hidden" id="receiver_name" name="receiver_name" value="<?php echo $receiver_name;?>">
    <input type="hidden" id="author_email" name="author_email" value=<?php echo $author_email;?>>
    <script>
        $(document).ready(function() {
            $("#post_area").emojioneArea({pickerPosition: "bottom"});
        })
    </script>
    <input style="width: 80px; position: relative;  top: 6px;left:20px;" type="submit" name="submit" id="mysubmit" value="Send" /> 
</form>		
    
</body>
</html>

