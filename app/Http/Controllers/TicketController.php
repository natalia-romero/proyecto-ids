<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Validation\Rule;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use App\Models\File;
use App\Models\Category;
use App\Models\SLA;
use App\Models\Functionary;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tickets = Ticket::all();
        if (!auth()->user()->is_coordinator) {
            $tickets = $tickets->where('user_id', auth()->user()->id);
        }
        if (!empty($request['state'])) {
            $tickets = $tickets->where('state_id', $request['state']);
        }
        if (!empty($request['sla'])) {
            $tickets = $tickets->where('sla_id', $request['sla']);
        }
        if (!empty($request['user'])) {
            $tickets = $tickets->where('user_id', $request['user']);
        }
        $users = User::where('id', '<>', auth()->user()->id)->get();
        $states = State::all();
        $slas = SLA::all();
        return view('tickets.index', ['tickets' => $tickets, 'close_state' => State::CLOSE_ID, 'slas' => $slas, 'states' => $states, 'users' => $users]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id', '<>', auth()->user()->id)->get();
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
            'sla_id' => SLA::NORMAL_ID,
            'state_id' => State::OPEN_ID,
            'user_id' => (Auth::user()->is_coordinator ? $request->user : Auth::user()->id),
        ]);
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('public/documents');
                $name = $file->getClientOriginalName();
                $new_file = File::create([
                    'name' => $name,
                    'path' => $path,
                    'ticket_id' => $ticket->id,
                ]);
            }
        }
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
        $users = User::where('id', '<>', auth()->user()->id)->get();
        $states = State::all();
        $categories = Category::all();
        $functionaries = Functionary::all();
        return view('tickets.edit', ['ticket' => $ticket, 'categories' => $categories, 'functionaries' => $functionaries, 'users' => $users, 'states' => $states]);
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
            'state' => ['required'],
            'user' => Rule::requiredIf(Auth::user()->is_coordinator),
        ]);
        $ticket->update([
            'description' => $request->description,
            'state_id' => $request->state,
            'category_id' => $request->category,
            'functionary_id' => $request->functionary,
            'user_id' => (Auth::user()->is_coordinator ? $request->user : Auth::user()->id),
        ]);
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('public/documents');
                $name = $file->getClientOriginalName();
                $new_file = File::create([
                    'name' => $name,
                    'path' => $path,
                    'ticket_id' => $ticket->id,
                ]);
            }
        }
        $flasher->addSuccess("Ticket editado correctamente!", "Enhorabuena");
        return redirect()->route('tickets.index');
    }

    public function close(Ticket $ticket, ToastrFactory $flasher)
    {
        $ticket->update([
            'state_id' => State::CLOSE_ID,
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
