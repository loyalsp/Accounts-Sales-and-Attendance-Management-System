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
        $user->full_name = "Talha Rasheed";
        $user->email = "talha@yahoo.com";
        $user->password = bcrypt("adnan");
        $user->save();
      $user = new User();
        $user->full_name = "Abdul Hafeez";
        $user->email = "abdul@yahoo.com";
        $user->password = bcrypt("adnan");
        $user->save();
      $user = new User();
        $user->full_name = "Aaniyah";
        $user->email = "aaniyah@yahoo.com";
        $user->password = bcrypt("adnan");
        $user->save();
      $user = new User();
        $user->full_name = "Aizah Adnan";
        $user->email = "aiza@yahoo.com";
        $user->password = bcrypt("adnan");
        $user->save();

    }
}
