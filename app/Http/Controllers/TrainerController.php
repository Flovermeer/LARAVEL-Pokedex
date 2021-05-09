<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Trainer;
use App\Models\Pokemon;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainers = Trainer::all();
        return response()->json(['message' => null, 'data' => $trainers], 200);
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
        $validator = $this->validateTrainer();

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 422);
        }

        $trainer = Trainer::create([
            'name' => $request->get('name'),
            'gender' => $request->get('gender'),
            'home_town' => $request->get('home_town'),
            'created_at' => Carbon::now()
        ]);


        return response()->json(['message' => 'Trainer Created', 'data' => $trainer], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Trainer::findOrFail($id), 200);
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

        $trainer = Trainer::findOrFail($id);

        $validator = Validator::make(request()->all(), [
            'name' => 'string|unique:trainers|max:255',
            'gender' => 'max:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 422);
        }

        $trainer->update($request->all());


        return response()->json(['message' => 'Trainer Updated', 'data' => $trainer], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainer = Trainer::findOrFail($id);

        $trainer->delete();

        return response()->json(['message' => 'Trainer Destroyed'], 200);
    }

    public function indexPokemon($id)
    {
        $trainers = Trainer::findOrFail($id)->pokemon;
        return response()->json(['message' => null, 'data' => $trainers], 200);
    }

    public function showPokemon($id, $pokemonId)
    {
        $trainers = Trainer::findOrFail($id)->pokemon()->where('id', $pokemonId)->firstOrFail();
        return response()->json(['message' => null, 'data' => $trainers], 200);
    }

    public function validateTrainer()
    {
        return Validator::make(request()->all(), [
            'name' => 'required|string|unique:trainers|max:255',
            'gender' => 'required|max:1'
        ]);
    }
}
