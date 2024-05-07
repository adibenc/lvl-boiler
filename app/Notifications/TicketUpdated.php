<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Log;

class TicketUpdated extends BaseNotif{
    
    public function toTelegram($notifiable){
        $ticket = $this->data['ticket'];
        
        // to do : save data to serialized queue insted of requerying using eloquent
        $id = $ticket->id;
        $by = $ticket->byUser->username;
        $dt = $ticket->created_at;
        $name = $ticket->name;
        $agent = $ticket->getAgent->username;
        $status = $ticket->last_status;
        $descr = substr($ticket->descr, 0, 64);

        return "Tiket Update :
id#$id 
$by @ $dt - $status
Agent: $agent
$name
$descr";
    }

    public function setDBContentByNotifiable($notifiable){
        if($notifiable->isSuperadmin()){
            $this->setDBContent(
                "Tiket dibuat",
                "Tiket dibuat oleh x", 
                ""
            );
        }

        if($notifiable->isManager()){

        }
    }
}
