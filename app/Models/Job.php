<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $primaryKey = 'job_id';
    protected $fillable = [
        'user_id',
        'jobcat_id', 'jobtype_id',
        'city_id',
        'job_title', 'job_description',
        'salary_from', 'salary_to','salary_type','job_status'];
}
