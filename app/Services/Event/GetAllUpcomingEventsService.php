<?php namespace App\Services\Event;

use Carbon\Carbon;
use App\Repositories\Interfaces\EventInterface;

class GetAllUpcomingEventsService
{
    protected $event;

    public function __construct(EventInterface $event)
    {
        $this->event = $event;
    }

    public function make(
        $perPage = false,
        $page = null,
        array $orderBy = ['starts_at', 'asc'],
        array $columns = ['*']
    ) {
        $events = $this->event->orderBy($orderBy)
                            ->where('starts_at', '>', Carbon::now());

        if ($perPage) {
            $events = $events->paginate($perPage, $columns, $page);
        } else {
            $events = $events->all($columns);
        }

        return $events;
    }
}
