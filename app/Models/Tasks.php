<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'deadline',
        'tag_id',
        'user_id',
        'status',
    ];

    public function tag() {
        return $this->hasOne(Tags::class, 'id', 'tag_id');
    }
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
