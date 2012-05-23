<?php

// http://core.trac.wordpress.org/browser/tags/3.3.2/wp-includes/general-template.php
function selected( $selected, $current = true, $echo = true ) {
	return __checked_selected_helper( $selected, $current, $echo, 'selected' );
}

// http://core.trac.wordpress.org/browser/tags/3.3.2/wp-includes/general-template.php
function __checked_selected_helper( $helper, $current, $echo, $type ) {
	if ( (string) $helper === (string) $current )
		$result = " $type='$type'";
	else
		$result = '';

	if ( $echo )
		echo $result;

	return $result;
}
