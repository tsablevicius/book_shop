<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'books';
    protected $fillable = [
        'title',
        'description',
        'price',
        'discount',
        'year',
        'cover_img_path',
        'is_confirmed',
        'user_id',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class)
            ->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class)
            ->withTimestamps();
    }

}
