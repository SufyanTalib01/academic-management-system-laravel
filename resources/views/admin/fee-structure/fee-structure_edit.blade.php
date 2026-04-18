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
                        <h1>Fee Structure Edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Fee Structure Edit</li>
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
                                <h3 class="card-title">Edit Fee Structure</h3>
                            </div>


                            <form action="{{ route('fee-structure.update', $fee->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="card-body">

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Select Academy</label>
                                            <Select name="academic_year_id"
                                                class="form-control @error('academic_year_id') is-invalid @enderror">
                                                <option value="" disabled selected>Select Academy</option>
                                                @foreach ($academy_years as $academic_year)
                                                    <option value="{{ $academic_year->id }}"
                                                        {{ $fee->academic_year_id == $academic_year->id ? 'selected' : '' }}>
                                                        {{ $academic_year->name }}
                                                    </option>
                                                @endforeach
                                            </Select>
                                            @error('academic_year_id')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Select Class</label>
                                            <Select name="class_id"
                                                class="form-control @error('class_id') is-invalid @enderror">
                                                <option value="" disabled>Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ $fee->class_id == $class->id ? 'selected' : '' }}>
                                                        {{ $class['name'] }}</option>
                                                @endforeach
                                            </Select>
                                            @error('class_id')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Select Fee Head</label>
                                            <Select name="fee_head_id"
                                                class="form-control @error('fee_head_id') is-invalid @enderror">
                                                <option value="" disabled selected>Select Fee Head</option>
                                                @foreach ($fee_heads as $fee_head)
                                                    <option value="{{ $fee_head['id'] }}"
                                                        {{ $fee->fee_head_id == $fee_head->id ? 'selected' : '' }}>
                                                        {{ $fee_head['name'] }}</option>
                                                @endforeach
                                            </Select>
                                            @error('fee_head_id')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach ($months as $month)
                                            <div class="form-group col-md-4">
                                                <label for="{{ $month }}">{{ ucfirst($month) }}</label>
                                                <input type="text"
                                                    class="form-control @error($month) is-invalid @enderror"
                                                    id="{{ $month }}" value="{{ old($month, $fee[$month]) }}"
                                                    name="{{ $month }}"
                                                    placeholder="Enter {{ ucfirst($month) }} Fee">
                                            </div>
                                        @endforeach
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
