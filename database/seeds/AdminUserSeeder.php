<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    User::create([
		    'name' => 'Eugene Kutas',
		    'email' => 'evgenij.kutas@gmail.com',
		    'password' => bcrypt('ghjkju'),
	    ]);
    }
}
