<?php
	session_start();
	date_default_timezone_set('America/North_Dakota/Center');
	$host_name='dpg-cn3qb5qcn0vc738pmp7g-a.oregon-postgres.render.com';
	$db_name='inew2374250spring24';
	$user_name='inew2374250spring24_user';
	$password='4i2U9tzMVYLGbj7ePpxmiyHr4oIflMf1';
?>
<!DOCTYPE HTML>
<html>

<head>

	<title>ITSE2374 Team 4</title>
	<meta charset="UTF-8">
	<meta name="keywords" content="ITSE2374 Team 4">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!----Reference: http://readwrite.com/2014/11/11/how-to-use-emoji-in-the-browser-window -->
	<!----retain this for credit: https://github.com/twitter/twemoji  https://github.com/iamludal/twemoji-awesome-->
	<!----refer http://www.emoji-cheat-sheet.com/  for icon name ------------->
	<link rel="stylesheet" href="twemoji-awesome-master/twemoji-awesome.css">
	
	<meta name="description" content="ITSE2374 Team 4"/>
	<meta name="keywords" content="Jack Chao"/>
	<meta name="author" content="Jack Chao"/>
	
	<style type="text/css">
		html {
			display: table;
			margin: auto;
		}

		body {
			display: table-cell;
			vertical-align: middle;
			background-color: #f0ebfa;
			font-family: calibri, arial, helvetica, cursive;
		}
		#mysubmit{color: black; background-color: #99ff33}
		#myreset{color: black; background-color: #grayee}
		fieldset {margin-bottom: 7px; padding: 7px; }
		#desc {font-size:90%;}
		fieldset {width: 250px; border-color:gray; border-style: solid;}
		.center {
			margin: auto;
			width: 60%;			
			padding: 5px;
		}
        .ui-datepicker {
			width: 216px;
			height: auto;
			margin: 5px auto 0;
			font: 9pt Arial, sans-serif;
			-webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
			-moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
			box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
		}
		.ui-datepicker table {
			width: 100%;
		}
        
		.ui-tooltip, .arrow:after {
			background: cyan;
			border: 2px solid white;
		}
		 .ui-tooltip {
			padding: 10px 20px;
			color: blue;
			background-color: #ffffcc;
			border-radius: 20px;
			font: 12px "Helvetica Neue", Sans-Serif;
			
			box-shadow: 0 0 7px black;
		}
		.arrow {
			width: 70px;
			height: 16px;
			overflow: hidden;
			position: absolute;
			left: 50%;
			margin-left: -35px;
			bottom: -16px;
		}
		.arrow.top {
			top: -16px;
			bottom: auto;
		}
		.arrow.left {
			left: 20%;
		}
		.arrow:after {
			content: "";
			position: absolute;
			left: 20px;
			top: -20px;
			width: 25px;
			height: 25px;
			box-shadow: 6px 5px 9px -9px black;
			-webkit-transform: rotate(45deg);
			-ms-transform: rotate(45deg);
			transform: rotate(45deg);
		}
		.arrow.top:after {
			bottom: -20px;
			top: auto;
		}		  
		a:link {
			text-decoration: none;
			color: black;
		}
		
    </style>

    <script type="text/javascript">

        $(function() {
            $( document ).tooltip({
                position: {
                    my: "center bottom-20",
                    at: "center top",
                    using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                        .addClass( "arrow" )
                        .addClass( feedback.vertical )
                        .addClass( feedback.horizontal )
                        .appendTo( this );
                    }
                }
                });
        });

		function call_level_2_menu(val) {
			if(document.getElementById('New_User_Registration').checked || document.getElementById('Manage_Individual_Message').checked || document.getElementById('Manage_Group_Message').checked) {
				const xhttp = new XMLHttpRequest();
				xhttp.onload = function() {
					document.getElementById("level_2_list").innerHTML = this.responseText;
					document.getElementById("group-list").innerHTML = '';
				}
				xhttp.open("GET", "level_2_menu.php?level_1_menu="+val);
				xhttp.send();
			} 
			else if (document.getElementById('List_All_User_Accounts').checked) {
				document.getElementById("level_2_list").innerHTML = '';
				document.getElementById("group-list").innerHTML = '';
				parent.pages.location="story04_list_all_accounts.php";
			}
		}

		function group_message_next(val) {

			var user_email=document.getElementById('user_email').value.trim();
			var user_password=document.getElementById('user_password').value.trim();

			const xhttp = new XMLHttpRequest();
				xhttp.onload = function() {
					document.getElementById("group-list").innerHTML = this.responseText;
				}
				xhttp.open("GET", "story09_group_dropdown.php?user_email="+user_email+"&user_password="+user_password);
				xhttp.send();
		}

        function ValidateName() {		
	        var user_first_name=document.getElementById('user_first_name').value.trim();
			var user_last_name=document.getElementById('user_last_name').value.trim();
            if (user_first_name.length==0 || user_last_name.length==0 || user_first_name.includes(' ') || user_last_name.includes(' ')) {
                alert("Please enter your first and last name and make sure no space");
                   return false;
            } else {
                return true;
            }

        }
