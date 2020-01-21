<?php


namespace deli13\CustomForm\interfaces;


interface FormInterface
{
    /**
     * Инициализация
     * @return mixed
     */
    public function init();

    /**
     * Загрузка данных формы
     * @param array $arr
     * @return mixed
     */
    public function loadData(array $arr);

    /**
     * Создание письма
     * @return string
     */
    public function createMessage(): string;

    /**
     * Запись письма в БД
     * @return mixed
     */
    public function writeDatabase();

    /**
     * Отправка
     * @return mixed
     */
    public function send();

}