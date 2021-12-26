<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone', 'website', 'verified', 'email_token', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verified()
    {
        $this->verified = 1;
        $this->email_token = null;
        $this->save();
    }

    public function product_users() {
        return $this->hasMany('App\ProductUser');
    }

    public function category_users() {
        return $this->hasMany('App\CategoryUser');
    }

    public function user_packages() {
        return $this->hasMany('App\UserPackage');
    }

    public function user_package() {
        // m
        //$p_id = $this->id;

        $now = date("Y-m-d");

        $data = array();

        $upackage = $this->user_packages()->where('user_id', $this->id)->where('uptodate', '>=', $now)->orderBy('uptodate', 'DESC')->first();
        if ($upackage == null) {
            $data['package_id'] = '0';
            $data['title'] = 'Free';
            $data['connects'] = 5;
            $data['fromdate'] = '';
            $data['uptodate'] = '';
        } else {

            $pid = $upackage['package_id'];
            $package = Package::findOrFail($pid);
            $data['package_id'] = $upackage['package_id'];
            $data['title'] = $package->package;
            $data['connects'] = $package->connects;
            $data['fromdate'] = $upackage['fromdate'];
            $data['uptodate'] = $upackage['uptodate'];

        }
        //dump($package);
        //()->where('product_id', $p_id)->where('user_id', $user_id)->get();
        return $data;
    }
}
