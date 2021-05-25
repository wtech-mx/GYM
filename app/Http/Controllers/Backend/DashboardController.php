<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Models\Customers;
use App\Models\Plan;
use App\Models\Pay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        $data['usersCount'] = User::count();
        $data['rolesCount'] = Role::count();
        $data['pagesCount'] = Page::count();
        $data['menusCount'] = Menu::count();
        $data['customersCount'] = Customers::count();
        $data['payCount'] = Pay::count();
        $data['planCount'] = Plan::count();
        $data['users'] = User::orderBy('last_login_at','desc')->take(10)->get();

        $mytime = Carbon::now();
        $month = $mytime->format('m');

        $data['CustomersMes'] = Customers::whereMonth('created_at','>=',$month)->count();

        return view('backend.dashboard', $data);
    }
}
