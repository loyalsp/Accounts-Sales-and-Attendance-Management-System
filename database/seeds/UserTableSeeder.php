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
        $user->email = "03317667004@yahoo.com";
        $user->password = bcrypt("adnan");
        $user->save();

      $user = new User();
        $user->full_name = "Adi Rasheed";
        $user->email = "adi@yahoo.com";
        $user->password = bcrypt("adnan");
        $user->save();

    }
}
