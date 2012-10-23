<?php
$show_student=false;
if ($_SESSION['role']<3){
    $show_student=true;
}
if(true == $show_student)
{
?>
<h1>检索学员</h1>
<form action="student.php" method="post">
  <fieldset>
    类型*:
    <select name="type">
    <option value="0">请选择</option>
    <option value="CMP" <?php if(isset($_POST['type']))
    {echo ($_POST['type'] == 'CMP')?"selected":"";}?>>综合</option>
    <option value="CON" <?php if(isset($_POST['type']))
    {echo ($_POST['type'] == 'CON')?"selected":"";}?>>会话</option>
    <option value="WRI" <?php if(isset($_POST['type']))
    {echo ($_POST['type'] == 'WRI')?"selected":"";}?>>写作</option>
    <option value="WPN" <?php if(isset($_POST['type']))
    {echo ($_POST['type'] == 'WPN')?"selected":"";}?>>数学</option>
    </select>
    等级*:
    <select name="level">
      <option value="0">请选择</option>
      <option value="BEGINNERS" <?php if(isset($_POST['level']))
      {echo ($_POST['level'] == 'BEGINNERS')?"selected":"";}?>>初级</option>
      <option value="INTERMEDIATE" <?php if(isset($_POST['level']))
      {echo ($_POST['level'] == 'INTERMEDIATE')?"selected":"";}?>>中级</option>
      <option value="ADVANCED" <?php if(isset($_POST['level']))
      {echo ($_POST['level'] == 'ADVANCED')?"selected":"";}?>>高级</option>
    </select>
    分部*：
    <select name="branch">
      <option value="0">请选择</option>
      <option value='changchun'>changchun</option>
      <option value='angmokio'>angmokio</option>
      <option value='bedok'>bedok</option>
      <option value='bishan'>bishan</option>
      <option value='bukitbatok'>bukitbatok</option>
      <option value='hougang'>hougang</option>
      <option value='jurongeast'>jurongeast</option>
      <option value='khatib'>khatib</option>
      <option value='pasirris'>pasirris</option>
      <option value='sembawang'>sembawang</option>
      <option value='sengkang'>sengkang</option>
      <option value='serangoon'>serangoon</option>
      <option value='tampines'>tampines</option>
      <option value='woodlands'>woodlands</option>
      <option value='yishun'>yishun</option>
    </select><br />
    <input type="submit" name="searchlevel" value="搜索"/>
  </fieldset>
</form>
<?php include('includes/student_search.php'); ?>
<?PHP
}//true == $show_seat
?>