<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'body' => 'required|max:500',
            ///^(?!.*\s).+$/uは、PHPにおいて半角スペースが無いことをチェックする正規表現
            //rulesメソッド内に正規表現によるバリデーションを行うためにregex:を指定
            'tags' => 'json|regex:/^(?!.*\s).+$/u',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '本文',
            'tags' => 'タグ',
        ];
    }

    //フォームリクエストのバリデーションが成功した後に自動的に呼ばれるメソッド。バリデーション成功後に何か処理をしたければ、ここに処理を書く。
    public function passedValidation()
    {
        //JSON形式の文字列であるタグ情報を連想配列に変換。それをcollect関数を使ってコレクションに変換
        //コレクションに変換する理由は、この後で使うsliceメソッドやmapメソッドといった、便利なコレクションメソッドを使うため
        $this->tags = collect(json_decode($this->tags))
            //コレクションの要素が6個以上あったとしても、最初の5個だけが残る
            ->slice(0, 5)
            ->map(function ($requestTag) {
                return $requestTag->text;
            });
    }
}
