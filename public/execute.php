<?php

$level_1_menu=$_POST['menu'];
$_SESSION['level_1_menu']=$level_1_menu;


switch($level_1_menu){
    case 'New_User_Registration':
        include_once("story01_save_user_info.php");
    break;
    case 'Manage_Individual_Message':
        // include_once("story02_user_login.php"); //for user_story02
        include_once("story05_popup_menu.php"); //for user_story 2, 5
        // include_once("story06_popup_menu.php"); //for user_story 2, 5, 6, 7, 8
    break;
    case 'Manage_Group_Message':
        $manage_group_option=$_POST['manage_group_option'];
        $user_email=$_POST['user_email'];

        switch($manage_group_option){
            case 'Create_Group':
                include_once("story09_create_group.php");
            break;
            case 'List_Group':
                include_once("story10_list_group.php");
            break;

            default:

            break;
            }
    break;
    default:

    break;
}
?>