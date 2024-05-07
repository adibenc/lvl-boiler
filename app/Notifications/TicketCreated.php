<?php

namespace App\Notifications;

class TicketCreated extends BaseNotif{

    public function toTelegram($notifiable){
        $ticket = $this->data['ticket'];
        
        // to do : save data to serialized queue insted of requerying using eloquent
        $by = $ticket->byUser->username;
        $dt = $ticket->created_at;
        $name = $ticket->name;
        $agent = $ticket->getAgent->username;
        $status = $ticket->last_status;
        $descr = $ticket->descr;

        return "Tiket Baru :
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
