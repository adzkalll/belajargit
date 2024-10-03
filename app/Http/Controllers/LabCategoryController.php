<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabCategories;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LabCategoryResource;

class LabCategoryController extends Controller
{
    public function index()
    {
        $labcat = LabCategories::all();
        return LabCategoryResource::collection($labcat->loadMissing(['authorId:id']));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' =>'required',
        ]);
        $validated['author'] = Auth::id();
        $labcat = LabCategories::create($validated);
        return new LabCategoryResource($labcat->loadMissing(['authorId:id']));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' =>'required',
        ]);

        $request['author'] = Auth::id();
        $labcat = LabCategories::findOrFail($id);
        $labcat->update($request->all());
        return new LabCategoryResource($labcat->loadMissing(['authorId:id']));
    }
    public function destroy(Request $request, $id)
    {
        $request['author'] = Auth::id();
        $labcat = LabCategories::findOrFail($id);
        $labcat->delete();
        return new LabCategoryResource($labcat);
    }
}
