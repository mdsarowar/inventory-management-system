@extends('admin.master')

@section('title',__('Account Receive Vouchers'))

@section('custom_css')
    <!-- Add any custom CSS if needed -->
@endsection

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Receive Vouchers List')}}</h4>
                <h6>{{__('Manage Your Receive Vouchers')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('account_receive.create')}}" class="btn btn-added">
                    <img src="{{asset('/')}}admin/assets/img/icons/plus.svg" class="me-2" alt="img">
                    {{__('Add Receive Voucher')}}
                </a>
            </div>
        </div>

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
                            <th>{{__('Date')}}</th>
                            <th>{{__('Invoice')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Note')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($receives as $receive)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ !empty($receive->date) ? \Carbon\Carbon::parse($receive->date)->format('d M Y') : '' }}</td>
                                <td>{{ $receive->inv_number }}</td>
                                <td>{{ $receive->amount }}</td>
                                <td>{{ Str::limit($receive->note, 80) }}</td>
                                <td>
                                    @can('update accountreceive')
                                        <a class="me-3" href="{{route('account_receive.edit',$receive->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('view accountreceive')
                                        <a class="me-3" href="{{route('account_receive.show',$receive->id)}}">
                                            <i class="fa fa-eye" data-bs-toggle="tooltip" title="view Product"></i>
                                        </a>
                                    @endcan
                                    @can('delete accountreceive')
                                        <form action="{{route('account_receive.destroy', $receive->id)}}" method="POST" class="sr-dl">
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
    </div>
@endsection
@section('js')

@endsection


