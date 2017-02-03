<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainHost extends Model
{
    protected $connection = 'mysql';
	protected $table = 'domain_host';
	protected $primaryKey = 'host_id';
    public $timestamps = false;
}
