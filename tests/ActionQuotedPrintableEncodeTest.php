<?php

class ActionQuotedPrintableEncodeTest extends PHPUnit_Framework_TestCase {
    function testDecode() {
        $action = new ActionQuotedPrintableEncode('a=b');
        $this->assertEquals('a=3Db', $action->decode());
    }
}
