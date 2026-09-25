<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;

class TicketController extends Controller
{
    private $departments;

    public function __construct()
    {
        $this->departments = Department::all();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $tickets = Ticket::with('department')
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            ->orderBy('title', 'asc')
            ->paginate(10)
            ->withQueryString();

        $departments = $this->departments;

        return view('tickets.index', compact(['tickets', 'search', 'departments']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create', [
            'departments' => $this->departments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        Ticket::create([
            'department_id' => $request->department_id,
            'title' => $request->title,
            'requester_name' => $request->requester_name,
            'priority' => $request->priority,
            'description' => $request->description
        ]);

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Chamado registrado com sucesso!');
    }

     /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $departments = $this->departments;

        $ticket->load([
            'department',
        ]);
        return view('tickets.show', compact('ticket', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $departments = $this->departments;

        return view('tickets.edit', compact('ticket', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $depatments = $this->departments;
        $ticket->update([
            'department_id' => $request->department_id,
            'title' => $request->title,
            'requester_name' => $request->requester_name,
            'priority' => $request->priority,
            'description' => $request->description,
            'status' => $request->status,
        ]);

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
