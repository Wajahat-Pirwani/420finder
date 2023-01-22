<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Business;

use App\Models\Brand;

use App\Models\BrandFeed;

use App\Models\Category;

use App\Models\CategoryType;

use App\Models\SubCategory;

use App\Models\BrandProduct;

use App\Models\ProductRequest;

use App\Models\BrandProductGallery;

use App\Models\Genetic;

use App\Models\Strain;

use App\Models\DispenseryProduct;

use App\Models\DispenseryProductGallery;

use App\Models\DeliveryProducts;

use App\Models\DeliveryProductGallery;
use App\Models\RetailOrder;
use App\Services\AuthorizeService;
use Image;

class BrandController extends Controller {

    public function index() {

        $brands = Brand::where('business_id', session('business_id'))
            ->get();

        return view('business.brands.index')
            ->with('brands', $brands);

    }

    public function create() {

        return view('business.brands.create');

    }

    public function save(Request $request) {

        $brand = new Brand;

        $brand->business_id = session('business_id');
        $brand->name = $request->name;
        $brand->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $brand->description = $request->description;

        if($request->hasFile('logo')) {

            $avatar = $request->file('logo');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(256,250)->save(public_path('images/brands/logo/' . $filename));

            $brand->logo = asset("images/brands/logo/" . $filename);

        }

        if($request->hasFile('cover')) {

            $avatar = $request->file('cover');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(770,218)->save(public_path('images/brands/cover/' . $filename));

            $brand->cover = asset("images/brands/cover/" . $filename);

        }

        $brand->license_type = $request->license_type;
        $brand->license_number = $request->license_number;
        $brand->yt_featured_url = $request->yt_featured_url;
        $brand->yt_playlist_url = $request->yt_playlist_url;
        $brand->website_url = $request->website_url;
        $brand->instagram_url = $request->instagram_url;
        $brand->twitter_url = $request->twitter_url;
        $brand->facebook_url = $request->facebook_url;
        $brand->status = $request->status;

        $brand->save();

        return redirect()->back()->with('info', 'Brand Created.');

    }

    public function edit($id) {

        $brand = Brand::where('id', $id)->first();

        return view('business.brands.edit')
            ->with('brand', $brand);

    }

    public function update(Request $request) {

        $brand = Brand::find($request->brand_id);

        $brand->business_id = session('business_id');
        $brand->name = $request->name;
        $brand->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $brand->description = $request->description;

        if($request->hasFile('logo')) {

            $avatar = $request->file('logo');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(256,250)->save(public_path('images/brands/logo/' . $filename));

            $brand->logo = asset("images/brands/logo/" . $filename);

        }

        if($request->hasFile('cover')) {

            $avatar = $request->file('cover');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(770,218)->save(public_path('images/brands/cover/' . $filename));

            $brand->cover = asset("images/brands/cover/" . $filename);

        }

        $brand->license_type = $request->license_type;
        $brand->license_number = $request->license_number;
        $brand->yt_featured_url = $request->yt_featured_url;
        $brand->yt_playlist_url = $request->yt_playlist_url;
        $brand->website_url = $request->website_url;
        $brand->instagram_url = $request->instagram_url;
        $brand->twitter_url = $request->twitter_url;
        $brand->facebook_url = $request->facebook_url;
        $brand->status = $request->status;

        $brand->save();

        return redirect()->back()->with('info', 'Brand Updated.');

    }

    public function view($id) {

        $business = Business::where('id', session('business_id'))->first();

        $brand = Brand::where('id', $id)->select('id', 'name', 'slug', 'is_paid')->first();

        $active = "contact-details";

        return view('business.brands.view')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('business', $business);

    }

    public function products($slug, $id) {

        $brand = Brand::where('id', $id)->select('id', 'name', 'slug', 'is_paid')->first();

        $active = "product-management";

        $products = BrandProduct::where('brand_id', $id)
            ->select('id', 'name', 'image', 'sku', 'subcategory_names', 'status')
            ->get();

        return view('business.brands.products')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('products', $products);

    }

