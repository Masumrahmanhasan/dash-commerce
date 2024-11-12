<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use function compact;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $products = Product::query()
            ->select('products.*')
            ->selectRaw('COUNT(order_items.id) as completed_order_items_count')
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'completed')
            ->groupBy('products.id')
            ->orderByDesc('completed_order_items_count')
            ->limit(5)
            ->with('category')
            ->get();

        $recentOrders = Order::query()
            ->with('user') // Assuming each order has a related user (customer)
            ->orderByDesc('created_at')
            ->select('id', 'order_number', 'total_price', 'status', 'user_id', 'created_at') // Select the relevant fields
            ->limit(5) // Limit to the most recent orders
            ->get();

        return view('dashboard', compact('products', 'recentOrders'));
    }
}
