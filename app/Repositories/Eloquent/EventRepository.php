<?php namespace App\Repositories\Eloquent;

use App\Models\Event;
use App\Abstracts\EloquentRepository;
use App\Repositories\Interfaces\EventInterface;

class EventRepository extends EloquentRepository implements EventInterface
{
    public function __construct(Event $event)
    {
        $this->model = $event;

        parent::__construct();
    }
}
