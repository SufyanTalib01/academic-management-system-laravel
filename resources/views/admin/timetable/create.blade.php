@extends('admin.layout')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Time Table</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Time Table</li>
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
                                <h3 class="card-title">Create Time Table</h3>
                            </div>



                            <form action="{{ route('time-table.store') }}" method="post">
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


                                    <div class="form-group">
                                        <label for="subject_id">Subject Name</label>
                                        <Select class="form-control @error('subject_id') is-invalid @enderror"
                                            id="subject_id" name="subject_id">
                                            <option value="">Select Class</option>
                                        </Select>
                                        @error('subject_id')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Room No</th>
                                            </tr>
                                        </thead>
                                        <tbody id="subject-tbody">
                                            @php $i = 1; @endphp @foreach ($days as $day)
                                                <tr>
                                                    <td>{{ $day->name }}</td> <input type="hidden"
                                                        name="timetable[{{ $i }}][day_id]"
                                                        value="{{ $day->id }}">
                                                    <td> <input type="time"
                                                            name="timetable[{{ $i }}][start_time]">
                                                    </td>
                                                    <td> <input type="time"
                                                            name="timetable[{{ $i }}][end_time]"> </td>
                                                    <td> <input type="number"
                                                            name="timetable[{{ $i }}][room_no]"> </td>
                                                </tr> @php $i++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>






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
                            `<option value="${item.subject.id}">${item.subject.name}</option>`
                        );
                    });
                }
            });
        })
    </script>
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
@endsection
