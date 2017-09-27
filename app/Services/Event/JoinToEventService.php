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

        return $this->event->attach($event, 'guests', [$user->id]);
    }
}
