<?php
namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\BaseRepository;
use App\Repositories\Traits\CRUDRepoTrait;

class TagsRepository extends BaseRepository{
    use CRUDRepoTrait;

    public function __construct(){
        $this->setModel(Tag::class);
    }
    
    public function insertData($attributes){
        $this->logsEvent($attributes);

        return [
            'name' => $attributes['name'], 
        ];
    }

    public function updateData($attributes){
        return [
            'name' => $attributes['name'], 
        ];
    }
}