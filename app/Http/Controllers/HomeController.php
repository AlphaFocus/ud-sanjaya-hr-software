<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $role = Auth::user()->role;
        if($role == 1){
            return view('admin.dashboard');
        }
        else{
            return view('pages.dashboard', compact('user_id'));
        }
    }

    public function indexUser()
    {
        return view('pages.index-user');
    }

    public function showUser($id)
    {
        $user = User::find($id);
        return view('pages.show-user', compact('user'));
    }

    public function pdf($id)
    {
        $user = User::find($id);
        $productions = Production::where('user_id', $id)->whereBetween('created_at', [Carbon::today()->subWeek(), Carbon::now()])->orderBy('created_at', 'desc')->get();
        return view('pages.pdf', compact('productions', 'user'));
        // dd($productions);
    }
}
