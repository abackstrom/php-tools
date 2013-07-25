<?php

class ActionDateCTest extends PHPUnit_Framework_TestCase {
    function testDecode() {
        $action = new ActionDateC("1374772515");
        $expected = [1374772515 => '2013-07-25T17:15:15+00:00'];
        $this->assertEquals($expected, $action->decode());
    }

    function testDecodeHasCorrectNumberOfResults() {
        $action = new ActionDateC("1374772515\n1374772516");
        $this->assertCount(2, $action->decode());
    }
}
