<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Helper;

class Student extends Model
{
    protected $table = "siswa";

    protected $primaryKey = "id";
    
    protected $guarded = ['id'];

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Helper::randString();
            $model->password = Helper::randPassword();
        });
    }
}
