@extends('layouts.master')
@section('title', 'Buy Now')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            
            <!-- Alerts -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            

            <!-- Top Balance & Limit Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h6 class="text-muted text-uppercase mb-2">Available Balance</h6>
                                    <h2 class="mb-0 text-primary">₹ {{ number_format($walletBalance, 2) }}</h2>
                                </div>
                                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                    <h6 class="text-muted text-uppercase mb-2">Products Purchased (Limit: {{ $maxProducts }})</h6>
                                    <h2 class="mb-0 {{ $remainingProducts <= 5 ? 'text-danger' : 'text-success' }}">
                                        {{ $totalPurchased }} / {{ $maxProducts }}
                                    </h2>
                                    <small class="text-muted">Remaining: {{ $remainingProducts }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products List -->
            <div class="row">
                @php
                    // API ka main domain nikal lein (http://127.0.0.1:8001) taaki images wahan se load hon
                    $apiDomain = str_replace('/api', '', env('API_BASE_URL', 'http://127.0.0.1:8001'));
                @endphp

                @forelse($products as $product)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            
                            {{-- PRODUCT IMAGE LOGIC (Updated for Array) --}}
                            @php
                                $imgPath = '';
                                if (!empty($product->images)) {
                                    // API se images direct PHP Array mein aa raha hai
                                    if (is_array($product->images) && isset($product->images[0])) {
                                        $imgPath = $product->images[0];
                                    } elseif (is_string($product->images)) {
                                        // Fallback agar kabhi string format mein aaye
                                        $decoded = json_decode($product->images, true);
                                        $imgPath = (is_array($decoded) && isset($decoded[0])) ? $decoded[0] : $product->images;
                                    }
                                }
                            @endphp

                            <div class="mb-3" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                                @if($imgPath)
                                    {{-- Image API ke domain (8001) se load hogi --}}
                                    <img src="{{ $apiDomain }}/storage/{{ $imgPath }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 100%; object-fit: contain;">
                                @else
                                    <i class="las la-box fs-1 text-muted"></i>
                                @endif
                            </div>

                            <h5 class="card-title text-primary">{{ $product->name }}</h5>
                            <p class="text-muted small">{{ Str::limit($product->short_description ?? 'Product Description', 60) }}</p>
                            
                            <ul class="list-unstyled mb-3 text-start px-3">
                                <li class="d-flex justify-content-between"><span><strong>MRP:</strong></span> <span>₹{{ number_format($product->price, 2) }}</span></li>
                                <li class="d-flex justify-content-between"><span><strong>DP:</strong></span> <span>₹{{ number_format($product->discount_price ?? $product->price, 2) }}</span></li>
                                <li class="d-flex justify-content-between"><span><strong>CC:</strong></span> <span>{{ $product->cc_points ?? 0 }}</span></li>
                                <li class="d-flex justify-content-between"><span><strong>Stock:</strong></span> <span class="badge bg-light text-dark">{{ $product->stock }}</span></li>
                            </ul>

                            @if($remainingProducts > 0 && $product->stock > 0)
                            <!-- Purchase Form -->
                            <form action="{{ route('purchase') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="mb-2">
                                    <label class="form-label small text-start d-block">Quantity (Max: {{ min($remainingProducts, $product->stock) }})</label>
                                    <input type="number" name="quantity" class="form-control form-control-sm" 
                                           min="1" max="{{ min($remainingProducts, $product->stock) }}" value="1" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100">Proceed</button>
                            </form>
                            @else
                            <button class="btn btn-secondary w-100" disabled>
                                @if($remainingProducts <= 0) Limit Reached @else Out of Stock @endif
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h4>No products available right now.</h4>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection