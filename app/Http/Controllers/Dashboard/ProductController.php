<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class ProductController extends Controller
{
    private $resources = 'products';
    private $resource = [
        'route' => 'admin.products',
        'view' => "products",
        'icon' => "product-hunt",
        'title' => "PRODUCTS",
        'action' => "",
        'header' => "Products",
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::orderBy('id', 'desc')->paginate(10);
        $resource = $this->resource;
        return view('dashboard.views.'.$this->resources.'.index',compact('data', 'resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource = $this->resource;
        $resource['action'] = 'Create';
        return view('dashboard.views.'.$this->resources.'.create',compact( 'resource'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lang)
    {
        $rules =  [
            'name_ar' => 'required',
            'name_en' => 'required',
            'desc_ar' => 'required',
            'desc_en' => 'required',
            'price' => 'required',
            'dept_id' => 'required|int',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
//            'images.*' => 'nullable|mimes:jpeg,jpg,png,gif',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        $inputs = $request->except('image', 'images');
        $item = Product::create($inputs);

        if ($request->image)
        {
            $item->image =$this->uploadFile($request->image, 'products/'.$item->id);
            $item->save();
        }

        if ($request->images)
        {
            foreach ($request->images as $images)
            {
                $image =$this->uploadFile($images, 'products/'.$item->id);
                ProductImage::create([
                    'image' => $image,
                    'product_id' => $item->id
                ]);
            }
        }

        flashy(__('dashboard.created'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $name = Product::find($id)->name_ar;
        $resource = $this->resource;
        $resource['action'] = 'Reviews';
        return view('dashboard.views.'.$this->resources.'.show',compact('data', 'resource', 'name'));
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
        $rules =  [
            'name_ar' => 'required',
            'name_en' => 'required',
            'desc_ar' => 'required',
            'desc_en' => 'required',
            'price' => 'required',
            'dept_id' => 'required|int',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif',
//            'images.*' => 'nullable|mimes:jpeg,jpg,png,gif',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        $item = Product::find($id);
        $inputs = $request->except('image', 'images');

        if ($request->image)
        {
            if (strpos($item->image, '/uploads/') !== false) {
                $image = str_replace( asset('').'storage/', '', $item->image);
                Storage::disk('public')->delete($image);
            }
            $inputs['image'] =$this->uploadFile($request->image, 'products/'.$id);
        }

        if ($request->images)
        {
            foreach ($request->images as $images)
            {
                $image =$this->uploadFile($images, 'products/'.$id);
                ProductImage::create([
                    'image' => $image,
                    'product_id' => $item->id
                ]);
            }
        }
        $item->update($inputs);

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
        $item = Product::findOrFail($id);
        Storage::disk('public')->deleteDirectory('uploads/products/'.$id);
        $item->delete();
//        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            $item = Product::findOrFail($id);
            Storage::disk('public')->deleteDirectory('uploads/products/'.$id);
            $item->delete();
        }

        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function search(Request $request)
    {
        $resource = $this->resource;
        $data = Product::where('name_ar', 'LIKE', '%'.$request->text.'%')
                            ->orWhere('name_en', 'LIKE', '%'.$request->text.'%')
                            ->orWhere('name_ar', 'LIKE', '%'.$request->text.'%')
                            ->orWhere('price', 'LIKE', '%'.$request->text.'%')
//                            ->orWhere('dis_price', 'LIKE', '%'.$request->text.'%')
                            ->orderBy('ordered')
                            ->paginate(10);
        return view('dashboard.views.' .$this->resources. '.index', compact('data', 'resource'));
    }
}
