<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 分类表
 */
class Category extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $fillable = [
        'name', 'description'
    ];
}
