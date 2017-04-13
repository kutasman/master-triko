<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->truncateTables();

		$categories = factory(\App\Models\Category::class, 10)->create();
		foreach ($categories as $category){
			$category->factories()->attach($factories = factory(\App\Models\Factory::class, 10)->create());
			foreach ($factories as $factory){
				$factory->products()->saveMany( factory(\App\Models\Product::class, 5)->create());
			}
		}

    }

    protected function truncateTables(){
	    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
	    DB::table('factories')->truncate();
	    DB::table('products')->truncate();
	    DB::table('categories')->truncate();
	    \App\Models\Factory::truncate();
	    \App\Models\Category::truncate();
	    \App\Models\Product::truncate();
	    DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
