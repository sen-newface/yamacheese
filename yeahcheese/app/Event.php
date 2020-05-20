<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    
    protected $fillable = [
        'name',
        'start_at',
        'end_at',
    ];

    /**
     * このイベントの作成者を取得
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    /**
     * イベント情報から写真を取得
     *
     * @return HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany('App\Photo');
    }
}
