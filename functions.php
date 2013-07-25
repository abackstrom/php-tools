<?php

function selected($selected, $current) {
    if ($selected === $current) {
        return 'selected';
    }

    return '';
}
