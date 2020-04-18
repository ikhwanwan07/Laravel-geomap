<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpacePhoto extends Model
{
    protected $guarded = [];
    protected $table = 'space_photos';
    protected $fillable = ['space_id','path'];

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id', 'id');
    }
}
