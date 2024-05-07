<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Traits\CRUDRepoTrait;
use App\Models\Data;

class DataRepository extends BaseRepository{
    use CRUDRepoTrait;

    public function __construct(){
        $this->setModel(Data::class);
    }
    
    public function insertData($attributes){
        return [
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
        ];
    }

    public function updateData($request){
        return [
            'name' => $request->name,
            'email' => $request->email
        ];
    }
}