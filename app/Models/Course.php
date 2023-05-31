<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class)->withDefault();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'mycourses');
    }

    public function getTransTitleAttribute()
    {
        return json_decode($this->title, true)[app()->currentLocale()] ?? '';
    }

    public function getTitleEnAttribute()
    {
        return json_decode($this->title, true)['en'] ?? '';
    }

    public function getTitleArAttribute()
    {
        return json_decode($this->title, true)['ar'] ?? '';
    }

}
