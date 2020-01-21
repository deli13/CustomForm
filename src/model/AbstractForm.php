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

    public $message = "";
    public $to;
    protected $set_theme;

    /**
     * Загрузка данных в форму
     * @param array $arr
     */
    public function loadData(array $arr)
    {
        foreach ($arr as $key => $value) {
            try {
                $this->$key = $value;
            } catch (\Exception $exception) {

            }
        }
        $this->init();
    }

    /**
     * Установка списка адресатов сообщений с формы
     * @param array $to
     */
    public function setTo(array $to)
    {
        $this->to = $to;
    }

    /**
     * Установка темы
     * @param string $theme
     */
    public function setTheme(string $theme)
    {
        $this->set_theme = $theme;
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
        return EmailSender::getInstance()->send($this->to, $this->set_theme, $message);
    }
}