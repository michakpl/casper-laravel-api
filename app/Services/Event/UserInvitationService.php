<?php namespace App\Services\Event;

use App\Models\Event;
use App\Repositories\Interfaces\EventInterface;

class UserInvitationService
{
    protected $event;

    public function __construct(EventInterface $event)
    {
        $this->event = $event;
    }

    public function make(Event $event, string $user_id)
    {
        return $this->event->attach($event, 'invitations', [$user_id]);
    }
}
