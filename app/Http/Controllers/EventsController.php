<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Event\GetAllUpcomingEventsService;

class EventsController extends Controller
{
    protected $getAllUpcomingEvents;

    public function __construct(GetAllUpcomingEventsService $getAllUpcomingEvents)
    {
        $this->getAllUpcomingEvents = $getAllUpcomingEvents;
    }

    public function upcoming(Request $request)
    {
        $currentPage = $request->get('current_page', 1);
        $perPageLimit = $request->get('per_page', false);

        $events = $this->getAllUpcomingEvents->make($perPageLimit, $currentPage, ['starts_at', 'asc']);

        return response()->json($events);
    }
}
