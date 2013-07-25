<?php

class DbugFormatterTest extends PHPUnit_Framework_TestCase {
    function testFormat() {
        $formatter = new DbugFormatter;

        $s = 'mine' . $_SERVER['REQUEST_TIME'] . sha1(time() . mt_rand());
        $this->assertContains($s, $formatter->format($s));
    }
}
