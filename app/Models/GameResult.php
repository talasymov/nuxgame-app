<?php

namespace App\Models;

use Database\Factories\GameResultFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    /** @use HasFactory<GameResultFactory> */
    use HasFactory;

    protected $fillable = [
        'link_id',
        'number',
        'result',
        'amount',
    ];
}
