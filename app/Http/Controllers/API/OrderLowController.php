<?php
declare(strict_types=1);
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\SendResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderLowController extends Controller
{
    use SendResponse;
    use AuthorizesRequests;
    /**
     * with this approach less data in memory
     * and execution time 0.09 sec
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(): JsonResponse
    {
        $this->authorize('viewAny', Order::class);
        $orders = Order::query()->select('orders.*', 'products.*', 'categories.name as category_name')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->get()
            ->groupBy('category_name');

        return $this->success($orders, 'Orders retrieved successfully.');
    }
}
