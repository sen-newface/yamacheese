<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    /**
     * この写真が掲載されているイベントを取得
     *
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo('App\Event');
    }
}
