<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listCountries()
    {
        $countries = Country::get();
        return view('admin.locations.countries',compact('countries'));
    }

    public function listStates()
    {
        $states = State::get();
        return view('admin.locations.states',compact('states'));
    }

    public function listCities()
    {
        $cities = City::get();
        return view('admin.locations.cities',compact('cities'));
    }

    public function countries()
    {
        $countries = Country::get();
        return response()->json(['countries'=>$countries],200);
    }

    public function states()
    {
        $states = State::join('countries','countries.id','states.country_id')
            ->select('states.*','countries.name as country')
            ->where('states.country_id','=',101)->get();
        return response()->json(['states'=>$states],200);
    }

    public function cities()
    {
        $cities = City::join('states','states.id','cities.state_id')
            ->select('cities.*','states.name as state')
            ->where('cities.state_id','<',42)->get();
//        dd($cities->toArray());
        return response()->json(['cities'=>$cities],200);
    }

}
