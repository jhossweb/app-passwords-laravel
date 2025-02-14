<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Passwords extends Model
{
    protected $fillable = [
        "title_site",
        "site_url",
        "gen_password"
    ];

    function user (): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
