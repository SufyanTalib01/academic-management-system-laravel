@extends('admin.layout')
@section('content')
    @php
        $months = [
            'april',
            'may',
            'june',
            'july',
            'august',
            'september',
            'october',
            'november',
            'december',
            'january',
            'february',
            'march',
        ];
    @endphp
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Teacher</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Teacher</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        @if (Session::has('success'))
            <div class="alert alert-success mt-3 mx-3">
                {{ Session::get('success') }}
            </div>
        @endif


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Teacher</h3>
                            </div>



                            <form action="{{ route('teacher.store') }}" method="post">
                                @csrf
                                <div class="card-body">



                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="father_name">Teacher Name</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                                placeholder="Enter Teacher Name">
                                            @error('name')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">

                                            <label for="father_name">Teacher's Father Name</label>
                                            <input type="text" name="father_name" id="father_name"
                                                class="form-control  @error('father_name')
                                                is-invalid
                                            @enderror"
                                                placeholder="Enter Teacher's Father Name">
                                            @error('father_name')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="father_name">Teacher's Mother Name</label>
                                            <input type="text" name="mother_name" id="mother_name"
                                                class="form-control  @error('mother_name')
                                                is-invalid
                                            @enderror"
                                                placeholder="Enter Teacher's Mother Name">
                                            @error('mother_name')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="father_name">Date Of Birth</label>
                                            <input type="date" name="dob" id="dob"
                                                class="form-control  @error('dob')
                                                is-invalid
                                            @enderror">
                                            @error('dob')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">

                                            <label for="father_name">Mobile Number</label>
                                            <input type="text" name="mob" id="mob"
                                                class="form-control  @error('mob')
                                                is-invalid
                                            @enderror"
                                                placeholder="Enter Mobile Number">
                                            @error('mob')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="father_name">Email Address</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control @error('email')
                                                is-invalid
                                            @enderror"
                                                placeholder="Enter Email Address">
                                            @error('email')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">

                                            <label for="father_name">Create Password</label>
                                            <input type="password" name="password" id="password"
                                                class="form-control @error('password')
                                                is-invalid
                                            @enderror"
                                                placeholder="Enter Password">
                                            @error('password')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>









                    </div>




                </div>

            </div>
        </section>

    </div>
@endsection

@section('customJs')
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
@endsection
