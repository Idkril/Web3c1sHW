

<div id="header">
  <div class="floatingblocks">
    <a href="/main">USERS</a>
  </div>


  <div class="floatingblocks">
    <a href="/media">AUDIO&VIDEO</a>
  </div>

  <div class="floatingblocks">
    <a href="/canvas">CANVAS</a>
  </div>
</div>

<div id="logindiv">

<?php
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
  <a href="/register">register</a><br><br>
  <div id="logoutev"></div>
  ';
  echo '</div>';
}
?>

<button onclick="reverseTable()">ezbutton</button>
<button onclick="orderById()">by id</button>
<button onclick="orderByName()">by name</button>

<table id="userstable" border="1">
</table>

<script>
loadUsersTable();
</script>
