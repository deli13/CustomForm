<?php


namespace deli13\CustomForm\interfaces;


interface FormInterface
{

    public function init();

    public function loadData(array $arr);

    public function createMessage(): string;

    public function writeDatabase();

    public function send();

}