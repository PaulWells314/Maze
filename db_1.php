<?php
$db_server = mysql_connect('localhost', 'paul', 'wuzetian');
if (!$db_server) die ("Unable to connect to MySQL: " . mysql_error());
mysql_select_db('houses') or die('Unable to select database: ' . mysql_error());

if (isset($_POST['mve']))
{
   $mv =  $_POST['move_name'];
   $query2 =  "SELECT * FROM avatars WHERE name='".$mv."'";
   $res = mysql_query($query2); 
   $row = mysql_fetch_row($res);
   $id_r      =  $row[0];
   $name_r    =  $row[1];
   $type_r    =  $row[2];
   $room_id_r =  $row[3];
   $query =  "UPDATE avatars SET room_id=".$room_id_r." WHERE name='".$mv."'";
   mysql_query($query);
   echo "New position: " . "Id: ". $id_r. " Name: " . $name_r." Room: ".$room_id_r;
   echo "<br />";
   
   $query =  "SELECT doors.id FROM doors, walls WHERE (doors.walls_id_1=walls.id) AND (walls.id IN (SELECT walls.id FROM walls, rooms WHERE walls.room_id=".$room_id_r."))";
   $res = mysql_query($query);
   $row = mysql_fetch_row($res);
   echo "door " .$row[0];
   echo "<br />";
   $query =  "SELECT doors.id FROM doors, walls WHERE (doors.walls_id_2=walls.id) AND (walls.id IN (SELECT walls.id FROM walls, rooms WHERE walls.room_id=".$room_id_r."))";
   $res = mysql_query($query);
   $row = mysql_fetch_row($res);
   echo "door " .$row[0];
   echo "<br />";
   
    
    
}

if (isset($_POST['id']) &&
  isset($_POST['name']) &&
  isset($_POST['type']) &&
  isset($_POST['room_id']) )


{
  $id  = $_POST['id'];
  $name  = $_POST['name'];
  $type  = $_POST['type'];
  $room_id  = $_POST['room_id'];
  echo  $id,$name,$type,$room_id;
  $query = "INSERT INTO avatars VALUES"  .
  "('$id', '$name', '$type', '$room_id')";
  mysql_query($query);
}

echo <<< _END
  <form action="db_1.php" method = "post" > <pre>
  id      <input type = "text" name ="id"  />
  name    <input type = "text" name ="name"  />
  type    <input type = "text" name ="type"  />
  room_id <input type = "text" name ="room_id"  /> 
          <input type = "submit" value = "ADD RECORD" />
  </pre></form>
  <form action="db_1.php" method = "post" > <pre>
  name    <input type = "text" name = "move_name"  />
          <input type = "hidden" name = "mve" value="yes" />
          <input type = "submit" value = "MOVE" />
  </pre></form>

_END;



 $result = mysql_query("SELECT * FROM avatars");
echo 'Author: ' . mysql_result($result, 0, 'type');
?>