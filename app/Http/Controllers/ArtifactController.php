<?php

namespace App\Http\Controllers;

use App\Models\Expedition;
use Illuminate\Http\Request;
use App\Models\Artifact;



class ArtifactController extends Controller
{
    public function index()
    {
        $artifacts = Artifact::all();
        return view('artifacts.index', compact('artifacts'));
    }

    public function create()
    {
        return view('artifacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $artifact = new Artifact();
        $artifact->name = $request->name;
        $artifact->image = 'images/'.$imageName;
        $artifact->save();

        return redirect('artifacts')->with('success', 'Artifact created successfully.');
    }

    public function edit($id)
    {
        $artifact = Artifact::findOrFail($id);
        return view('artifacts.edit', compact('artifacts'));
    }

    public function update(Request $request, $id)
    {
        $artifact = Artifact::findOrFail($id);
        
        if(!is_null($request->image)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $artifact->image = 'images/'.$imageName;
        }

        $artifact->name = $request->name;
        $artifact->save();

        return redirect('artifacts')->with('success', 'Artifacts updated successfully.');
    }

    public function destroy($id)
    {
        $artifacts = Artifact::findOrFail($id);
        $artifacts->delete();
        return redirect('artifacts')->with('success', 'Artifacts deleted successfully.');
    }
}
