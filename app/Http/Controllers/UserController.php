<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use App\Rules\IsRut;
use App\Models\Role;
use App\Models\User;
use App\Models\Ticket;
use App\Models\State;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '<>', Auth::user()->id)->get();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ToastrFactory $flasher)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
            'rut' => ['required', new IsRut, 'unique:users'],
            'phone' => ['required','digits_between:8,9','numeric'],
            'role' => ['required', 'exists:App\Models\Role,id'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rut' => $request->rut,
            'phone' => $request->phone,
            'role_id' => $request->role,
        ]);
        $flasher->addSuccess("Usuario creado correctamente!", "Enhorabuena");
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, ToastrFactory $flasher)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'rut' => ['required', new IsRut, Rule::unique('users')->ignore($user->id)],
            'phone' => ['required','digits_between:8,9','numeric'],
            'role' => ['required', 'exists:App\Models\Role,id'],
        ]);
        if ($request->password != null) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
            ]);
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'rut' => $request->rut,
            'phone' => $request->phone,
            'role_id' => $request->role,
        ]);
        $flasher->addSuccess("Usuario editado correctamente!", "Enhorabuena");
        return redirect()->route('users.index');
    }

    /**
     * Display a listing of the disabled resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function disabled()
    {
        $users = User::onlyTrashed()->get();
        return view('users.disabled', ['users' => $users]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, ToastrFactory $flasher)
    {
        $tickets = Ticket::where('user_id','=',$user->id)->where('state_id','=',State::OPEN_ID);
        $tickets->update([
            'user_id' => null
        ]);
        $user->delete();
        $flasher->addSuccess("Usuario deshabilitado correctamente!", "Enhorabuena");
        return redirect()->route('users.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function restore(User $user, ToastrFactory $flasher)
    {
        $user->restore();
        $user->save();
        $flasher->addSuccess("Usuario restaurado correctamente!", "Enhorabuena");
        return redirect()->route('users.index');
    }
}
