<?php

namespace App;

use App\Mail\BareMail;
use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //パスワード再設定処理　トレイトよりオーバーライド
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token, new BareMail()));
    }

    public function articles(): HasMany
    {
        return $this->hasMany('App\Article');
    }

    public function backgrounds(): HasMany
    {
        return $this->hasMany('App\Background');
    }

    public function skills(): HasMany
    {
        return $this->hasMany('App\Skill');
    }

    public function comment(): HasMany
    {
        return $this->hasMany('App\Comment');
    }

    //リレーション元のusersテーブルのidは、中間テーブルのfollowee_idと紐付く
    //リレーション先のusersテーブルのidは、中間テーブルのfollower_idと紐付く
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }

    //followersメソッドと第三・第四引数が逆になる。
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Article', 'likes')->withTimestamps();
    }

    //あるユーザーをフォロー中かどうか判定する
    public function isFollowedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->followers->where('id', $user->id)->count()
            : false;
    }

    public function getCountFollowersAttribute(): int
    {
        //このユーザーモデルのフォロワー
        return $this->followers->count();
    }
 
    public function getCountFollowingsAttribute(): int
    {
        //
        return $this->followings->count();
    }
}
