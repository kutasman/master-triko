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
		$this->truncateTables();

	    User::create([
		    'name' => 'Eugene Kutas',
		    'email' => 'evgenij.kutas@gmail.com',
		    'password' => bcrypt('ghjkju'),
	    ]);
    }

    protected function truncateTables()
    {
	    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
	    DB::table('users')->truncate();
	    \App\Models\User::truncate();
	    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
