<?php

namespace App\Notifications;

class TicketDeleted extends BaseNotif{
    
    public function toTelegram($notifiable){
        $ticket = $this->data['ticket'];
        
        $by = $ticket->byUser->username;
        $dt = $ticket->created_at;
        $descr = substr($ticket->descr, 0, 64);

        return "Tiket dihapus :
$by @ $dt
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
