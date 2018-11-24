function drawLoginDivAuthed(name) {
  document.getElementById("logindiv").innerHTML='Welcome, '+name+'<br> <button class="button_bluetext" id="logoutev"  onclick="logoutf()">logout</button><br><div id="authsend"></div>';
}

function drawLoginDivAuthForm() {
  document.getElementById("logindiv").innerHTML='<form>    Login:<br>    <input type="text"><br>    Password:<br>    <input type="password"><br>  </form>  <div id="authsend"> <button onclick="authsendf()">Send</button> </div><br>  <a href="registration_form.php">register</a><br><br>  <div id="logoutev"></div>';
}

function logoutf() {
  $.post("http://localhost/main/logout",{
  } , onAjaxSuccess);

  function onAjaxSuccess(data) {
    drawLoginDivAuthForm();
    loadUsersTable();
  }
}

 function authsendf() {
  $.post("http://localhost/main/auth",{
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
  $.post("http://localhost/main/getuserstable",{
    orderw: 1
  } , onAjaxSuccess);

  function onAjaxSuccess(data) {
    document.getElementById("userstable").innerHTML=data;
  }
}

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
    $.post("http://localhost/main/getuserstable",{
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
    $.post("http://localhost/main/getuserstable",{
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

    function defaultDrawTable() {
      $.post("http://localhost/main/getuserstable",{
        orderw: 1
      } , onAjaxSuccess);

      function onAjaxSuccess(data) {
        document.getElementById("userstable").innerHTML=data;
      }
  }


    function deluser(del_user_id) {
      $.post("http://localhost/main/delete_user",{
        someid: del_user_id
      } , onAjaxSuccess);

      function onAjaxSuccess(data) {
        //alert(data);
        //location.reload();
      }
      document.getElementById("ti"+del_user_id).hidden=true;
    }
