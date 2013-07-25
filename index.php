<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Tools</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php

require_once 'dBug.php';
require_once 'classes.php';
require_once 'functions.php';

?>

<h1>PHP Tools</h1>

<?php

$action = null;
$action_str = isset($_POST['action']) ? $_POST['action'] : null;

if( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
    $class = "Action" . $action_str;
    $action = new $class( $_POST['data'] );
}

?>

<div class="cols">
    <div class="col">
        <form method="post">
            <textarea class="data" name="data"><?php if( $action ) echo $action->esc_raw(); ?></textarea><br>
            <select name="action">
                <option value="QuotedPrintableDecode" <?php echo selected($action_str, 'QuotedPrintableDecode'); ?>>quoted_printable_decode()</option>
                <option value="QuotedPrintableEncode" <?php echo selected($action_str, 'QuotedPrintableEncode'); ?>>quoted_printable_encode()</option>
                <option value="Urlencode" <?php echo selected($action_str, 'Urlencode'); ?>>urlencode()</option>
                <option value="Urldecode" <?php echo selected($action_str, 'Urldecode'); ?>>urldecode()</option>
                <option value="Unserialize" <?php echo selected($action_str, 'Unserialize'); ?>>unserialize()</option>
                <option value="Base64Decode" <?php echo selected($action_str, 'Base64Decode'); ?>>base64_decode()</option>
                <option value="Base64Encode" <?php echo selected($action_str, 'Base64Encode'); ?>>base64_encode()</option>
                <option value="JsonDecode" <?php echo selected($action_str, 'JsonDecode'); ?>>json_decode()</option>
                <option value="JsonEncode" <?php echo selected($action_str, 'JsonEncode'); ?>>json_encode()</option>
            <select>
            <input type="submit">
        </form>
    </div>
    <?php if( $action ) echo $action; ?>
</div>

<h2>Randomness</h2>

<ul>
    <li>MD5: <input class="randomness-box" value="<?php echo md5(uniqid(mt_rand(), true)); ?>"></li>
    <li>SHA1: <input class="randomness-box" value="<?php echo sha1(uniqid(mt_rand(), true)); ?>"></li>
</ul>

</body>
</html>
