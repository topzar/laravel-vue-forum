<?php

namespace App\Http\Controllers;

use Jenssegers\Date\Date;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function userHome($userName)
    {
        return $userName;
    }

    public function test()
    {
        Date::setLocale('ug');

        echo Date::now()->format('l j F Y H:i:s');

        echo "<br/>";

        echo Date::parse('-1 day')->diffForHumans();
        echo "<br/>";

        //echo Date::create('2018-03-01 10:08:05')->diffForHumans();
        echo Date::parse('2018-04-21 23:08:05')->diffForHumans(Date::now());
        echo "<br/>";

        $date = new Date('+1000 days');
        echo Date::now()->timespan($date);


    }
}
