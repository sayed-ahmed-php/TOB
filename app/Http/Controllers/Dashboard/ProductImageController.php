<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Storage;
use Auth;

class ProductImageController extends Controller
{
    private $resources = 'productImages';
    private $resource = [
        'route' => 'admin.productImages',
        'view' => "productImages",
        'icon' => "picture-o",
        'title' => "PRODUCTS",
        'action' => "",
        'header' => "Products",
        'return' => "admin.products",
        'index' => "show",
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $name = Product::find($id)->name_ar;
        $data = ProductImage::Where('product_id', $id)->orderBy('id', 'desc')->get();
        $resource = $this->resource;
        return view('dashboard.views.'.$this->resources.'.index',compact('data', 'resource', 'name'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $item = Product::find(ProductImage::find($id)->product_id);
        $name = $item->name_ar;
        $ids = $item->id;
        $item = ProductImage::find($id);
        $resource = $this->resource;
        return view('dashboard.views.'.$this->resources.'.edit',compact('item', 'resource', 'name', 'ids'));
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
        $ids = ProductImage::find($id)->product_id;
        $item = ProductImage::find($id);
        $rules =  [
            'image' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        if ($request->image)
        {
            Storage::disk('public')->delete($item->image);
            $item->image =$this->uploadFile($request->image, 'products/'.$id);
            $item->save();
        }

        flashy(__('dashboard.updated'));
        return redirect()->route($this->resource['route'].'.'.$this->resource['index'], [$lang, $ids]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        $ids = ProductImage::find($id)->product_id;
        $item = ProductImage::findOrFail($id);
        Storage::disk('public')->delete($item->image);
        $item->delete();
//        flashy(__('dashboard.deleted'));
        return response()->json(true);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            $ids = ProductImage::find($id)->product_id;
            $item = ProductImage::findOrFail($id);
            Storage::disk('public')->delete($item->image);
            $item->delete();
        }

        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.'.$this->resource['index'], [$lang, $ids]);
    }

}
