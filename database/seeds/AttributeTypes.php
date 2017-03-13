<?php

use Illuminate\Database\Seeder;

class AttributeTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['radio', 'checkbox', 'select', 'text', 'number'];

        foreach ($types as $type){

        	\App\Models\AttributeType::create([
        		'name' => ucfirst($type),
		        'type' => $type,
	        ]);
        }

    }
}
