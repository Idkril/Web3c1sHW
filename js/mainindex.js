function drawLoginDivAuthed(name) {
  document.getElementById("logindiv").innerHTML='Welcome, '+name+'<br> <button class="button_bluetext" id="logoutev"  onclick="logoutf()">logout</button><br><div id="authsend"></div>';
}

function drawLoginDivAuthForm() {
  document.getElementById("logindiv").innerHTML='<form>    Login:<br>    <input type="text"><br>    Password:<br>    <input type="password"><br>  </form>  <div id="authsend"> <button onclick="authsendf()">Send</button> </div><br>  <a href="registration_form.php">register</a><br><br>  <div id="logoutev"></div>';
}
