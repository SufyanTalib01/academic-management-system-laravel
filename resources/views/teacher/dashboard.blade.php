@extends('teacher.layout')

@section('title', 'Teacher Dashboard')

@section('header', 'Teacher Dashboard')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>0</h3>
                    <p>Classes Assigned</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>0</h3>
                    <p>Students</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>0</h3>
                    <p>Assignments</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>0</h3>
                    <p>Pending Reviews</p>
                </div>
                <div class="icon">
                    <i class="fas fa-edit"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Welcome</h3>
                </div>
                <div class="card-body">
                    <p>Welcome to School LMS Teacher Dashboard</p>
                    <p>Logged in as: <strong>{{ Auth::user()->name }}</strong></p>
                    <p>Email: <strong>{{ Auth::user()->email }}</strong></p>
                </div>
            </div>
        </div>
    </div>
@endsection
