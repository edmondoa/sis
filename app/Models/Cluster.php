<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $connection = 'domain';
    protected $table = 'cluster';
    protected $primaryKey = 'cluster_id';
    
    public static $rules = ['cluster_name' => 'required|unique:cluster,cluster_name']; 

    protected $fillable = ['cluster_name','notes'];

    protected $appends = ['count_branch'];

    public function branch()
    {
    	return $this->hasMany('App\Models\Branch','cluster_id','cluster_id');
    }
    public function getCountBranchAttribute()
    {
    	return $this->branch()->count('branch_id');
    }
}
