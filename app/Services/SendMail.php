<?php


class SendMail
{
    protected $service;
    public function __construct()
    {
        $this->service = new PhpMailService();
    }

    public function run($data)
    {

        $this->service->send($data);
    }
}