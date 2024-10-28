<?php

namespace App\Http\Controllers;

use App\Models\Jobcat;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class JobcatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function jobcatView()
    {
        return view('admin.jobs.jobcat');
    }

    public function allJobcats()
    {
        $jobcats = Jobcat::get();
        return response()->json(['jobcats' => $jobcats],200);
    }

    public function addJobcat(Request $request)
    {
        $cat = $request->only('jobcat_name', 'jobcat_description', 'jobcat_img_url',);;
        $validator = Validator::make($cat,[
            'jobcat_name' => 'required|string|min:3|max:50|unique:jobcats',
            'jobcat_description' => 'required|min:10|max:300|string|unique:jobcats',
            'jobcat_img_url' => 'mimes:jpeg,jpg,png,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }else{

            if($request->hasFile('jobcat_img_url')){
                $image = $request->file('jobcat_img_url');
                $filename = "cat".$image->hashName();
                $img = Image::make($image->getRealPath())->resize(480, 270, function ($constraint) {$constraint->aspectRatio();});
                $path = 'images/' . $filename;
                Storage::disk('s3')->put($path, $img->stream()->__toString());
            }
            $jobcat = new Jobcat();
            $jobcat->jobcat_name = $request->jobcat_name;
            $jobcat->jobcat_url = strtolower(Str::slug($request->jobcat_name));
            $jobcat->jobcat_description = $request->jobcat_description;
            $jobcat->jobcat_img_url = $path;
            $jobcat->save();

            return response()->json(
                [
                    'status'=>200,
                    'message' => 'Job Category Added Successfully',
                    'jobcat' => $jobcat,
                ],200);
        }
    }
}
