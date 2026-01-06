@extends('layouts.Meomeo')

@section('content')
<div class="container">
    <h2>Kết quả tìm kiếm cho: "{{ $keyword }}"</h2>

    @if ($products->count() == 0)
        <p>Không tìm thấy sản phẩm phù hợp.</p>
    @else
        <div class="product-grid">
            @foreach ($products as $p)
                <a href="{{ route('product.show', $p->id) }}" class="product-card">
                    <div class="product-image">
                        <img src="{{ $p->mainImage->duong_dan_hinh ?? 'https://via.placeholder.com/300x380' }}">
                    </div>
                    <h3>{{ $p->Tensanpham }}</h3>
                    <p>{{ number_format($p->gia) }}đ</p>
                </a>
            @endforeach
        </div>

        <div class="pagination">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
