<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{

    protected $accept;
    protected $fillable = ['id_user','start_vacation','finish_vacation','accept'];

public function __construct(array $attributes = [])
{
    parent::__construct($attributes);

}

    public function getUserName(){

        return $this->hasOne('App\Users','id','id_user');
    }
    public static function changeFormatDate($date){

        return \DateTime::createFromFormat('Y-m-d',$date)->format('d-m-Y');


    }
}
