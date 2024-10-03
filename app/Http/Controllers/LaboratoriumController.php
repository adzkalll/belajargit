<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LaboratoriumResource;

class LaboratoriumController extends Controller
{
    public function index()
    {
        $lab = Laboratorium::all();
        return  LaboratoriumResource::collection($lab->loadMissing(['lab_category:id,name', 'userId:id,username,password']));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'laboratorium_category_id' => 'required|exists:laboratorium_category,id',
            'name' => 'required',
            'description' =>'required',
            'head_of_lab' => 'required',
            'start_operasional_hour' => 'required',
            'end_operasional_hour' => 'required',
        ]);
        $validated['user_id'] = Auth::id();

        $request = Laboratorium::create($validated);

        return new LaboratoriumResource($request->loadMissing(['userId:id', 'lab_category:id,name']));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'laboratorium_category_id' => 'required',
            'name' => 'required',
            'description' =>'required',
            'head_of_lab' => 'required',
            'start_operasional_hour' => 'required',
            'end_operasional_hour' => 'required',
        ]);
        $request['user_id'] = Auth::id();
        $lab = Laboratorium::findOrFail($id);
        $lab->update($request->all());
        return new LaboratoriumResource($lab->loadMissing(['lab_category:id,name']));
    }
    public function destroy(Request $request, $id)
    {
        $request['user_id'] = Auth::id();
        $lab = Laboratorium::findOrFail($id);
        $lab->delete();
        return new LaboratoriumResource($lab->loadMissing(['lab_category:id,name']));
    }
}
