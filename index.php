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

<script src="/js/mainindex.js"></script>
<script>
function logoutf() {
  $.post("http://localhost/logout.php",{
  } , onAjaxSuccess);

  function onAjaxSuccess(data) {
    drawLoginDivAuthForm();
    loadUsersTable();
  }
}

 function authsendf() {
  $.post("http://localhost/auth.php",{
    login: document.getElementsByTagName("input")[0].value,
    password: document.getElementsByTagName("input")[1].value
  } , onAjaxSuccess);

  function onAjaxSuccess(data) {
    if (data!=1) {
      drawLoginDivAuthed(data);
      loadUsersTable();
    } else {
       document.getElementsByTagName("input")[0].value="";
       document.getElementsByTagName("input")[1].value="";
    }
  }
}

function loadUsersTable() {
  $.post("http://localhost/getuserstable.php",{
    orderw: 1
  } , onAjaxSuccess);

  function onAjaxSuccess(data) {
    document.getElementById("userstable").innerHTML=data;
  }
}
</script>

<div id="logindiv">
<?php

session_start();
if (isset($_SESSION['login']))
{
  echo 'Welcome,'.$_SESSION['login'].'     <br>
  <button class="button_bluetext" id="logoutev" onclick="logoutf()">logout</button><br>
  <div id="authsend"></div></div>';
}
else
{
  echo '
  <form>
    Login:<br>
    <input type="text"><br>
    Password:<br>
    <input type="password"><br>
  </form>
  <div id="authsend"> <button onclick="authsendf()">Send</button> </div><br>
  <a href="registration_form.php">register</a><br><br>
  <div id="logoutev"></div>
  ';
  echo '</div>';
}
if (!isset($_SESSION['role']))
{
  $_SESSION['role']=0;
}

include('DB_conn.php');
$res=mysqli_query($conn,"SELECT id,FirstName,LastName,Role,Photo FROM users");
echo '
<button onclick="reverseTable()">ezbutton</button>
<button onclick="orderById()">by id</button>
<button onclick="orderByName()">by name</button>
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

  var orderwayID=0; //0= 3->2->1      1= 1->2->3
  var orderwayNAME=2; //2 = 1->2->3      3 = 3->2->1
  function orderById() {
    $.post("http://localhost/getuserstable.php",{
      orderw: orderwayID
    } , onAjaxSuccess);

    function onAjaxSuccess(data) {
      document.getElementById("userstable").innerHTML=data;
      if (orderwayID==0) {
        orderwayID=1;
      } else {
        orderwayID=0;
      }

    }
  }

  function orderByName() {
    $.post("http://localhost/getuserstable.php",{
      orderw: orderwayNAME
    } , onAjaxSuccess);

    function onAjaxSuccess(data) {
      document.getElementById("userstable").innerHTML=data;
      if (orderwayNAME==2) {
        orderwayNAME=3;
      } else {
        orderwayNAME=2;
      }

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
        //alert(data);
        //location.reload();
      }
      document.getElementById("ti"+del_user_id).hidden=true;
    }
  </script>';

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
 </table>
</html>
