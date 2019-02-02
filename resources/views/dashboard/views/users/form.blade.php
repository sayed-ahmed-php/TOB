<div class="form-group">
  <label for="f_name" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.F_Name")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::text('f_name', null, array('required', 'id' => 'f_name', 'placeholder'=>__('dashboard.F_Name'), 'class'=>'form-control'))!!}
  </div>
</div>

<div class="form-group">
    <label for="l_name" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.L_Name")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::text('l_name', null, array('required', 'id' => 'l_name', 'placeholder'=>__('dashboard.L_Name'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="phone" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Phone")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::number('phone', null, array('required', 'id' => 'phone', 'placeholder'=>__('dashboard.Phone'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
  <label for="password" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Password")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::text('password', isset($item->password) ? '' : NULL, array(isset($item->password) ? '' : 'required', 'id' => 'password', 'placeholder'=>__('dashboard.Password'), 'class'=>'form-control'))!!}
  </div>
</div>

<div class="form-group">
    <label for="image" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__('dashboard.Image')}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::file('image', array('id' => 'image', 'class'=>'form-control', isset($item) ? '' : 'required'))!!}
    </div>
</div>
