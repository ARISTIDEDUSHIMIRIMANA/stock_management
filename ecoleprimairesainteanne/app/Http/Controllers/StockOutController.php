<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = StockOut::with('product')->latest()->paginate(10);
        return view('stock.out.index', compact('stockOuts'));
    }

    public function create()
    {
        $products = Product::all()->map(function ($product) {
            $product->available_stock = $product->available_stock;
            return $product;
        });
        return view('stock.out.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Product_Id' => 'required|exists:products,ProductId',
            'Quantity' => 'required|integer|min:1',
            'Date' => 'required|date',
        ]);

        try {
            $product = Product::findOrFail($validated['Product_Id']);
            
            // Check if there's enough stock
            if ($validated['Quantity'] > $product->available_stock) {
                return back()->with('error', 'Not enough stock available. Available: ' . $product->available_stock)
                            ->withInput();
            }

            // Create stock out record
            StockOut::create([
                'Product_Id' => $validated['Product_Id'],
                'Quantity' => $validated['Quantity'],
                'Date' => $validated['Date'],
            ]);

            return redirect()->route('stock.out.index')
                           ->with('success', 'Stock out recorded successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error recording stock out: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function show(StockOut $stockOut)
    {
        return view('stock.out.show', compact('stockOut'));
    }

    public function edit(StockOut $stockOut)
    {
        $products = Product::all()->map(function ($product) use ($stockOut) {
            $product->available_stock = $product->available_stock + ($product->ProductId == $stockOut->Product_Id ? $stockOut->Quantity : 0);
            return $product;
        });
        return view('stock.out.edit', compact('stockOut', 'products'));
    }

    public function update(Request $request, StockOut $stockOut)
    {
        $validated = $request->validate([
            'Product_Id' => 'required|exists:products,ProductId',
            'Quantity' => 'required|integer|min:1',
            'Date' => 'required|date',
        ]);

        try {
            $product = Product::findOrFail($validated['Product_Id']);
            
            // Calculate available stock plus current stock out quantity (if same product)
            $availableStock = $product->available_stock;
            if ($product->ProductId == $stockOut->Product_Id) {
                $availableStock += $stockOut->Quantity;
            }

            // Check if there's enough stock
            if ($validated['Quantity'] > $availableStock) {
                return back()->with('error', 'Not enough stock available. Available: ' . $availableStock)
                            ->withInput();
            }

            // Update stock out record
            $stockOut->update([
                'Product_Id' => $validated['Product_Id'],
                'Quantity' => $validated['Quantity'],
                'Date' => $validated['Date'],
            ]);

            return redirect()->route('stock.out.index')
                           ->with('success', 'Stock out updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating stock out: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(StockOut $stockOut)
    {
        try {
            $stockOut->delete();
            return redirect()->route('stock.out.index')
                           ->with('success', 'Stock out deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting stock out: ' . $e->getMessage());
        }
    }
} 