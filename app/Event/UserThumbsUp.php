<?php

namespace App\Event;

use App\Detail;
use App\Events\Event;
use App\ThumbRecord;

use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserThumbsUp extends Event
{
    use SerializesModels;

    public $user;

    public $detail;

    /**
     * UserThumbsUp constructor.
     * @param User $user
     * @param Detail $detail
     */
    public function __construct(User $user, Detail $detail)
    {
        $this->user = $user;
        $this->detail = $detail;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
