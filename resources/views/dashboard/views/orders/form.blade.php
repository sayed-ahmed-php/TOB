<div class="form-group">
    <label for="condition_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__('dashboard.Condition')}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        <select name="condition_id" id="condition_id" class="form-control">
            @foreach(App\Models\Condition::all() as $city)
                <option @if(isset($item) && $item->condition_id == $city->id) selected @endif value="{{ $city->id }}">{{ $city['name_'.App::getLocale()] }}</option>
            @endforeach
        </select>
    </div>
</div>
