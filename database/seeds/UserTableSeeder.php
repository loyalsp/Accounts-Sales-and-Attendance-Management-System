<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->full_name = "Adnan Rasheed";
        $user->facebook_id = "loyal.sp";
        $user->email = "adnan@adnan.com";
        $user->password = bcrypt("adnan");
        $user->save();

    }
}
