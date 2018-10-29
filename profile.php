<html>
<link href="css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
 session_start();

 include('DB_conn.php');
 if (!$_POST['someid'])
 {
   header('Location: index.php');
 }
 $res=mysqli_query($conn,'SELECT * FROM users WHERE id='.$_POST['someid']);
 if ( mysqli_num_rows($res) > 0)
 {
   //check viewer is the ADMIN and check can/not edit
   echo '<div class="prof_information">';
   $row=mysqli_fetch_array($res);
   if ( $_SESSION['role']==2 ) {
     //all editable by admin
     echo '<form>
     Login: <br>
     <input type="text" value="'.$row['login'].'" class="colortext"><br>
     New Password: <br>
     <input type="password" class="colortext"><br>
     First Name: <br>
     <input type="text" value="'.$row['FirstName'].'" class="colortext"><br>
     Last Name: <br>
     <input type="text" value="'.$row['LastName'].'" class="colortext"><br>
     Role: <br>

     <select id="roleslct" size="1" name="role">
     <option ';
     if ($row['Role']==1) {
       echo 'selected';
     }
     echo ' value="1">User</option>
     <option ';
     if ($row['Role']==2) {
       echo 'selected';
     }
     echo ' value="2">Admin</option>
     </select><br>

     <div id="updsend"><input type="button" value="Отправить"></div>
     </form>

     <script>
     updsend.onclick = function(e) {
       $.post("http://localhost/update_profile_as_admin.php",{
         login: document.getElementsByTagName("input")[0].value,
         pwd: document.getElementsByTagName("input")[1].value,
         FirstName: document.getElementsByTagName("input")[2].value,
         LastName: document.getElementsByTagName("input")[3].value,
         role: document.getElementById("roleslct").options[document.getElementById("roleslct").selectedIndex].value,
         someid: '.$row['id'].'
       } , onAjaxSuccess);

       function onAjaxSuccess(data) {
        window.location.href="http://localhost/index.php";
       }
     }
     </script>';

     echo '</div>';
     /*--------------- IMG -----------*/
     echo '<div class="prof_imgupload">';
     if ($row['Photo']=="0") {
       echo '<img class="img_userphoto" id="img_ava" src="img_userphoto/0.png">';
     } else {
       echo '<img class="img_userphoto" id="img_ava" src="img_userphoto/'.$row['id'].$row['Photo'].'?'.time().'">';
     }
     echo '<br><br>
        <input id="sortpicture" type="file" name="sortpic" accept="image/*" />
        <button id="upload">Загрузить</button>';
     echo '</div>

     <script>
     $("#upload").on("click", function() {
    var file_data = $("#sortpicture").prop("files")[0];
    var form_data = new FormData();
    form_data.append("file", file_data);
    form_data.append("user_upd_id","'.$row['id'].'");
    $.ajax({
                url: "file-handler.php",
                dataType: "text",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: "post",
                success: function(php_script_response){
                    document.getElementById("img_ava").src="img_userphoto/'.$row['id'].$row['Photo'].'?"+new Date().getTime();
                    function updimgrt() {
                      document.getElementById("img_ava").src="img_userphoto/'.$row['id'].$row['Photo'].'?"+new Date().getTime();

                    }
                    setTimeout(updimgrt,5000);
                }
     });
});

     </script>';
     /*------------- ENDIMG -----------*/
   }
   elseif ($_SESSION['login']==$row['login']) {
     //editable
     echo '<form>
     Login: <br>
     <input type="text" value="'.$row['login'].'" readonly><br>
     New Password: <br>
     <input type="password" class="colortext"><br>
     First Name: <br>
     <input type="text" value="'.$row['FirstName'].'" class="colortext"><br>
     Last Name: <br>
     <input type="text" value="'.$row['LastName'].'" class="colortext"><br>
     Role: <br>
     <input type="text" value="';
     switch($row['Role'])
     {
       case 1:
         echo 'User';
         break;
       case 2:
         echo 'Admin';
         break;
     }
     echo '" readonly><br>
     <div id="updsend"><input type="button" value="Отправить"></div>
     </form>
     <script>
     updsend.onclick = function(e) {
       $.post("http://localhost/update_profile_as_user.php",{
         pwd: document.getElementsByTagName("input")[1].value,
         FirstName: document.getElementsByTagName("input")[2].value,
         LastName: document.getElementsByTagName("input")[3].value,
         someid: '.$row['id'].'
       } , onAjaxSuccess);

       function onAjaxSuccess(data) {
        window.location.href="http://localhost/index.php";
       }
     }
     </script>';


     echo '</div>';
     /*--------------- IMG -----------*/
     echo '<div class="prof_imgupload">';
     if ($row['Photo']=="0") {
       echo '<img class="img_userphoto" id="img_ava" src="img_userphoto/0.png">';
     } else {
       echo '<img class="img_userphoto" id="img_ava" src="img_userphoto/'.$row['id'].$row['Photo'].'?'.time().'">';
     }
     echo '<br><br>
        <input id="sortpicture" type="file" name="sortpic" accept="image/*" />
        <button id="upload">Загрузить</button>';
     echo '</div>

     <script>
     $("#upload").on("click", function() {
    var file_data = $("#sortpicture").prop("files")[0];
    var form_data = new FormData();
    form_data.append("file", file_data);
    form_data.append("user_upd_id","'.$row['id'].'");
    $.ajax({
                url: "file-handler.php",
                dataType: "text",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: "post",
                success: function(php_script_response){
                    document.getElementById("img_ava").src="img_userphoto/'.$row['id'].$row['Photo'].'?"+new Date().getTime();
                    function updimgrt() {
                      document.getElementById("img_ava").src="img_userphoto/'.$row['id'].$row['Photo'].'?"+new Date().getTime();

                    }
                    setTimeout(updimgrt,5000);
                }
     });
});

     </script>';
     /*------------- ENDIMG -----------*/
   }
   else {
      //not editable.
     echo '<form>
     Login: <br>
     <input type="text" value="'.$row['login'].'" readonly><br>
     First Name: <br>
     <input type="text" value="'.$row['FirstName'].'" readonly><br>
     Last Name: <br>
     <input type="text" value="'.$row['LastName'].'" readonly><br>
     Role: <br>
     <input type="text" value="';
     switch($row['Role'])
     {
       case 1:
         echo 'User';
         break;
       case 2:
         echo 'Admin';
         break;
     }
     echo '" readonly><br>
     </form>
     <br> <a href="index.php">Back</a>';

     echo '</div>';

     /*--------------- IMG -----------*/
     echo '<div class="prof_imgupload">';
     if ($row['Photo']=="0") {
       echo '<img class="img_userphoto" id="img_ava" src="img_userphoto/0.png">';
     } else {
       echo '<img class="img_userphoto" id="img_ava" src="img_userphoto/'.$row['id'].$row['Photo'].'?'.time().'">';
     }
    // echo '<br><br>
  //      <input id="sortpicture" type="file" name="sortpic" accept="image/*" />
    //    <button id="upload">Загрузить</button>';
     echo '</div>';
      /*---------------END IMG -----------*/
   }

 }
?>
</html>
