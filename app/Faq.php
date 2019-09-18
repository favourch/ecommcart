<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faqs';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'deleted_at'];

    /**
     * Get the Topic associated with the faq.
     */
    public function topic()
    {
        return $this->belongsTo(FaqTopic::class, 'faq_topic_id');
    }

    /**
     * Get the question with replaced placeholder.
     *
     * @return string
     */
    public function getQuestionAttribute($question)
    {
        return str_replace([':marketplace_url', ':marketplace'], ['<a href="' . url('/') . '" target="_black">' . url('/') . '</a>', get_platform_title()], $question);
    }

    /**
     * Get the question with replaced placeholder.
     *
     * @return string
     */
    public function getAnswerAttribute($answer)
    {
        return str_replace([':marketplace_url', ':marketplace'], ['<a href="' . url('/') . '" target="_black">' . url('/') . '</a>', get_platform_title()], $answer);
    }
}
