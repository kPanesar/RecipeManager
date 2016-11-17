<?php

namespace App\Http\Controllers;

use App\Direction;
use App\Http\Requests\DeleteRecipesRequest;
use App\Http\Requests\StoreRecipesRequest;
use App\Http\Requests\UpdateRecipesRequest;
use Illuminate\Http\Request;
use App\Recipe;
use App\Ingredient;

use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\App;

class RecipesController extends Controller
{

    use FileUploadTrait;

    /**
     * Display all recipes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::with('ingredients', 'directions')->get();
        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating new Recipe.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created Recipe in storage.
     *
     * @param  \App\Http\Requests\StoreRecipesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipesRequest $request)
    {
        $request = $this->saveFiles($request);
        $recipe = Recipe::create($request->all());

        // Update Ingredients
        $ingredients = $request->get('ingredients');

        if(is_array($ingredients)) {
            foreach ($ingredients as $ingredient){
                $new_ingredient = new Ingredient($ingredient);
                $recipe->ingredients()->save($new_ingredient);
            }
        }

        // Update Directions
        $directions = $request->get('directions');

        if(is_array($directions)) {
            foreach ($directions as $direction){
                $new_direction = new Direction($direction);
                $recipe->directions()->save($new_direction);
            }
        }

        return 'Store Successful.';
    }

    /**
     * Show the form for editing Recipe.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$ingredient = Ingredient::orderBy('name')->get();
        $recipe = Recipe::with('ingredients', 'directions')->findOrFail($id);
        return view('recipes.edit', compact('recipe'));
    }

    public function show($id)
    {
        $recipe = Recipe::with('ingredients', 'directions')->findOrFail($id);
        return compact('recipe');
    }

    /**
     * Update Recipe in storage.
     *
     * @param  \App\Http\Requests\UpdateRecipesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecipesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $recipe = Recipe::findOrFail($id);
        $recipe->update($request->all());

        // Update Ingredients
        $ingredients = $request->get('ingredients');

        if(is_array($ingredients)) {
            //Delete all current ingredients
            Ingredient::where('recipe_id', $recipe->id)->delete();
            foreach ($ingredients as $ingredient){
                $new_ingredient = new Ingredient($ingredient);
                $recipe->ingredients()->save($new_ingredient);
            }
        }

        // Update Directions
        $directions = $request->get('directions');

        if(is_array($directions)) {
            //Delete all current ingredients
            Direction::where('recipe_id', $recipe->id)->delete();
            foreach ($directions as $direction){
                $new_direction = new Direction($direction);
                $recipe->directions()->save($new_direction);
            }
        }

        return 'Save Successful.';
    }

    /**
     * Remove Recipe from storage.
     *
     * @param  \App\Http\Requests\DeleteRecipesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRecipesRequest $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        //Only delete if it exists
        if(!empty($recipe)) $recipe->delete();

        // Delete Ingredients
        $ingredients = $request->get('ingredients');
        if(is_array($ingredients)) {
            Ingredient::where('recipe_id', $recipe->id)->delete();
        }

        // Delete Directions
        $directions = $request->get('directions');
        if(is_array($directions)) {
            Direction::where('recipe_id', $recipe->id)->delete();
        }

        return 'Delete Successful.';
    }
}
