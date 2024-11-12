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

class OrderHighController extends Controller
{
    use SendResponse;
    use AuthorizesRequests;

    /**
     * with this approach data is structured but memory size is 18mb
     * and execution time is 0.12 sec
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(): JsonResponse
    {
        $this->authorize('viewAny', Order::class);
        $orders = Order::with(['orderItems.product.category'])
            ->get()
            ->groupBy(function ($order) {
                return $order->orderItems->first()->product->category->name;
            });

        return $this->success($orders, 'Orders retrieved successfully.');
    }
}
