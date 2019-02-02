@php
$title = __('dashboard.Confirmation');
$body['en'] = 'Are you sure you want to delete <strong>'. $user_name . '</strong>?';
$body['ar'] = 'هل انت متأكد من حذف  <strong>'. $user_name . '</strong>؟';
@endphp
<div class="modal modal-danger fade" id="danger_{{ $id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: {{ App::getLocale() == 'ar' ? 'left' : 'right' }}">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">{{ $title }}</h4>
      </div>
      <div class="modal-body">
        <p>{!! $body[App::getLocale()] !!}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{{__('dashboard.Close')}}</button>
        <button type="button" class="btn btn-outline delete-{{$id}}">{{__('dashboard.OK')}}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    $(".delete-{{$id}}").on('click', function(e){
        e.preventDefault();

        $.ajax({
            url: "{{route($resource.'.destroy', [App::getLocale(), $id])}}",
            type: 'post',
            data: {_method: 'delete', _token :"{{csrf_token()}}"},
            success: function( msg ) {
                $('.modal').modal('hide');
                $('.image-{{$id}}').remove()
            }
        });
    });
</script>

