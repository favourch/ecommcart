<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogComment extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_comments';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'blog_id', 'user_id', 'status'];

    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the author associated with the blog post.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    /**
     * Scope a query to only include published comments.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('approved', 1);
    }

    /**
     * Scope a query to only include published comments.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnPublished($query)
    {
        return $query->where('approved', '!=', 1);
    }
}
