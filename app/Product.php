<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Product extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_title', 'product_url', 'current_price', 'original_price', 'available', 'stock_qty', 'image_url', 'number_reivews', 'rating', 'seller', 'brand', 'category_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function getCompany()
    {
        $value = $this->product_url;
        if ($value != "" or $value != null) {
            $website = parse_url($value);
            $host = (isset($website["host"]) ? $website["host"] : "") ;
            $data = explode(".", $host);
            if ($data[0] == "www")
                return $data[1];
            else
                return $data[0];
        } else {
            return $value;
        }
    }


    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function product_user()
    {
        return $this->hasMany('App\ProductUser');
    }

    public function product_user_c()
    {
        return $this->hasMany('App\ProductUser', 'comp_product_id');
    }

    public function related_products($user_id)
    {
        // must be of same user
        $p_id = $this->id;
        $products = $this->product_user()->where('product_id', $p_id)->where('user_id', $user_id)->get();
        return $products;
    }

    public function related_productsc()
    {
        $p_id = $this->id;
        $products = $this->product_user_c()->where('comp_product_id', $p_id)->get();
        return $products;
    }


    public function product_history()
    {
        return $this->hasMany('App\ProductHistory');
    }

    public function product_history_recent()
    {
        $p_id = $this->id;
        $products = $this->product_history()->where('product_id', $p_id)->orderBy('id', 'desc')->first();
        return $products;
    }

    public function product_history_change()
    {
        $p_current = $this->current_price;

        $prod_recent = $this->product_history_recent();

        if ($prod_recent == null) {
            return 0;
        } else {
            $p_prev = $prod_recent['current_price'];
            return ($p_current - $p_prev);
        }
    }

    public function product_history_7()
    {
        $p_id = $this->id;
        $products = $this->product_history()->where('product_id', $p_id)->orderBy('id', 'desc')->limit(7)->pluck('current_price')->toArray();
        return $products;
    }

    public function avg($user_id)
    {

        $p_id = $this->id;

        //echo $this->current_price;

        //\DB::enableQueryLog();

        $products = $this->related_products($user_id);

        //dump($products);

        $ctr = 0;
        $avg = 0;
        foreach ($products as $product) {
            $prod = Product::find($product->comp_product_id);

            $avg += $prod->current_price;
            $ctr++;
            //dump($product);
            //$itemCount = $store->items()->count();
        }
        if ($ctr > 0) {
            return $avg / $ctr;
        } else {
            return 0;
        }

        //$products->selectRaw('avg(current_price) as avgprice')->groupBy('product_id');

        //->product; //->avg('current_price');

        //dump(\DB::getQueryLog());

        //echo $products;


    }

    public function isAvg($user_id)
    {

        $p_id = $this->id;

        $price = $this->current_price;

        $avg = $this->avg($user_id);

        if ($price == $avg) {
            return 0;
        } else if ($price > $avg) {
            return 1;
        } else {
            return -1;
        }
    }

//
//    public function avgRating()
//    {
//        return $this->reviewRows()
//            ->selectRaw('avg(rating) as aggregate, product_id')
//            ->groupBy('product_id');
//    }

public function position($user_id) {
    // product group
    // product to compare

    $position[$this->id] = $this->current_price;

    $products = $this->related_products($user_id);

    foreach ($products as $product) {
        $prod = Product::find($product->comp_product_id);
        $position[$prod->id] = $prod->current_price;
    }
    //arsort($position);
    asort($position);
    return $position;

}


}