<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'text', 'author_id'];

    /**
     * Увеличиваем счетчик просмотров поста на величину count
     * @param int $id  - post's id
     * @param int $count - how many views to add (1 - default)
     */
    public static function addViewCounts(int $id, int $count = 1)
    {
        for($i = 0; $i < $count; $i++ ){
            Postview::create(['post_id' => $id])->save();
        }
        return self::class;
    }
}
