<?php namespace App\Services\Event;

use Auth;
use App\Models\Event;
use App\Repositories\Interfaces\EventInterface;
use App\Services\Event\RemoveEventInvitationService;

class JoinToEventService
{
    protected $event;
    protected $removeEventInvitation;

    public function __construct(
        EventInterface $event,
        RemoveEventInvitationService $removeEventInvitation
    ) {
        $this->event = $event;
        $this->removeEventInvitation = $removeEventInvitation;
    }

    public function make(Event $event)
    {
        $user = Auth::user();
        
        if ($this->userCanJoin($event, $user)) {
            if ($event->invitations->contains($user->id)) {
                $this->removeEventInvitation->make($event, $user->id);
            }

            return $this->event->attach($event, 'guests', [$user->id]);
        }

        return false;
    }

    protected function userCanJoin(Event $event, $user)
    {
        if (($event->is_private && $event->invitations->contains($user->id)) ||
            !$event->guests->contains($user->id) ||
            ($event->guestsLimit > 0 && $event->guestsLimit >= $event->guests->count()) ||
            $event->user_id === $user->id) {
            return true;
        }

        return false;
    }
}
