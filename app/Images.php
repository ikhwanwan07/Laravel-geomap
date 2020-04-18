<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $guarded = [];
    public $table = 'spaces_photos';
    protected $fillable = ['space_id','images'];

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id', 'id');
    }
}
