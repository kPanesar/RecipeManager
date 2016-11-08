<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $fillable = [
        'step_num',
        'direction_text'
    ];

    /**
     * Defines an inverse one-to-many relationship.
     *
     * @see https://laravel.com/docs/5.3/eloquent-relationships#one-to-many-inverse
     */
    public function recipe()
    {
        return $this->belongsTo('App\Recipe');
    }
}
