<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Checkout - SSLCommerz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
        }
        .checkout-container {
            max-width: 1140px;
        }
        .card {
            border: none;
            border-radius: 16px;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: none;
        }
        .list-group-item {
            border: none;
            padding: 0.75rem 1rem;
        }
        .total-line {
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-checkout {
            padding: 0.75rem;
            font-size: 1rem;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container py-5 checkout-container">
    <div class="row g-4">
        <!-- Billing Form -->
        <div class="col-lg-8">
            <div class="card shadow-sm p-4">
                <h4 class="mb-4"><i class="bi bi-person-circle me-2"></i>Billing Details</h4>
                <form method="POST" action="{{ url('/pay') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="customer_name" class="form-control" placeholder="John Doe" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Mobile</label>
                            <input type="text" name="customer_mobile" class="form-control" placeholder="01XXXXXXXXX" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="customer_email" class="form-control" placeholder="john@example.com" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Address Line 1</label>
                            <input type="text" name="address" class="form-control" placeholder="House #, Road #, Area" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Address Line 2 <span class="text-muted">(Optional)</span></label>
                            <input type="text" name="address2" class="form-control" placeholder="Apartment, suite, etc.">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">State</label>
                            <select name="state" class="form-select" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Chattogram">Chattogram</option>
                                <option value="Rajshahi">Rajshahi</option>
                                <option value="Khulna">Khulna</option>
                                <option value="Sylhet">Sylhet</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Zip</label>
                            <input type="text" name="zip" class="form-control" placeholder="1200" required>
                        </div>
                    </div>

                    <input type="hidden" name="amount" value="{{ $total }}">

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary btn-checkout w-100">
                            <i class="bi bi-credit-card-2-front me-1"></i> Pay Now
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card shadow-sm p-4">
                <h5 class="mb-4"><i class="bi bi-bag-check me-2"></i>Your Order</h5>
                <ul class="list-group mb-3">
                    @foreach($cart as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $item['name'] }}</span>
                            <span class="text-muted">{{ number_format($item['price'], 2) }} BDT</span>
                        </li>
                    @endforeach
                    {{-- @dd($subTotal) --}}
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Subtotal</span>
                        <strong>{{ number_format((float) $subTotal) }} BDT</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Discount</span>
                        <strong>-{{ number_format($discount, 2) }} BDT</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Delivery</span>
                        <strong>{{ number_format($delivery, 2) }} BDT</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between total-line border-top pt-3">
                        <span>Total</span>
                        <span>{{ number_format((float)  $total) }} BDT</span>
                    </li>
                </ul>
                <div class="alert alert-info mt-3 mb-0">
                    <small><i class="bi bi-info-circle"></i> You will be redirected to payment page.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
