<?php


namespace deli13\CustomForm\sender;


use deli13\CustomForm\errors\SenderNotSetException;

/**
 * Class EmailSender
 * @package deli13\CustomForm\sender
 */
class EmailSender
{

    private $sender;
    private static $_instance;

    public static function getInstance(): self
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @param \Closure $sender
     */
    public function setSender(\Closure $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * Отправка письма
     * @param $to
     * @param $theme
     * @param $message
     * @return mixed
     * @throws SenderNotSetException
     */
    public function send($to, $theme, $message)
    {
        if ($this->sender instanceof \Closure) {
            return call_user_func($this->sender, $to, $theme, $message);
        } else {
            throw new SenderNotSetException("Не установлена функция отправки почты");
        }
    }

}