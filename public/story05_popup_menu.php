<?php
//call from execute.php
//Reference: https://www.jqueryscript.net/menu/inline-context-menu-np.html
$author_email=$_POST['user_email'];
$user_password=$_POST['user_password'];

?>
<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Users List</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.4.0/paper/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <link rel="stylesheet" href="inline-context-menu-np/sample/css/main.css">
    <style>
        table, th, td {
        border: 1px solid;
        border-collapse: collapse;
        }
    </style>
</head>
<body>
    <?php
    $host_name='dpg-cn3qb5qcn0vc738pmp7g-a.oregon-postgres.render.com';
    $db_name='inew2374250spring24';
    $user_name='inew2374250spring24_user';
    $password='4i2U9tzMVYLGbj7ePpxmiyHr4oIflMf1';
    $Table_name='"ITSE-2374-APP-4"."USER_LIST"';

    $db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");

    $result = pg_query($db,"SELECT * FROM $Table_name where email='".$author_email."' and password='".$user_password."' LIMIT 1");
    
    if (pg_num_rows($result) == 0) {
        echo "<div style=\"margin-left: 15px; color: red; font-size: 150%\">Hi, there is no record for email/password you just entered. <br>Please make sure you entered the correct email/password.
        <br>If you have not registered, please register via 'New User Registration' option. Thanks.</div>";
        pg_free_result($result);
        pg_close($db);
        exit();
    } else {
        $row = pg_fetch_assoc($result);
        if ($row['validation_status']=='NO') {
            echo "<div style=\"margin-left: 15px; color: red; font-size: 150%\">User: " .$row['first_name'].' '. $row['last_name'].', Email: '. $row['email'].',  
            Please check your email and follow the instructions to complete registration first.</div>';
            echo "<br />\n";
            pg_free_result($result);
            pg_close($db);
            exit();
        } else {
            echo "<h4 style=\"margin-left: 15px;\">Right click a name to post a message to that user</h4>";
            pg_free_result($result);
            pg_close($db);
            
            $db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");
            $result = pg_query($db,"SELECT * FROM $Table_name order by first_name");
            
    ?>

            <!-- <h4 style="margin-left: 15px;">List of all users in the table <span style="color:green">(right click a name to post a message to that user)</span></h4> -->

            <table id="myTable" class="table-hover" style="margin-left: 15px;">
                <thead>
                    <?php
                    echo "<tr>
                    <th style=\"background:lightblue; color:black; \">ID</th>
                    <th style=\"background:lightblue; color:black; \">Name</th>
                    <th style=\"background:lightblue; color:black; \">Email</th>
                    <th style=\"background:lightblue; color:black; \">Validated</th>
                    <th style=\"background:lightblue; color:black; \">Last_Update</th></tr>";

                    ?>
                </thead>
                <tbody>

                <?php
                    $i=1;
                    while($row=pg_fetch_assoc($result)){
                        $bk_color=($row['validation_status']=='NO')?'lightgray':(($author_email==$row['email'])?'lightgreen':'Bisque');
                        echo "<tr style=\"background:$bk_color\">";
                        echo "<td class=\"nr\" style=\"color:black; \" align='left' width='20'>" . $i . "</td>";
                        if ($row['validation_status']=='YES') {
                            echo "<td class=\"name\" style=\"color:black; \" align='left' width='200'>" . $row['first_name'] .' '.$row['last_name'] . "</td>";
                            
                        } else {
                            echo "<td style=\"color:black; \" align='left' width='200'>" . $row['first_name'] .' '.$row['last_name'] . "</td>";
                        }
                        echo "<td style=\"color:black; \" align='left' width='200'>" . $row['email'] . "</td>";
                        echo "<td style=\"color:black; \" align='left' width='100'>" . $row['validation_status'] . "</td>";
                        echo "<td style=\"color:black; \" align='left' width='150'>" . $row['last_update'] . "</td>";
                        echo "</tr>";
                        $i=$i+1;
                        } 
                    pg_free_result($result);
                    pg_close($db);       
                ?>
                </tbody>
            </table>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

            <ul id="contextDynamicMenu" class="dropdown-menu" role="menu" style="display:none"></ul>

            <script src="inline-context-menu-np/sample/js/jquery.npContextMenu.js"></script>
            <script>
                $( document ).ready(function() {
                    console.log( "ready!" );
        
                    $("p").on("click contextmenu", function(e){
                        var c = 'xxx';
                        $("#superMenu").trigger("npmenu:show",e);
                    });

                    //Reference: https://stackoverflow.com/questions/4068373/center-a-popup-window-on-screen
                    function popupWindow(url, windowName, win, w, h) {
                        const y = win.top.outerHeight / 2 + win.top.screenY - ( h / 2);
                        const x = win.top.outerWidth / 2 + win.top.screenX - ( w / 2);
                        return win.open(url, windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`);
                    }

                    var saySelected = function ($invokedOn, $selectedMenu) {
                        // parent.pages.location="story04_write_msg.php?author_email=<?php echo $author_email;?>&name="+$invokedOn.text();
                        popupWindow("story05_write_msg.php?author_email=<?php echo $author_email;?>&name="+$invokedOn.text(), 'Post a message', window, 800, 600);
                    }
                    $("#myTable tbody td.name").npContextMenu({
                        menuSelector: "#contextDynamicMenu",
                        dynamicContent: function($invokedOn) {
                            var html_link='story05_write_msg.php?name='+$invokedOn.text();
                            return '<li><a tabindex="-1" href="'+html_link+'" npaction=" ">Post a message to '+$invokedOn.text()+'</a></li>';                    
                        },
                        onMenuOptionSelected: function ($invokedOn, $selectedMenu) {
                            saySelected($invokedOn, $selectedMenu);
                        },
                        onMenuShow: function($invokedOn) {
                            $invokedOn.addClass("success");
                        },
                        onMenuHide: function($invokedOn) {
                            $invokedOn.removeClass("success");
                        }
                    });


                });

            </script>


        </body>
        </html>
<?php     
        }
    }
?>    