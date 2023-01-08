<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','body'];

    //the reason for casting the body into an array is bcus I'm saving it....
    //as a json format in mysql and laravel will auto format it into a json..
    //so we dnt need to manually json_encode and json_decode
    protected $cast = [
        'body' => 'array',
    ];

    //since body has a json attribute
    //we have to set it to a json format even if empty
    protected $attributes = [
        'body' => "{}",
    ];

    //used to exclude columns of database from response
    protected $hidden = [];

    //we to include an accessor
    protected $append = [
        'title_upper'
    ];

    //creating an accessor
    //if we name any method with GET and the start and end with Attribute
    //laravel will consider it as an accessor
    public function getTitleUpperAttribute(){
        return strtoupper($this->title);
    }

    //we create a mutator
    public function setTitleAttribute($value){
        $this->attributes['title'] = strtolower($value);
    }

    public function user(){
        return $this->belongsToMany(User::class, 'post_user', 'post_id','user_id');
    }

    public function comment(){
        return $this->hasMany(Comment::class, 'post_id');
    }
}
