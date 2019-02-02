
<div class="form-group">
  <label for="link" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Link")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::url('link', NULL, array('required', 'id' => 'link', 'placeholder'=>__('dashboard.Link'), 'class'=>'form-control'))!!}
  </div>
</div>

<div class="form-group">
    <label for="image" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__('dashboard.Image')}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::file('image', array('id' => 'image', 'class'=>'form-control', isset($item) ? '' : 'required'))!!}
    </div>
</div>
