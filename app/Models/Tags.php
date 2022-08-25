<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'title',
    ];

    public function task()
    {
        return $this->belongsTo(Tasks::class);
    }
}
