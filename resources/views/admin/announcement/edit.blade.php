@extends('admin.layout')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Announcement Edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Announcement Edit</li>
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
                                <h3 class="card-title">Announcement Edit</h3>
                            </div>



                            <form action="{{ route('announcement.update', $findUser->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="message">Announcement</label>
                                        <textarea name="message" id="message" cols="30" rows="3"
                                            class="form-control @error('message') is-invalid @enderror" placeholder="Write your announcement">{{ old('message', $findUser->message) }}</textarea>
                                        @error('message')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="type">Broadcast To</label>
                                        <Select class="form-control @error('type') is-invalid @enderror" name="type">
                                            <option value="" disabled selected>Select Type</option>
                                            <option value="teacher"
                                                {{ old('type', $findUser->type) == 'teacher' ? 'selected' : '' }}>Teacher
                                            </option>
                                            <option value="student"
                                                {{ old('type', $findUser->type) == 'student' ? 'selected' : '' }}>Student
                                            </option>
                                            <option value="parent"
                                                {{ old('type', $findUser->type) == 'parent' ? 'selected' : '' }}>Parents
                                            </option>
                                        </Select>
                                        @error('type')
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
    </script>
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
@endsection
