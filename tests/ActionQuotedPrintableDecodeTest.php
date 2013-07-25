<?php

class ActionQuotedPrintableDecodeTest extends PHPUnit_Framework_TestCase {
    function testDecode() {
        $action = new ActionQuotedPrintableDecode('a=3Db');
        $this->assertEquals('a=b', $action->decode());
    }
}
