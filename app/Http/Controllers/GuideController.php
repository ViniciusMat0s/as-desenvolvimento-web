<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Explorer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::all();
        return view('guides.index', compact('guides'));
    }

    public function create()
    {
        Gate::authorize('create', Explorer::class);
        $guides = Guide::all();
        return view('explorer.create', compact('guides'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $guide = new Guide();
        $guide->name = $request->name;
        $guide->image = 'images/'.$imageName;
        $guide->save();

        return redirect('guides')->with('success', 'Guide created successfully.');
    }

    public function edit($id)
    {
        Gate::authorize('edit', Explorer::class);
        $explorer = Explorer::findOrFail($id);
        $guides = Guide::all();
        return view('explorer.edit', compact(['explorer', 'guides']));
    }

    public function update(Request $request, $id)
    {
        $guide = Guide::findOrFail($id);
        
        if(!is_null($request->image)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $guide->image = 'images/'.$imageName;
        }

        $guide->name = $request->name;
        $guide->save();

        return redirect('guides')->with('success', 'guides updated successfully.');
    }

    public function destroy($id)
    {
        $guides = Guide::findOrFail($id);
        $guides->delete();
        return redirect('guides')->with('success', 'Guides deleted successfully.');
    }
}
