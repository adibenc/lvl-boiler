<?php
namespace App\Services;

use App\Jobs\NotificationJobs;
use App\Models\User;
use App\Notifications\TicketCreated;
use App\Notifications\TicketDeleted;
use App\Notifications\TicketUpdated;
use App\Traits\LoggingTrait;

class EventService{
    use LoggingTrait;

    /**
     * 
     * if false then use dispatch
     * 
     */
    protected $useQueue = false;

    function __construct() {
    }

    private function notifyUser($data, $notif){
        $user = User::first();
        $job = new NotificationJobs();
        $job->setUsers($user)
            ->setNotification($notif)
            ->setData("arbit data");

        return $job;
    }

    function trigger($type, $data = null){
        $ret = null;
        try{
            $job = null;
            switch($type){
                // to do : set bot user
                case "ticket-created":
                    $job = $this->notifyUser($data, new TicketCreated([
                        "ticket" => $data
                    ]));
                break;
                case "ticket-deleted":
                    $job = $this->notifyUser($data, new TicketDeleted([
                        "ticket" => $data
                    ]));
                break;
                case "ticket-updated":
                    $job = $this->notifyUser($data, new TicketUpdated([
                        "ticket" => $data
                    ]));
                break;
            }

            if($this->getUseQueue()){
                $ret = event($job);
            }else{
                $ret = dispatch($job);
            }
        }catch(\Exception $e){
            $this->logs($e->getMessage());
        }

        return $ret;
    }

	public function getUseQueue(){
		return $this->useQueue;
	}

	public function setUseQueue($useQueue){
		$this->useQueue = $useQueue;

		return $this;
	}
}