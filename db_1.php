<?php
$db_server = mysql_connect('localhost', 'paul', 'wuzetian');
if (!$db_server) die ("Unable to connect to MySQL: " . mysql_error());
mysql_select_db('houses') or die('Unable to select database: ' . mysql_error());

$mv   = 'paul';
$mve = '';
$roomlist = array();
$roomoption = '';

if (isset($_POST['mve']))
{
   $mv =  $_POST['move_name'];
   $pos =  $_POST['pos'];
   $query2 =  "SELECT * FROM avatars WHERE name='".$mv."'";
   $res = mysql_query($query2); 
   $row = mysql_fetch_row($res);
   $id_r      =  $row[0];
   $name_r    =  $row[1];
   $type_r    =  $row[2];
   $room_id_r =  $row[3];
   
   // search for doors from current room
   $query =  "SELECT doors.id FROM doors, walls WHERE ((doors.walls_id_1=walls.id) OR (doors.walls_id_2=walls.id)) AND (walls.id IN (SELECT walls.id FROM walls, rooms WHERE walls.room_id=".$room_id_r."))";
   $res = mysql_query($query);
   
   $roomlist = array();
   while ($row = mysql_fetch_row($res))
   {
      //echo "door: " .$row[0];
    
      // what rooms are connected to this door ?
      $query = "SELECT walls.room_id FROM walls, doors WHERE (doors.id=".$row[0]." AND ((doors.walls_id_1=walls.id) OR (doors.walls_id_2=walls.id)))";
      $res2 = mysql_query($query);
   
      while ($nextroom = mysql_fetch_row($res2))
      {
         if ($room_id_r != $nextroom[0])
         {
            //echo " room " .$nextroom[0];
            array_push($roomlist,$nextroom[0]); 
         }
      }
      //echo "<br />";  
   }  
     echo "POS\n";
     echo $pos;
   //var_dump($roomlist);
   
   $match = in_array((string)($pos), $roomlist);
  
   if ($match !== FALSE)
   {
      $query =  "UPDATE avatars SET room_id=".$pos." WHERE name='".$mv."'";
      mysql_query($query);
      echo " Name: " . $name_r." Room: ".$pos;
      echo "<br />";
      
      $query = "SELECT rooms.picname FROM rooms WHERE rooms.id='$pos'";
      
      $result = mysql_query($query);
      $row = mysql_fetch_row($result);
      $pic = $row[0];    
   }
   else
   {
      echo "bad room";
      echo "<br />";
   }
   
   // search for doors from current room
   $query =  "SELECT doors.id FROM doors, walls WHERE ((doors.walls_id_1=walls.id) OR (doors.walls_id_2=walls.id)) AND (walls.id IN (SELECT walls.id FROM walls, rooms WHERE walls.room_id=".$pos."))";
   $res = mysql_query($query);
   
   $roomlist = array();
   while ($row = mysql_fetch_row($res))
   {
      echo "door: " .$row[0];
    
      // what rooms are connected to this door ?
      $query = "SELECT walls.room_id FROM walls, doors WHERE (doors.id=".$row[0]." AND ((doors.walls_id_1=walls.id) OR (doors.walls_id_2=walls.id)))";
      $res2 = mysql_query($query);
   
      while ($nextroom = mysql_fetch_row($res2))
      {
         if ($pos != $nextroom[0])
         {
            echo " room " .$nextroom[0];
            array_push($roomlist,$nextroom[0]); 
         }
      }
      echo "<br />";  
   }    
}
else 
{
   if (isset($_POST['shw']))
   {
       $mv =  $_POST['show_name'];
   }
   else
   {
       $mv = "paul";
   }
   $query2 =  "SELECT * FROM avatars WHERE name='".$mv."'";
   $res = mysql_query($query2); 
   $row = mysql_fetch_row($res);
   $id_r      =  $row[0];
   $name_r    =  $row[1];
   $type_r    =  $row[2];
   $room_id_r =  $row[3];
   
  
   echo " Name: " . $name_r." Room: ".$room_id_r;
   echo "<br />";
   
   // search for doors from current room
   $query =  "SELECT doors.id FROM doors, walls WHERE ((doors.walls_id_1=walls.id) OR (doors.walls_id_2=walls.id)) AND (walls.id IN (SELECT walls.id FROM walls, rooms WHERE walls.room_id=".$room_id_r."))";
   $res = mysql_query($query);
   
   $roomlist = array();
   while ($row = mysql_fetch_row($res))
   {
      echo "door: " .$row[0];
    
      // what rooms are connected to this door ?
      $query = "SELECT walls.room_id FROM walls, doors WHERE (doors.id=".$row[0]." AND ((doors.walls_id_1=walls.id) OR (doors.walls_id_2=walls.id)))";
      $res2 = mysql_query($query);
  
      while ($nextroom = mysql_fetch_row($res2))
      {
         if ($room_id_r != $nextroom[0])
         {
            echo " room " .$nextroom[0];
            array_push($roomlist,$nextroom[0]); 
         }
      }
      echo "<br />";  
   }  
   
   
   $query2 =  "SELECT * FROM avatars WHERE name='".$mv."'";
   $res = mysql_query($query2); 
   $row = mysql_fetch_row($res);
   $id_r      =  $row[0];
   $name_r    =  $row[1];
   $type_r    =  $row[2];
   $room_id_r =  $row[3];
   
   $query = "SELECT rooms.picname FROM rooms WHERE rooms.id='$room_id_r'";
      
   $result = mysql_query($query);
   $row = mysql_fetch_row($result);
   $pic = $row[0]; 
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

echo "<img src= '$pic'/";
echo <<< _END1
  <form action="db_1.php" method = "post" > <pre>
  id      <input type = "text" name ="id"  />
  name    <input type = "text" name ="name"  />
  type    <input type = "text" name ="type"  />
  room_id <input type = "text" name ="room_id"  /> 
          <input type = "submit" value = "ADD RECORD" />
  </pre></form>
_END1;
  
echo <<< _END2
  <form action="db_1.php" method = "post" > <pre>
  name    <input type = "text" name = "show_name" value = $mv />
          <input type = "hidden" name = "shw" value="yes" />
          <input type = "submit" value = "SHOW" />
  </pre></form>
  
_END2;

echo <<< _END3
  <form action="db_1.php" method = "post" > <pre>
  name    <input type = "text" name = "move_name" value = $mv />
          <input type = "hidden" name = "mve" value="yes" />
                  
_END3;

echo <<< _END4
next room <select name= "pos">
_END4;
  
while ( $roomoption = array_pop($roomlist) )
{
   echo "<option value= $roomoption >".$roomoption."</option>";                       
}
echo "</select>";
echo "<br />"; 
echo <<< _END4
<input type = "submit" value = "MOVE" />
  </pre></form>
_END4;
  
    
 $result = mysql_query("SELECT * FROM avatars");
echo 'Author: ' . mysql_result($result, 0, 'type');
?>