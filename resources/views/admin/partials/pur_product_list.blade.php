@if($products->isEmpty())
    <div class="text-muted">
        no products found <i class="far fa-frown"></i>
    </div>
@else
    @foreach($products as $product)
        @php
            $ssn_products = array_reverse(session()->get('purchase_products', []));
            $ssn_product_ids = array_column($ssn_products, 'id');
            $inSession = in_array($product->id, $ssn_product_ids);
        @endphp
        <div class="custom-product-item {{ $inSession ? 'cursor_not_allowed' : 'cursor_pointer' }}" data-id="{{ $product->id }}" data-name="{{ $product->name }}">
            <div class="product-info default-cover card">
                <div class="img-bg">
                    <img src="{{ asset($product->image) }}" class="custom-product-img">
                    <i class="fas fa-check-circle product_check_mark {{ $inSession ? 'd-block' : '' }}"></i>
                </div>
                <h6 class="product-name">{{ $product->name }}</h6>
                <div class="d-flex align-items-center justify-content-between price">
                    <span>{{ $product->quantity }} Qty</span>
                    <p>৳{{ $product->price }}</p>
                </div>
            </div>
        </div>
    @endforeach
@endif