<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


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

    //いいね数をカウントするアクセサ
    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    //記事モデルとタグモデルの関係は多対多
    public function tags(): BelongsToMany
    {
        //今回は中間テーブルの名前がarticle_tagといった2つのモデル名の単数形をアルファベット順に結合しており、第二引数は省略可能
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function comments(): HasMany
    {
        return $this->hasMany('App\Comment');
    }

    //コメント数をカウントするアクセサ
    public function getCountCommentAttribute(): int
    {
        return $this->comments->count();
    }
}
