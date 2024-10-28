<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobcat extends Model
{
    use HasFactory;
    protected $primaryKey = 'jobcat_id';
    protected $fillable = ['jobcat_name','jobcat_url','jobcat_description','jobcat_img_url'];

}
