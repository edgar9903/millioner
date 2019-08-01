<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert admin

        $User = new User();
        $User->name = 'Edgar';
        $User->surname = 'Kirakosyan';
        $User->email = 'edgar.kirakosyan19@gmail.com';
        $User->password = Hash::make('12345678');
        $User->type = User::Admin;
        $User->save();
    }
}
