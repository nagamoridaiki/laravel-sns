<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];
                            //戻り値の「型」を宣言
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

                            //?を付けると、その引数がnullであることも許容される。
    public function isLikedBy(?User $user): bool
    {
        //三項演算子を用いて$userがnullかどうかによって処理を振り分け
        return $user
            //$userがnullでない場合、この記事をいいねしたユーザーの中に、引数として渡された$userがいるかどうかを調べています。
            ? (bool)$this->likes->where('id', $user->id)->count()
            //$userがnullであれば、falseを返す。
            : false;
    }
}
