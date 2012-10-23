<?PHP
if(isset($_GET['atdic'])&&$_GET['atdic']!='')
{
  $branch=$_SESSION['branch'];
  $ic=$_GET['atdic'];
  $classid1=$_GET['classid'];
  include("includes/conn.php");
  include("includes/link.php");
  $searchnotes = mysql_query("SELECT * FROM sub_class_info 
    WHERE ic='$ic' AND classid='$classid1' AND status!='delete'")
  or die ("Could not match data because ".mysql_error());
  $num_rownotes = mysql_num_rows($searchnotes);
  if($num_rownotes>0)
  {
    $getnotes=mysql_fetch_array($searchnotes);
    $_POST['notes']=$getnotes['notes'];
    $_POST['reg_no']=$getnotes['reg_no'];
    $_POST['receipt_no']=$getnotes['relatedreceipt'];
    $_POST['attendance']=$getnotes['attendance'];
  }
}  
?>