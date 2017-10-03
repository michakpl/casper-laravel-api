<?php namespace App\Services\Event;

use DB;
use Auth;
use App\Models\Event;
use App\Notifications\UserInvitation;
use App\Services\User\FindUserService;
use App\Repositories\Interfaces\EventInterface;

class UserInvitationService
{
    protected $event;
    protected $findUser;

    public function __construct(EventInterface $event, FindUserService $findUser)
    {
        $this->event = $event;
        $this->findUser = $findUser;
    }

    public function make(Event $event, string $user_id)
    {
        $currentUser = Auth::user();

        if ($this->userCanInvite($event, $currentUser)) {
            DB::transaction(function () use ($event, $user) {
                $user = $this->findUser->make($user_id);

                $invitation = $this->event->attach($event, 'invitations', [$user->id]);

                $user->notify(new UserInvitation($event));

                return $invitation;
            });
        }
    }

    protected function userCanInvite(Event $event, $currentUser)
    {
        if (!$event->is_private ||
            $event->guests->contains($currentUser->id) ||
            $event->user_id === $currentUser->id) {
            return true;
        }

        return false;
    }
}
