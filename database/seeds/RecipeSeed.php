<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear out any old data if it exists
        DB::table('recipes')->delete();

        App\Recipe::create([
            'id'            => 1,
            'name'          => 'Cheesecake',
            'description'   => 'This is a cheesecake recipe',
            'created_at'    => '2016-09-29 19:27:24',
            'updated_at'    => '2016-09-29 19:27:24'
        ]);

        App\Ingredient::create([
            'id'        => 1,
            'recipe_id' => 1,
            'quantity'  => 1,
            'unit'      => 'cup',
            'name'      => 'milk',
            'created_at'    => '2016-09-29 19:27:24',
            'updated_at'    => '2016-09-29 19:27:24'
        ]);

        App\Direction::create([
            'id'            => 1,
            'recipe_id'     => 1,
            'step_num'      => 1,
            'direction_text' => 'Pour the milk into a container and put it in the oven.'
        ]);
    }
}