<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Validation\Rule;
use Flasher\Toastr\Prime\ToastrFactory;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\SLA;
use App\Models\Functionary;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        if (!auth()->user()->is_coordinator) {
            $tickets = $tickets->where('user_id', auth()->user()->id);
        }
        //print_r($tickets);
        return view('tickets.index', ['tickets' => $tickets, 'close_state' => State::CLOSE_ID]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        $functionaries = Functionary::all();
        return view('tickets.create', ['functionaries' => $functionaries, 'categories' => $categories, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request, ToastrFactory $flasher)
    {
        $request->validate([
            'description' => ['required'],
            'category' => ['required'],
            'functionary' => ['required'],
            'user' => Rule::requiredIf(Auth::user()->is_coordinator),
        ]);
        $ticket = Ticket::create([
            'description' => $request->description,
            'category_id' => $request->category,
            'functionary_id' => $request->functionary,
            'sla_id' => SLA::LOW_ID,
            'state_id' => State::OPEN_ID,
            'user_id' => (Auth::user()->is_coordinator ? $request->user : Auth::user()->id),
        ]);
        $flasher->addSuccess("Ticket creado correctamente!", "Enhorabuena");
        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $users = User::all();
        $categories = Category::all();
        $functionaries = Functionary::all();
        return view('tickets.edit', ['ticket' => $ticket, 'categories' => $categories, 'functionaries' => $functionaries, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket, ToastrFactory $flasher)
    {
        $request->validate([
            'description' => ['required'],
            'category' => ['required'],
            'functionary' => ['required'],
            'user' => Rule::requiredIf(Auth::user()->is_coordinator),
        ]);
        $ticket->update([
            'description' => $request->description,
            'category_id' => $request->category,
            'functionary_id' => $request->functionary,
            'user_id' => (Auth::user()->is_coordinator ? $request->user : Auth::user()->id),
        ]);
        $flasher->addSuccess("Ticket editado correctamente!", "Enhorabuena");
        return redirect()->route('tickets.index');
    }

    public function close(Ticket $ticket, ToastrFactory $flasher)
    {
        $ticket->update([
            'state_id' => State::CLOSE_ID
        ]);
        $flasher->addSuccess("Ticket cerrado correctamente!", "Enhorabuena");
        return redirect()->route('tickets.index');
    }
    public function open(Ticket $ticket, ToastrFactory $flasher)
    {
        $ticket->update([
            'state_id' => State::OPEN_ID
        ]);
        $flasher->addSuccess("Ticket abierto correctamente!", "Enhorabuena");
        return redirect()->route('tickets.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
