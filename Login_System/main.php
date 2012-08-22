<?
include("include/session.php");
//include("include/database.php");
$i=0;
/**
 * Main.php
 *
 * This is an example of the main page of a website. Here
 * users will be able to login. However, like on most sites
 * the login form doesn't just have to be on the main page,
 * but re-appear on subsequent pages, depending on whether
 * the user has logged in or not.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 26, 2004
 */
?>
<script language="Javascript">
function validateChange(){
	input_box=confirm("Are you sure you want to change this restaurant/event?");
if (input_box==true)
{ 
// Output when OK is clicked
return true;
}

else
{
// Output when Cancel is clicked
return false;
}
}
</script>

<html>
<title>DoGo Deals Main Login Page</title>
<body>


<?
/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
 if($session->logged_in){
   echo "<h1>Logged In</h1>";
   echo "Welcome <b>$session->username</b>, you are logged in. <br><br>"
       ."[<a href=\"userinfo.php?user=$session->username\">My Account</a>] &nbsp;&nbsp;"
       ."[<a href=\"useredit.php\">Edit Account</a>] &nbsp;&nbsp;"
       ."[<a href=\"add_rest_events.php\">Add a Restaurant</a>] &nbsp;&nbsp;"
	   ."[<a href=\"main.php\">View/Edit a Restaurant or Event</a>] &nbsp;&nbsp;"
        ."[<a href=\"remove.php\">Remove Events</a>] &nbsp;&nbsp;"
        ."[<a href=\"add_event.php\">Add Event</a>] &nbsp;&nbsp;"
       ."[<a href=\"process.php\">Logout</a>] &nbsp;&nbsp;";
       echo "<br><br><b>Below are the Restaurants and associated promos you have entered. To change any information please adjust it accordingly and click the submit button below.</b><br>";
       
$results =  $database->getEvent($session->username);
?>
<table width="100%" cellspacing="10"><tr><td>
<?
// $results = $database->eventdata
while($row = mysql_fetch_array($results))
  {
  ++$i;
  $name = $row['rest_name'];
  	$add = $row['rest_address'];
	$phone=$row['rest_phone'];
	$email=$row['rest_email'];
	$cat= $row['rest_category'];
	$cuisine = $row['rest_cuisine'];
	$desc=$row['rest_desc'];
	$dow=$row['event_day_of_week'];
	$type=$row['event_type'];
	$start=$row['event_start_time'];
	$end=$row['event_end_time'];
	$e_cat=$row['event_category'];
	$e_id=$row['event_id'];

  
 ?>

 <form action="process.php" method="POST" onSubmit="return validateChange();">
<table align="left" border="2" cellspacing="0" cellpadding="3">
<tr><td>Restaurant Name </td><td><input type="text" name="r_name" value="<? echo $name; ?>"></td></tr>
<tr><td>Restaurant Address </td><td><input type="text" name="r_address" value="<? echo $add; ?>"></td></tr>
<tr><td>Restaurant Phone </td><td><input type="text" name="r_phone" value="<?echo $phone; ?>"></td></tr>
<tr><td>Restaurant Email </td><td><input type="text" name="r_email" value="<?echo $email; ?>"></td></tr>
<tr><td>Restaurant Category </td><td><input type="text" name="r_cat" value="<? echo $cat; ?>"></td></tr>
<tr><td>Restaurant Cuisine </td><td><input type="text" name="r_cuisine" value="<? echo $cuisine; ?>"></td></tr>
<tr><td>Restaurant Description </td><td><input type="text" name="r_desc" value="<?echo $desc; ?>"></td></tr>
<tr><td>Event Day </td><td><input type="text" name="e_day" value="<? echo $dow; ?>"></td></tr>
<tr><td>Event Type </td><td><input type="text" name="e_type" value="<? echo $type; ?>"></td></tr>
<tr><td>Event Start Time </td><td><input type="text" name="e_starttime" value="<? echo $start; ?>"></td></tr>
<tr><td>Event End Time </td><td><input type="text" name="e_endtime" value="<? echo $end; ?>"></td></tr>
<tr><td>Event Category </td><td><input type="text" name="e_cat" value="<? echo $e_cat; ?>"></td></tr>
<input type="hidden" name="event_id" value="<? echo $e_id; ?>">
<input type="hidden" name="subeditEvent" value="500">
<td align="center" valign="bottom"><input type="submit" value="Submit Change"></td>
</form></table></td><td>

<?php
 //echo "</table>";
// echo "</td><td>";
  if($i==3){
  echo "</tr><tr><td>";
  } 
  if($i>3 && !($i%3)){
  echo "</tr><tr><td>";
  }
  
   }   
/*
   <tr><td>Restaurant Phone </td><td><input type="text" name="Restaurant Phone" value=" <?echo $row['rest_phone']; ?>"></td></tr>
<tr><td>Event Day </td><td><input type="text" name="Event Day" value="<? echo$row['event_day_of_week']; ?>"></td></tr>
<tr><td>Event Type </td><td><input type="text" name="Event Type" value=" <? echo$row['event_type']; ?>"></td></tr>
<tr><td>Event Start Time </td><td><input type="text" name="Event Start Time" value="<? echo $row['event_start_time']; ?>"></td></tr>
<tr><td>Event End Time </td><td><input type="text" name="Event End Time" value="<? echo$row['event_end_time']; ?>"></td></tr>
<tr><td>Event Category </td><td><input type="text" name="Event Category" value="<? echo$row['event_category']; ?>"></td></tr>


  // }
  //echo "</table></tr></td><br><br>";
*/
//echo "</table></tr></td><br><br>";
}
else{

?>

<h1>Login</h1>
<?
/**
 * User not logged in, display the login form.
 * If user has already tried to login, but errors were
 * found, display the total number of errors.
 * If errors occurred, they will be displayed.
 */
if($form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font>";
}
?>
<form action="process.php" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr><td>Username:</td><td><input type="text" name="user" maxlength="30" value="<? echo $form->value("user"); ?>"></td><? echo $form->error("user"); ?></td></tr>
<tr><td>Password:</td><td><input type="password" name="pass" maxlength="30" value="<? echo $form->value("pass"); ?>"></td><td><? echo $form->error("pass"); ?></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="remember" <? if($form->value("remember") != ''){ echo "checked"; } ?>>
<font size="2">Remember me next time &nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="sublogin" value="1">
<input type="submit" value="Login"></td></tr>
<tr><td colspan="2" align="left"><br><font size="2">[<a href="forgotpass.php">Forgot Password?</a>]</font></td><td align="right"></td></tr>
<tr><td colspan="2" align="left"><br>Not registered? <a href="register.php">Sign-Up!</a></td></tr>
</table>
</form>

<?
}

/**
 * Just a little page footer, tells how many registered members
 * there are, how many users currently logged in and viewing site,
 * and how many guests viewing site. Active users are displayed,
 * with link to their user information.
 */
/*
*/
echo "</td></tr><tr><td align=\"center\"><br><br>";
echo "<b>Member Total:</b> ".$database->getNumMembers()."<br>";
echo "There are $database->num_active_users registered members and ";
echo "$database->num_active_guests guests viewing the site.<br><br>";

//echo "<br>";
//echo "<td align=\"left\" valign=\"bottom\">";
include("include/view_active.php");
?>

</table></tr></td>



</body>
</html>
