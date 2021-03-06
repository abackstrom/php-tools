<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Tools</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/classes.php';
require __DIR__ . '/functions.php';

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
            <textarea class="data boxed" name="data"><?php if( $action ) echo $action->esc_raw(); ?></textarea><br>
            <select name="action" class="boxed">
                <option value="QuotedPrintableDecode" <?php echo selected($action_str, 'QuotedPrintableDecode'); ?>>quoted_printable_decode()</option>
                <option value="QuotedPrintableEncode" <?php echo selected($action_str, 'QuotedPrintableEncode'); ?>>quoted_printable_encode()</option>
                <option value="Urlencode" <?php echo selected($action_str, 'Urlencode'); ?>>urlencode()</option>
                <option value="Urldecode" <?php echo selected($action_str, 'Urldecode'); ?>>urldecode()</option>
                <option value="Serialize" <?php echo selected($action_str, 'Serialize'); ?>>serialize($json)</option>
                <option value="Unserialize" <?php echo selected($action_str, 'Unserialize'); ?>>unserialize()</option>
                <option value="Base64Decode" <?php echo selected($action_str, 'Base64Decode'); ?>>base64_decode()</option>
                <option value="Base64Encode" <?php echo selected($action_str, 'Base64Encode'); ?>>base64_encode()</option>
                <option value="JsonDecode" <?php echo selected($action_str, 'JsonDecode'); ?>>json_decode()</option>
                <option value="JsonEncode" <?php echo selected($action_str, 'JsonEncode'); ?>>json_encode()</option>
                <option value="DateC" <?php echo selected($action_str, 'DateC'); ?>>date('c', $timestamp)</option>
                <option value="Strtotime" <?php echo selected($action_str, 'Strtotime'); ?>>strtotime()</option>
                <option value="ParseStr" <?php echo selected($action_str, 'ParseStr'); ?>>parse_str()</option>
                <option value="Ansi2Html" <?php echo selected($action_str, 'Ansi2HTml'); ?>>ansi-to-html</option>
            <select>
            <input type="submit" class="boxed">
        </form>

        <div class="math">
            <h2>Math</h2>
            <div>
                <input type="text" class="math-expression boxed full-width" placeholder="2 + 2">
                <input type="text" class="math-solution boxed full-width" style="display: none;">
            </div>
        </div>

        <h2>Other</h2>
        <ul>
            <li><a href="https://www.wellsfargo.com/biz/loans-and-lines/repayment-calculator/">Loan repayment calculator</a></li>
            <li><a href="https://blog.tersmitten.nl/slugify/">Slugify</a></li>
        </ul>
    </div>
    <?php if( $action ) echo $action; ?>
</div>

<section class="randomness">
    <h2>Randomness</h2>
    <ul>
        <li><label for="md5">MD5</label><input id="md5" class="boxed randomness-box" value="<?php echo md5(uniqid(mt_rand(), true)); ?>"></li>
        <li><label for="sha1">SHA1</label><input id="sha1" class="boxed randomness-box" value="<?php echo sha1(uniqid(mt_rand(), true)); ?>"></li>
    </ul>
</section>

<footer>
    <a href="https://github.com/abackstrom/php-tools"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>
</footer>

<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="math.min.js"></script>
<script src="tools.js" async></script>

</body>
</html>
