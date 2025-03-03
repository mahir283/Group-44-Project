<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cars;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderedItems;
use App\Models\Form;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total Sales Calculation
        $totalSales = OrderedItems::join('cars', 'ordered_items.car_id', '=', 'cars.id')
            ->selectRaw('SUM(cars.price * ordered_items.order_quantity) as total_sales')
            ->value('total_sales');

        // Active Users Count
        $activeUsers = User::count();

        // Total Products Count
        $totalProducts = Cars::count();

        // Total Orders Count
        $totalOrders = Order::count();

        // Best Selling Cars (Top 3)
        $bestSellingCars = OrderedItems::join('cars', 'ordered_items.car_id', '=', 'cars.id')
            ->select('cars.car_model', DB::raw('SUM(ordered_items.order_quantity) as total_sold'))
            ->groupBy('cars.id', 'cars.car_model')
            ->orderByDesc('total_sold')
            ->limit(3)
            ->get();

        // Sales Month on Month
        $monthlySales = OrderedItems::join('cars', 'ordered_items.car_id', '=', 'cars.id')
            ->selectRaw('DATE_FORMAT(ordered_items.created_at, "%M") as month, SUM(cars.price * ordered_items.order_quantity) as total_sales')
            ->groupBy('month')
            ->orderByRaw('MONTH(ordered_items.created_at)')
            ->get();



        // Car Type Sales Distribution
        $carTypeSales = OrderedItems::join('cars', 'ordered_items.car_id', '=', 'cars.id')
            ->select('cars.category', DB::raw('SUM(ordered_items.order_quantity) as total_sold'))
            ->groupBy('cars.category')
            ->get();

        // Stock Alerts
        $stockAlerts = Cars::select('car_model', 'quantity')->get()->map(function ($car) {
            return [
                'name' => $car->car_model,
                'quantity' => $car->quantity,
                'status' => $car->quantity < 20 ? 'low-stock' : 'success'
            ];
        });

        $queries = Form::query()->get();



        return view('AdminDashboard', compact(
            'totalSales',
            'activeUsers',
            'totalProducts',
            'totalOrders',
            'bestSellingCars',
            'monthlySales',
            'carTypeSales',
            'stockAlerts',
            'queries'
        ));
    }
}
