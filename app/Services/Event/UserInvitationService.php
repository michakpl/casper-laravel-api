<?php namespace App\Services\Event;

use DB;
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
        $user = $this->findUser->make($user_id);

        if ($this->userCanInvite($event, $user)) {
            DB::transaction(function () use ($event, $user) {
                $invitation = $this->event->attach($event, 'invitations', [$user->id]);

                $user->notify(new UserInvitation($event));

                return $invitation;
            });
        }
    }

    protected function userCanInvite(Event $event, $user)
    {
        if (!$event->is_private ||
            $event->guests->contains($user->id) ||
            $event->user_id === $user->id) {
            return true;
        }

        return false;
    }
}
