@php
    $headers = [
            $name => route($resource['return'].'.index', App::getLocale()),
            __('dashboard.'.$resource['header']) => '#'
        ];
    $tableCols = [
         __('dashboard.Name'),
         __('dashboard.Phone'),
         __('dashboard.Address'),
         __('dashboard.Quantity'),
         __('dashboard.Price'),
         __('dashboard.Delivery'),
         __('dashboard.Payment'),
         __('dashboard.Condition'),
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

                <div class="box-tools" style="text-align: {{ App::getLocale() == 'ar' ? 'left' : 'right' }}">
                    <div class="input-group-btn">
                        <a href="#" class="btn btn-default delete_all disabled" data-toggle="modal" data-target="#danger_all" title="Delete"><i class="fa fa-fw fa-trash text-red"></i></a>
                    </div>
                </div>
                @include('dashboard.components.dangerModalMulti')
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                {!! Form::open(['method'=>'DELETE', 'route'=> [$resource['route'].'.multiDelete', App::getLocale()], 'class'=>'delete-form'])!!}
                    @if(count($data) == 0)
                        <div class="col-xs-12">
                            <h4> {{ __('dashboard.No Data') }}</h4>
                            {{--<p>{{ __('dashboard.Add Link') }}  <b><a href="{{route($resource['route'].'.create', App::getLocale())}}">{{ __('dashboard.here') }}</a></b>.</p>--}}
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
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->delivery }}</td>
                                    <td>
                                        @if($item->payment == 1)
                                            {{ __('dashboard.Cash') }}
                                        @else
                                            {{ __('dashboard.Visa') }}
                                        @endif
                                    </td>
                                    <td>{{ $item->Condition['name_'.App::getLocale()] }}</td>
                                    <td>

                                         <a href="{{ route($resource['route'].'.show', [App::getLocale(), $item->id]) }}" title="show"><i class="fa fa-fw fa-eye text-light-blue"></i></a>
{{--                                        <a href="{{ route($resource['route'].'.edit', [App::getLocale(), $item->id]) }}" title="edit"><i class="fa fa-fw fa-edit text-yellow"></i></a>--}}
                                        <a href="#" data-toggle="modal" data-target="#danger_{{$item->id}}" title="Delete"><i class="fa fa-fw fa-trash text-red"></i></a>

                                    </td>
                                    <td><input type="checkbox" class="sub_chk" name="checked[]" value="{{$item->id}}"></td>
                                </tr>
                                @include('dashboard.components.dangerModal', ['user_name' => $item->name, 'id' => $item->id, 'resource' => $resource['route']])
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
