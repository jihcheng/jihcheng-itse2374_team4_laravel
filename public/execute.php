<?php

$level_1_menu=$_POST['menu'];
$_SESSION['level_1_menu']=$level_1_menu;

switch($level_1_menu){
    case 'New_User_Registration':
        include_once("story01_save_user_info.php");
    break;
    case 'User_Login':
        // include_once("story02_user_login.php"); //for user_story02
        include_once("story05_popup_menu.php"); //for user_story 2, 5
        // include_once("story6_popup_menu.php"); //for user_story 2, 5, 6, 7, 8
    break;
    default:

    break;
}
?>