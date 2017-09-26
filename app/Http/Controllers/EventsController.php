<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventStore;
use App\Services\Event\FindEventService;
use App\Services\Event\CreateEventService;
use App\Services\Event\GetAllUpcomingEventsService;

class EventsController extends Controller
{
    protected $findEvent;
    protected $createEvent;
    protected $getAllUpcomingEvents;

    public function __construct(
        FindEventService $findEvent,
        CreateEventService $createEvent,
        GetAllUpcomingEventsService $getAllUpcomingEvents
    ) {
        $this->findEvent = $findEvent;
        $this->createEvent = $createEvent;
        $this->getAllUpcomingEvents = $getAllUpcomingEvents;
    }

    public function upcoming(Request $request)
    {
        $currentPage = $request->get('current_page', 1);
        $perPageLimit = $request->get('per_page', false);

        $events = $this->getAllUpcomingEvents->make($perPageLimit, $currentPage, ['starts_at', 'asc']);

        return response()->json($events);
    }

    public function store(EventStore $request)
    {
        $event = $this->createEvent->make($request->only([
            'title',
            'location',
            'location_geo',
            'description',
            'starts_at',
            'duration',
            'guests_limit',
            'registration_ends_at',
            'is_private'
        ]));

        if ($event) {
            return response()->json([
                'message'   => 'Event has been created'
            ]);
        }

        return response()->json([
            'message'   => 'Something went wrong'
        ], 500);
    }

    public function show(string $id)
    {
        $event = $this->findEvent->make($id);

        return response()->json($event);
    }
}
