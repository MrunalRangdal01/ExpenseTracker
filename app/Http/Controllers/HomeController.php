<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $category_id = $request->category_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = Expense::with('category')
                    ->where('is_active', 1);

    if (!is_null($category_id)) {
        $query->where('category_id', $category_id);
    }

    if (!is_null($from_date)) {
        $query->whereDate('date', '>=', $from_date);
    }

    if (!is_null($to_date)) {
        $query->whereDate('date', '<=', $to_date);
    }

    $expenses = $query->get();
        $categories = Category::where('is_active',1)->get();
        return view('dashboard',get_defined_vars());
    }
}
