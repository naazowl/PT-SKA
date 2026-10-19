<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Article;
use App\Models\Gallery;
class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard', ['products'=>Product::count(),'articles'=>Article::count(),'gallery'=>Gallery::count(),'recentProducts'=>Product::latest()->take(5)->get()]);
    }
}
