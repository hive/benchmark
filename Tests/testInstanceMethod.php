<?php
    
class TestInstanceMethod extends PHPUnit_Framework_TestCase
{
    public function testSanity()
    {
        $this->assertEquals(1+1, 2);
    }
}