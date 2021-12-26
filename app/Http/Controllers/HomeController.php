<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\ProductUser;
use App\Category;
use App\CategoryUser;
use App\User;

use Session;
use Auth;
use Validator;
use Redirect;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('faq');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        if ($user == null) {
            $user_id = 0;
        } else {
            $user_id = $user->id;
        }
        $company = "";
        if ($user->website != "" or $user->website != null) {
            $website = parse_url($user->website);
            $host = (isset($website["host"]) ? $website["host"] : "");
            $data = explode(".", $host);
            if ($data[0] == "www")
                $company = $data[1];
            else
                $company = $data[0];
        } else {
            $company = $user->website;
        }

        $products_user =
            ProductUser::select(DB::raw('MIN(id) as id, product_id'))
                ->where('user_id', $user_id)
                ->groupBy('product_id')
                ->get()
                ->toArray();

        $p = array();
        foreach ($products_user as $product) {
            $p[] = $product['product_id'];
        };

        $products_comp =
            ProductUser::select(DB::raw('MIN(id) as id, comp_product_id'))
                ->where('user_id', $user_id)
                ->groupBy('comp_product_id')
                ->get()
                ->toArray();

        $pc = array();
        foreach ($products_comp as $product) {
            $pc[] = $product['comp_product_id'];
        };

        $products = Product::whereIn('id', $p)->get();

        $products_count = $products->count();
        $brand_count = $products->groupBy('brand')->count();
        $category_count = $products->groupBy('category')->count();

        $webs = DB::select('SELECT DISTINCT SUBSTRING_INDEX(b.product_url, \'/\', 3) FROM product_users AS a INNER JOIN products AS b ON a.product_id = b.id WHERE a.user_id = ?', [$user_id]);

        $web_count = count($webs);

        $productsc = Product::whereIn('id', $pc)->get();

        $products_comp_count = $productsc->count();
        $products_comp_website = $web_count;

        $counts = compact('products_count', 'brand_count', 'category_count', 'products_comp_count', 'products_comp_website');

        $postock = 0;
        $ppinc = 0;
        $ppdec = 0;
        foreach ($products as $product) {
            if ($product->available == 0) $postock++;
            $change = $product->product_history_change();
            if ($change > 0) $ppinc++; else if ($change < 0) $ppdec++;
        }
        $pricestock = compact('postock', 'ppinc', 'ppdec');

        $postock = 0;
        $ppinc = 0;
        $ppdec = 0;
        foreach ($productsc as $product) {
            if ($product->available == 0) $postock++;
            $change = $product->product_history_change();
            if ($change > 0) $ppinc++; else if ($change < 0) $ppdec++;
        }
        $pricestockc = compact('postock', 'ppinc', 'ppdec');

        $avg0 = 0;
        $avgplus = 0;
        $avgminus = 0;
        foreach ($products as $prod) {

            $avg = $prod->isAvg($user_id);
            if ($avg == 0) $avg0++;
            if ($avg > 0) $avgplus++;
            if ($avg < 0) $avgminus++;
        }
        $average = compact('avg0', 'avgplus', 'avgminus');

        $last_updated = Product::whereIn('id', $p)->orderBy('updated_at', 'DESC')->first();
        if ($last_updated == null)
            $last_sync = 'Never';
        else
            $last_sync = $last_updated->updated_at;

        // get user's package and limits
        $package = $user->user_package();

        return view('home', ['user' => $user, 'package' => $package, 'counts' => $counts, 'avg' => $average, 'pricestock' => $pricestock, 'pricestockc' => $pricestockc, 'lastsync' => $last_sync, 'company' => $company]);
    }

    public function faq()
    {


        return view('faq', []);
    }


    public function getUser()
    {
        $user = \Auth::user();
        if ($user == null) {
            $user_id = 0;
        } else {
            $user_id = $user->id;
        }

        return view('edit-user', ['user' => $user, 'user_id' => $user_id]);
    }

    public function postUser(Request $request)
    {

        $user = \Auth::user();
        if ($user == null) {
            $user_id = 0;
        } else {
            $user_id = $user->id;
        }

        $rules = array(
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255',
        );

        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {
            Session::flash('flash_message', 'User not updated!');
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $update_user = User::findOrFail($user_id);

            $update_user->first_name = $request['first_name'];
            $update_user->last_name = $request['last_name'];
            $update_user->email = $request['email'];
            $update_user->phone = $request['phone'];
            $update_user->website = $request['website'];
            if (($request['password'] != null or trim($request['password']) != "") and strlen($request['password']) > 6 and ($request['password'] == $request['password_confirmation']) ) {
                $update_user->password = bcrypt($request['first_name']);
            }

            $update_user->save();
            Session::flash('flash_message', 'User updated!');
        }
        return Redirect::route('edit-user');

    }

    public function getProducts(Request $request)
    {

        $user = \Auth::user();
        if ($user == null) {
            $user_id = 0;
        } else {
            $user_id = $user->id;
        }

        // get user's package and limits
        $package = $user->user_package();

        // serach string
        $str = $request->input('str');

        $package_title = $package['title'];
        $connects = $package['connects'];
        $perpage = 5;

        // Free user cant search, there are only 5 products
        if ($str != null and $package_title != 'Free') {

            $products_user =
                ProductUser::select(DB::raw('MIN(id) as id, product_id'))
                    ->where('user_id', $user_id)
                    ->whereHas('Product', function ($query) use ($str) {
                        $query->where('product_title', 'like', '%' . $str . '%');
                    })
                    ->groupBy('product_id')->limit($connects)->get()
                    ;

        } else {
            $products_user =
                ProductUser::select(DB::raw('MIN(id) as id, product_id'))
                    ->where('user_id', $user_id)
                    ->groupBy('product_id')->limit($connects)->get()
                    ;
        }

        $products_all = ProductUser::where('user_id', $user_id)->orderBy('id', 'product_id')->get();

//        $categories_user =
//            CategoryUser::select(DB::raw('MIN(id) as id, category_id'))
//                ->where('user_id', $user_id)
//                ->groupBy('category_id')
//                ->get();
//
//        $categories_all = CategoryUser::where('user_id', $user_id)->orderBy('id', 'category_id')->get();

        // calculations

        $records  = $products_user->count();
        $maxpages = ceil($records/$perpage);

        $page = $request->input('page'); //) ? $request->input('page') : 1 );
        if ($page == null or $page == "") $page = 1;
        $start = ($page - 1) * $perpage;
        // limit products for page
        $products_user = $products_user->slice( $start, $perpage);

        return view('products', ['productsbyuser' => $products_user, 'products' => $products_all, 'user_id' => $user_id, 'pages' => $maxpages]);

    }


    public function getProductsStock()
    {
        $user = \Auth::user();
        if ($user == null) {
            $user_id = 0;
        } else {
            $user_id = $user->id;
        }

        $products_user =
            ProductUser::select(DB::raw('MIN(id) as id, product_id'))
                ->where('user_id', $user_id)

                ->groupBy('product_id')
                ->get()
                ->toArray();

        $p = array();
        foreach ($products_user as $product) {
            $p[] = $product['product_id'];
        };

        $products = Product::whereIn('id', $p)->where('available', 0)->get();

        return view('products-own', ['products' => $products]);



    }

    public function getProductsStockComp()
    {

        $user = \Auth::user();
        if ($user == null) {
            $user_id = 0;
        } else {
            $user_id = $user->id;
        }

        $products_comp =
            ProductUser::select(DB::raw('MIN(id) as id, comp_product_id'))
                ->where('user_id', $user_id)
                ->groupBy('comp_product_id')
                ->get()
                ->toArray();

        $pc = array();
        foreach ($products_comp as $product) {
            $pc[] = $product['comp_product_id'];
        };

        $products = Product::whereIn('id', $pc)->where('available', 0)->get();

        return view('products-comp', ['products' => $products]);
    }


    public function getAddProduct()
    {
        return view('product', []);
    }

    public function postAddProduct(Request $request)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $rules = array('product_title' => 'required|max:150', 'product_category' => 'max:50', 'product_brand' => 'max:50', 'product_url' => 'required',);

        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $product_url = trim($request["product_url"]);

            $products = Product::where('product_url', $product_url)->first();

            if ($products == null) {

                $product = new Product();
                $product->product_title = $request["product_title"];
                $product->product_url = $request["product_url"];
                $product->brand = $request["product_brand"];
                $product->category = $request["product_category"];

                $product->save();

                $product_id = $product->id;
            } else {
                $product_id = $products->id;
            }

            $competitors = $request['competitor_url'];
            foreach ($competitors as $competitor) {
                $competitor_url = trim($competitor);
                if ($competitor_url != "") {
                    $product_comp = Product::where('product_url', $competitor_url)->first();
                    if ($product_comp == null) {
                        $product = new Product();
                        $product->product_title = "";
                        $product->product_url = $competitor_url;
                        $product->brand = "";
                        $product->save();
                        $comp_product_id = $product->id;
                    } else {
                        $comp_product_id = $product_comp->id;
                    }
                    // search for product users table
                    $product_user = new ProductUser();
                    $product_user->user_id = $user_id;
                    $product_user->product_id = $product_id;
                    $product_user->comp_product_id = $comp_product_id;
                    $product_user->save();
                }
            }
            Session::flash('flash_message', 'Product successfully added!');
        }


        switch($request->submitBtn) {

            case 'Submit':
                return Redirect::route('products');
                break;

            case 'Submit and Add Another':
                return Redirect::route('create-product');
                break;
        }

        return;

    }

    public function getEditProduct($id)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $product = Product::findOrFail($id);

        $products_all = ProductUser::where('user_id', $user_id)->where('product_id', $id)->orderBy('id')->get();

        return view('edit-product', ['product' => $product, 'products' => $products_all]);

    }

    public function postUpdateProduct(Request $request)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $id = $request['id'];

