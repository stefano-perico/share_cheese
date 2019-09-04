<?php


namespace App\Event;


use App\Entity\User;

class RegisterEvent
{
    public const NAME = 'user.register';
    private $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    public function getUser() {
        return $this->user;
    }
}