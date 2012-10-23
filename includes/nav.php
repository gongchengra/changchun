<div id="nav">

	<ul>
		<li><a href="student.php">学员管理</a>
			<ul class="sub">
				<li>学员报名</li>
				<li>学员检索</li>
			</ul>
		</li>
		<li><a href="class.php">班级管理</a>
			<ul class="sub">
				<li>开班</li>
				<li>结课</li>
			</ul>
		</li>
		<li><a href="exam.php">考试管理</a>
			<ul class="sub">
				<li>ATO</li>
				<li>设置座位</li>
			</ul>
		</li>
		<?php
                $show_system=false;
                if ($_SESSION['role']<2){
                    $show_system=true;
                }
                if(true == $show_system)
                {
        ?>

		<li><a href="system.php">系统管理</a>
			<ul class="sub">
				<li>帐号管理</li>
			</ul>
		</li>

		<?PHP
                }//true == $show_inputseat
        ?>
	</ul>

</div> <!-- end #nav -->