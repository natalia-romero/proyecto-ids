<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nowYear = Carbon::now()->format('Y');
        $nowMonth = Carbon::now()->month;
        $donutData = Ticket::selectRaw('user_id, COUNT(*) as count')
            ->groupBy('user_id')
            ->get();
        $lineData = Ticket::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $nowYear)
            ->groupBy('month')
            ->get();
        $barData = Ticket::selectRaw('state_id, MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $nowYear)
            ->groupBy('month')
            ->groupBy('state_id')
            ->get();
        $barHorizontalData = Category::selectRaw('categories.name, COUNT(*) as count')
            ->join('tickets', 'categories.id', '=', 'tickets.category_id')
            ->whereYear('tickets.created_at', $nowYear) // Especifica la tabla 'tickets'
            ->whereMonth('tickets.created_at', $nowMonth) // Especifica la tabla 'categories'
            ->groupBy('categories.name') // Especifica la tabla 'categories'
            ->orderBy('count','DESC')
            ->limit(5)
            ->get();
        $users = User::where('role_id', '<>', Role::COORDINATOR_ID)->get(['id', 'name']);
        return view('stats.index', ['barData' => $barData, 'lineData' => $lineData, 'donutData' => $donutData, 'users' => $users, 'barHorizontalData' => $barHorizontalData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
