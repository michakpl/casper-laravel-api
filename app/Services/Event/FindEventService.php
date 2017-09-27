<?php namespace App\Services\Event;

use App\Repositories\Interfaces\EventInterface;

class FindEventService
{
    public function __construct(EventInterface $event)
    {
        $this->event = $event;
    }

    public function make(string $id)
    {
        return $this->event->with('user')
                            ->with('guests')
                            ->findOrFail($id);
    }
}
