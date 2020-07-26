<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
    public function store(){
        $data=$this->validateRequest();
        $author=Author::create($data);

    }
    public function update(Author $author){
        $data=$this->validateRequest();
        $author->update($data);

    }
    public function destroy(Author $author){
        $author->delete();
    }
    protected function validateRequest(){
        return request()->validate([
            'name'=>'required',
            'dob'=>'required',
        ]);

    }
}
