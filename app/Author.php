<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'author';
    //protected $fillable = ['name', 'dob'];
    protected $guarded = [];
    protected $dates = ['dob'];

    // Mutator
    public function setDobAttribute($dob) // Follow laravel naming convention set+Column-name+Attribute
    {
        // Gets dob model attribute from model attributes array and parse it to Carbon object
        $this->attributes['dob'] = Carbon::parse($dob);
    }
}
