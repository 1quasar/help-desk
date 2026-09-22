<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departament;
use App\Http\Requests\DepartamentRequest;

class DepartamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = $request->get('search');

        $departaments = Departament::with('tickets')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name', 'asc')
            ->paginate(10)
            -withQueryString();

        return view('departaments.index', compact('departaments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departaments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartamentRequest $request)
    {
        Departament::create($request->validated());

        return redirect()
            ->route('departaments.index')
            ->with('success', 'Departamento Cadastradado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('departaments.edit', compact('departament'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $departament->update($request->validated());

        return redirect()
            ->route('departaments.index')
            ->with('success', 'Departamento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
