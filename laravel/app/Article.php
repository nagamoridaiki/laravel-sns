<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
                            //戻り値の「型」を宣言
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
