<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventStore;
use App\Services\Event\FindEventService;
use App\Services\Event\CreateEventService;
use App\Services\Event\JoinToEventService;
use App\Services\Event\UserInvitationService;
use App\Services\Event\GetAllUpcomingEventsService;

class EventsController extends Controller
{
    protected $findEvent;
    protected $createEvent;
    protected $joinToEvent;
    protected $userInvitation;
    protected $getAllUpcomingEvents;

    public function __construct(
        FindEventService $findEvent,
        CreateEventService $createEvent,
        JoinToEventService $joinToEvent,
        UserInvitationService $userInvitation,
        GetAllUpcomingEventsService $getAllUpcomingEvents
    ) {
        $this->middleware('auth')->only([
            'store',
            'join',
            'invite'
        ]);

        $this->findEvent = $findEvent;
        $this->createEvent = $createEvent;
        $this->joinToEvent = $joinToEvent;
        $this->userInvitation = $userInvitation;
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

    public function join(string $id)
    {
        $event = $this->findEvent->make($id);

        if ($event) {
            if ($this->joinToEvent->make($event)) {
                return response()->json([
                    'message'   => 'Successfully joined to event'
                ]);
            }
        }

        return response()->json([
            'message'   => 'Something went wrong'
        ], 500);
    }

    public function invite(Request $request, string $id)
    {
        $event = $this->findEvent->make($id);

        if ($event) {
            $this->userInvitation->make($event, $request->get('user_id'));

            return response()->json([
                'message'   => 'Successfully invited user to event'
            ]);
        }

        return respons()->json([
            'message'   => 'Something went wrong'
        ], 500);
    }
}
