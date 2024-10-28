<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobtype extends Model
{
    use HasFactory;
    protected $primaryKey = 'jobtype_id';
    protected $fillable = ['jobtype_title','jobtype_slug','jobtype_description','jobtype_img_url'];
}
