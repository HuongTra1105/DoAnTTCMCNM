@extends('layouts.Meomeo')
@php
    $coMau  = $options->pluck('mau')->filter()->unique()->count() > 0;
    $coSize = $options->pluck('size')->filter()->unique()->count() > 0;
@endphp
@section('content')
<div class="product-detail">
    <div class="detail-wrap">
        <div class="detail-image">
            <img 
                src="{{ optional($product->mainImage)->duong_dan_hinh ?? 'https://via.placeholder.com/500x500' }}"
                alt="{{ $product->Tensanpham }}"
                class="main-img"
            >
        </div>
        <div class="detail-info">
            <h1>{{ $product->Tensanpham }}</h1>

            <div class="price-box">
                @if (!empty($product->gia_giam))
                    <span class="old-price">{{ number_format($product->gia) }}đ</span>
                    <span class="sale-price">{{ number_format($product->gia_giam) }}đ</span>
                @else
                    <span class="current-price">{{ number_format($product->gia) }}đ</span>
                @endif
            </div>
            <p class="short-desc">
                {{ Str::limit($product->Mota, 150) }}
            </p>
            @if ($coMau)
            <div class="option-group">
                <div class="option-title">Màu</div>
                <div class="option-items">
                    @foreach ($options->unique('mau') as $o)
                        <div class="option-item color-option"
                            data-color="{{ $o->mau }}"
                            style="background-color: {{ $o->mau }}">
                            {{ $o->mau }}
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
                @if ($coSize)
                <div class="option-group">
                    <div class="option-title">Size</div>
                    <div class="option-items">
                        @foreach ($options->unique('size') as $o)
                            <div class="option-item size-option"
                                data-size="{{ $o->size }}">
                                {{ $o->size }}
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            <div class="actions">
                <button 
                class="btn-add-cart"
                onclick="themVaoGioHang(this)"
                data-id="{{ $product->id }}"
                data-ten="{{ $product->Tensanpham }}"
                data-gia="{{ $product->gia_giam ?? $product->gia }}"
                data-hinh="{{ optional($product->mainImage)->duong_dan_hinh }}"
            >
                Thêm vào giỏ
            </button>
                <button class="btn-buy-now">Mua ngay</button>
            </div>
        </div>
    </div>
    <div class="description-section">
        <div class="desc-tab">Mô tả</div>
        <div class="desc-content">
            {!! nl2br(e($product->Mota)) !!}
        </div>
    </div>
</div>
@endsection
