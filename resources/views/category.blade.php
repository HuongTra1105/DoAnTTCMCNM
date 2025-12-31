@extends('layouts.Meomeo')
@section('content')
<div class="container">
    <div class="Lop-Boc">
        <aside class="Thanh-Ben">
            <h3>{{ $category->Tendanhmuc }}</h3>
            @foreach ($subCategories as $sub)
                <a href="{{ route('category.show', $sub->slug) }}"
                   class="{{ request()->is('danh-muc/'.$sub->slug) ? 'active' : '' }}">
                    {{ $sub->Tendanhmuc }}
                </a>
            @endforeach
        </aside>
        <section class="products">
            <div class="product-grid">
                @foreach ($products as $p)
                <a href="{{ route('product.show', $p->id) }}" class="product-card-link">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ optional($p->mainImage)->duong_dan_hinh ?? 'https://via.placeholder.com/300x380' }}">
                        </div>
                        <h3>{{ $p->Tensanpham }}</h3>
                        <p>{{ number_format($p->gia) }}đ</p>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
    </div>
    <div class="pagination">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
