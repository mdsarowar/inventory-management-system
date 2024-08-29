@extends('admin.master')

@section('title',__('Manufacture'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Manufacture List')}}</h4>
                <h6>{{__('Manage your Manufacture')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('manufacture.create') }}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">{{__('Add Manufacture')}}</a>
            </div>
        </div>


        <!-- /product list -->
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Contact')}}</th>
                            <th>{{__('Address')}}</th>
                            <th>{{__('Main Product')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($manufactures as $manufacture)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $manufacture->name }}</td>
                                <td>{{ $manufacture->cmobile }}</td>
                                <td>{{ Str::limit($manufacture->address, 40) }}</td>
                                <td>{{ Str::limit($manufacture->mainproduct, 40) }}</td>
                                <td>{{ $manufacture->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    @can('update manufacture')
                                        <a class="me-3" href="{{route('manufacture.edit',$manufacture->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete manufacture')
                                        <form action="{{route('manufacture.destroy',$manufacture->id)}}" method="POST" class="sr-dl" >
                                            @csrf
                                            @method('delete')
                                            <a class="delete_confirm" href="javascript:void(0);">
                                                <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">
                                            </a>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
@endsection


