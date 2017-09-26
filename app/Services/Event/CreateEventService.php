<?php namespace App\Services\Event;

use App\Repositories\Interfaces\EventInterface;

class CreateEventService
{
    protected $event;

    public function __construct(EventInterface $event)
    {
        $this->event = $event;
    }

    public function make(array $attributes)
    {
        return $this->event->create($attributes);
    }
}
