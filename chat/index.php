<?php
  // session_start();
  include("../includes/sessions.php");
  if ((!isset($_SESSION['username']))||($_SESSION['username'])=='') 
  {
    header('Location:../index.php');
  }
?>
<html>
<head>
	<title>AJAX with jQuery Example</title>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			timestamp = 0;
			updateMsg();
			$("form#chatform").submit(function(){
				$.post("backend.php",{
							message: $("#msg").val(),
							name: $("#author").val(),
							action: "postmsg",
							time: timestamp
						}, function(xml) {
					$("#msg").empty();
					addMessages(xml);
				});
				return false;
			});
		});
		function addMessages(xml) {
			if($("status",xml).text() == "2") return;
			timestamp = $("time",xml).text();
			$("message",xml).each(function(id) {
				message = $("message",xml).get(id);
				$("#messagewindow").prepend("<b>"+$("author",message).text()+
											"</b>: "+$("text",message).text()+
											"<br />");
			});
		}
		function updateMsg() {
			$.post("backend.php",{ time: timestamp }, function(xml) {
				$("#loading").remove();
				addMessages(xml);
			});
			setTimeout('updateMsg()', 4000);
		}
	</script>
	<style type="text/css">
		#messagewindow {
			height: 250px;
			border: 1px solid;
			padding: 5px;
			overflow: auto;
		}
		#wrapper {
			margin: auto;
			width: 438px;
		}
	</style>
</head>
<body>
	<div id="wrapper">
	<p id="messagewindow"><span id="loading">Loading...</span></p>
	<form id="chatform">
	Name: <input type="text" id="author" value=<?php echo $_SESSION['username']; ?> readonly="readonly"/>
	Message: <input type="text" id="msg" />    
	<input type="submit" value="ok" /><br />
	</form>
	</div>
</body>
</html>
