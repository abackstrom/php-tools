<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
<style>
body {
	font-family: Verdana, Arial, sans-serif;
	font-size: 67.5%;
}
textarea {
	height: 200px;
	width: 100%;
}
h2 {
	clear: both;
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
require_once 'classes.php';
require_once 'functions.php';

?>

<h1>PHP Tools</h1>

<h2>Expand Serialized</h2>

<?php

$action = null;

if( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
	$class = "Action" . $_POST['action'];
	$action = new $class( $_POST['data'] );
}

?>

<div class="cols">
	<div class="col">
		<form method="post">
			<textarea class="data" name="data"><?php if( $action ) echo $action->esc_raw(); ?></textarea><br>
			<select name="action">
				<option value="QuotedPrintableDecode" <?php echo selected($_POST['action'], 'QuotedPrintableDecode'); ?>>quoted_printable_decode()</option>
				<option value="Urlencode" <?php echo selected($_POST['action'], 'Urlencode'); ?>>urlencode()</option>
				<option value="Urldecode"<?php echo selected($_POST['action'], 'Urldecode'); ?>>urldecode()</option>
				<option value="Unserialize"<?php echo selected($_POST['action'], 'Unserialize'); ?>>unserialize()</option>
			<select>
			<input type="submit">
		</form>
	</div>
	<?php if( $action ) echo $action; ?>
</div>

</body>
</html>
