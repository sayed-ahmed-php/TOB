
<div class="form-group">
    <label for="image" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__('dashboard.Image')}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::file('image', array('id' => 'image', 'class'=>'form-control', isset($item) ? '' : 'required'))!!}
    </div>
</div>
