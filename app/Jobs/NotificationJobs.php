<?php
namespace App\Jobs;

class NotificationJobs extends BaseJobs {
    public $notification;
    public $users;
    
    public function handle(){
        //
        $this->users->notify($this->getNotification());
    }

	public function getNotification(){
		return $this->notification;
	}

	public function setNotification($notification){
		$this->notification = $notification;

		return $this;
	}

	public function getUsers(){
		return $this->users;
	}

	public function setUsers($users){
		$this->users = $users;

		return $this;
	}
}
