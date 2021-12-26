<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserPackage extends Model
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

    public function package()
    {
        return $this->belongsTo('App\Package');
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
