<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CategoryUser extends Model
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

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function categorycomp()
    {
        return $this->belongsTo('App\Category', 'comp_category_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}