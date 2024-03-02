<?php
session_start();

$level_1_menu=$_GET['level_1_menu'];
$_SESSION['level_1_menu']=$level_1_menu;

switch($level_1_menu){
    case 'New_User_Registration':
?>
    <fieldset style="position: relative;  top: -8px ;left:4px; font-size:85%;"><legend><?php echo str_replace("_"," ",$level_1_menu);?></legend>
    <label style="color:blue">Enter Your Name
    <a href="#" title="Max 20/20 characters for first and last name. No space is allowed."><i style="font-size:60%" class="twa twa-2x twa-question-mark"></i></a>
    </label><br>
    First_Name: <input id="user_first_name" size="20" type="text" maxlength="30" name="user_first_name"/><br>
    Last_Name:<span style="margin-left:2px"></span> <input id="user_last_name" size="20" type="text" maxlength="30" name="user_last_name"/><br>

    <label style="color:blue;relative;  top: 6px;">Enter Your email
    <a href="#" title="Max 30 characters for an email address"><i style="font-size:60%" class="twa twa-2x twa-question-mark"></i></a>
    </label><br>
    <input id="user_email" size="30" type="email" maxlength="30" name="user_email"/><br>

    <label style="color:blue;relative;  top: 6px;">Enter Your Password
    <a href="#" title="A password must be between 8 and 20 characters long and must contain at least one uppercase letter, one lowercase letter, and one number"><i style="font-size:60%" class="twa twa-2x twa-question-mark"></i></a></label>
    <input id="user_password" size="20" type="password" maxlength="20" name="user_password"/><br>

    <input style="width: 80px; position: relative;  top: 6px;left:20px;" type="reset" name="reset" id="myreset" value="Reset" />
    &nbsp;&nbsp;			
    <input style="width: 80px; position: relative;  top: 6px;left:20px;" type="submit" name="submit" id="mysubmit" value="Submit" /> 
    </fieldset>
<?php
    break;
    case 'User_Login':
?>
    <fieldset style="position: relative;  top: -8px ;left:4px; font-size:85%;"><legend><?php echo str_replace("_"," ",$level_1_menu);?></legend>
    <label style="color:blue;relative;  top: 6px;">Enter Your email
    <a href="#" title="Max 30 characters for an email address"><i style="font-size:60%" class="twa twa-2x twa-question-mark"></i></a>
    </label><br>
    <input id="user_email" size="30" type="email" maxlength="30" name="user_email"/><br>

    <label style="color:blue;relative;  top: 6px;">Enter Your Password
    <a href="#" title="A password must be between 8 and 20 characters long and must contain at least one uppercase letter, one lowercase letter, and one number"><i style="font-size:60%" class="twa twa-2x twa-question-mark"></i></a></label>
    <input id="user_password" size="20" type="password" maxlength="20" name="user_password"/><br>

    <input style="width: 80px; position: relative;  top: 6px;left:20px;" type="reset" name="reset" id="myreset" value="Reset" />
    &nbsp;&nbsp;			
    <input style="width: 80px; position: relative;  top: 6px;left:20px;" type="submit" name="submit" id="mysubmit" value="Submit" /> 
    </fieldset>
<?php

    break;

    default:
        echo "Hello";

    break;



}

?>