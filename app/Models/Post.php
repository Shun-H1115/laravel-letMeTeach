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

    public function scopeAvailableItems($query) {
        return $query;
    }

    // カテゴリ検索
    public function scopeSelectCategory($query, $categoryId) {
        if($categoryId !== '0') {
            return $query->where('category_id', $categoryId);
        }else{
            return ;
        }
    }

    // キーワード検索
    public function scopeSearchKeyword($query, $keyword) {
        if(!is_null($keyword)) {
            // 全角スペース→半角スペースに
            $spaceConvert = mb_convert_kana($keyword, 's');

            // 空白で区切る
            $keywords = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);

            foreach($keywords as $keyword) {
                $query->where('title', 'like', '%'.$keyword.'%');
            }
            return $query;
        }else{
            return ;
        }
    }

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'comment',
    ];
}
