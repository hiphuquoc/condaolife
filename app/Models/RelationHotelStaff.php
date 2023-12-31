<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationHotelStaff extends Model {
    use HasFactory;
    protected $table        = 'relation_hotel_staff';
    protected $fillable     = [
        'hotel_info_id', 
        'staff_info_id'
    ];
    public $timestamps      = false;

    public static function insertItem($params){
        $id             = 0;
        if(!empty($params)){
            $model      = new RelationHotelStaff();
            foreach($params as $key => $value) $model->{$key}  = $value;
            $model->save();
            $id         = $model->id;
        }
        return $id;
    }

    public function infoStaff(){
        return $this->hasOne(\App\Models\Staff::class, 'id', 'staff_info_id');
    }
}
