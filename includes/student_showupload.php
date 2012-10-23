<?php
$show_upload=false;
if ($_SESSION['role']<3)
{
  $show_upload=true;
}
if(true == $show_upload)
{
?>
<form name="inputbranchform" id="inputbranchform" action="" method="POST">
<fieldset>
学员IC*：
<input type="text" name="branchic" id="branchic"
value="<?php if (isset($_POST['branchic'])) 
{
print stripslashes($_POST['branchic']);
}
?>"/>
<input type="button" name="searchbranch" id="searchbranch" value="搜索"/>
分部：<select name="branch" id="branch">
<option value='0'>Please select</option>
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
</select>
<input type="button" name="inputbranchbtn" id="inputbranchbtn" value="保存"><br>
</fieldset>
</form>

<form enctype="multipart/form-data" action="importrecordn.php" method="post">
  <fieldset>

	  <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
	  <table width="600">
	  <tr>
	  <td>XLSX文件:</td>
	  <td><input type="file" name="file" /></td>
	  <td><input type="submit" value="Upload" /></td>
	  </tr>
	  </table>
  </fieldset>
</form>
<?php } ?>