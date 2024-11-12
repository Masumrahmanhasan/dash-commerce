<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use function compact;

class HomeController extends Controller
{
    public function index(): View|Factory|Application
    {
        $products = Product::with('category')->paginate(20);
        return view('welcome', compact('products'));
    }
}
