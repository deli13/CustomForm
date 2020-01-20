<?php


namespace deli13\CustomForm;


use deli13\CustomForm\errors\BadFormException;
use deli13\CustomForm\interfaces\FormInterface;
use deli13\CustomForm\model\AbstractForm;
use deli13\CustomForm\sender\EmailSender;

/**
 * Класс взаимодействия с формами
 * Class FabricForm
 * @property  FormInterface[] $form_classes
 * @package deli13\CustomForm
 * @property AbstractForm $form
 *
 */
class FabricForm
{

    private $field_name_form = "FORM_NAME";
    private $form;
    private $form_classes;

    /**
     * Установка Функции отправки
     * @param \Closure $function
     */
    public function setSender(\Closure $function){
        EmailSender::getInstance()->setSender($function);
    }

    /**
     * Загрузка данных формы
     * @param array $req_data
     */
    public function prepareForm(array $req_data){
        if (array_key_exists($this->field_name_form, $req_data)) {
            $this->form = new $this->form_classes[$req_data[$this->$field_name_form]];
            $this->form->loadData($req_data);
        }
    }

    public function setFieldNameForm(string $name){
        $this->field_name_form=$name;
    }

    /**
     * Загрузка списка форм
     * @param array $form_list
     * @throws BadFormException
     */
    public function setFormList(array $form_list){
        foreach ($form_list as $key=>$form){
            if(!($form instanceof FormInterface)){
                throw new BadFormException("Форма не реализует интерфейс ".FormInterface::class);
            }
        }
        $this->form_classes=$form_list;
    }

    /**
     * Для кого
     * @param array $to
     */
    public function setTo(array $to)
    {
        $this->form->setTo($to);
    }

    /**
     * Отправка формы
     */
    public function send()
    {
//        $form = $this->form;
        /** @var FormUploadFile|FormInterface $form */
//        if ($form instanceof FormUploadFile) {
//            return $form->sendFile();
//        } else {
        return $this->form->send();
//        }
    }
}