<div class="form-group">
  <label for="about_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.About_ar")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::textarea('about_ar', null, array('required', 'id' => 'about_ar', 'placeholder'=>__('dashboard.About_ar'), 'class'=>'form-control'))!!}
  </div>
</div>

<div class="form-group">
  <label for="about_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.About_en")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::textarea('about_en', null, array('required', 'id' => 'about_en', 'placeholder'=>__('dashboard.About_en'), 'class'=>'form-control'))!!}
  </div>
</div>

<div class="form-group">
  <label for="privacy_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Privacy_ar")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::textarea('privacy_ar', null, array('required', 'id' => 'privacy_ar', 'placeholder'=>__('dashboard.Privacy_ar'), 'class'=>'form-control'))!!}
  </div>
</div>

<div class="form-group">
  <label for="privacy_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Privacy_en")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::textarea('privacy_en', null, array('required', 'id' => 'privacy_en', 'placeholder'=>__('dashboard.Privacy_en'), 'class'=>'form-control'))!!}
  </div>
</div>