    public function savebrandproduct(Request $request) {

        // $authorizePayment = resolve(AuthorizeService::class);
        // $response = $authorizePayment->chargeCreditCard($request);
        // $tresponse = $response->getTransactionResponse();

        // if ($tresponse != null && $tresponse->getMessages() != null) {

        $product = new BrandProduct;

        $product->brand_id = $request->brand_id;

        $product->name = $request->name;

        $product->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));

        $product->description = $request->description;

        if($request->hasFile('image')) {

            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(274,274)->save(public_path('images/brands/products/' . $filename));

            $product->image = asset("images/brands/products/" . $filename);

        }

        $product->sku = $request->sku;
        $product->suggested_price = $request->suggested_price;
        $product->category_id = $request->category_id;

        $idsArray = array();
        $subcategoriesArray = array();
        $search = "type_";
        $search_length = strlen($search);

        foreach ($_POST as $key => $value) {
            if (substr($key, 0, $search_length) == $search) {
                array_push($subcategoriesArray, substr($key, 5));
                array_push($idsArray, $value);
            }
        }

        $subcategoryids = implode(", ", $idsArray);

        $subcategorynames = implode(", ", $subcategoriesArray);

        $product->subcategory_ids = $subcategoryids;
        $product->subcategory_names = $subcategorynames;

        $product->strain_id = $request->strain_id;
        $product->genetic_id = $request->genetic_id;
        $product->thc_percentage = $request->thc_percentage;
        $product->cbd_percentage = $request->cbd_percentage;

        if ($request->is_featured == 'on') {

            $product->is_featured = 1;

        } else {

            $product->is_featured = 0;

        }

        $product->status = $request->status;
        // $product->is_paid = 1;

        if ($product->save()) {

            // RetailOrder::create([
            //     'brand_id' => $request->brand_id,
            //     'product_id' => $product->id,
            //     'business_id' => session('business_id'),
            //     'amount' => '5.00',
            //     'name_on_card' => $request->name_on_card,
            //     'response_code' => $tresponse->getResponseCode(),
            //     'transaction_id' => $tresponse->getTransId(),
            //     'auth_id' => $tresponse->getAuthCode(),
            //     'message_code' => $tresponse->getMessages()[0]->getCode(),
            //     'quantity' => 1,
            // ]);

            if ($request->hasFile('galleryimages')) {

                echo count($request->galleryimages);

                foreach($request->file('galleryimages') as $image) {

                    $name=$image->getClientOriginalName();
                    $image->move(public_path('images/brands/products/gallery'), $name);

                    $bpg = new BrandProductGallery;

                    $bpg->brand_product_id = $product->id;
                    $bpg->image = asset("images/brands/products/gallery/" . $name);
                    $bpg->save();

                }

            }

            return redirect()->back()->with('info', 'Product Created.');

        } else {

            return redirect()->back()->with('error', 'Problem occured while creating product.');

        }

    //   } else {

    //     return redirect()->back()->with('error', "Sorry we couldn't process the payment");

    //   }

    }

    public function editbrandproduct($slug, $brand_id, $product_id) {

        $brand = Brand::where('id', $brand_id)->select('id', 'name', 'slug', 'is_paid')->first();

        $active = "product-management";

        $categories = Category::all();

        $product = BrandProduct::where('id', $product_id)
            ->first();

        $gallery = BrandProductGallery::where('brand_product_id', $product_id)->get();

        $genetics = Genetic::all();

        $strains = Strain::all();

        return view('business.brands.editproducts')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('categories', $categories)
            ->with('product', $product)
            ->with('gallery', $gallery)
            ->with('genetics', $genetics)
            ->with('strains', $strains);

    }

    public function removegalleryimage($id) {

        $image = BrandProductGallery::find($id);

        $image->delete();

        return redirect()->back()->with('info', 'Gallery Image Removed Successfully.');

    }

    public function updatebrandproduct(Request $request) {

        $product = BrandProduct::find($request->product_id);

        $product->name = $request->name;

        $product->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));

        $product->description = $request->description;

        if($request->hasFile('image')) {

            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(274,274)->save(public_path('images/brands/products/' . $filename));

            $product->image = asset("images/brands/products/" . $filename);

        }

        $product->sku = $request->sku;
        $product->suggested_price = $request->suggested_price;

        if ($request->is_featured == 'on') {

            $product->is_featured = 1;

        } else {

            $product->is_featured = 0;

        }

        $product->strain_id = $request->strain_id;
        $product->genetic_id = $request->genetic_id;
        $product->thc_percentage = $request->thc_percentage;
        $product->cbd_percentage = $request->cbd_percentage;

        $product->status = $request->status;

        if ($product->save()) {

            if ($request->hasFile('galleryimages')) {

                echo count($request->galleryimages);

                foreach($request->file('galleryimages') as $image) {

                    $name=$image->getClientOriginalName();
                    $image->move(public_path('images/brands/products/gallery'), $name);

                    $bpg = new BrandProductGallery;

                    $bpg->brand_product_id = $product->id;
                    $bpg->image = asset("images/brands/products/gallery/" . $name);
                    $bpg->save();

                }

            }


            // UPDATE DELIVERY PRODUCT
            $deliveryProduct = DeliveryProducts::where('brand_product_id', $request->product_id)->first();

            if(!is_null($deliveryProduct)) {

            $deliveryProduct->name = $request->name;

            $deliveryProduct->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));

            $deliveryProduct->description = $request->description;

            if($request->hasFile('image')) {

                $avatar = $request->file('image');
                $filename = time() . '.' . $avatar->GetClientOriginalExtension();

                $avatar_img = Image::make($avatar);
                $avatar_img->resize(274,274)->save(public_path('images/brands/products/' . $filename));

                $deliveryProduct->image = asset("images/brands/products/" . $filename);

            }

            $deliveryProduct->sku = $request->sku;
            $deliveryProduct->price = $request->price;
            $deliveryProduct->off = $request->off;

            if ($request->is_featured == 'on') {

                $deliveryProduct->is_featured = 1;

            } else {

                $deliveryProduct->is_featured = 0;

            }

            $deliveryProduct->strain_id = $request->strain_id;
            $deliveryProduct->genetic_id = $request->genetic_id;
            $deliveryProduct->thc_percentage = $request->thc_percentage;
            $deliveryProduct->cbd_percentage = $request->cbd_percentage;

            if ($deliveryProduct->save()) {

                if ($request->hasFile('galleryimages')) {

                    echo count($request->galleryimages);

                    foreach($request->file('galleryimages') as $image) {

                        $name=$image->getClientOriginalName();
                        $image->move(public_path('images/brands/products/gallery'), $name);

                        $bpg = new DeliveryProductGallery;

                        $bpg->dispensery_product_id = $deliveryProduct->id;
                        $bpg->image = asset("images/brands/products/gallery/" . $name);
                        $bpg->save();

                    }

                }
            }

        }

            return redirect()->back()->with('info', 'Product Updated.');

        } else {

            return redirect()->back()->with('error', 'Problem occured while updated product.');

        }

    }

    public function viewbrandfeeds($slug, $id) {

        $brand = Brand::where('id', $id)->select('id', 'name', 'slug', 'is_paid')->first();

        $active = "feeds";

        $feeds = BrandFeed::where('business_id', session('business_id'))
            ->where('brand_id', $id)
            ->get();

        return view('business.feeds.index')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('feeds', $feeds);

    }

    public function savebrandfeed(Request $request) {

        $feed = new BrandFeed;

        $feed->business_id = session('business_id');

        $feed->brand_id = $request->brand_id;

        if($request->hasFile('image')) {

            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(500,500)->save(public_path('images/brands/posts/' . $filename));

            $feed->image = asset("images/brands/posts/" . $filename);

        }

        $feed->description = $request->description;

        $feed->save();

        return redirect()->back()->with('info', 'New Post Created.');

    }

    public function getfeedsingle(Request $request) {

        $feed = BrandFeed::where('id', $request->feed_id)->first();

        $response = [
                        'statuscode'=> 200,
                        'feed_id'=> $feed->id,
                        'image'=> $feed->image,
                        'description' => $feed->description
                    ];

        echo json_encode($response);

    }

    public function updatebrandfeed(Request $request) {

        $feed = BrandFeed::find($request->feed_id);

        if($request->hasFile('image')) {

            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(500,500)->save(public_path('images/brands/posts/' . $filename));

            $feed->image = asset("images/brands/posts/" . $filename);

        }

        $feed->description = $request->description;

        $feed->save();

        return redirect()->back()->with('info', 'New Post Created.');

    }

    public function removebrandfeed($id) {

        $feed = BrandFeed::find($id);

        $feed->delete();

        return redirect()->back()->with('info', 'Feed removed successfully.');

    }

    public function manageverifications($slug, $id) {

        $brand = Brand::where('id', $id)->select('id', 'name', 'slug', 'is_paid')->first();

        $requests = ProductRequest::where('brand_id', $id)->get();

        $active = "manage-verifications";

        return view('business.verifications.index')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('requests', $requests);

    }

    public function approveproductrequest($id) {

        $approve = ProductRequest::find($id);

        $approve->status = 1;

        $approve->save();

        $getBP = ProductRequest::where('id', $id)->first();

        $product_ids = explode(", ", $getBP->products);

        $retailer = Business::where('id', $getBP->retailer_id)->first();

        if ($retailer->business_type == 'Delivery') {

            foreach($product_ids as $product_id) {

                $brandproduct = BrandProduct::where('id', $product_id)->first();

                $dproduct = new DeliveryProducts;

                $dproduct->delivery_id        = $getBP->retailer_id;
                $dproduct->brand_product        = 1;
                $dproduct->brand_product_id     = $brandproduct->id;
                $dproduct->brand_id             = $brandproduct->brand_id;
                $dproduct->name                 = $brandproduct->name;
                $dproduct->slug                 = $brandproduct->name;
                $dproduct->description          = $brandproduct->name;
                $dproduct->price                = $brandproduct->suggested_price;
                $dproduct->image                = $brandproduct->image;
                $dproduct->sku                  = $brandproduct->sku;
                $dproduct->category_id          = $brandproduct->category_id;
                $dproduct->subcategory_ids      = $brandproduct->subcategory_ids;
                $dproduct->subcategory_names    = $brandproduct->subcategory_names;
                $dproduct->strain_id            = $brandproduct->strain_id;
                $dproduct->genetic_id           = $brandproduct->genetic_id;
                $dproduct->thc_percentage       = $brandproduct->thc_percentage;
                $dproduct->cbd_percentage       = $brandproduct->cbd_percentage;
                $dproduct->is_featured          = $brandproduct->is_featured;

                $dproduct->save();

                $gallery = BrandProductGallery::where('brand_product_id', $product_id)->get();

                foreach($gallery as $single) {

                    $image = new DeliveryProductGallery;

                    $image->delivery_product_id = $dproduct->id;

                    $image->image = $single->image;

                    $image->save();

                }

            }

        } else {

            foreach($product_ids as $product_id) {

                $brandproduct = BrandProduct::where('id', $product_id)->first();

                $dproduct = new DispenseryProduct;

                $dproduct->dispensery_id        = $getBP->retailer_id;
                $dproduct->name                 = $brandproduct->name;
                $dproduct->slug                 = $brandproduct->name;
                $dproduct->description          = $brandproduct->name;
                $dproduct->price                = $brandproduct->suggested_price;
                $dproduct->image                = $brandproduct->image;
                $dproduct->sku                  = $brandproduct->sku;
                $dproduct->category_id          = $brandproduct->category_id;
                $dproduct->subcategory_ids      = $brandproduct->subcategory_ids;
                $dproduct->subcategory_names    = $brandproduct->subcategory_names;
                $dproduct->strain_id            = $brandproduct->strain_id;
                $dproduct->genetic_id           = $brandproduct->genetic_id;
                $dproduct->thc_percentage       = $brandproduct->thc_percentage;
                $dproduct->cbd_percentage       = $brandproduct->cbd_percentage;
                $dproduct->is_featured          = $brandproduct->is_featured;

                $dproduct->save();

                $gallery = BrandProductGallery::where('brand_product_id', $product_id)->get();

                foreach($gallery as $single) {

                    $image = new DispenseryProductGallery;

                    $image->dispensery_product_id = $dproduct->id;

                    $image->image = $single->image;

                    $image->save();

                }

            }

        }

        return redirect()->back()->with('info', 'Request approved.');

    }

    public function rejectproductrequest($id) {

        $reject = ProductRequest::find($id);

        $reject->status = 0;

        $reject->save();

        return redirect()->back()->with('error', 'Request rejected.');

    }

    public function getrequestedproductslist(Request $request) {

        $request_id = $request->request_id;

        $products = ProductRequest::where('id', $request_id)->first();

        $pids = explode(", ", $products->products);

        $data = "";

        foreach ($pids as $index => $pid) {

            $product = BrandProduct::where('id', $pid)->select('name')->first();

            $data .= "<p class='border-bottom pb-3'><strong>" . $index + 1 . ":</strong> " . $product['name'] . "</p>";

        }

        echo $data;

    }

    public function addbrandproduct($slug, $id) {

        $brand = Brand::where('id', $id)->select('id', 'name', 'slug', 'is_paid')->first();

        $active = "product-management";

        $categories = Category::all();

        $genetics = Genetic::all();

        $strains = Strain::all();

        return view('business.brands.createproduct')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('categories', $categories)
            ->with('genetics', $genetics)
            ->with('strains', $strains);

    }

    public function gettypesubcat(Request $request) {

        $category_id = $request->category_id;

        $types = CategoryType::where('category_id', $category_id)->get();

        $data = '

            <div class="row categoriesCols">
                ';
                foreach($types as $type) {
                    $data .='
                    <div class="col-md-3">
                        <h6 class="pb-2"><strong>' . $type->name . '</strong></h6>
                        <ul class="list-unstyled">';

                        $subcategories = SubCategory::where('type_id', $type->id)->where('parent_id', 0)->get();

                        foreach($subcategories as $subcat) {
                            $data .= '

                                <li class="mb-2"><label><input rel="' . $subcat->name . '" type="radio" class="childOfParentSC" name="type_' . $type->name . '" value="' . $subcat->id . '" required=""> ' . $subcat->name . '</label></li>

                            ';
                        }

                        $data .='</ul>
                    </div>';
                }
            $data .= "
                <script>

                    $('.childOfParentSC').on('click', function() {
                        var subcat_id = $(this).val();
                        var type_name = $(this).attr('rel');
                        var selected = $(this).attr('rel');
                        var main = $('.selectedcats').text();
                        $('#typesubcategories').addClass('loader');
                        $.ajax({
                            headers: {
                              'X-CSRF-TOKEN': '" . csrf_token() . "'
                            },
                            url:'" . route("getparentchildsc") . "',
                            method:'POST',
                            data:{subcat_id:subcat_id, type_name:type_name},
                            success:function(data) {
                                $('.subchild').remove();
                                $('.categoriesCols').append(data);

                                let str = main;
                                if(str.includes(selected)) {

                                } else {
                                    $('.selectedcats').html(main + selected + ', ');
                                }
                                $('#typesubcategories').removeClass('loader');
                            }
                        });

                    });

                </script>
            </div>
            ";

        $response = [
                        'statuscode'=> 200,
                        'data' => $data
                    ];

        echo json_encode($response);

    }

    public function getparentchildsc(Request $request) {

        $subcategories = SubCategory::where('parent_id', $request->subcat_id)->get();
        $data = '';

        if ($subcategories->count() > 0) {

            $data .='
                <div class="col-md-3 subchild">
                    <h6 class="pb-2"><strong>' . $request->type_name . ' Type</strong></h6>
                    <ul class="list-unstyled">';

                    foreach($subcategories as $subcat) {
                        $data .= '

                            <li class="mb-2"><label><input rel="' . $subcat->name . '" type="radio" class="childOfParentSC" name="type_' . $request->type_name . '" value="' . $subcat->id . '" required=""> ' . $subcat->name . '</label></li>

                        ';
                    }

                    $data .='</ul>
                </div>
                <script>
                    $(".childOfParentSC").on("click", function(){
                        var selected = $(this).attr("rel");
                        var main = $(".selectedcats").text();
                        let str = main;
                        if(str.includes(selected)) {
                            main.replace(selected+", ","");
                        } else {
                            $(".selectedcats").html(main + selected + ", ");
                        }
                    });
                </script>

                ';

            echo $data;

        }

    }

    /*
    *   BRAND PAYMENT
    *
    */
    public function brandPayments($brandSlug, $brandId) {

        if(is_null($this->checkIfUserBrand($brandId))) {

            return redirect()->route('dashboardbrands');

        } else {

            $brand = Brand::where('id', $brandId)->select('id', 'name', 'slug', 'is_paid')->first();

            $active = "payments";

            return view('business.brands.brandpayment')
                ->with('active', $active)
                ->with('brand', $brand);
        }
    }

    /*
    *  STORE BRAND PAYMENT
    *
    */
    public function storeBrandPayment(Request $request) {

        $validated = request()->validate([
            'name_on_card' => 'required|min:2',
            'cvv' => 'required|numeric|digits:3',
            'card_number' => 'required|numeric|digits:16',
            'expiration_month' => 'required',
            'expiration_year' => 'required'
        ]);

        if(!is_null($request->brand_id)) {

        $brand = $this->checkIfUserBrand($request->brand_id);
        if(!is_null($brand)) {

            $authorizePayment = resolve(AuthorizeService::class);
            $response = $authorizePayment->chargeCreditCard($validated);
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getMessages() != null) {

                $created = RetailOrder::create([
                    'brand_id' => $brand->id,
                    'business_id' => session('business_id'),
                    'amount' => '5.00',
                    'name_on_card' => $validated['name_on_card'],
                    'response_code' => $tresponse->getResponseCode(),
                    'transaction_id' => $tresponse->getTransId(),
                    'auth_id' => $tresponse->getAuthCode(),
                    'message_code' => $tresponse->getMessages()[0]->getCode(),
                    'quantity' => 1,
                ]);

                $brand->update([
                    'is_paid' => 1
                ]);

                if($created) {

                    session()->flash('success', 'Your payment has been successful');
                    return redirect()->route('managebrandpayments', [$brand->slug, $brand->id])->with('paid', $created);

                } else {

                    session()->flash('error', 'Sorry something went wrong');
                    return redirect()->route('managebrandpayments', [$brand->slug, $brand->id]);

                }
            } else {

                session()->flash('error', 'Sorry we couldn\'t process the payment');

                return redirect()->route('managebrandpayments', [$brand->slug, $brand->id]);

            }

        } else {

            return redirect()->route('dashboardbrands');
        }

        } else {
            return redirect()->route('dashboardbrands');
        }

    }
    /*
    *   CHECK IF USER BRAND
    *
    */
    private function checkIfUserBrand($brandId) {

        $businessId = session('business_id');

        $brand = Brand::where([
            ['id', $brandId],
            ['business_id', $businessId]
        ])->first();

        return $brand;
    }

}