//        $rules = array('product_title' => 'required', 'product_url' => 'required',);
        $rules = array('product_title' => 'required|max:150', 'product_category' => 'max:50', 'product_brand' => 'max:50', 'product_url' => 'required',);

        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            // check url
            //


            $product = Product::findOrFail($id);

            if ($product != null) {


                $product->product_title = $request["product_title"];
                $product->product_url = $request["product_url"];
                $product->brand = $request["product_brand"];
                $product->category = $request["product_category"];

                $product->save();

            }
            Session::flash('flash_message', 'Product successfully updated!');
        }
        return Redirect::route('edit-product', $id);

    }

    public function getDeleteProduct($id)
    {
        // product with all comparison rows delete
        $user = Auth::user();
        $user_id = $user->id;

        $product = ProductUser::where('user_id', $user_id)->where('product_id', $id)->delete();

        return Redirect::route('products');

    }

    public function getCompDeleteProduct($id)
    {
        // competitor delete
        $user = Auth::user();
        $user_id = $user->id;

        $product = ProductUser::where('user_id', $user_id)->where('id', $id)->first();

        $product_id = $product->product_id;

        $product = ProductUser::where('user_id', $user_id)->where('id', $id)->delete();

        Session::flash('flash_message', 'Product Competitor deleted!');

        return Redirect::route('edit-product', $product_id);
    }

    public function postAddProductComp(Request $request)
    {
        // competitor delete
        $user = Auth::user();
        $user_id = $user->id;

        $id = $request['id']; // product id
        $competitor = $request['competitor'];
        $competitor_url = trim($competitor);
        if ($competitor_url != "") {
            $product_comp = Product::where('product_url', $competitor_url)->first();
            if ($product_comp == null) {
                $product = new Product();
                $product->product_title = "";
                $product->product_url = $competitor_url;
                $product->brand = "";
                $product->save();
                $comp_product_id = $product->id;

            } else {
                $comp_product_id = $product_comp->id;

            }
            // search for product users table
            $product_user = new ProductUser();
            $product_user->user_id = $user_id;
            $product_user->product_id = $id;
            $product_user->comp_product_id = $comp_product_id;
            $product_user->save();


        }

        Session::flash('flash_message', 'Product Competitor added!');

        return Redirect::route('edit-product', $id);


    }

    public function getHistoryProduct($id)
    {
        //return 'Charts are here';
        $user = \Auth::user();
        if ($user == null) {
            $user_id = 0;
        } else {
            $user_id = $user->id;
        }

        // first record

        $product = Product::findOrFail($id);

        $url = $product->getCompany(); //product_url;
        $data = [0, 0, 0, 0, 0, 0, 0];
        $data[0] = $product->current_price;

        $prices = $product->product_history_7();
        $ctr = 1;
        foreach ($prices as $p) {
            $data[$ctr] = $p;
            $ctr++;
        }
        $data = array_reverse($data);

        $results[] = ['url' => $url, 'data' => join(",", $data)];

        // other records
        $products_all = ProductUser::where('user_id', $user_id)->where('product_id', $id)->orderBy('id', 'product_id')->get();

        // collection of productuser
        foreach ($products_all as $produser) {
            $produser1 = $produser->product_comp()->first();

            $url = $produser1->product_url;
            $data = [0, 0, 0, 0, 0, 0, 0];
            $data[0] = $produser1->current_price;

            $prodcomp = $produser->product_comp()->get();

            foreach ($prodcomp as $prodc) {
                $url = $produser1->getCompany(); //product_url;
                $prices = $prodc->product_history_7();

                $ctr = 1; // $data = [0, 0, 0, 0, 0, 0, 0];
                foreach ($prices as $p) {
                    $data[$ctr] = $p;
                    $ctr++;
                }
                $data = array_reverse($data);
                $results[] = ['url' => $url, 'data' => join(",", $data)];

            };


        }


        return view('charts', ['results' => $results]);
    }

    public function getCategories()
    {

        $user = \Auth::user();
        if ($user == null) {
            $user_id = 0;
        } else {
            $user_id = $user->id;
        }

//        $products_user =
//            ProductUser::select(DB::raw('MIN(id) as id, product_id'))
//                ->where('user_id', $user_id)
//                ->groupBy('product_id')
//                ->get();
//
//        $products_all = ProductUser::where('user_id', $user_id)->orderBy('id', 'product_id')->get();

        $categories_user =
            CategoryUser::select(DB::raw('MIN(id) as id, category_id'))
                ->where('user_id', $user_id)
                ->groupBy('category_id')
                ->get();

        $categories_all = CategoryUser::where('user_id', $user_id)->orderBy('id', 'category_id')->get();

        return view('categories', ['categoriesbyuser' => $categories_user, 'categories' => $categories_all]);

    }


    public function getAddCategory()
    {
        return view('category', []);
    }

    public function postAddCategory(Request $request)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $rules = array('category_title' => 'required', 'category_url' => 'required',);

        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();

        } else {

            $category_url = trim($request["category_url"]);

            $categories = Category::where('category_url', $category_url)->first();

            if ($categories == null) {

                $category = new Category();
                $category->category = $request["category_title"];
                $category->category_url = $request["category_url"];

                $category->save();

                $category_id = $category->id;
            } else {
                $category_id = $categories->id;
            }

            $competitors = $request['competitor_url'];

            foreach ($competitors as $competitor) {
                $competitor_url = trim($competitor);
                if ($competitor_url != "") {
                    $category_comp = Category::where('category_url', $competitor_url)->first();
                    if ($category_comp == null) {
                        $category = new Category();
                        $category->category = "";
                        $category->category_url = $competitor_url;

                        $category->save();
                        $comp_category_id = $category->id;
                    } else {
                        $comp_category_id = $category_comp->id;
                    }
                    // search for category users table
                    $category_user = new CategoryUser();
                    $category_user->user_id = $user_id;
                    $category_user->category_id = $category_id;
                    $category_user->comp_category_id = $comp_category_id;
                    $category_user->save();
                }
            }
        }

        return Redirect::route('home');


    }

    public function getEditCategory($id)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $category = Category::findOrFail($id);
        return view('edit-category', ['category' => $category]);

    }

    public function postUpdateCategory(Request $request)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $rules = array('category_title' => 'required', 'category_url' => 'required',);

        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            // check url
            //
            $id = $request['id'];


            $category = Category::findOrFail($id);

            if ($category != null) {

                $category->category = $request["category_title"];
                $category->category_url = $request["category_url"];

                $category->save();

            }
        }
        return Redirect::route('home');

    }

    public function getDeleteCategory($id)
    {
        // product with all comparison rows delete
        $user = Auth::user();
        $user_id = $user->id;

        $product = CategoryUser::where('user_id', $user_id)->where('category_id', $id)->delete();

        return Redirect::route('home');

    }

    public function getCompDeleteCategory($id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $product = CategoryUser::where('user_id', $user_id)->where('id', $id)->delete();
        return Redirect::route('home');
    }

    public function postAddCategoryComp(Request $request)
    {
        // competitor delete
        $user = Auth::user();
        $user_id = $user->id;

        $id = $request['id']; // category id
        $competitor = $request['competitor'];
        $competitor_url = trim($competitor);
        if ($competitor_url != "") {
            $category_comp = Category::where('category_url', $competitor_url)->first();
            if ($category_comp == null) {
                $category = new Category();
                $category->category = "";
                $category->category_url = $competitor_url;
                $category->save();
                $comp_category_id = $category->id;
            } else {
                $comp_category_id = $category_comp->id;
            }
            // search for category users table
            $category_user = new CategoryUser();
            $category_user->user_id = $user_id;
            $category_user->category_id = $id;
            $category_user->comp_category_id = $comp_category_id;
            $category_user->save();

        }

        return Redirect::route('home');


    }

    public function getAddBatch()
    {
        return view('batch', []);
    }

    public function postAddBatch(Request $request)
    {

        $user = Auth::user();
        $user_id = $user->id;

        // getting all of the post data
        $file = $request['csvfile'];
        $destinationPath = 'uploads/csv';
        if ($file and $file->getMimeType() == 'text/plain') {
            // only jpg files of less than 2MB
            $filename = $file->getClientOriginalName();

            $fname = $user_id . "-" . $filename;
            // save image name
            $fpath = $destinationPath . '/' . $fname;

            $file->move($destinationPath, $fname);

            $customerArr = $this->csvToArray($fpath);

            $i = 0;

            for ($i = 0; $i < count($customerArr); $i++) {
                //User::firstOrCreate($customerArr[$i]);

                $product_title = $customerArr[$i]["ProductName"]; // space to cover bug
                $product_brand = $customerArr[$i]["Brand"];
                $category = $customerArr[$i]["Category"];
                $product_url = $customerArr[$i]["YourOwnURL"];

                $competitors = Array();
                $competitors[0] = $customerArr[$i]["Competitor1URL"];
                $competitors[1] = $customerArr[$i]["Competitor2URL"];
                $competitors[2] = $customerArr[$i]["Competitor3URL"];
                $competitors[3] = $customerArr[$i]["Competitor4URL"];
                $competitors[4] = $customerArr[$i]["Competitor5URL"];

                $products = Product::where('product_url', $product_url)->first();

                if ($products == null) {

                    $product = new Product();
                    $product->product_title = $product_title;
                    $product->product_url = $product_url;
                    $product->brand = $product_brand;
                    $product->category = $category;

                    $product->save();

                    $product_id = $product->id;
                } else {
                    $product_id = $products->id;
                }


                foreach ($competitors as $competitor) {
                    $competitor_url = trim($competitor);
                    if ($competitor_url != "") {
                        $product_comp = Product::where('product_url', $competitor_url)->first();
                        if ($product_comp == null) {
                            $product = new Product();
                            $product->product_title = "";
                            $product->product_url = $competitor_url;
                            $product->brand = "";
                            $product->save();
                            $comp_product_id = $product->id;
                        } else {
                            $comp_product_id = $product_comp->id;
                        }
                        // search for product users table
                        $product_user = new ProductUser();
                        $product_user->user_id = $user_id;
                        $product_user->product_id = $product_id;
                        $product_user->comp_product_id = $comp_product_id;
                        $product_user->save();
                    }


                }
            }
            Session::flash('flash_message', $i . ' Record(s) loaded.');
        } else {
            Session::flash('flash_message', 'Error Processing file');
        }
        return Redirect::route('home');

    }

    function csvToArray($filename = '', $delimiter = ',')
    {

        // check for file
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        // check for columns

        $header = null;
        $data = array();
        $ctr = 0;

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {

                if (!$header)
                    $header = $row;
                else {
                    $error = 0;
                    $product = $row[0];
                    $url = $row[3];
                    $url1 = $row[4];
                    $url2 = $row[5];
                    $url3 = $row[6];
                    $url4 = $row[7];
                    if ((strlen($product) < 1 )) {
                        $error = 1;
                    }
                    if ( preg_match('/^(http|https):\/\/.*$/', $url, $matches) == 0) {
                        $error = 1;
                    }
                    if ( $url1 != "" and preg_match('/^(http|https):\/\/.*$/', $url1, $matches) == 0) {
                        $error = 1;
                    }
                    if ( $url2 != "" and preg_match('/^(http|https):\/\/.*$/', $url2, $matches) == 0) {
                        $error = 1;
                    }
                    if ( $url3 != "" and preg_match('/^(http|https):\/\/.*$/', $url3, $matches) == 0) {
                        $error = 1;
                    }
                    if ( $url4 != "" and preg_match('/^(http|https):\/\/.*$/', $url4, $matches) == 0) {
                        $error = 1;
                    }
                    if ($error == 0) {
                        $data[$ctr] = array_combine($header, $row);
                        $ctr++;
                    }
                }
            }
            fclose($handle);
        }

        return $data;
    }
}