<?php namespace App\Services\Event;

use Auth;
use App\Models\Event;
use App\Repositories\Interfaces\EventInterface;

class JoinToEventService
{
    protected $event;

    public function __construct(EventInterface $event)
    {
        $this->event = $event;
    }

    public function make(Event $event)
    {
        $user = Auth::user();

        if ($this->userCanJoin($event, $user)) {
            $this->event->attach($event, 'guests', [$user->id]);

            return true;
        }

        return false;
    }

    protected function userCanJoin(Event $event, $user)
    {
        if (($event->is_private && !$event->invitations->contains($user->id)) ||
            $event->guests->contains($user->id) ||
            ($event->guestsLimit != 0 && $event->guestsLimit <= $event->guests->count())) {
            return false;
        }

        return true;
    }
}
