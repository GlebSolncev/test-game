<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Game extends Model
{

    /**
     *
     */
    const TYPE_GAMES = [
        self::TYPE_LOSE => 'Lose',
        self::TYPE_WIN  => 'Win',
    ];

    /**
     *
     */
    const TYPE_LOSE = 0;

    /**
     *
     */
    const TYPE_WIN = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'type',
        'bonus',
    ];

    /**
     * @param int $value
     * @return string
     */
    public function getTypeAttribute(int $value){
        return self::TYPE_GAMES[$value];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}