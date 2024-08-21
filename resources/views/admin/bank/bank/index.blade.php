@extends('admin.master')

@section('title','Banks List')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Banks List</h4>
                <h6>Manage Your Banks</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('banks.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg" class="me-2" alt="img">Add Bank</a>
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
                            <th>#</th>
                            <th>Name</th>
                            <th>Short Form</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banks as $bank)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bank->name }}</td>
                                <td>{{ $bank->short_name }}</td>
                                <td>{{ ucfirst($bank->status) }}</td>
                                <td>
                                    @can('update bank')
                                        <a class="me-3" href="{{route('banks.edit',$bank->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete bank')
                                        <form action="{{route('banks.destroy',$bank->id)}}" method="POST" class="sr-dl" >
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
        <!-- /bank list -->
    </div>
@endsection

@section('js')
{{--    @include('admin.include.plugin.datatable')--}}
@endsection
