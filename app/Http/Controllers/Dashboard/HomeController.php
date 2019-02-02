<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Department;
use App\Models\Order;
use App\Models\Plog;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;

class HomeController extends Controller
{
    private $resource = [
        'route' => 'admin.home',
        'icon' => "home",
        'title' => "DASHBOARD",
        'action' => "",
        'header' => "home"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statistics = [
            'users'          => User::count(),
            'admins'          => Admin::count(),
            'departments'          => Department::count(),
            'products'          => Product::count(),
            'orders'          => Order::count(),
            'conditions'          => Condition::count(),
//            'banners'          => Banner::count(),
        ];
        $resource = $this->resource;

        return view('dashboard.home', compact('statistics', 'resource'));
    }
}
