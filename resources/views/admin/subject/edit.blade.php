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
                        <h1>Subject Edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Subject Edit</li>
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
                                <h3 class="card-title">Edit Subject</h3>
                            </div>


                            <form action="{{ route('subject.update', $subject->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name"> Subject</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" value="{{ old('name', $subject->name) }}" name="name"
                                            placeholder="Enter Subject Name">
                                        @error('name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <Select
                                            class="form-control @error('type')
                                            is-invalid
                                        @enderror"
                                            name="type" id="type">
                                            <option value="" disabled selected>Select Type</option>
                                            <option value="theory"
                                                {{ old('type', $subject->type) == 'theory' ? 'selected' : '' }}>Theory
                                            </option>
                                            <option value="practical"
                                                {{ old('type', $subject->type) == 'practical' ? 'selected' : '' }}>
                                                Practical</option>
                                        </Select>
                                        @error('type')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>


                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
