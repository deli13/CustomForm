<?php

class SendTest extends \PHPUnit\Framework\TestCase
{
    public function testSender()
    {
        \deli13\CustomForm\sender\EmailSender::getInstance()->setSender(function ($to, $theme, $message) {
            print_r("\n");
            print_r($to);
            print_r($theme);
            print_r($message);
            return true;
        });
        $this->assertIsBool(\deli13\CustomForm\sender\EmailSender::getInstance()->send("1", "2", "3"));
    }

}