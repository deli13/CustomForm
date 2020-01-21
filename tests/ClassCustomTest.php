<?php


class ClassCustomTest extends \PHPUnit\Framework\TestCase
{
    public function testImplement(){
        $form=new CustomForm();
        $this->assertInstanceOf(\deli13\CustomForm\interfaces\FormInterface::class,$form);
    }

    public function testFabricSend(){
        $fabric=new \deli13\CustomForm\FabricForm();
        $fabric->setFormList([
            "test"=>CustomForm::class
        ]);
        $fabric->setSender(function ($to,$theme,$message){
            print_r($to);
            print_r($theme);
            print_r($message);
            return true;
        });
        $fabric->prepareForm([
            "FORM_NAME"=>"test",
            "name"=>"name_field",
            "message"=>"message_field"
        ]);
        $fabric->setTo(["test@test.ru"]);
        $this->assertTrue($fabric->send());
    }

}

class CustomForm extends \deli13\CustomForm\model\AbstractForm
{

    public $name;
    public $message;

    public function init()
    {
        $this->setTheme("Тема письма");
        // TODO: Implement init() method.
    }

    public function createMessage(): string
    {
        $this->message="name: ".$this->name
            ."message: ".$this->message;
        // TODO: Implement createMessage() method.
        return $this->message;
    }

    public function writeDatabase()
    {
        // TODO: Implement writeDatabase() method.
    }
}