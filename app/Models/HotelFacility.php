<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelFacility extends Model {
    use HasFactory;
    protected $table        = 'hotel_facility';
    protected $fillable     = [
        'name',
        'category_name',
        'icon',
        'type',
        'highlight'
    ];
    public $timestamps      = false;

    public static function insertItem($params){
        $id                 = 0;
        if(!empty($params)){
            $model          = new HotelFacility();
            foreach($params as $key => $value) $model->{$key}  = $value;
            $model->save();
            $id             = $model->id;
        }
        return $id;
    }

    public static function updateItem($id, $params){
        $flag           = false;
        if(!empty($id)&&!empty($params)){
            $model      = self::find($id);
            foreach($params as $key => $value) $model->{$key}  = $value;
            $flag       = $model->update();
        }
        return $flag;
    }

    // public function prices(){
    //     return $this->hasMany(\App\Models\Ho::class, 'tour_option_id', 'id');
    // }
}
