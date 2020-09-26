<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $controllerName = 'product';
    private $products;
    private $type;

    public function __construct()
    {
        $this->products = new Product();
        $this->type = new ProductType();
    }

    public function index()
    {
        $items = $this->products::all();
        // $type = $this->type::all();

        return view('products', ['items' => $items]);
    }
}
