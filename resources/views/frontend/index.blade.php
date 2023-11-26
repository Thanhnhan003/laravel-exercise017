@extends('frontend.layouts.master') @section('main-content')

<!-- =====================slideshow================================ -->
@if(count($banners)>0)
<section id="Gslider" class="carousel slide  text-center" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($banners as $key=>$banner)
        <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach ($banners as $key=>$banner)
        <div class="carousel-item {{(($key==0)? 'active' : '')}}" style="color:black;">
            <img class="first-slide" src="{{$banner->photo}}" alt="First slide" style="width: 1600px;height: 700px;">
            <div class="carousel-caption d-none d-md-block text-left">
                <h1 class="wow fadeInDown">{{$banner->title}}</h1>
                <p>{!! html_entity_decode($banner->description) !!}</p>
                <a class="btn btn-lg ws-btn wow fadeInUpBig" href="" role="button">Mua ngay<i
                        class="far fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section>
@endif

<!--========================== banner ==========================================-->

<section class="small-banner section">
    <div class="container text-center">
        <div class="row align-items-start">
            @php $category_litsts=DB::table('categories')->where('status', 'active')->limit(3)->get(); @endphp @if($category_litsts) @foreach($category_litsts as $cat) @if($cat->is_parent==1)
            <!-- single banner -->
            <div class="col">
                <div class="single-banner">
                    @if($cat->photo)
                    <img src="{{$cat->photo}}" alt="{{$cat->photo}}" style="width: 3500px;height: 250px;border: 1px solid #ccc;"> @else
                    <img src="https://via.placeholder.com/600x370" alt="#"> @endif
                    <div class="content">
                        <h3>{{$cat->title}}</h3>
                        <a href="">Khám phá ngay</a>
                    </div>
                </div>
            </div>
            @endif @endforeach @endif
        </div>
    </div>
    <section>

        <!-- =======================products tất cả sản phẩm========================= -->
        <div class="product-area section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>MẶT HÀNG XU HƯỚNG</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-info">
                            <div class="nav-main">
                                <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                                    @php $categories=DB::table('categories')->where('status','active')->where('is_parent',1)->get(); @endphp @if($categories)
                                    <button class="btn" style="background:black" data-filter="#">Tất cả sản phẩm</button> @foreach ($categories as $key=>$cat )
                                    <button class="btn" style="background:none; color:black;   border-style: solid; border-color: black;" data-filter=".{{ $cat->id }}">
                                        {{ $cat->title }}
                                    </button> @endforeach @endif
                                </ul>
                                <!-- End Tab Nav-->
                            </div>
                            <div class="tab-content isotope-grid" id="myTabContent" style="display:flex;  flex-wrap:wrap; ">
                                @php $product_lists=DB::table('products')->where('status','active')->limit(8)->get(); @endphp @if ($product_lists) @foreach ($product_lists as $key=>$product )
                                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $product->cat_id }}">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{route('product-detail',$product->slug)}}">

                                                @php
                                                $photo=explode(',',$product->photo) ;
                                                @endphp
                                                <img class="default-img" src="{{ $photo[0] }}" alt="{{ $photo[0] }}">
                                                <img class="hover-img" src="{{ $photo[0] }}" alt="{{ $photo[0] }}">
                                                @if ($product->stock<=0) <span class="out-of-stock">Sale out</span>
                                                    @elseif($product->condition=='new')
                                                    <span class="new">new</span>
                                                    @elseif($product->condition=='hot')
                                                    <span class="hot">Hot</span>
                                                    @else
                                                    <span class="price-dec">{{ $product->discount }}%off</span>
                                                    @endif
                                            </a>
                                            <div class="button-head">
                                                <div class="product-action">
                                                    <a data-toggle="modal" data-target="#{{ $product->id }}" title="Quick View" href="#"><i class="ti-eye"></i><span>Xem nhanh</span></a>
                                                    <a title="Wishlist" href=""><i class="ti-heart"></i><span>Thêm vào danh sách yêu thích</span></a>
                                                </div>
                                                <div class="product-action-2">
                                                    <a title="Add to cart" href="">Thêm vào giỏ hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="">{{$product->title}}</a></h3>
                                        <div class="product-price">
                                            @php $after_discount=($product->price-($product->price*$product->discount)/100); @endphp
                                            <span>{{number_format($after_discount)}} VND</span>
                                            <del style="padding-left:4%;">{{number_format($product->price)}} VND</del>
                                        </div>
                                    </div>
                                </div>
                                @endforeach @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==========================2 banner lớn=============================== -->
        <section class="midium-banner">
            <div class="container">
                <div class="row">
                    @if($featured) @foreach($featured as $data)
                    <!-- Single Banner -->
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="single-banner">
                            @php $photo=explode(',', $data->photo); @endphp
                            <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                            <div class="content">

                                <h3>{{$data->title}} <br>Up to<span> {{$data->discount}}%</span></h3>
                                <a href="{{route('product-detail',$product->slug)}}">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                    <!--/End Single Banner -->
                    @endforeach @endif
                </div>
            </div>
        </section>

        <!-- ==================slide product============================= -->
        <div class="product-area most-popular section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>HÀNG HOT</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel popular-slider" style="display: flex; ">
                            @foreach($products_hot as $product) @if($product->condition=='hot')
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{route('product-detail',$product->slug)}}">
                                        @php
                                        $photo=explode(',',$product->photo);
                                        @endphp
                                        <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                        <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                    </a>
                                    <div class="button-head">
                                        <div class="product-action">
                                            <a data-toggle="modal" data-target="#{{ $product->id }}" title="Quick View" href="#"><i class="ti-eye"></i><span>Xem nhanh</span></a>
                                            <a title="Wishlist" href=""><i class="ti-heart"></i><span>Thêm vào danh sách yêu thích</span></a>
                                        </div>
                                        <div class="product-action-2">
                                            <a title="Add to cart" href="">Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="product-content">
                                    <h3><a href="">{{$product->title}}</a></h3>
                                    <div class="product-price">
                                        @php $after_discount=($product->price-($product->price*$product->discount)/100); @endphp
                                        <span>{{number_format($after_discount)}} VND</span>
                                        <del style="padding-left:4%;">{{number_format($product->price)}} VND</del>

                                    </div>
                                </div>
                            </div>
                            @endif @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 4
                        }
                    }
                })
            });
        </script>

        <!-- ================Mục mới nhất================================== -->
        <section class="shop-home-list section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="shop-section-title">
                                    <h1>Mục mới nhất</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($products_last as $product) @if ($product->condition == 'last')
                            <div class="col-md-4">
                                <!-- Start Single List -->
                                <div class="single-list">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="list-image overlay">
                                                @php $photo=explode(',',$product->photo); @endphp
                                                <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                <a href="" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                                            <div class="content">
                                                <h4 class="title"><a href="#">{{$product->title}}</a></h4>
                                                <p class="price with-discount">{{number_format($product->discount)}} VND
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single List -->
                            </div>
                            @endif @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Blog của chúng tôi  -->



        <div class="shop-blog section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Blog của chúng tôi</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($posts) @foreach ($posts as $post )
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--start single blog-->
                        <div class="shop-single-blog">
                            <img src="{{ $post->photo }}" alt="{{ $post->photo }}">
                            <div class="content">
                                <p class="date">{{$post->created_at->format('d M ,Y. D')}}</p>
                                <a href="" class="titile">{{ $post->title }}</a>
                                <a href="" class="more-btn">Tiếp tục đọc</a>
                            </div>
                        </div>
                        <!--end single blog-->
                    </div>
                    @endforeach @endif
                </div>
            </div>
        </div>



        <section class="shop-services section home">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Service -->
                        <div class="single-service">
                            <i class="ti-rocket"></i>
                            <h4>MIỄN PHÍ VẬN CHUYỂN</h4>
                            <p>Đơn hàng trên $100</p>
                        </div>
                        <!-- End Single Service -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Service -->
                        <div class="single-service">
                            <i class="ti-reload"></i>
                            <h4>Trả lại miễn phí</h4>
                            <p>Trong vòng 30 ngày trở lại</p>
                        </div>
                        <!-- End Single Service -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Service -->
                        <div class="single-service">
                            <i class="ti-lock"></i>
                            <h4>Thanh toán an toàn</h4>
                            <p>Thanh toán an toàn 100%</p>
                        </div>
                        <!-- End Single Service -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Service -->
                        <div class="single-service">
                            <i class="ti-tag"></i>
                            <h4>Giá tốt nhất</h4>
                            <p>Đảm bảo giá</p>
                        </div>
                        <!-- End Single Service -->
                    </div>
                </div>
            </div>
        </section>
        @include('frontend.layouts.newslatter') @endsection