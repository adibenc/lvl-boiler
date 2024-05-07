<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Admin\JsonCrudController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends JsonCrudController {
    
    public function __construct(
        UserRepository $dataRepository
    ) {
        $this->dataRepository = $dataRepository;
        // $this->middleware("roles:sys"); // todo
    }

    public function show($id = null) {
        $data = [];
        try {
            $id = auth()->user()->id;
            $data = $this->dataRepository->show($id);

            return self::success("Ok", $data);
        } catch (\Exception $e) {
            return self::fail($e->getMessage(), $data);
        }
    }
    
    public function updateProfile(Request $req) {
        $data = [];
        try {
            $id = auth()->user()->id;
            $data = $this->dataRepository
                ->validate("update-profil", $req)
                ->updateProfile($id, $req);

            return self::success("Updated", $data);
        } catch (\Exception $e) {
            return self::fail($e->getMessage(), $data);
        }
    }

    public function updatePassword(Request $req) {
        $data = [];
        try {
            $id = auth()->user()->id;
            $data = $this->dataRepository
                ->validate("update-password", $req)
                ->updatePassword($id, $req);

            return self::success("Password updated!", $data);
        } catch (\Exception $e) {
            return self::fail($e->getMessage(), $data);
        }
    }
}
