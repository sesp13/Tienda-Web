<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;

class ProductActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $product = Product::find($request->id);

        if ($product != null) {
            if ($product->active) {
                return $next($request);
            } else {
                return redirect()->route('products.index');
            }
        }
    }
}
