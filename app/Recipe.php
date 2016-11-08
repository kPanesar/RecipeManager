<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'photo'
    ];

    /**
     * Defines a one-to-many relationship.
     *
     * @see https://laravel.com/docs/5.3/eloquent-relationships#one-to-many
     */
    public function ingredients()
    {
        return $this->hasMany('App\Ingredient');
    }

    /**
     * Defines a one-to-many relationship.
     *
     * @see https://laravel.com/docs/5.3/eloquent-relationships#one-to-many
     */
    public function directions()
    {
        return $this->hasMany('App\Direction');
    }
}
