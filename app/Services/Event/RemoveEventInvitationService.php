<?php namespace App\Services\Event;

use App\Repositories\Interfaces\EventInterface;

class RemoveEventInvitationService
{
    protected $event;

    public function __construct(EventInterface $event)
    {
        $this->event = $event;
    }

    public function make($event, string $user_id)
    {
        return $this->event->detach($event, 'invitations', [$user_id]);
    }
}
