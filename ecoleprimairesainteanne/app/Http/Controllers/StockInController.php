<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    public function index()
    {
        $stockIns = StockIn::with('product')->latest()->paginate(10);
        return view('stock.in.index', compact('stockIns'));
    }

    public function create()
    {
        return view('stock.in.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Product_Name' => 'required|string|max:255',
            'Date' => 'required|date',
            'Quantity' => 'required|integer|min:1',
            'Unit_Price' => 'required|numeric|min:0',
            'Supplier' => 'required|string|max:255',
            'Reference_Number' => 'required|string|max:255|unique:stock_in,Reference_Number'
        ]);

        try {
            // First, find or create the product
            $product = Product::firstOrCreate(
                ['Product_Name' => $validated['Product_Name']]
            );

            // Calculate total price
            $total_price = $validated['Quantity'] * $validated['Unit_Price'];
            
            // Create stock in record
            StockIn::create([
                'Product_Id' => $product->ProductId,
                'Date' => $validated['Date'],
                'Quantity' => $validated['Quantity'],
                'Unit_Price' => $validated['Unit_Price'],
                'Total_Price' => $total_price,
                'Supplier' => $validated['Supplier'],
                'Reference_Number' => $validated['Reference_Number']
            ]);

            return redirect()->route('stock.in.index')->with('success', 'Stock entry recorded successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error recording stock in: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function show(StockIn $stockIn)
    {
        return view('stock.in.show', compact('stockIn'));
    }

    public function edit(StockIn $stockIn)
    {
        return view('stock.in.edit', compact('stockIn'));
    }

    public function update(Request $request, StockIn $stockIn)
    {
        $validated = $request->validate([
            'Product_Name' => 'required|string|max:255',
            'Date' => 'required|date',
            'Quantity' => 'required|integer|min:1',
            'Unit_Price' => 'required|numeric|min:0',
        ]);

        try {
            // First, find or create the product
            $product = Product::firstOrCreate(
                ['Product_Name' => $validated['Product_Name']]
            );

            // Calculate total price
            $total_price = $validated['Quantity'] * $validated['Unit_Price'];
            
            // Update stock in record
            $stockIn->update([
                'Product_Id' => $product->ProductId,
                'Date' => $validated['Date'],
                'Quantity' => $validated['Quantity'],
                'Unit_Price' => $validated['Unit_Price'],
                'Total_Price' => $total_price
            ]);

            return redirect()->route('stock.in.index')->with('success', 'Stock entry updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating stock in: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(StockIn $stockIn)
    {
        try {
            $stockIn->delete();
            return redirect()->route('stock.in.index')->with('success', 'Stock entry deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting stock in: ' . $e->getMessage());
        }
    }
} 