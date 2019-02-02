@php
    $headers = [
            $name => route($resource['route'].'.index', App::getLocale()),
            __('dashboard.'.$resource['action']) => '#',
        ];
    $tableCols = [
         __('dashboard.Name'),
         __('dashboard.Phone'),
         __('dashboard.Rate'),
         __('dashboard.Comment'),
         __('dashboard.Status'),
         __('dashboard.Image'),
       ];
@endphp
@extends('dashboard.layouts.app')
@section('title', __('dashboard.'.$resource['title']))
@section('content')
    @include('dashboard.components.header1')
    <div class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-fw fa-{{$resource['icon']}}"> </i> {{__('dashboard.'.$resource['header'])}}</h3>

                <div class="box-tools">
                    <div class="box-tools" style="text-align: {{ App::getLocale() == 'ar' ? 'left' : 'right' }}">
                        <div class="input-group-btn">
                            <a href="#" class="btn btn-default delete_all disabled" data-toggle="modal" data-target="#danger_all" title="Delete"><i class="fa fa-fw fa-trash text-red"></i></a>
                        </div>
                    </div>
                    @include('dashboard.components.dangerModalMulti')
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                {!! Form::open(['method'=>'DELETE', 'route'=> ['admin.reviews.multiDelete', App::getLocale()], 'class'=>'delete-form'])!!}
                @if(count($data) == 0)
                    <div class="col-xs-12">
                        <h4> {{ __('dashboard.No Data') }}</h4>
                        {{--                            <p>{{ __('dashboard.Add Link') }}  <b><a href="{{route($resource['route'].'.create', App::getLocale())}}">{{ __('dashboard.here') }}</a></b>.</p>--}}
                    </div>
                @else
                    <table class="table table-hover">
                        <tr>
                            @foreach($tableCols as $col)
                                <td><strong>{{ $col }}</strong></td>
                            @endforeach
                            <td><strong>{{__('dashboard.Actions')}}</strong></td>
                            <td><strong><input type="checkbox" id="master"></strong></td>
                        </tr>
                        <br>
                        @foreach($data as $item)
                            <tr class="tr-{{ $item->id }}">
                                <td>{{ $item->User['name'] }}</td>
                                <td>{{ $item->User['phone'] }}</td>
                                <td>
                                    @for($star = 0; $star < $item->rate; $star++)
                                        <i class="fa fa-star" style="font-size:20px;color: #3c8dbc"></i>
                                    @endfor
                                    @for($star = 0; $star < (5 - $item->rate); $star++)
                                        <i class="fa fa-star-o" style="font-size:20px;color: #3c8dbc"></i>
                                    @endfor
                                </td>
                                <td>{{ $item->comment }}</td>
                                <td>
                                    <a href="#" class="btn btn-adn not_active{{$item->id}}">{{ __('dashboard.NotActive') }}</a>
                                    <a href="#" class="btn btn-info active{{$item->id}}">{{ __('dashboard.Active') }}</a>
                                </td>
                                <td>
                                    @if($item->User['image'] == NULL)
                                        <i class="fa fa-fw fa-image"> </i>
                                    @else
                                        <a href="#" data-toggle="modal" data-target="#img_modal_{{$item->id}}" title="Photo">
                                            <i class="fa fa-fw fa-image"> </i>
                                        </a>
                                    @endif
                                </td>
                                <script>
                                    var active = "{{$item->active}}";
                                    if (active === '2'){
                                        $('.not_active{{$item->id}}').addClass('hidden');
                                        $('.active{{$item->id}}').removeClass('hidden');
                                    }else {
                                        $('.active{{$item->id}}').addClass('hidden');
                                        $('.not_active{{$item->id}}').removeClass('hidden');
                                    }
                                    $('.active{{$item->id}}').on('click', function () {
                                        $.ajax({
                                            url: "{{route('admin.reviews.update', [App::getLocale(), $item->id])}}",
                                            type: 'post',
                                            data: {_method: 'put', _token :"{{csrf_token()}}", active:1},
                                            success: function( msg ) {
                                                $('.active{{$item->id}}').addClass('hidden');
                                                $('.not_active{{$item->id}}').removeClass('hidden');
                                            }
                                        });
                                    });
                                    $('.not_active{{$item->id}}').on('click', function () {
                                        $.ajax({
                                            url: "{{route('admin.reviews.update', [App::getLocale(), $item->id])}}",
                                            type: 'post',
                                            data: {_method: 'put', _token :"{{csrf_token()}}", active:2},
                                            success: function( msg ) {
                                                $('.not_active{{$item->id}}').addClass('hidden');
                                                $('.active{{$item->id}}').removeClass('hidden');
                                            }
                                        });
                                    })
                                </script>
                                <td>

                                    {{-- <a href="{{ route($resource.'.show', $item->id) }}" title="show"><i class="fa fa-fw fa-eye text-light-blue"></i></a> --}}
                                    {{--                                        <a href="{{ route($resource['route'].'.edit', [App::getLocale(), $item->id]) }}" title="edit"><i class="fa fa-fw fa-edit text-yellow"></i></a>--}}
                                    <a href="#" data-toggle="modal" data-target="#danger_{{$item->id}}" title="Delete"><i class="fa fa-fw fa-trash text-red"></i></a>

                                </td>
                                <td><input type="checkbox" class="sub_chk" name="checked[]" value="{{$item->id}}"></td>
                            </tr>
                            @include('dashboard.components.dangerModal', ['user_name' => $item->name, 'id' => $item->id, 'resource' => 'admin.reviews'])
                            @include('dashboard.components.imageModal', ['id' => $item->id,'img' => $item->User['image']])
                        @endforeach
                    </table>
                @endif
                {!! Form::close()!!}
            </div>
        </div>
    </div>
    <div class="text-center" >
        {{ $data->links() }}
    </div>
@endsection
