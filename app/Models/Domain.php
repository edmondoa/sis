<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $connection = 'mysql';
	protected $table = 'domain';
	protected $primaryKey = 'domain_id';
	public function master()
	{
		return $this->belongsTo('App\Models\DomainHost','master_host_id','host_id');
	}
}
