<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function stockIn(Request $request)
    {
        $query = StockIn::with(['product.category']);
        $products = Product::all();
        $data = $this->applyFilters($query, $request);

        return view('reports.stock-in', compact('data', 'products'));
    }

    public function stockOut(Request $request)
    {
        $query = StockOut::with(['product.category']);
        $products = Product::all();
        $data = $this->applyFilters($query, $request);

        return view('reports.stock-out', compact('data', 'products'));
    }

    protected function applyFilters($query, Request $request)
    {
        if ($request->filled('product_id')) {
            $query->where('Product_Id', $request->product_id);
        }

        if ($request->filled('date_range')) {
            switch ($request->date_range) {
                case 'today':
                    $query->whereDate('Date', Carbon::today());
                    break;
                case 'week':
                    $query->whereBetween('Date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('Date', Carbon::now()->month);
                    break;
                case 'year':
                    $query->whereYear('Date', Carbon::now()->year);
                    break;
                case 'custom':
                    if ($request->filled('start_date') && $request->filled('end_date')) {
                        $query->whereBetween('Date', [
                            Carbon::parse($request->start_date)->startOfDay(),
                            Carbon::parse($request->end_date)->endOfDay()
                        ]);
                    }
                    break;
            }
        }

        if ($request->filled('hour_range')) {
            $query->whereTime('Date', '>=', $request->hour_range . ':00:00')
                  ->whereTime('Date', '<', ($request->hour_range + 1) . ':00:00');
        }

        return $query->latest('Date')->paginate(15);
    }
} 