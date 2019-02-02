<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Cart;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\OrderCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    private $resources = 'orders';
    private $resource = [
        'route' => 'admin.orders',
        'view' => "orders",
        'icon' => "shopping-cart",
        'title' => "ORDERS",
        'action' => "",
        'header' => "Orders"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::orderBy('id', 'DESC')->paginate(10);
        $resource = $this->resource;
        return view('dashboard.views.'.$this->resources.'.index',compact('data', 'resource'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
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
        return view('dashboard.views.' .$this->resources. '.show', compact('data', 'resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $resource = $this->resource;
        $resource['action'] = 'Edit';
        $item = Product::findOrFail($id);
        return view('dashboard.views.' .$this->resources. '.edit', compact('item', 'resource'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lang, $id)
    {
        Order::find($id)->update($request->all());
        flashy(__('dashboard.updated'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        Order::findOrFail($id)->delete();
//        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            Order::findOrFail($id)->delete();
        }

        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function search(Request $request)
    {
        $resource = $this->resource;
        $data = Order::where('quantity', 'LIKE', '%'.$request->text.'%')
            ->orWhere('price', 'LIKE', '%'.$request->text.'%')
            ->orWhere('address', 'LIKE', '%'.$request->text.'%')
            ->paginate(10);
        return view('dashboard.views.' .$this->resources. '.index', compact('data', 'resource'));
    }
}
