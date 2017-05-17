<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Modificator extends Model
{


	protected $fillable = ['name', 'type', 'toggle'];

	protected $casts = [
	    'toggle' => 'boolean'
    ];


    //Relations______________

	public function factories()
	{
		return $this->morphedByMany(Factory::class, 'modificable');
	}

	public function products()
	{
		return $this->morphedByMany(Product::class, 'modificable');
	}

	public function options()
	{
		return $this->hasMany(ModOption::class);
	}

    public function rules()
    {
        return $this->hasMany(ModRule::class);
	}

	//Methods

    public function createRule(array $data){

	    $rule =  $this->rules()->create([
	        'option_id' => $data['option_id'],
            'target_id' => $data['target_id'],
            'action' => $data['action'],
        ]);

	    $this->update(['toggle' => true]);

	    return $rule;
    }

}
