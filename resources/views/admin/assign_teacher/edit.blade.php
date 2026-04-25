@extends('admin.layout')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Teacher</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Update Teacher</li>
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

        @if (Session::has('error'))
            <div class="alert alert-danger mt-3 mx-3">
                {{ Session::get('error') }}
            </div>
        @endif


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Teacher</h3>
                            </div>



                            <form action="{{ route('assign-teacher.update', $assignTeacherToClass->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="class_id">Class Name</label>
                                        <Select class="form-control @error('class_id') is-invalid @enderror" id="class_id"
                                            name="class_id">
                                            <option value="">Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ old('class_id', $assignTeacherToClass->class_id) == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </Select>
                                        @error('class_id')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="subject_id">Subject Name</label>
                                        <Select class="form-control @error('subject_id') is-invalid @enderror"
                                            id="subject_id" name="subject_id">
                                            <option value="">Select Subject here</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->subject->id }}"
                                                    {{ old('subject_id', $assignTeacherToClass->subject_id) == $subject->subject->id ? 'selected' : '' }}>
                                                    {{ $subject->subject->name }}
                                                </option>
                                            @endforeach
                                        </Select>
                                        @error('subject_id')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="teacher_id">Teacher Name</label>
                                        <Select class="form-control @error('teacher_id') is-invalid @enderror"
                                            id="teacher_id" name="teacher_id">
                                            <option value="">Select Teacher</option>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}"
                                                    {{ old('teacher_id', $assignTeacherToClass->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                                    {{ $teacher->name }}
                                                </option>
                                            @endforeach
                                        </Select>
                                        @error('teacher_id')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror



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

        $('#class_id').change(function() {
            var class_id = $(this).val();
            $.ajax({
                url: "{{ route('findSubject') }}",
                type: "GET",
                data: {
                    class_id: class_id
                },
                success: function(response) {
                    $('#subject_id').find('option').not(':first').remove();
                    $.each(response['subjects'], (key, item) => {
                        $('#subject_id').append(
                            `<option value="${ item . subject . id }"> ${ item . subject . name } </option>`
                        );
                    });
                }
            });
        })
    </script>
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
@endsection
