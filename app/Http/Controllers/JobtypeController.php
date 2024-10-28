<?php

namespace App\Http\Controllers;

use App\Models\Jobtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class JobtypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function jobtypeView()
    {
        return view('admin.jobs.jobtype');
    }

    public function allJobtypes()
    {
        $jobtypes = Jobtype::get();
        return response()->json(['jobtypes'=>$jobtypes],200);
    }

    public function addJobtype(Request $request)
    {
        $jtype = $request->only('jobtype_title','jobtype_description','jobtype_img_url');
        $validator = Validator::make($jtype,[
            'jobtype_title' => 'required|string|min:3|max:50|unique:jobtypes',
            'jobtype_description' => 'required|min:10|max:300|string|unique:jobtypes',
            'jobtype_img_url' => 'mimes:jpeg,jpg,png,gif',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }else{
            if($request->hasFile('jobtype_img_url')){
                $image = $request->file('jobtype_img_url');
                $filename = "jtype".$image->hashName();
                $img = Image::make($image->getRealPath())->resize(480, 270, function ($constraint) {$constraint->aspectRatio();});
                $path = 'images/' . $filename;
                Storage::disk('s3')->put($path, $img->stream()->__toString());
            }
            $jobtype = new Jobtype();
            $jobtype->jobtype_title=$request->jobtype_title;
            $jobtype->jobtype_slug=strtolower(Str::slug($request->jobtype_title));
            $jobtype->jobtype_description=$request->jobtype_description;
            $jobtype->jobtype_img_url=$path;
            $jobtype->save();
            return response()->json(
                [
                    'status'=>200,
                    'message' => 'Job Category Added Successfully',
                    'jobtype' => $jobtype,
                ],200);
        }
    }
}
