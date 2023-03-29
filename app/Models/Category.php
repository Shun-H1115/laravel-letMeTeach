<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function posts() {
        return $this->hasMany(Posts::class);
    }

    public function commissions() {
        return $this->hasMany(Commissions::class);
    }

    protected $fillable = [
        'category_L',
        'category_S',
    ];
}
