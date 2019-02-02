<div class="form-group">
  <label for="name_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Name_ar")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::text('name_ar', null, array('required', 'id' => 'name_ar', 'placeholder'=>__('dashboard.Name_ar'), 'class'=>'form-control'))!!}
  </div>
</div>

<div class="form-group">
    <label for="name_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Name_en")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::text('name_en', null, array('required', 'id' => 'name_en', 'placeholder'=>__('dashboard.Name_en'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
  <label for="content" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Category")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    <select class="form-control" id="dept_id" name="dept_id" required>
        @foreach(App\Models\Department::orderBy('ordered')->get() as $dept)
            <option @if(isset($item) && $item->dept_id == $dept->id) selected @endif value="{{ $dept->id }}">{{ $dept['name_'.App::getLocale()] }}</option>
        @endforeach
    </select>
  </div>
</div>

<div class="form-group">
    <label for="price" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Price")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::number('price', null, array('required', 'id' => 'price', 'placeholder'=>__('dashboard.Price'), 'class'=>'form-control'))!!}
    </div>
</div>

{{--<div class="form-group">--}}
    {{--<label for="dis_price" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Dis_Price")}}</label>--}}
    {{--<div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">--}}
        {{--{!!Form::number('dis_price', null, array('required', 'id' => 'dis_price', 'placeholder'=>__('dashboard.Dis_Price'), 'class'=>'form-control'))!!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    <label for="desc_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Description_ar")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        <textarea class="form-control" placeholder="{{__('dashboard.Description_ar')}}" id="desc_ar" name="desc_ar" required>@if(isset($item)) {!! $item->desc_ar !!}" @endif</textarea>
        {{--        {!!Form::textarea('desc_ar', null, array('required', 'id' => 'desc_ar', 'placeholder'=>__('dashboard.Description'), 'class'=>'form-control'))!!}--}}
    </div>
</div>

<div class="form-group">
    <label for="desc_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Description_en")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        <textarea class="form-control" placeholder="{{__('dashboard.Description_en')}}" id="desc_en" name="desc_en" required>@if(isset($item)) {!! $item->desc_ar !!}" @endif</textarea>
        {{--        {!!Form::textarea('desc_ar', null, array('required', 'id' => 'desc_ar', 'placeholder'=>__('dashboard.Description'), 'class'=>'form-control'))!!}--}}
    </div>
</div>

<div class="form-group">
    <label for="image" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__('dashboard.Image')}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::file('image', array('id' => 'image', 'class'=>'form-control', isset($item) ? '' : 'required'))!!}
    </div>
</div>

<div class="form-group">
    <label for="images" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__('dashboard.Images')}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::file('images[]', array('id' => 'images', 'class'=>'form-control', 'multiple'))!!}
    </div>
</div>
