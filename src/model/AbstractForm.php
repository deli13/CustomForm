<?php


namespace deli13\CustomForm\model;


use deli13\CustomForm\errors\SenderNotSetException;
use deli13\CustomForm\interfaces\FormInterface;
use deli13\CustomForm\sender\EmailSender;

/**
 * Общий конструктор для форм
 * Class AbstractForm
 * @package App\forms\base
 */
abstract class AbstractForm implements FormInterface
{

    public $message="";
    public $to;
    protected $set_theme;

    public function loadData(array $arr)
    {
        foreach ($arr as $key => $value) {
            try {
                $this->$key = $value;
            } catch (\Exception $exception) {
                loader()->logger()->sendLog($exception);
            }
        }
        $this->init();
    }

    public function setTo(array $to)
    {
        $this->to = $to;
    }

    public function setTheme(string $theme){
        $this->set_theme=$theme;
    }

    /**
     * Отправка почты
     * @return bool
     * @throws SenderNotSetException
     */
    public function send()
    {
        $message = $this->createMessage();
        $this->writeDatabase();
        return EmailSender::getInstance()->send($this->to,$this->set_theme,$message);
    }
}