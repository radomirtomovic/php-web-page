<?php


namespace App\Mail;


class From
{
    protected $name;
    protected $email;

    public function __construct(string $email, string $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    public function  getName(): string
    {
        return $this->name;
    }
}