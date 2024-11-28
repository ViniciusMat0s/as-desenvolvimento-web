<?php

namespace App\Http\Controllers;

use App\Models\Expedition;
use Illuminate\Http\Request;
use App\Models\Explorer;


class ExpeditionController extends Controller
{
    public function index()
    {
        $expeditions = Expedition::all();
        return view('expeditions.index', compact('expeditions'));
    }

    public function create()
    {
        return view('expeditions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $expedition = new Expedition();
        $expedition->name = $request->name;
        $expedition->image = 'images/'.$imageName;
        $expedition->save();

        return redirect('expeditions')->with('success', 'Expedition created successfully.');
    }

    public function edit($id)
    {
        $expedition = Expedition::findOrFail($id);
        return view('expeditions.edit', compact('expeditions'));
    }

    public function update(Request $request, $id)
    {
        $expedition = Expedition::findOrFail($id);
        
        if(!is_null($request->image)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $expedition->image = 'images/'.$imageName;
        }

        $expedition->name = $request->name;
        $expedition->save();

        return redirect('expeditions')->with('success', 'Expeditions updated successfully.');
    }

    public function destroy($id)
    {
        $expeditions = Expedition::findOrFail($id);
        $expeditions->delete();
        return redirect('expeditions')->with('success', 'Expeditions deleted successfully.');
    }
}
