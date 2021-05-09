<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pokemon;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['message' => null, 'data' => Pokemon::all()], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validatePokemon();

        if ($validator->fails()) {
            return response()->json($validator->getMessagesBag(), 422);
        }

        $pokemon = Pokemon::create([
            'name' => $request->get('name'),
            'gender' => $request->get('gender'),
            'trainers_id' => $request->get('trainer_id'),
            'created_at' => Carbon::now()
        ]);

        return response()->json(['message' => 'Pokemon Created', 'data' => $pokemon], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $pokemon->types;

        return response()->json(['message' => null, 'data' => $pokemon], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validatePokemon()
    {
        return Validator::make(request()->all(), [
            'name' => 'string|required|max:255',
            'gender' => 'required|max:1',
            'trainer_id' => 'required|exists:trainers, id'
        ]);
    }
}
