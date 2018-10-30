
<?php
session_start();
$orderw=$_POST['orderw'];

include('DB_conn.php');

//0 = by id 3->2->1
//1 = by id 1->2->3
//2 = by name 1->2->3
//3 = by name 3->2->1

$res;
switch ($orderw) {
  case 0:
    $res=mysqli_query($conn,'SELECT id,FirstName,LastName,Role,Photo FROM users ORDER BY id DESC');
    break;
  case 1:
    $res=mysqli_query($conn,'SELECT id,FirstName,LastName,Role,Photo FROM users');
    break;
  case 2:
    $res=mysqli_query($conn,'SELECT id,FirstName,LastName,Role,Photo FROM users ORDER BY FirstName');
    break;
  case 3:
    $res=mysqli_query($conn,'SELECT id,FirstName,LastName,Role,Photo FROM users ORDER BY FirstName DESC');
    break;
}

if (!isset($_SESSION['role']))
{
  $_SESSION['role']=0;
}

switch ($_SESSION['role']) {
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
        echo '<img class="img_userphoto_intable" src="img_userphoto/'.$row['id'].$row['Photo'].'?'.time().'">';
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
   <button class="button_bluetext">'.$row['id'].'</button>
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
        echo '<img class="img_userphoto_intable" src="img_userphoto/'.$row['id'].$row['Photo'].'?'.time().'">';
    }
    echo '</td>';

    echo '</tr>';
    }
    break;

  case 2: //ADMIN

    while ($row = mysqli_fetch_array($res))
    {
    echo '<tr id="ti'.$row['id'].'">';

    echo '<td>';
    echo '<form name="toprofile" method="post" action="profile.php">
    <input type="hidden" name="someid" value="'.$row['id'].'">
   <button class="button_bluetext">'.$row['id'].'</button>
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
        echo '<img class="img_userphoto_intable" src="img_userphoto/'.$row['id'].$row['Photo'].'?'.time().'">';
    }
    echo '</td>';

    echo '<td>';
    echo '<button class="button_bluetext" onclick="deluser('.$row['id'].')">X</button>';

    echo '</td>';

    echo '</tr>';
    }
    break;
}

?>
