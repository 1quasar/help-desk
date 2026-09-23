<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $tickets = Ticket::with('departament')
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            ->orderBy('title', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('tickets.index', compact('tickets', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Ticket::create($request->validated());

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado registrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tickets = Ticket::orderBy('title', 'asc')->get();

        return view('tickets.edit', compact('tickets', 'departaments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update($request->validated());

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado removido com sucesso!');
    }
}
