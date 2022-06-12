<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TrapCatch
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public String $identifier;

    public String $time;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;

        $this->time = Carbon::now()->format('d-m-Y H:i:s');
    }

}
