<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThumbRecord extends Model
{
    protected $fillable = ['user_id','detail_id'];
    //
    public function thumbCreator()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function thumbOwn()
    {
        return $this->belongsTo(Detail::class, 'detail_id','id');
    }
}
