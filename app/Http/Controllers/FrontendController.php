<?php
namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\User;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        return null;
    }
    public function home()
    {
        $banners = Banner::where('status', 'active')->limit(3)->orderBy('id', 'DESC')->get();

        $products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(8)->get();

        $featured = Product::where('status', 'active')->where('is_featured', 1)->orderBy('price', 'DESC')->limit(2)->get();
       
        $products_hot = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(14)->get();
        
        $products_last = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(10)->get();

        $posts=Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.index')
                    ->with('posts', $posts)
                    ->with('products_last', $products_last)
                    ->with('banners', $banners)
                    ->with('product_lists', $products)
                    ->with('featured', $featured)
                    ->with('products_hot', $products_hot);
    }
    public function productDetail($slug){
        $product_detail=Product::getProductBySlug($slug);
        return view('frontend.pages.product_detail')->with('product_detail', $product_detail);
    }
}