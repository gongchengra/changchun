<center>
  <h1>
    备份数据库
  </h1>
    <form action="backup.php" method="post" >
      <?php
      include("includes/conn.php");
      include("includes/link1.php");
      $res = mysqli_query($link, "SHOW TABLES FROM $dbname")
      or die ("Could not match data because ".mysqli_error($link));
      $tables = array();
      echo "Talbes：<select name='tables'>";
      while($row = mysqli_fetch_array($res)) {
          echo "<option value='$row[0]'>$row[0]</option>"; 
          // $tables[] = "$row[0]";
      }
      echo "</select><br />";
      ?>
      Start id:
      <input type="text" name="startid"><br />
      End id:
      <input type="text" name="endid"><br />
      <input name="backuptables" type="submit" value="备份">
    </form>
  <h1>
    还原数据库
  </h1>
  <form enctype="multipart/form-data" action="restore.php" method="post">
  <?php
  include("includes/conn.php");
  include("includes/link1.php");
  $res = mysqli_query($link, "SHOW TABLES FROM $dbname")
  or die ("Could not match data because ".mysqli_error($link));
  $tables = array();
  echo "Talbes：<select name='tables'>";
  while($row = mysqli_fetch_array($res)) {
      echo "<option value='$row[0]'>$row[0]</option>"; 
      // $tables[] = "$row[0]";
  }
  echo "</select><br />";
  ?>
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
  <table width="600">
  <tr>
  <td>还原数据库:</td>
  <td><input type="file" name="file" /></td>
  <td><input type="submit" value="Upload" /></td>
  </tr>
  </table>
  </form>
</center>
