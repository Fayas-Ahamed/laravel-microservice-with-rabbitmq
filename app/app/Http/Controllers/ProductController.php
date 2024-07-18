<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use App\Models\ProductUser;
use App\Jobs\ProductLiked;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function like($id)
    {
        $response = Http::get('http://localhost:8000/api/user');

        $user = $response->json();

        try {
            $productUser = ProductUser::create([
                'user_id' => $user['id'],
                'product_id' => $id
            ]);

            ProductLiked::dispatch($productUser->toArray())->onQueue('admin_queue');

            return response([
                'message' => 'success'
            ]);
        } catch (\Exception $exception) {
            return response([
                'error' => 'You already liked this product!'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
