<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function file() {
        return $this->belongsTo(File::class);
    }

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'comment',
    ];
}
