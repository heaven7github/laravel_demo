<?php declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function list()
    {
        return Product::all()->toArray();
    }

    public function pdf()
    {
        $pdf = Pdf::setOption(['dpi' => 150])->loadView('pdf', ['products' => Product::all()]);
        return $pdf->download('pdf');
    }

    public function api(): JsonResponse
    {
        return response()->json(['product' => Product::first()]);
    }

    public function raw()
    {
        return DB::select( "SELECT * FROM products LIMIT 2");
    }
}
