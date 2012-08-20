<?php
/*function nav(){
	//checks if username AND admin cookies are set, means admin is logged on so includes navigation for admins
	if ((isset($_COOKIE["username"])) && (isset($_COOKIE["admin"])))
	{ include("navadmin.php"); }
	else if (isset($_COOKIE["username"])) //checks if username is set, so includes navigation for users
	{ include("nav.php"); }
	else // nothing set so user not logged in
	{ include("navlogout.php"); }
}*/

function panel(){
	if (!isset($_COOKIE['username'])){
		echo "<button class='cpbutton' onclick='ldialog()'>Log In</button>
		<div id='loginDialog'>
		  <form action='login.php' method='post'><table>
		    <tr><td>Username:&nbsp;</td> <td><input type='text' id='username' name='username' /></td></tr>
		    <tr><td>Password:&nbsp;</td> <td><input type='password' id='password' name='password' required /></td></tr>
		    <tr><td><button type='submit'>Log In</button></td></tr></table></form>
		</div>

		<button class='cpbutton' onclick='rdialog()'>Register</button>
		<div id='registerDialog'>
		  <form action='register.php' method='post'><table>
		    <tr><td>Username:&nbsp;</td> <td><input type='text' id='username' name='username' required /></td></tr>
		    <tr><td>Email:&nbsp;</td> <td><input type='email' id='email' name='email' required /></td></tr>
		    <tr><td>Password:&nbsp;</td> <td><input type='password' id='password' name='password' required /></td></tr>
		    <tr><td><button type='submit'>Register</button></td></tr></table></form>
		</div>";
	} 
	else{ 
		echo "<button onclick='logout()'>Log out</button>&nbsp;&nbsp;
		Logged on as:&nbsp;".$_COOKIE['username']."&nbsp;&nbsp";
	}
}



?>