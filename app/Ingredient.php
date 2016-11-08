<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'quantity',
        'unit',
        'name'
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
