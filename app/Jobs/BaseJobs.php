<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Traits\LoggingTrait; 

class BaseJobs implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use LoggingTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }

    // use Dispatchable, InteractsWithSockets, SerializesModels, InteractsWithQueue, Queueable;

    protected $data;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

	public function getData(){
		return $this->data;
	}

	public function setData($data){
		$this->data = $data;

		return $this;
	}
}
