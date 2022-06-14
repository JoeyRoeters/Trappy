<?php

namespace App\Events;

use App\Models\Trap;
use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TrapCatch
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Trap $trap;

    public String $time;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($trap)
    {
        $this->trap = $trap;

        $this->time = Carbon::now()->format('d-m-Y H:i:s');
    }
}
