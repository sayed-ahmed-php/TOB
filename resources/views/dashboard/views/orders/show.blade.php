@php
    $headers = [
            $resource['header'] => $resource['route'].'.index',
            $resource['action'] => '#',
        ];
    $tableCols = [
      __('dashboard.Products'),
      __('dashboard.Price'),
      __('dashboard.Quantity'),
      __('dashboard.Image'),
    ];
@endphp
@extends('dashboard.layouts.app')
@section('title', __('dashboard.'.$resource['title']))
@section('content')
@include('dashboard.components.header')
<div class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-fw fa-{{$resource['icon']}}"> </i> {{__('dashboard.'.$resource['header'])}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        @foreach($tableCols as $col)
                            <td><strong>{{ $col }}</strong></td>
                        @endforeach
                    </tr>

                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                @if($item->image == NULL)
                                    <i class="fa fa-fw fa-image"> </i>
                                @else
                                    <a href="#" data-toggle="modal" data-target="#img_modal_{{$item->id}}" title="Photo">
                                        <i class="fa fa-fw fa-image"> </i>
                                    </a>
                                @endif
                            </td>
                        </tr>
{{--                        @include('dashboard.components.dangerModal', ['user_name' => $item->name, 'id' => $item->id, 'resource' => $resource])--}}
                                    @include('dashboard.components.imageModal', ['id' => $item->id,'img' => $item->image])
                    @endforeach

                </table>
        </div>

        <div class="text-center">
            {{ $data->links() }}
        </div>
    </div>
</div>
@endsection
