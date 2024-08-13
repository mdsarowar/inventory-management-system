<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="{{request()->is('dashboard')?'active':''}}">
                            <a href="{{route('dashboard')}}" ><i data-feather="grid"></i><span>Dashboard</span></a>
                        </li>
{{--                        <li class="submenu">--}}
{{--                            <a href="javascript:void(0);"><i data-feather="smartphone"></i><span>Application</span><span class="menu-arrow"></span></a>--}}
{{--                            <ul>--}}
{{--                                <li><a href="chat.html">Chat</a></li>--}}
{{--                                <li><a href="calendar.html">Calendar</a></li>--}}
{{--                                <li><a href="email.html">Email</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                        <li class="submenu slide {{request()->is('admins*') || request()->is('roles*') || request()->is('permissions*') ?'is-expanded':''}}">
                            @can('role management')
                                <a href="javascript:void(0);" class="{{request()->is('admins*') || request()->is('roles*') || request()->is('permissions*') ?'active subdrop':''}}"><i data-feather="smartphone"></i>
                                    <span>Role Management</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @can('view user')
                                        <li><a href="{{route('admins.index')}}" class="{{request()->is('admins*')?'active':''}}">User</a></li>
                                    @endcan
                                    @can('view role')
                                        <li><a href="{{route('roles.index')}}" class="{{request()->is('roles*')?'active':''}}">Role</a></li>
                                    @endcan
                                    @can('view permission')
                                        <li><a href="{{route('permissions.index')}}" class="{{request()->is('permissions*')?'active':''}}">Permission</a></li>
                                    @endcan
                                </ul>
                            @endcan

                        </li>
                    </ul>
                </li>
                @can('company management')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">{{__('Company')}}</h6>
{{--                        <a href="javascript:void(0);" class="{{request()->is('company*')  ?'active subdrop':''}}"><i data-feather="smartphone"></i>--}}
{{--                            <span>Company Management</span><span class="menu-arrow"></span>--}}
{{--                        </a>--}}
                        <ul>
                            <li class="submenu slide {{request()->is('company*') || request()->is('branch*')|| request()->is('store*')  ?'is-expanded':''}}">
{{--                                @can('role management')--}}
                                    <a href="javascript:void(0);" class="{{request()->is('company*') || request()->is('branch*')|| request()->is('store*') ?'active subdrop':''}}"><i data-feather="smartphone"></i>
                                        <span>{{__('Company')}}</span><span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        @can('view company')
                                            <li>
                                                <a class="{{request()->is('company*') ? 'active':''}}"
                                                   href="{{route('company.index')}}"><i data-feather="box"></i><span>{{__('Company')}}</span></a>
                                            </li>
                                        @endcan
                                        @can('view branch')
                                            <li>
                                                <a class="{{request()->is('branch*') ? 'active':''}}"
                                                   href="{{route('branch.index')}}"><i data-feather="box"></i><span>{{__('Branch')}}</span></a>
                                            </li>
                                        @endcan
                                        @can('view store')
                                            <li>
                                                <a class="{{request()->is('store*') ? 'active':''}}"
                                                   href="{{route('store.index')}}"><i
                                                        data-feather="box"></i><span>{{__('Store')}}</span></a></li>
                                        @endcan
{{--                                                                                            <li><a href="addproduct.html"><i data-feather="plus-square"></i><span>Create Product</span></a></li>--}}
{{--                                        <li><a href="categorylist.html"><i data-feather="codepen"></i><span>Category</span></a></li>--}}
{{--                                        <li><a href="brandlist.html"><i data-feather="tag"></i><span>Brands</span></a></li>--}}
{{--                                        <li><a href="subcategorylist.html"><i data-feather="speaker"></i><span>Sub Category</span></a></li>--}}
{{--                                        <li><a href="barcode.html"><i data-feather="align-justify"></i><span>Print Barcode</span></a></li>--}}
{{--                                        <li><a href="importproduct.html"><i data-feather="minimize-2"></i><span>Import Products</span></a></li>--}}
{{--                                        @can('view user')--}}
{{--                                            <li><a href="{{route('admins.index')}}" class="{{request()->is('admins*')?'active':''}}">User</a></li>--}}
{{--                                        @endcan--}}
{{--                                        @can('view role')--}}
{{--                                            <li><a href="{{route('roles.index')}}" class="{{request()->is('roles*')?'active':''}}">Role</a></li>--}}
{{--                                        @endcan--}}
{{--                                        @can('view permission')--}}
{{--                                            <li><a href="{{route('permissions.index')}}" class="{{request()->is('permissions*')?'active':''}}">Permission</a></li>--}}
{{--                                        @endcan--}}
                                    </ul>
{{--                                @endcan--}}

                            </li>

                        </ul>
                    </li>
                @endcan

                @can('product management')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">{{__('Products')}}</h6>
                        <ul>
                            <li class="submenu slide {{request()->is('brand*') || request()->is('category*')|| request()->is('sub_category*') || request()->is('child_category*')|| request()->is('color*')|| request()->is('size*') || request()->is('unit*') || request()->is('manufacture*') || request()->is('product*')  ?'is-expanded':''}}">
                                {{--                                @can('role management')--}}
                                <a href="javascript:void(0);" class="{{request()->is('brand*') || request()->is('category*')|| request()->is('sub_category*') || request()->is('child_category*') || request()->is('color*') || request()->is('size*') || request()->is('unit*') || request()->is('manufacture*')|| request()->is('product*') ?'active subdrop':''}}"><i data-feather="smartphone"></i>
                                    <span>{{__('Product')}}</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @can('view product')
                                    <li><a href="{{ route('product.index') }}" class="{{request()->is('product*') ? 'active':''}}"><i data-feather="box"></i><span>{{__('Products')}}</span></a></li>
                                    @endcan
                                    <li><a href="{{ route('select_product') }}" class="{{request()->is('product*') ? 'active':''}}"><i data-feather="box"></i><span>select_product</span></a></li>
{{--                                    <li><a href="{{ route('product.create') }}"><i data-feather="plus-square"></i><span>Create Product</span></a></li>--}}
                                    {{--                                        <li><a href="categorylist.html"><i data-feather="codepen"></i><span>Category</span></a></li>--}}
                                    @can('view brand')
                                        <li><a class="{{request()->is('brand*') ? 'active':''}}" href="{{route('brand.index')}}"><i data-feather="tag"></i><span>{{__('Brands')}}</span></a></li>
                                    @endcan
                                    @can('view category')
                                        <li><a class="{{request()->is('category*') ? 'active':''}}" href="{{route('category.index')}}"><i data-feather="codepen"></i><span>{{__('Category')}}</span></a></li>
                                    @endcan
                                    @can('view subcategory')
                                        <li><a class="{{request()->is('sub_category*') ? 'active':''}}" href="{{route('sub_category.index')}}"><i data-feather="speaker"></i><span>{{__('Sub Category')}}</span></a></li>
                                    @endcan
                                    @can('view childcategory')
                                        <li><a class="{{request()->is('child_category*') ? 'active':''}}" href="{{route('child_category.index')}}"><i data-feather="speaker"></i><span>{{__('Child Category')}}</span></a></li>
                                    @endcan
                                    @can('view color')
                                        <li><a class="{{request()->is('color*') ? 'active':''}}" href="{{route('color.index')}}"><i data-feather="command"></i><span>{{__('Color')}}</span></a></li>
                                    @endcan
                                    @can('view size')
                                        <li><a class="{{request()->is('size*') ? 'active':''}}" href="{{route('size.index')}}"><i data-feather="minimize"></i><span>{{__('Size')}}</span></a></li>
                                    @endcan
                                    @can('view unit')
                                        <li><a class="{{request()->is('unit*') ? 'active':''}}" href="{{route('unit.index')}}"><i data-feather="grid"></i><span>{{__('Units')}}</span></a></li>
                                    @endcan
                                    @can('view manufacture')
                                        <li><a class="{{request()->is('manufacture*') ? 'active':''}}" href="{{route('manufacture.index')}}"><i data-feather="cpu"></i><span>{{__('Manufacture')}}</span></a></li>
                                    @endcan
{{--                                    <li><a href="barcode.html"><i data-feather="align-justify"></i><span>Print Barcode</span></a></li>--}}
{{--                                    <li><a href="importproduct.html"><i data-feather="minimize-2"></i><span>Import Products</span></a></li>--}}
                                </ul>
                                {{-- @endcan --}}
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('people management')
                    <li class="submenu-open">
{{--                        <h6 class="submenu-hdr">Peoples</h6>--}}
                        <ul>
                            <li class="submenu slide {{request()->is('suppliers*') || request()->is('customers*')  ?'is-expanded':''}}">
                                <a href="javascript:void(0);" class="{{request()->is('customers*') || request()->is('suppliers*') ?'active subdrop':''}}"><i data-feather="users"></i></i>
                                    <span>Peoples</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @can('view product')
                                        <li><a href="{{ route('customers.index') }}" class="{{request()->is('customers*') ? 'active':''}}"><i data-feather="user"></i><span>Customers</span></a></li>
                                    @endcan
                                    {{--                                    <li><a href="{{ route('product.create') }}"><i data-feather="plus-square"></i><span>Create Product</span></a></li>--}}
                                    {{--                                        <li><a href="categorylist.html"><i data-feather="codepen"></i><span>Category</span></a></li>--}}
                                    @can('view brand')
                                        <li><a href="{{route('suppliers.index')}}" class="{{request()->is('suppliers*') ? 'active':''}}" ><i data-feather="users"></i><span>Suppliers</span></a></li>
                                    @endcan
                                </ul>
                                {{-- @endcan --}}
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('people management')
                    <li class="submenu-open">
{{--                        <h6 class="submenu-hdr">Peoples</h6>--}}
                        <ul>
                            <li class="submenu slide {{request()->is('suppliers*') || request()->is('customers*')  ?'is-expanded':''}}">
                                <a href="javascript:void(0);" class="{{request()->is('customers*') || request()->is('suppliers*') ?'active subdrop':''}}"><i data-feather="users"></i></i>
                                    <span>Purchases</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @can('view product')
                                        <li><a href="{{ route('purchases.index') }}" class="{{request()->is('purchases*') ? 'active':''}}"><i data-feather="shopping-bag"></i><span>Purchases</span></a></li>
                                    @endcan
{{--                                    @can('view brand')--}}
{{--                                        <li><a href="{{route('suppliers.index')}}" class="{{request()->is('suppliers*') ? 'active':''}}" ><i data-feather="minimize-2"></i><span>Import Purchases</span></a></li>--}}
{{--                                    @endcan--}}
                                    @can('view brand')
                                        <li><a href="{{route('purchasOrderCreate')}}" class="{{request()->is('suppliers*') ? 'active':''}}" ><i data-feather="file-minus"></i><span>Purchase Order</span></a></li>
                                    @endcan
{{--                                    @can('view brand')--}}
{{--                                        <li><a href="{{route('suppliers.index')}}" class="{{request()->is('suppliers*') ? 'active':''}}" ><i data-feather="refresh-cw"></i><span>Purchase Return</span></a></li>--}}
{{--                                    @endcan--}}
                                </ul>
                                {{-- @endcan --}}
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('people management')
                    <li class="submenu-open">
{{--                        <h6 class="submenu-hdr">Peoples</h6>--}}
                        <ul>
                            <li class="submenu slide {{request()->is('suppliers*') || request()->is('customers*')  ?'is-expanded':''}}">
                                <a href="javascript:void(0);" class="{{request()->is('customers*') || request()->is('suppliers*') ?'active subdrop':''}}"><i data-feather="shopping-cart"></i><span>Sales</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @can('view product')
                                        <li><a href="{{ route('customers.index') }}" class="{{request()->is('customers*') ? 'active':''}}"><i data-feather="shopping-cart"></i><span>Sales</span></a></li>
                                    @endcan
                                    @can('view brand')
                                        <li><a href="{{route('suppliers.index')}}" class="{{request()->is('suppliers*') ? 'active':''}}" ><i data-feather="file-text"></i><span>Invoices</span></a></li>
                                    @endcan
                                    @can('view brand')
                                        <li><a href="{{route('suppliers.index')}}" class="{{request()->is('suppliers*') ? 'active':''}}" ><i data-feather="copy"></i><span>Sales Return</span></a></li>
                                    @endcan
                                    @can('view brand')
                                        <li><a href="{{route('suppliers.index')}}" class="{{request()->is('suppliers*') ? 'active':''}}" ><i data-feather="save"></i><span>Quotation</span></a></li>
                                    @endcan
                                        <li><a href="pos.html"><i data-feather="hard-drive"></i><span>POS</span></a></li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"><i data-feather="shuffle"></i><span>Transfer</span><span class="menu-arrow"></span></a>
                                            <ul>
                                                <li><a href="transferlist.html">Transfer List</a></li>
                                                <li><a href="importtransfer.html">Import Transfer </a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"><i data-feather="corner-up-left"></i><span>Return</span><span class="menu-arrow"></span></a>
                                            <ul>
                                                <li><a href="salesreturnlist.html">Sales Return</a></li>
                                                <li><a href="purchasereturnlist.html">Purchase Return</a></li>
                                            </ul>
                                        </li>
                                </ul>
                                {{-- @endcan --}}
                            </li>
                        </ul>
                    </li>

{{--                    <li class="submenu-open">--}}
{{--                        <h6 class="submenu-hdr">Sales</h6>--}}
{{--                        <ul>--}}
{{--                            <li><a href="saleslist.html"><i data-feather="shopping-cart"></i><span>Sales</span></a></li>--}}
{{--                            <li><a href="invoicereport.html"><i data-feather="file-text"></i><span>Invoices</span></a></li>--}}
{{--                            <li><a href="salesreturnlists.html"><i data-feather="copy"></i><span>Sales Return</span></a></li>--}}
{{--                            <li><a href="quotationList.html"><i data-feather="save"></i><span>Quotation</span></a></li>--}}
{{--                            <li><a href="pos.html"><i data-feather="hard-drive"></i><span>POS</span></a></li>--}}
{{--                            <li class="submenu">--}}
{{--                                <a href="javascript:void(0);"><i data-feather="shuffle"></i><span>Transfer</span><span class="menu-arrow"></span></a>--}}
{{--                                <ul>--}}
{{--                                    <li><a href="transferlist.html">Transfer List</a></li>--}}
{{--                                    <li><a href="importtransfer.html">Import Transfer </a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li class="submenu">--}}
{{--                                <a href="javascript:void(0);"><i data-feather="corner-up-left"></i><span>Return</span><span class="menu-arrow"></span></a>--}}
{{--                                <ul>--}}
{{--                                    <li><a href="salesreturnlist.html">Sales Return</a></li>--}}
{{--                                    <li><a href="purchasereturnlist.html">Purchase Return</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                @endcan
                @can('employee management')
                    <li class="submenu-open">
                        {{--                        <h6 class="submenu-hdr">Peoples</h6>--}}
                        <ul>
                            <li class="submenu slide {{request()->is('department*') || request()->is('designation*')|| request()->is('employee*')  ?'is-expanded':''}}">
                                <a href="javascript:void(0);" class="{{request()->is('department*') || request()->is('designation*')|| request()->is('employee*') ?'active subdrop':''}}"><i data-feather="users"></i></i>
                                    <span>Employee</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @can('view department')
                                        <li><a href="{{ route('department.index') }}" class="{{request()->is('department*') ? 'active':''}}"><i data-feather="shopping-bag"></i><span>Department</span></a></li>
                                    @endcan
                                    @can('view designation')
                                        <li><a href="{{route('designation.index')}}" class="{{request()->is('designation*') ? 'active':''}}" ><i data-feather="minimize-2"></i><span>Designation</span></a></li>
                                    @endcan
                                    @can('view employee')
                                        <li><a href="{{route('employee.index')}}" class="{{request()->is('employee*') ? 'active':''}}" ><i data-feather="file-minus"></i><span>Employee</span></a></li>
                                    @endcan
{{--                                    @can('view brand')--}}
{{--                                        <li><a href="{{route('suppliers.index')}}" class="{{request()->is('suppliers*') ? 'active':''}}" ><i data-feather="refresh-cw"></i><span>Purchase Return</span></a></li>--}}
{{--                                    @endcan--}}
                                </ul>
                                {{-- @endcan --}}
                            </li>
                        </ul>
                    </li>
                @endcan

{{--                <li class="submenu-open">--}}
{{--                    <h6 class="submenu-hdr">Peoples</h6>--}}
{{--                    <ul>--}}
{{--                        <li><a href="customerlist.html"><i data-feather="user"></i><span>Customers</span></a></li>--}}
{{--                        <li><a href="supplierlist.html"><i data-feather="users"></i><span>Suppliers</span></a></li>--}}
{{--                        <li><a href="userlist.html"><i data-feather="user-check"></i><span>Users</span></a></li>--}}
{{--                        <li><a href="storelist.html"><i data-feather="home"></i><span>Stores</span></a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                @can('account management')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Accounts Setup</h6>
                        <ul>
                            <li class="submenu slide {{ request()->is('class*') || request()->is('group*')|| request()->is('sub_group*') || request()->is('journal*') || request()->is('ledger*') || request()->is('account_payment*') || request()->is('account_receive*') || request()->is('transaction*') || request()->is('expense_details*') || request()->is('transaction_details*') ? 'is-expanded' : '' }}">
                                {{--                                @can('role management')--}}
                                <a href="javascript:void(0);" class="{{ request()->is('class*') || request()->is('group*')|| request()->is('sub_group*') || request()->is('journal*') || request()->is('ledger*') || request()->is('account_payment*') || request()->is('account_receive*') || request()->is('transaction*') || request()->is('expense_details*') || request()->is('transaction_details*') ? 'active subdrop' : ''}}"><i class="far fa-money-bill-alt me-2"></i>
                                    <span>Accounts</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @can('view class')
                                        <li><a class="{{request()->is('class*') ? 'active':''}}" href="{{route('class.index')}}"><i class="fas fa-list-ol me-2"></i><span>Class</span></a></li>
                                    @endcan
                                    @can('view group')
                                        <li><a class="{{request()->is('group*') ? 'active':''}}" href="{{route('group.index')}}"><i class="fas fa-object-ungroup me-2"></i><span>Group</span></a></li>
                                    @endcan
                                    @can('view subgroup')
                                        <li><a class="{{request()->is('sub_group*') ? 'active':''}}" href="{{route('sub_group.index')}}"><i class="far fa-object-ungroup me-2"></i><span>Sub-Group</span></a></li>
                                    @endcan
                                    @can('view ledger')
                                        <li><a class="{{request()->is('ledger*') ? 'active':''}}" href="{{route('ledger.index')}}"><i class="fas fa-file-invoice-dollar me-2"></i><span>Ledger</span></a></li>
                                    @endcan
                                    @can('view accountpayment')
                                        <li><a class="{{request()->is('account_payment*') && !request()->is('account_payment_details*') ? 'active':''}}" href="{{route('account_payment.index')}}"><i class="fas fa-cash-register me-2"></i><span>Payment Voucher</span></a></li>
                                    @endcan
                                    @can('view accountreceive')
                                        <li><a class="{{request()->is('account_receive*') && !request()->is('account_receive_details*') ? 'active':''}}" href="{{route('account_receive.index')}}"><i class="fas fa-money-check me-2"></i><span>Receive Voucher</span></a></li>
                                    @endcan
                                    @can('view journal')
                                        <li><a class="{{request()->is('journal*') && !request()->is('journal_details*') ? 'active':''}}" href="{{route('journal.index')}}"><i class="fas fa-newspaper me-2"></i><span>Journal</span></a></li>
                                    @endcan
                                    @can('view transaction')
                                        <li><a class="{{request()->is('transaction*') && !request()->is('transaction_details*') ? 'active' : ''}}" href="{{route('transaction.index')}}"><i class="fas fa-university me-2"></i><span>Bank Transaction</span></a></li>
                                    @endcan
                                    @can('view expensedetails')
                                        <li><a class="{{request()->is('expense_details*') ? 'active':''}}" href="{{route('expense_details.index')}}"><i class="fas fa-hand-holding-usd me-2"></i><span>Expense Details</span></a></li>
                                    @endcan
                                    @can('view transactiondetails')
                                        <li><a class="{{request()->is('transaction_details*') ? 'active':''}}" href="{{route('transaction_details.index')}}"><i class="fas fa-file-invoice me-2"></i><span>Transaction Details</span></a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('bank management')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Bank Management</h6>
                        <ul>
                            <li class="submenu slide {{ request()->is('banks*') || request()->is('bank_account*') || request()->is('bank_mobile*') || request()->is('bank_transaction*') || request()->is('bank_transfer*') || request()->is('bank_cheque*') ?'is-expanded':''}}">
                                <a href="javascript:void(0);" class="{{request()->is('banks*') || request()->is('bank_account*') || request()->is('bank_mobile*') || request()->is('bank_transaction*') || request()->is('bank_transfer*') || request()->is('bank_cheque*') ?'active subdrop':''}}"><i class="fas fa-university me-2"></i>
                                    <span>Bank</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @can('view bank')
                                        <li>
                                            <a class="{{request()->is('banks*') ? 'active':''}}"
                                               href="{{route('banks.index')}}"><i class="fas fa-building me-2"></i><span>Banks</span></a>
                                        </li>
                                    @endcan
                                    @can('view bankaccount')
                                        <li>
                                            <a class="{{request()->is('bank_account*') ? 'active':''}}"
                                               href="{{route('bank_account.index')}}"><i class="fas fa-wallet me-2"></i><span>Bank Accounts</span></a>
                                        </li>
                                    @endcan
                                    @can('view bankmobile')
                                        <li>
                                            <a class="{{request()->is('bank_mobile*') ? 'active':''}}"
                                               href="{{route('bank_mobile.index')}}"><i class="fas fa-mobile me-2"></i><span>Mobile Banking</span></a></li>
                                    @endcan
                                    @can('view banktransaction')
                                        <li>
                                            <a class="{{request()->is('bank_transaction*') ? 'active':''}}"
                                               href="{{route('bank_transaction.index')}}"><i class="fas fa-file-invoice-dollar me-2"></i><span>Transactions</span></a></li>
                                    @endcan
                                    @can('view banktransfer')
                                        <li>
                                            <a class="{{request()->is('bank_transfer*') ? 'active':''}}"
                                               href="{{route('bank_transfer.index')}}"><i class="fas fa-exchange-alt me-2"></i><span>Transfer</span></a></li>
                                    @endcan
                                    @can('view bankcheque')
                                        <li>
                                            <a class="{{request()->is('bank_cheque*') ? 'active':''}}"
                                               href="{{route('bank_cheque.index')}}"><i class="fas fa-money-check-alt me-2"></i><span>Cheque</span></a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endcan

               @can('')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Products</h6>
                        <ul>
                            <li><a href="productlist.html"><i data-feather="box"></i><span>Products</span></a></li>
                            <li><a href="addproduct.html"><i data-feather="plus-square"></i><span>Create Product</span></a></li>
                            <li><a href="categorylist.html"><i data-feather="codepen"></i><span>Category</span></a></li>
                            <li><a href="brandlist.html"><i data-feather="tag"></i><span>Brands</span></a></li>
                            <li><a href="subcategorylist.html"><i data-feather="speaker"></i><span>Sub Category</span></a></li>
                            <li><a href="barcode.html"><i data-feather="align-justify"></i><span>Print Barcode</span></a></li>
                            <li><a href="importproduct.html"><i data-feather="minimize-2"></i><span>Import Products</span></a></li>
                        </ul>
                    </li>
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Sales</h6>
                        <ul>
                            <li><a href="saleslist.html"><i data-feather="shopping-cart"></i><span>Sales</span></a></li>
                            <li><a href="invoicereport.html"><i data-feather="file-text"></i><span>Invoices</span></a></li>
                            <li><a href="salesreturnlists.html"><i data-feather="copy"></i><span>Sales Return</span></a></li>
                            <li><a href="quotationList.html"><i data-feather="save"></i><span>Quotation</span></a></li>
                            <li><a href="pos.html"><i data-feather="hard-drive"></i><span>POS</span></a></li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i data-feather="shuffle"></i><span>Transfer</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="transferlist.html">Transfer List</a></li>
                                    <li><a href="importtransfer.html">Import Transfer </a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i data-feather="corner-up-left"></i><span>Return</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="salesreturnlist.html">Sales Return</a></li>
                                    <li><a href="purchasereturnlist.html">Purchase Return</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Purchases</h6>
                        <ul>
                            <li><a href="purchaselist.html"><i data-feather="shopping-bag"></i><span>Purchases</span></a></li>
                            <li><a href="importpurchase.html"><i data-feather="minimize-2"></i><span>Import Purchases</span></a></li>
                            <li><a href="purchaseorderreport.html"><i data-feather="file-minus"></i><span>Purchase Order</span></a></li>
                            <li><a href="purchasereturnlist.html"><i data-feather="refresh-cw"></i><span>Purchase Return</span></a></li>
                        </ul>
                    </li>
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Finance & Accounts</h6>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i data-feather="file-text"></i><span>Expense</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="expenselist.html">Expenses</a></li>
                                    <li><a href="expensecategory.html">Expense Category</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Peoples</h6>
                        <ul>
                            <li><a href="customerlist.html"><i data-feather="user"></i><span>Customers</span></a></li>
                            <li><a href="supplierlist.html"><i data-feather="users"></i><span>Suppliers</span></a></li>
                            <li><a href="userlist.html"><i data-feather="user-check"></i><span>Users</span></a></li>
                            <li><a href="storelist.html"><i data-feather="home"></i><span>Stores</span></a></li>
                        </ul>
                    </li>
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Reports</h6>
                        <ul>
                            <li><a href="salesreport.html"><i data-feather="bar-chart-2"></i><span>Sales Report</span></a></li>
                            <li><a href="purchaseorderreport.html"><i data-feather="pie-chart"></i><span>Purchase report</span></a></li>
                            <li><a href="inventoryreport.html"><i data-feather="credit-card"></i><span>Inventory Report</span></a></li>
                            <li><a href="invoicereport.html"><i data-feather="file"></i><span>Invoice Report</span></a></li>
                            <li><a href="purchasereport.html"><i data-feather="bar-chart"></i><span>Purchase Report</span></a></li>
                            <li><a href="supplierreport.html"><i data-feather="database"></i><span>Supplier Report</span></a></li>
                            <li><a href="customerreport.html"><i data-feather="pie-chart"></i><span>Customer Report</span></a></li>
                        </ul>
                    </li>
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">User Management</h6>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i data-feather="users"></i><span>Manage Users</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="newuser.html">New User </a></li>
                                    <li><a href="userlists.html">Users List</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Pages</h6>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i data-feather="shield"></i><span>Authentication</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="signin.html">Log in</a></li>
                                    <li><a href="signup.html">Register</a></li>
                                    <li><a href="forgetpassword.html">Forgot Password</a></li>
                                    <li><a href="resetpassword.html">Reset Password</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i data-feather="file-minus"></i><span>Error Pages</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="error-404.html">404 Error </a></li>
                                    <li><a href="error-500.html">500 Error </a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i data-feather="map"></i><span>Places</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="countrieslist.html">Countries</a></li>
                                    <li><a href="statelist.html">States</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="blankpage.html" ><i data-feather="file"></i><span>Blank Page</span> </a>
                            </li>
                            <li>
                                <a href="components.html" ><i data-feather="pen-tool"></i><span>Components</span> </a>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">UI Interface</h6>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i data-feather="layers"></i><span>Elements</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="sweetalerts.html">Sweet Alerts</a></li>
                                    <li><a href="tooltip.html">Tooltip</a></li>
                                    <li><a href="popover.html">Popover</a></li>
                                    <li><a href="ribbon.html">Ribbon</a></li>
                                    <li><a href="clipboard.html">Clipboard</a></li>
                                    <li><a href="drag-drop.html">Drag & Drop</a></li>
                                    <li><a href="rangeslider.html">Range Slider</a></li>
                                    <li><a href="rating.html">Rating</a></li>
                                    <li><a href="toastr.html">Toastr</a></li>
                                    <li><a href="text-editor.html">Text Editor</a></li>
                                    <li><a href="counter.html">Counter</a></li>
                                    <li><a href="scrollbar.html">Scrollbar</a></li>
                                    <li><a href="spinner.html">Spinner</a></li>
                                    <li><a href="notification.html">Notification</a></li>
                                    <li><a href="lightbox.html">Lightbox</a></li>
                                    <li><a href="stickynote.html">Sticky Note</a></li>
                                    <li><a href="timeline.html">Timeline</a></li>
                                    <li><a href="form-wizard.html">Form Wizard</a></li>
                                </ul>
                            </li>
                            <li  class="submenu">
                                <a href="javascript:void(0);"><i data-feather="bar-chart-2"></i><span>Charts</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="chart-apex.html">Apex Charts</a></li>
                                    <li><a href="chart-js.html">Chart Js</a></li>
                                    <li><a href="chart-morris.html">Morris Charts</a></li>
                                    <li><a href="chart-flot.html">Flot Charts</a></li>
                                    <li><a href="chart-peity.html">Peity Charts</a></li>
                                </ul>
                            </li>
                            <li  class="submenu">
                                <a href="javascript:void(0);"><i data-feather="database"></i><span>Icons</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="icon-fontawesome.html">Fontawesome Icons</a></li>
                                    <li><a href="icon-feather.html">Feather Icons</a></li>
                                    <li><a href="icon-ionic.html">Ionic Icons</a></li>
                                    <li><a href="icon-material.html">Material Icons</a></li>
                                    <li><a href="icon-pe7.html">Pe7 Icons</a></li>
                                    <li><a href="icon-simpleline.html">Simpleline Icons</a></li>
                                    <li><a href="icon-themify.html">Themify Icons</a></li>
                                    <li><a href="icon-weather.html">Weather Icons</a></li>
                                    <li><a href="icon-typicon.html">Typicon Icons</a></li>
                                    <li><a href="icon-flag.html">Flag Icons</a></li>
                                </ul>
                            </li>
                            <li  class="submenu">
                                <a href="javascript:void(0);"><i data-feather="edit"></i><span>Forms</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="form-basic-inputs.html">Basic Inputs </a></li>
                                    <li><a href="form-input-groups.html">Input Groups </a></li>
                                    <li><a href="form-horizontal.html">Horizontal Form </a></li>
                                    <li><a href="form-vertical.html"> Vertical Form </a></li>
                                    <li><a href="form-mask.html">Form Mask </a></li>
                                    <li><a href="form-validation.html">Form Validation </a></li>
                                    <li><a href="form-select2.html">Form Select2 </a></li>
                                    <li><a href="form-fileupload.html">File Upload </a></li>
                                </ul>
                            </li>
                            <li  class="submenu">
                                <a href="javascript:void(0);"><i data-feather="columns"></i><span>Tables</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="tables-basic.html">Basic Tables </a></li>
                                    <li><a href="data-tables.html">Data Table </a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Settings</h6>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i data-feather="settings"></i><span>Settings</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="generalsettings.html">General Settings</a></li>
                                    <li><a href="emailsettings.html">Email Settings</a></li>
                                    <li><a href="paymentsettings.html">Payment Settings</a></li>
                                    <li><a href="currencysettings.html">Currency Settings</a></li>
                                    <li><a href="grouppermissions.html">Group Permissions</a></li>
                                    <li><a href="taxrates.html">Tax Rates</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="signin.html" ><i data-feather="log-out"></i><span>Logout</span> </a>
                            </li>
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
