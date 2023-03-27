<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function files() {
        return $this->hasMany(File::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'comment',
    ];
}
