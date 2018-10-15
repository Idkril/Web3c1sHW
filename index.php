<html>
<link href="css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div id="header">
  <div class="floatingblocks">
    <a href="index.php">USERS</a>
  </div>


  <div class="floatingblocks">
    <a href="audioVideo.php">AUDIO&VIDEO</a>
  </div>

  <div class="floatingblocks">
    <a href="canvas.php">CANVAS</a>
  </div>
</div>
<?php

session_start();
if (isset($_SESSION['login']))
{
  echo 'Welcome,'.$_SESSION['login'].'     ';
  echo '<a href="logout.php" id="logoutev">   logout</a>';
  echo '
  <script>
  logoutev.onclick = function(e) {
    $.post("http://localhost/logout.php",{
    } , onAjaxSuccess);

    function onAjaxSuccess(data) {
      window.location.reload();
    }
  }
  </script>';
}
else
{
  echo '<form>
    Login:<br>
    <input type="text"><br>
    Password:<br>
    <input type="password"><br>
    <div id="authsend"> <input type="submit"> </div><br>
  </form>
  <a href="registration_form.php">register</a><br><br>
  <script>
  authsend.onclick = function(e) {
    $.post("http://localhost/auth.php",{
      login: document.getElementsByTagName("input")[0].value,
      password: document.getElementsByTagName("input")[1].value
    } , onAjaxSuccess);

    function onAjaxSuccess(data) {
      alert(data);
    }
  }
  </script>';
}
if (!isset($_SESSION['role']))
{
  $_SESSION['role']=0;
}

include('DB_conn.php');
$res=mysqli_query($conn,"SELECT id,FirstName,LastName,Role,Photo FROM users");
echo '
<button onclick="reverseTable()">ezbutton</button>
<script>
  function reverseTable() {
    var table=document.getElementById("userstable");
    var tmprow,row;
    for (var i=0; i < table.rows.length/2; i++) {
      tmprow = table.rows[table.rows.length-1-i].innerHTML;
      table.rows[table.rows.length-1-i].innerHTML = table.rows[i].innerHTML;
      table.rows[i].innerHTML=tmprow;
    }
  }
</script>
';
echo '<table id="userstable" border="1">';

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
  echo '<script>
    function deluser(del_user_id) {
      $.post("http://localhost/delete_user.php",{
        someid: del_user_id
      } , onAjaxSuccess);

      function onAjaxSuccess(data) {
        alert(data);
        location.reload();
      }
    }
  </script>';

    while ($row = mysqli_fetch_array($res))
    {
    echo '<tr>';

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
 </table>
</html>
