@extends('admin.layout')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Assign Subject</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Assign Subject</li>
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
                                <h3 class="card-title">Create Assign Subject</h3>
                            </div>



                            <form action="{{ route('assign-subject.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="class_id">Class Name</label>
                                        <Select class="form-control @error('class_id') is-invalid @enderror" id="class_id"
                                            name="class_id">
                                            <option value="">Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </Select>
                                        @error('class_id')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror

                                    </div>


                                    @foreach ($subjects as $subject)
                                        <div class="form-check px-0">
                                            <input type="checkbox" id="subject_id-{{ $subject->id }}" name="subject_id[]"
                                                value="{{ $subject->id }}"
                                                class="@error('subject_id')
                                                    is-invalid
                                                @enderror">
                                            <label for="subject_id-{{ $subject->id }}">{{ $subject->name }}</label>

                                        </div>
                                    @endforeach
                                    @error('subject_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror



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
