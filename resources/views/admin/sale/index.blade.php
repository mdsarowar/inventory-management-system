@extends('admin.master')

@section('title', __('Sales'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{ __('Sales') }} {{ __('List') }}</h4>
                <h6>{{ __('Manage your') }} {{ __('Sales') }}</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('sales.create') }}" class="btn btn-added">
                    <img src="{{ asset('admin/assets/img/icons/plus.svg') }}" alt="img" class="me-1">
                    {{ __('Sales Create') }}
                </a>
            </div>
        </div>

        <!-- /sales list -->
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
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Customer') }}</th>
                            <th>{{ __('Customer Phone') }}</th>
                            <th>{{ __('Total Amount') }}</th>
                            <th>{{ __('Paid Amount') }}</th>
                            <th>{{ __('Payment Due') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Payment Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $sale)
                            @php
                                $supplierName = '';
                                if (empty($sale->wkname)) {
                                    $sup = explode("-", $sale->vendor);
                                    if (isset($sup[1])) {
                                        $model = $sup[0] == 'sup' ? \App\Models\Supplier::class : \App\Models\Customer::class;
                                        $supplier = $model::find($sup[1]);
                                        $supplierName = $supplier ? $supplier->name : 'Unknown';
                                        $phone=$supplier->mobile;
                                    }
                                } else {
                                    $supplierName = $sale->wkname;
                                    $phone=$sale->wkphone;
                                }
                            @endphp
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $sale->issue_date }}</td>
                                <td>{{ $supplierName }}</td>
                                <td>{{ $phone }}</td>
                                <td>{{ $sale->total }}</td>
                                <td>{{ floatval($sale->total) - floatval($sale->due) }}</td>
                                <td>{{ $sale->due }}</td>
                                <td>
                                    @php
                                        $statusClass = $sale->status == 0 ? 'bg-lightred' : ($sale->status == 1 ? 'bg-lightgreen' : 'bg-lightyellow');
                                        $statusText = $sale->status == 0 ? 'Pending' : ($sale->status == 1 ? 'Received' : 'Ordered');
                                    @endphp
                                    <span class="badges {{ $statusClass }}">{{ $statusText }}</span>
                                </td>
                                <td>
                                    @php
                                        $paymentStatusClass = $sale->invoice->status == 'paid' ? 'bg-lightgreen' : ($sale->invoice->status == 'unpaid' ? 'bg-lightred' : 'bg-lightyellow');
                                    @endphp
                                    <span class="badges {{ $paymentStatusClass }}">{{ $sale->invoice->status }}</span>
                                </td>
                                <td>
                                    @can('update purchase')
                                        <a class="me-3" href="{{ route('sales.show', $sale->id) }}">
                                            <i class="fa fa-eye" data-bs-toggle="tooltip" title="View Sale"></i>
                                        </a>
                                    @endcan
                                    @can('edit purchase')
                                        <a class="me-3" href="{{ route('sales.edit', $sale->id) }}">
                                            <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete purchase')
                                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <a class="delete_confirm" href="javascript:void(0);">
                                                <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="img">
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
        <!-- /sales list -->
    </div>
@endsection

