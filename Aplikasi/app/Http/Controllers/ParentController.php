<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ParentController extends Controller
{
      public function index()
    {
        $parents = ParentModel::all();

        return view('dashboard.parent', compact('parents'));
    }

    public function create()
    {
        $parents = ParentModel::all();

        return view('dashboard.parent', compact('parents'));
    }

    public function store(Request $request)
    {
         $request->validate([
        'nama' => 'required',
        'email' => 'required|email|unique:parents,email',
        'no_hp' => 'required',
        ]);

        $parent = ParentModel::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        Auth::user()->update([
            'parent_id' => $parent->id,
        ]);

        

        return redirect()->route('parents.index')
            ->with('success', 'Data parent berhasil ditambahkan');
    }

    public function edit($id)
    {
        $parent = ParentModel::findOrFail($id);
        $parents = ParentModel::all();

        return view('dashboard.parent', compact('parent', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $parent = ParentModel::findOrFail($id);

        $request->validate([
            'nama'  => 'required',
            'email' => 'required|email|unique:parents,email,' . $id,
            'no_hp' => 'required'
        ]);

        $parent->update([
            'nama'  => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('parents.index')
            ->with('success', 'Data parent berhasil diupdate');
    }

    public function destroy($id)
    {
        $parent = ParentModel::findOrFail($id);
        $parent->delete();

        return redirect()->route('parents.index')
            ->with('success', 'Data parent berhasil dihapus');
    }
}
