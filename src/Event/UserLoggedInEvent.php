<?php

namespace App\Event;

use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class UserLoggedInEvent extends Event
{
  public const NAME = 'user.logged_in';

  private $user;

  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function getUser(): User
  {
    return $this->user;
  }
}
