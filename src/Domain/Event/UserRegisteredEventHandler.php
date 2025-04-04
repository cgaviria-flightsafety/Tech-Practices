<?php

namespace App\Domain\Event;

class UserRegisteredEventHandler
{
    public function handle(UserRegisteredEvent $event)
    {
        return "Welcome email sent to: " . $event->getUser()->getEmail();
    }
}
