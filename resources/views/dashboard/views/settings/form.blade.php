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

<div class="form-group">
    <label for="delivery" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Delivery")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::number('delivery', null, array('required', 'id' => 'delivery', 'placeholder'=>__('dashboard.Delivery'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="facebook" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Facebook")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::url('facebook', null, array('required', 'id' => 'facebook', 'placeholder'=>__('dashboard.Facebook'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="twitter" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Twitter")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::url('twitter', null, array('required', 'id' => 'twitter', 'placeholder'=>__('dashboard.Twitter'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="instagram" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Instagram")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::url('instagram', null, array('required', 'id' => 'instagram', 'placeholder'=>__('dashboard.Instagram'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="snap" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Snap")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::url('snap', null, array('required', 'id' => 'snap', 'placeholder'=>__('dashboard.Snap'), 'class'=>'form-control'))!!}
    </div>
</div>
