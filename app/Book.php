<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $table = 'book';
    //protected $fillable = ['title', 'author'];
    protected $guarded = [];

    public function path()
    {
        return '/books/' . $this->id . '-' . Str::slug($this->title);
    }

    public function setAuthorIdAttribute($author)
    {
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name' => $author
        ]))->id;
    }
}
