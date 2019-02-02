<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Buyer;
use App\Models\Course;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use MercurySeries\Flashy\Flashy;
use Validator;

class UserController extends Controller
{
    private $resources = 'users';
    private $resource = [
        'route' => 'admin.users',
        'view' => "users",
        'icon' => "users",
        'title' => "USERS",
        'action' => "",
        'header' => "Users",
        'return' => "admin.users",
        'index' => "index",
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('id', 'DESC')->paginate(10);
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
            'f_name' => 'required',
            'l_name' => 'required',
            'password' => 'required|min:6',
            'phone' => 'required|unique:users',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        $inputs = $request->except('image');
        if ($request->image)
        {
            $inputs['image'] =$this->uploadFile($request->image, 'users');
        }

        User::create($inputs);

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
        $name = User::find($id)->name;
        $data = Course::whereIn('id', Buyer::where('user_id', $id)->select('course_id')->get())->orderBy('id', 'DESC')->paginate(10);
        $resource = $this->resource;
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
        $item = User::findOrFail($id);
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
            'f_name' => 'required',
            'l_name' => 'required',
            'password' => 'nullable|min:6',
            'phone' => 'required|unique:users,phone,'.$id,
            'image' => 'nullable|mimes:jpeg,jpg,png,gif',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        $item = User::find($id);
        $inputs = $request->except('image');

        if ($request->image)
        {
            if (strpos($item->image, '/uploads/') !== false) {
                $image = str_replace( asset('').'storage/', '', $item->image);
                Storage::disk('public')->delete($image);
            }
            $inputs['image'] =$this->uploadFile($request->image, 'users');
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
        $item = User::findOrFail($id);
        $image = str_replace( asset('').'storage/', '', $item->image);
        Storage::disk('public')->delete($image);
        $item->delete();
//        flashy(__('dashboard.deleted'));
        return response()->json(true);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            $item = User::findOrFail($id);
            $image = str_replace( asset('').'storage/', '', $item->image);
            Storage::disk('public')->delete($image);
            $item->delete();
        }

        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function search(Request $request)
    {
        $resource = $this->resource;
        $data = User::where('f_name', 'LIKE', '%'.$request->text.'%')
            ->orWhere('l_name', 'LIKE', '%'.$request->text.'%')
            ->orWhere('phone', 'LIKE', '%'.$request->text.'%')
            ->paginate(10);
        return view('dashboard.views.' .$this->resources. '.index', compact('data', 'resource'));
    }
}