//Reference: https://www.simplilearn.com/tutorials/javascript-tutorial/email-validation-in-javascript 
        function ValidateEmail() {
            if (ValidateName()) {
                var user_email=document.getElementById('user_email').value.trim();				
                var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                if (user_email.match(validRegex)) {
					<?php 
                    $Table_name='"ITSE-2374-APP-4"."USER_LIST"';
                    $db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");
                    $result = pg_query($db,"SELECT email FROM $Table_name");                    
                  ?>
                  if (<?php echo pg_num_rows($result);?>==0) return true;
				  else {
					<?php
                      while($row=pg_fetch_assoc($result)){
                    ?>
                      if(user_email.toUpperCase()=="<?php echo strtoupper($row['email']);?>") {
                          alert('Email:'+user_email+' is already in Database. Most likely you have registered!');
                          return false;                                                   
                      } 
                    <?php  
                      }
					?>                    
                    return true; 
				  } 
				  <?php                    
				  pg_free_result($result);
				  pg_close($db);                  
				  ?>  
                } else {
                    alert("Invalid email address!");
                    return false;
                }
            } else return false;
        }
//Reference: https://www.w3resource.com/javascript/form/password-validation.php
        function CheckPassword() { 
            if(ValidateEmail()) {
                var user_password=document.getElementById('user_password').value.trim();
                var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
                if(user_password.match(passw)) {                 
                    return true;
                } else { 
                    alert('Password '+user_password+' does not meet criteria! Please try again.')
                    return false;
                }
            } else return false;
        }
		
	  //=============================================================================================================	
        function startForm(){				
			document.forms[0].onsubmit = CheckPassword;
			document.forms[0].onreset = resetForm1;
		}
		
		function resetForm1(){
			parent.left_top.location = "index_left.php";
			parent.pages.location = "welcome.php";
		}
    </script>
</head>

<body onload="startForm()" >
<h3 style="position: relative;  left:4px;">Collin College 2024 Spring <br> ITSE2374 Team 4 <br> (PHP+Python Framework)</h3>
<form action="execute.php" method="POST" name="form1" target="pages" >
	<fieldset style="position: relative;  top: -8px ;left:4px; font-size:85%;"><legend>Menu</legend>
		<input id="New_User_Registration" type="radio" name="menu" value="New_User_Registration" onchange="call_level_2_menu(this.value)" /><label>New User Registration</label><br>
		<input id="Manage_Individual_Message" type="radio" name="menu" value="Manage_Individual_Message" onchange="call_level_2_menu(this.value)" /><label>Manage Individual Messages</label><br>
		<input id="Manage_Group_Message" type="radio" name="menu" value="Manage_Group_Message" onchange="call_level_2_menu(this.value)" /><label>Manage Group Messages</label><br>
		<input id="List_All_User_Accounts" type="radio" name="menu" value="List_All_User_Accountsn" onchange="call_level_2_menu(this.value)" /><label>List All User Accounts</label><br>
	</fieldset>
	<div id="level_2_list"></div>
	<div id="group-list"></div>
</form>
</body>

</html>