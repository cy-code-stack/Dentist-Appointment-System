<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class AppointmentBlockEvent implements ShouldBroadcastNow
{
    use SerializesModels;

    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function broadcastOn()
    {
        return new Channel('appointments');
    }

    public function broadcastWith()
    {
        return [
            'event_name' => $this->event->event_name,
            'start_date' => $this->event->start_date,
            'end_date' => $this->event->end_date,
        ];
    }
}
