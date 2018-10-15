
<?php
 $dbhost='localhost:3306';
 $dbuser='WebDes';
 $dbpass='1111';
 $dbname='web';
 $conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
 if (!$conn) {
   die ('No connection');
 }
?>
