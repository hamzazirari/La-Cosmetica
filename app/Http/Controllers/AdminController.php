<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        
        $stats = DB::table('orders')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        
        $total = DB::table('orders')->count();

      
        $lastOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->take(10)
            ->get();

        return response()->json([
            'stats' => [
                'total'          => $total,
                'par_statut'     => $stats,
            ],
            'last_orders' => $lastOrders,
        ]);
    }
}