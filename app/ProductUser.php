<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductUser extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function product_comp()
    {
        return $this->belongsTo('App\Product', 'comp_product_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

//    public function yyy() {
//        echo 'xxxyyy';
//
//        $products = $this->product();
//
//        return $products;
//    }
//
//    public function aaa() {
//        echo 'yes';
//    }
}
