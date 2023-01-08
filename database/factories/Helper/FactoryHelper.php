<?php
namespace Database\Factories\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FactoryHelper
{
    /**
     * this will get a random model id from database
     * @param string | HasFactory $model
     */

    public static function getRandomId(string $model){
        $count = $model::query()->count();
        if($count === 0){
            //create post
            return $model::factory()->create()->id;
        }else{
            return rand(1, $count);
        }
    }
}