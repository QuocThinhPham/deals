<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'typies';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}
