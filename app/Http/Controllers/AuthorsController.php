<?php

namespace App\Http\Controllers;

use App\Author;

class AuthorsController extends Controller
{
    public function create()
    {
        return view('authors.create');
    }

    public function store()
    {
        Author::create($this->validateRequest());
    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'dob' => 'required'
        ]);
    }
}
