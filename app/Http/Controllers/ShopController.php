<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $size = $request->query('size', 12);
        $order = $request->query('order', -1);
        $q_brands = $request->query('brands', '');
        $q_categories = $request->query('categories', '');
        $prange= $request->query('prange');
        if(!$prange){
          $prange= "0,50";
        }
        $from = explode(",",$prange)[0];
        $to = explode(",",$prange)[1];


        // Set default ordering
        $o_column = 'id';
        $o_order = 'DESC';

        switch ($order) {
            case 1:
                $o_column = 'created_at';
                $o_order = 'DESC';
                break;
            case 2:
                $o_column = 'created_at';
                $o_order = 'ASC';
                break;
            case 3:
                $o_column = 'regular_price';
                $o_order = 'ASC';
                break;
            case 4:
                $o_column = 'regular_price';
                $o_order = 'DESC';
                break;
        }

        // Retrieve brands and categories
        $brands = Brand::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();

        // Filter products based on brands and categories
        $products = Product::query()
            ->when(!empty($q_brands), function ($query) use ($q_brands) {
                $brandIds = explode(',', $q_brands);
                $query->whereIn('brand_id', $brandIds);
            })
            ->when(!empty($q_categories), function ($query) use ($q_categories) {
                $categoryIds = explode(',', $q_categories);
                $query->whereIn('category_id', $categoryIds);
            })
            ->whereBetween('regular_price', array($from,$to))
            ->orderBy($o_column, $o_order)
            ->paginate($size);

        // Return view with products and filter options
        return view('shop', compact('products', 'page', 'size', 'order', 'brands', 'q_brands', 'categories', 'q_categories','from','to'));
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $rproducts = Product::where('slug', '!=', $slug)->inRandomOrder()->take(8)->get();
        return view('details', compact('product', 'rproducts'));
    }
}
