<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'content_key',
        'content_type',
        'content_value',
    ];
}
