<html>
<link href="css/AudVid.css" rel="stylesheet">

<?php
include('DB_conn.php');
$res=mysqli_query($conn,"SELECT id,AVName,Type,FilePath FROM audiovideo");

while ($row = mysqli_fetch_array($res))
{
  switch ($row['Type'])
  {
    case 1: //video on disk
      echo '
      <div class="VideoBlock">
      '.$row['AVName'].'<br>
      <video width="480" height="360" controls="controls">
         <source src="AV/'.$row['FilePath'].'" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'>
      </video>
      </div>
      ';
    break;

    case 2: //video from youtube
      echo '
      <div class="VideoBlock">
      '.$row['AVName'].'<br>
      <iframe width="480" height="360" src="'.$row['FilePath'].'" frameborder="0" allowfullscreen></iframe>
      </div>
      ';
    break;

    case 3: //audio from disk
    {
      echo '
      <div class="VideoBlock">
        '.$row['AVName'].'<br>
        <audio controls>
          <source src="AV/'.$row['FilePath'].'" type="audio/mpeg">
        </audio>
      </div>
      ';
    }

  }
}

/*
<div class="VideoBlock">
<iframe width="480" height="360" src="https://www.youtube.com/embed/HbaQ9xnoMGQ" frameborder="0" allowfullscreen></iframe>
</div>

<div class="VideoBlock">
<iframe width="480" height="360" src="https://www.youtube.com/embed/HbaQ9xnoMGQ" frameborder="0" allowfullscreen></iframe>
</div>

<div class="VideoBlock">
<iframe width="480" height="360" src="https://www.youtube.com/embed/HbaQ9xnoMGQ" frameborder="0" allowfullscreen></iframe>
</div>

<div class="VideoBlock">
<video width="480" height="360" controls="controls">
   <source src="AV/Five Finger Death Punch - Sham Pain (Official Video).mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
</video>
</div>

*/
?>

</html>
