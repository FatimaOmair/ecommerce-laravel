@extends('layouts.base')

@section('content')
<section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Cart</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('app.index') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Cart Section Start -->
<section class="cart-section section-b-space">
    <div class="container">
        @if ($cartItems->count() > 0)
        <div class="row">
            <div class="col-md-12 text-center">
                <table class="table cart-table">
                    <thead>
                        <tr class="table-head">
                            <th scope="col">image</th>
                            <th scope="col">product name</th>
                            <th scope="col">price</th>
                            <th scope="col">quantity</th>
                            <th scope="col">total</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                        <tr>
                            <td>
                                <a href="{{ route('shop.product.details', ['slug' => $item->model->slug]) }}">
                                    <img src="{{ asset('assets/images/fashion/product/front/' . $item->model->image) }}" class="blur-up lazyloaded" alt="{{ $item->model->name }}">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('shop.product.details', ['slug' => $item->model->slug]) }}">{{ $item->model->name }}</a>
                                <div class="mobile-cart-content row">
                                    <div class="col">
                                        <div class="qty-box">
                                            <div class="input-group">
                                                <input type="number" name="quantity" class="form-control input-number" data-rowid="{{ $item->rowId }}" onchange="updateQuantity(this)" value="{{ $item->qty }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h2>${{ $item->price }}</h2>
                                    </div>
                                    <div class="col">
                                        <h2 class="td-color">
                                            <form method="POST" action="{{ route('cart.remove') }}" class="remove-item-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                                <button type="submit" class="btn btn-link p-0"><i class="fas fa-times"></i></button>
                                            </form>
                                        </h2>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h2>${{ $item->price }}</h2>
                            </td>
                            <td>
                                <div class="qty-box">
                                    <div class="input-group">
                                        <input type="number" name="quantity" data-rowid="{{ $item->rowId }}" class="form-control input-number" onchange="updateQuantity(this)" value="{{ $item->qty }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h2 class="td-color item-subtotal">${{ $item->subtotal }}</h2>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove') }}" class="remove-item-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                    <button type="submit" class="btn btn-link p-0"><i class="fas fa-times"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 mt-md-5 mt-4">
                <div class="row">
                    <div class="col-sm-7 col-5 order-1">
                        <div class="left-side-button text-end d-flex d-block justify-content-end">
                            <form method="POST" action="{{ route('cart.clear') }}" class="clear-cart-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-decoration-underline theme-color d-block text-capitalize">Clear All Items</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-5 col-7">
                        <div class="left-side-button float-start">
                            <a href="{{ route('shop.index') }}" class="btn btn-solid-default btn fw-bold mb-0 ms-0">
                                <i class="fas fa-arrow-left"></i> Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-checkout-section">
                <div class="row g-4">
                    <div class="col-lg-4 col-sm-6">
                        <div class="promo-section">
                            <form class="row g-3">
                                <div class="col-7">
                                    <input type="text" class="form-control" id="number" placeholder="Coupon Code">
                                </div>
                                <div class="col-5">
                                    <button class="btn btn-solid-default rounded btn">Apply Coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="checkout-button">
                            <a href="" class="btn btn-solid-default btn fw-bold">
                                Check Out <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-box">
                            <div class="cart-box-details">
                                <div class="total-details">
                                    <div class="top-details">
                                        <h3>Cart Totals</h3>
                                        <h6>Sub Total <span id="cart-subtotal">${{ Cart::instance('cart')->subtotal() }}</span></h6>
                                        <h6>Tax <span id="cart-tax">${{ Cart::instance('cart')->tax() }}</span></h6>
                                        <h6>Total <span id="cart-total">${{ Cart::instance('cart')->total() }}</span></h6>
                                    </div>
                                    <div class="bottom-details">
                                        <a href="">Process Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Cart is empty -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Your Cart is Empty :(</h2>
                <h5 class="mt-5">Add items to the cart</h5>
                <a href="{{ route('shop.index') }}" class="btn btn-warning mt-5">Shop now</a>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = "{{ session('success') }}";
        var errorMessage = "{{ session('error') }}";

        if (successMessage) {
            Swal.fire({
                title: 'Success!',
                text: successMessage,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                    location.reload(); // Reload the page to reflect changes
                });
        }

        if (errorMessage) {
            Swal.fire({
                title: 'Error!',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                    location.reload(); // Reload the page to reflect changes
                });
        }
    });

    function updateQuantity(quantity) {
        $.ajax({
            url: "{{ route('cart.update') }}",
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                rowId: $(quantity).data('rowid'),
                quantity: $(quantity).val()
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Cart updated successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                    location.reload(); // Reload the page to reflect changes
                });

                    // Update the subtotal, tax, and total without reloading
                    $('#cart-subtotal').text('$' + response.subtotal);
                    $('#cart-tax').text('$' + response.tax);
                    $('#cart-total').text('$' + response.total);

                    // Update the subtotal for the individual item
                    $(quantity).closest('tr').find('.item-subtotal').text('$' + response.itemSubtotal);
                }
            },
            error: function(response) {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error updating the cart. Please try again Or refresh the page.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Reload the page to reflect changes
                });
            }
        });
    }

    $(document).on('submit', '.remove-item-form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: form.action,
            type: 'POST',
            data: $(form).serialize(),
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Item removed successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Reload the page to reflect changes
                });
            },
            error: function(response) {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error removing the item. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            }
        });
    });

    $(document).on('submit', '.clear-cart-form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: form.action,
            type: 'DELETE',
            data: $(form).serialize(),
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Cart cleared successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Reload the page to reflect changes
                });
            },
            error: function(response) {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error clearing the cart. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>
@endsection
