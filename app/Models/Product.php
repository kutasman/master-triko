<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'title','price', 'factory_id', 'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    //Relations

	public function attributes()
	{
		return $this->hasMany(Attribute::class);
	}

	public function images()
	{
		return $this->morphMany(Image::class, 'imageable');
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
	}

	public function type()
	{
		return $this->belongsTo(ProductType::class, 'type_slug', 'slug');
	}

	public function factory()
	{
		return $this->belongsTo(Factory::class);
	}

	public function modificators()
	{
		return $this->morphToMany(Modificator::class, 'modificable');
	}

    public function mod_rules()
    {
        return $this->hasMany(ModRule::class);
	}

	//Methods

    public function createRule(array $data){

        $rule =  $this->mod_rules()->create([
            'toggle_id' => $data['toggle_id'],
            'toggle_option_id' => $data['toggle_option_id'],
            'target_id' => $data['target_id'],
            'action' => $data['action'],
        ]);

        return $rule;
    }

    //Helper
    public function hasRules(){

        return !! $this->mod_rules->count();

    }

}
