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
        $queryAttributes,
        $perPage = false,
        $page = null,
        array $orderBy = ['starts_at', 'asc'],
        array $columns = ['*']
    ) {
        $events = $this->event->orderBy($orderBy)
                              ->where('starts_at', '>', Carbon::now());

        foreach ($queryAttributes as $queryColumn => $queryValue) {
            switch ($queryColumn) {
                case 'location_geo':
                    $events = $this->event->whereBetween($queryColumn, $queryValue);
                    break;
                
                default:
                    $events = $this->event->where($queryValue);
                    break;
            }
        }

        if ($perPage) {
            $events = $events->paginate($perPage, $columns, $page);
        } else {
            $events = $events->all($columns);
        }

        return $events;
    }
}
