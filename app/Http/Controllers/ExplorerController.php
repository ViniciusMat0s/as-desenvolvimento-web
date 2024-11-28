<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Explorer;
use App\Models\Expedition;
use App\Models\Guide;
use App\Models\Artifact;




class ExplorerController extends Controller
{
    public function index()
    {
        $explorer = Explorer::all();
        return view('explorer.index', compact('explorer'));
    }

    public function create()
    {
        Gate::authorize('create', Explorer::class);
        $expeditions = Expedition::all();
        return view('explorer.create', compact('expeditions'));
        $guides = Guide::all();
        return view('guide.create', compact('guides'));
        $artifacts = Artifact::all();
        return view('artifact.create', compact('artifacts'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'identification' => 'required',
            'email' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $explorer = new Explorer();
        $explorer->name = $request->name;
        $explorer->identification = $request->identification;
        $explorer->email = $request->email;
        $explorer->image = 'images/'.$imageName;
        $explorer->save();

        return redirect('explorer')->with('success', 'Explorer created successfully.');
    }

    public function edit($id)
    {
        Gate::authorize('edit', Explorer::class);
        $explorer = Explorer::findOrFail($id);
        $explorer = Expedition::all();
        return view('explorer.edit', compact(['explorer', 'expeditions']));
        $explorer = Guide::all();
        return view('explorer.edit', compact(['explorer', 'guides']));
        $artifact = Guide::all();
        return view('explorer.edit', compact(['explorer', 'artifacts']));
    }

    public function update(Request $request, $id)
    {
        $explorer = Explorer::findOrFail($id);
        
        if(!is_null($request->image)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $explorer->image = 'images/'.$imageName;
        }

        $explorer->name = $request->name;
        $explorer->identification = $request->identification;
        $explorer->email = $request->email;
        $explorer->save();

        return redirect('explorer')->with('success', 'Explorer updated successfully.');
    }

    public function destroy($id)
    {
        $explorer = Explorer::findOrFail($id);
        $explorer->delete();
        return redirect('explorer')->with('success', 'Explorer deleted successfully.');
    }
}