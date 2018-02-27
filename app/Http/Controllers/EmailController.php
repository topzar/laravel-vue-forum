<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    public function confirm()
    {
        return 'email confirm page';
    }

    public function test()
    {
        return DB::table('users')->get();
    }
}
