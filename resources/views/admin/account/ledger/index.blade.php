@extends('admin.master')

@section('title','Account Ledgers')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Ledgers List</h4>
                <h6>Manage Your Ledgers</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('ledger.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">Add Ledger</a>
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
                            <th>Name</th>
                            <th>Group</th>
                            <th>Sub-Group</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ledgers as $ledger)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $ledger->name }}</td>
                                <td>{{ $ledger->group_id ? $ledger->group->name : '' }}</td>
                                <td>{{ $ledger->subgroup_id ? $ledger->sub_group->name : '' }}</td>
                                <td>
                                    @can('update ledger')
                                        <a class="me-3" href="{{route('ledger.edit',$ledger->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete ledger')
                                        <form action="{{route('ledger.destroy', $ledger->id)}}" method="POST" class="sr-dl" >
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
        <!-- /class list -->
    </div>
@endsection

@section('js')
{{--    @include('admin.include.plugin.datatable')--}}
@endsection
