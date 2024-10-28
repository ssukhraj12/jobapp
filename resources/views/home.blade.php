@extends('layouts.app')

@section('content')
    <div class="row my-1">
        <div class="col-12 col-md-4"><h2>Dashboard</h2></div>
        <div class="col-12 col-md-4">{{$jobtypes}}</div>
        <div class="col-12 col-md-4"></div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    {{$jobtypes}}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    {{$jobcats}}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    {{$jobs}}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    {{$users}}
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
@endsection
