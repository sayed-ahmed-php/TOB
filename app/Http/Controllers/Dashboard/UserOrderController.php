<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Cart;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\OrderCart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserOrderController extends Controller
{
    private $resources = 'userOrders';
    private $resource = [
        'route' => 'admin.userOrders',
        'view' => "userOrders",
        'icon' => "shopping-cart",
        'title' => "ORDERS",
        'action' => "",
        'header' => "Orders",
        'return' => "admin.orders",
        'index' => "edit",
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $name = User::find($id)->name;
        $data = Order::where('user_id', $id)->orderBy('id', 'DESC')->paginate(10);
        $resource = $this->resource;
        return view('dashboard.views.'.$this->resources.'.index',compact('data', 'resource', 'name'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $user = User::find(Order::find($id)->user_id);
        $name = $user->name;
        $ids = $user->id;
        $resource = $this->resource;
        $resource['action'] = 'Show';
        $data = Cart::whereIn('id', OrderCart::select('cart_id')->where('order_id', $id)->get())
            ->select('product_id', 'quantity')
            ->paginate(10);

        $data->map(function ($item){
            $product = Product::find($item->product_id);

            $item->name = $product->name_ar;
            $item->price = $product->price;
            $item->image = $product->image;

            unset($item->product_id);
        });
        return view('dashboard.views.' .$this->resources. '.show', compact('data', 'resource', 'name', 'ids'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        $ids = User::find(Order::find($id)->user_id);
        Order::findOrFail($id)->delete();
//        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.'.$this->resource['index'], [$lang, $ids]);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            $ids = User::find(Order::find($id)->user_id);
            Order::findOrFail($id)->delete();
        }

        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.'.$this->resource['index'], [$lang, $ids]);
    }
}
