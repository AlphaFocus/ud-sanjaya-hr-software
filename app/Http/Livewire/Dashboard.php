<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Production;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public function render()
    {
        $current = Carbon::now()->day(1);
        $usersTop = User::find(2);
        // $test = Production::get()
        // ->groupBy(function($item){
        //     return $item->created_at->format('d-m-Y');
        // })
        // ;
        //         // ->selectRaw('sum(quantity) as sum, created_at')
        //         ; 
        $prod = Production::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
        $prod2Week = Production::whereBetween('created_at', [Carbon::now()->subWeek(2), Carbon::now()->subWeek()])->sum('quantity');
        $prodWeek = $prod->select(
                DB::raw("(sum(quantity)) as quantity"),
                DB::raw("(DATE_FORMAT(created_at, '%d-%M-%Y')) as date")
                )
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%M-%Y')"))
                ->get();

        $prodYear = Production::select(
                    DB::raw("(sum(quantity)) as quantity"),
                    DB::raw("(DATE_FORMAT(created_at, '%M %Y')) as date")
                    )
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M %Y')"))
                    ->get();
        
        $sale = Sale::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
        $sale2Week = Sale::whereBetween('created_at', [Carbon::now()->subWeek(2), Carbon::now()->subWeek()])->sum('quantity');
        $saleWeek = $sale->select(
                DB::raw("(sum(quantity)) as quantity"),
                DB::raw("(DATE_FORMAT(created_at, '%d-%M-%Y')) as date")
                )
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%M-%Y')"))
                ->get();

        $saleYear = Sale::select(
                    DB::raw("(sum(quantity)) as quantity"),
                    DB::raw("(DATE_FORMAT(created_at, '%M %Y')) as date")
                    )
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M %Y')"))
                    ->get();
        
        // dd($prodYear);
        return view('livewire.dashboard', compact(
            'current', 'usersTop', 'prodWeek', 'prod2Week', 'prodYear', 'saleYear', 'saleWeek', 'sale2Week'
        ));
    }
}
