<div style='text-align:center'>
  <h1>查看学员所有信息</h1>
  <form name="searchallform" id="searchallform" action="" method="POST">
    <fieldset>
      学员IC*：<input type="text" name="allic" value="<?php if (isset($_POST['allic'])) {
      print stripslashes($_POST['allic']);}else {print "";} ?>"/>
      <input type="button" name="searchallic" id="searchallic" value="搜索">
    </fieldset>
  </form>
  <div id='searchall'>
  </div>
</div>