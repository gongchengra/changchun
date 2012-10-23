<center>

  <h3>
    <form action="class.php" method="post">
      班级 id：
      <input type="text" name="del_class"
      value="<?php if (isset($_POST['del_class'])) {
      print stripslashes($_POST['del_class']);} ?>">
      <input type="submit" name="delclass" value="删除">
    </form>
  </h3>
</center>
