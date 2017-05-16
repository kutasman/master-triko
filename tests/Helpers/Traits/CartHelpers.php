<?php
/**
 * Created by PhpStorm.
 * User: kutas
 * Date: 5/16/17
 * Time: 9:51 PM
 */

namespace Tests\Helpers\Traits;


use App\Models\Modificator;
use App\Models\Product;

trait CartHelpers
{


    public function getModFormData($modificators)
    {
        $data = [];

        foreach ($modificators as $mod){

            if ('text' == $mod->type)
            {
                $data['text'] = [$mod->id => 'test text'];
            } else {
                $data[$mod->type] = [$mod->id => $mod->options()->first()->id];
            }
        }

        return $data;
    }


    /**
     * @param array $option Default value for option
     *
     * @return mixed
     */
    protected function createProductWithModificators(array $option = [ 'name' => 'test', 'rise' =>10])
    {

        $product = factory(Product::class)->create();

        $mod_select = factory(Modificator::class)->create()->each(function ($m) use ($option){
            if ( ! empty($option)){
                $m->options()->create($option);
            }
        });

        $mod_text = factory(Modificator::class)->create(['type' => 'text']);

        $product->modificators()->attach($mod_select);
        $product->modificators()->attach($mod_text);

        return $product;
    }
}