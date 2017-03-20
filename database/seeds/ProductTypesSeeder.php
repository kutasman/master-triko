<?php

use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productTypes = [
	        'triko',
	        'default',
        ];

        foreach ($productTypes as $type){
        	ProductType::create([
        		'name' => ucfirst($type),
		        'slug' => $type,
	        ]);
        }
    }
}
