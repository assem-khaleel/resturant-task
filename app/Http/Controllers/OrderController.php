<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    /**** Accepts the order details from the request payload , Persists the Order in the database. ****/

    public function storeOrder(Request $request, OrderRequest $orderRequest)
    {

        // check the request of payload that contains product(product_id , quantity)

        $product = new Product;
        $product->name = $request->input('product_id');;
        $product->quantity = $request->input('quantity');;

        Validator::make($request->all(), [
            'product_id' => 'required|unique:products',
            'quantity' => 'required|integer',
        ]);

        if ($request->validated()) {
            return response()->json($product);
        }

        $product->save();

        $this->addToOrderTable($orderRequest);

        // Insert into product_order table
        $order = Order::find($orderRequest);

        $product->orders()->attach($order);


    }

    /**** Updates the stock of the ingredients. ****/

    public function update(Order $order)
    {
        // get products related to specific order
        $products = Order::where('id', $order)->with(Product::class)->get();

        // Update ingredients after saving order
        foreach ($products->ingredients as $ingredient) {

            $id = $ingredient->id;

            if ($ingredient) {
                Ingredient::where('id', $id)->update(array('updated_stock' => $ingredient->stock - $ingredient->updated_stock));
            }
        }

          // check the updated stock of the ingredient
          $this->checkQuantityIngredients($order, $id);
    }

    // create order
    protected function addToOrderTable($request)
    {
        // Insert into orders table
        $order = Order::create([
            'quantity' => $request->quantity,
        ]);

        return $order;
    }


    // check the quantity of Ingredients after updated stock
    protected function checkQuantityIngredients(Order $order, Ingredient $ingredient)
    {
        // get order then get products inside order then get ingredients stock after update the order

        $products = Order::where('id', $order)->with(Product::class)->get();

        $actualIngredient = Ingredient::where('id', $ingredient)->firstOrFail();

        foreach ($products->ingredient as $ingredient) {

            $checkAvalability = $actualIngredient->stock - $ingredient->updated_stock;

            $r = 50;
            $l = 100;

            if ($checkAvalability == ($r / $l) * ($actualIngredient->stock)) {

                Mail::send(new \App\Mail\Order($checkAvalability));

            }
        }

    }
}
