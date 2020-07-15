<?php

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Users\UserInterface;
use App\User;
use Illuminate\Support\Facades\Session;
use Cartalyst\Sentinel\Activations\EloquentActivation;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Support\Facades\DB;
class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//
//        $credential = [
//            'email' => 'admin@gmail.com',
//            'password' => '123456',
//            'first_name' => 'admin',
//            'last_name' => 'admin',
//
//        ];
//        $user_act = \Sentinel::registerAndActivate($credential);
//        $role =  \Sentinel::findRoleByName('admin');
//        $role->users()->attach($user_act);
    }
}

