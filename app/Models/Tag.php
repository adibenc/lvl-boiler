<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function lembaga(){
        return $this->where("type", "lembaga");
    }

    public function ticketType(){
        return $this->where("type", "tiket");
    }

    public function ticketStatus(){
        return $this->where("type", "ticket-status");
    }

    public function ticket(){
        return $this->morphedByMany(Tickets::class, 'taggable');
    }
}
