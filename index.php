<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
<style>
.serialized {
	height: 200px;
	width: 100%;
}
.cols {
}
.col {
	margin-right: 1.8%;
	width: 45%;
	float: left;
	padding: 10px;
}
</style>
</head>
<body>

<?php

require_once 'dBug.php';

?>

<h1>PHP Tools</h1>

<h2>Expand Serialized</h2>

<div class="cols">
	<div class="col">
		<form method="post">
		<textarea class="serialized" name="serialized"><?php echo nl2br(htmlentities($_POST['serialized'])); ?></textarea><br>
		<input type="submit">
		</form>
	</div>
	<div class="col"><?php if( isset($_POST['serialized']) ) new dBug(unserialize($_POST['serialized'])); ?></div>
</div>


</body>
</html>
