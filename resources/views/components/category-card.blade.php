<div class="col-xl-2 col-lg-2 col-6">
    <div class="product-box">
        <div class="img-wrapper">
            <a href="">
                <img src="{{ asset('assets/images/fashion/category/' . $product->category->image) }}" class="w-100 bg-img blur-up lazyload" alt="category image">
            </a>
            <div class="circle-shape"></div>
            <span class="background-text">Fashion</span> <!-- Adjust if needed -->
            <div class="label-block">
                <span class="label label-theme">30% Off</span> <!-- Adjust or remove if not needed -->
            </div>
        </div>
        <div class="product-style-3 product-style-chair">
            <div class="product-title d-block mb-0">
                <h5>{{ $product->category->name }}</h5>
            </div>
        </div>
    </div>
</div>
