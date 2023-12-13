<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $User=new User();
        $User->first_name="admin";
        $User->last_name="admin";
        $User->user_name="admin";
        $User->phone="000000000";
        $User->image="";
        $User->email="admin@gmail.com";
        $User->password=Hash::make('admin');
        $User->role_id=1;
        $User->zip_code="";
        $User->lat="";
        $User->long="";
        $User->save();
    }
}
