<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class Link extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'slug',
        'verified_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'verified_at' => 'datetime',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}