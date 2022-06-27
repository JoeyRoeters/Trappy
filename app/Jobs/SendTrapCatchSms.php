<?php

namespace App\Jobs;

use App\Models\Trap;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTrapCatchSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Trap $trap;

    private User $user;

    private $time;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Trap $trap, User $user, $time)
    {
        $this->trap = $trap;
        $this->user = $user;
        $this->time = $time;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $basic = new \Vonage\Client\Credentials\Basic('88ba4799', 'XmyyfnqmU9bbT6ld');
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($this->user->phone, 'Trappy', 'Beste ' . $this->user->name . ",
            \nEr is een rat gevangen, de rat is gevangen rond: " . $this->time . "
            \nHet gaat om de volgende val:
            \nNaam: " . $this->trap->name . "
            \nBeschrijving: " . $this->trap->description . "
            \nLocatie:
            \n\nMet vriendelijk groet,
            \nTeam Trappy")
        );
    }
}
