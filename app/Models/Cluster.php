<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $connection = 'domain';
    protected $table = 'cluster';

    public static $rules = ['cluster_name' => 'required|unique:cluster,cluster_name']; 

    protected $fillable = ['cluster_name','notes'];
}
