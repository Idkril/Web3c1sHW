<html>
<link href="css/style.css" rel="stylesheet">

<?php

session_start();
if (isset($_SESSION['login']))
{
  echo 'Welcome,'.$_SESSION['login'];
  echo '<a href="logout.php">   logout</a>';
}
else
{
  echo '<form method="POST" action="auth.php">
    Login:<br>
    <input type="text" name="login"><br>
    Password:<br>
    <input type="password" name="password"><br>
    <input type="submit"><br>
  </form>
  <a href="registration_form.php">register</a><br><br>';
}
if (!isset($_SESSION['role']))
{
  $_SESSION['role']=0;
}
//call bd

include('DB_conn.php');
$res=mysqli_query($conn,"SELECT id,FirstName,LastName,Role,Photo FROM users");
echo '<table border="1">';

//switch to role depending draw
switch ($_SESSION['role'])
{
  case 0: //guest
    while ($row = mysqli_fetch_array($res))
    {
    echo '<tr>';

    echo '<td>';
    echo $row['id'];
    echo '</td>';

    echo '<td>';
    echo $row['FirstName'];
    echo '</td>';

    echo '<td>';
    echo $row['LastName'];
    echo '</td>';

    echo '<td>';
    switch($row['Role'])
    {
      case 1:
        echo 'User';
        break;
      case 2:
        echo 'Admin';
        break;
    }
    echo '</td>';

    echo '<td>';
    if ($row['Photo']=="0") {
      echo '<img class="img_userphoto_intable" src="img_userphoto/0.png" alt="Photo">';
    } else {
        echo '<img class="img_userphoto_intable" src="img_userphoto/'.$row['id'].$row['Photo'].'">';
    }
    echo '</td>';

    echo '</tr>';
    }
    break;

  case 1: //default user
    while ($row = mysqli_fetch_array($res))
    {
    echo '<tr>';

    echo '<td>';
    //echo $row['id'];
    echo '<form name="toprofile" method="post" action="profile.php">
    <input type="hidden" name="someid" value="'.$row['id'].'">
   <button>'.$row['id'].'</button>
   </form>';
    echo '</td>';

    echo '<td>';
    echo $row['FirstName'];
    echo '</td>';

    echo '<td>';
    echo $row['LastName'];
    echo '</td>';

    echo '<td>';
    switch($row['Role'])
    {
      case 1:
        echo 'User';
        break;
      case 2:
        echo 'Admin';
        break;
    }
    echo '</td>';

    echo '<td>';
    if ($row['Photo']=="0") {
      echo '<img class="img_userphoto_intable" src="img_userphoto/0.png" alt="Photo">';
    } else {
        echo '<img class="img_userphoto_intable" src="img_userphoto/'.$row['id'].$row['Photo'].'">';
    }
    echo '</td>';

    echo '</tr>';
    }
    break;

  case 2: //ADMIN
    while ($row = mysqli_fetch_array($res))
    {
    echo '<tr>';

    echo '<td>';
    //echo $row['id'];
    echo '<form name="toprofile" method="post" action="profile.php">
    <input type="hidden" name="someid" value="'.$row['id'].'">
   <button>'.$row['id'].'</button>
   </form>';
    echo '</td>';
    echo '</td>';

    echo '<td>';
    echo $row['FirstName'];
    echo '</td>';

    echo '<td>';
    echo $row['LastName'];
    echo '</td>';

    echo '<td>';
    switch($row['Role'])
    {
      case 1:
        echo 'User';
        break;
      case 2:
        echo 'Admin';
        break;
    }
    echo '</td>';

    echo '<td>';
    if ($row['Photo']=="0") {
      echo '<img class="img_userphoto_intable" src="img_userphoto/0.png" alt="Photo">';
    } else {
        echo '<img class="img_userphoto_intable" src="img_userphoto/'.$row['id'].$row['Photo'].'">';
    }
    echo '</td>';

    //admin options column
    echo '<td>';
    echo '<form name="callback" method="post" action="delete_user.php">
    <input type="hidden" name="someid" value="'.$row['id'].'">
   <button>X</button>
   </form>';
    echo '</td>';

    echo '</tr>';
    }
    break;
}
while ($row = mysqli_fetch_array($res))
{
  echo '<tr>';

  echo '<td>';
  echo $row['id'];
  echo '</td>';

  echo '<td>';
  echo $row['FirstName'];
  echo '</td>';

  echo '<td>';
  echo $row['LastName'];
  echo '</td>';

  echo '<td>';
  switch($row['Role'])
  {
    case 1:
      echo 'User';
      break;
    case 2:
      echo 'Admin';
      break;
  }
  echo '</td>';

  echo '</tr>';
}



?>
 </table>
</html>
