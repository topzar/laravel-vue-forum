<?php


namespace App\Http\Repositories;


use App\User;

class UserRepository
{

    public function byId($id)
    {
        return User::find($id);
    }

    public function byName($name)
    {
        return User::where('name', $name)->first();
    }
}