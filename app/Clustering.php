<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Clustering extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'tb_clustering';
    public $timestamps = false;

     protected $fillable = [
        'no_pajak', 'cluster'
    ];

    protected $primaryKey = 'id_clustering';
    public $incrementing =true;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function pajak(){
        return $this->belongsTo('App\Pajak','no_pajak');
    }
}
