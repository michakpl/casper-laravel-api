<?php namespace App\Services\Event;

use Auth;
use App\Repositories\Interfaces\EventInterface;

class RemoveEventGuestService
{
    protected $event;

    public function __construct(EventInterface $event)
    {
        $this->event = $event;
    }

    public function make($event, string $user_id)
    {
        $currentUser = Auth::user();

        if ($event->user_id === $currentUser->id || $event->user_id === $user_id) {
            return $this->event->detach($event, 'guests', [$user_id]);
        }

        return false;
    }
}
