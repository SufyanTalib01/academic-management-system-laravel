 @extends('admin.layout')
 @section('customCss')
     <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
     <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
 @endsection
 @section('content')
     @php
         $months = [
             'march',
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
         ];
     @endphp

     <div class="content-wrapper">

         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Fee Structure List</h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                             <li class="breadcrumb-item active">Fee Structure List </li>
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

             <form action="">
                 <div class="form-group col-md-4">
                     <label>Select Academy</label>
                     <Select name="academic_year_id" class="form-control @error('academic_year_id') is-invalid @enderror">
                         <option value="" disabled selected>Select Academy</option>
                         @foreach ($academy_years as $academy_year)
                             <option value="{{ $academy_year->id }}"
                                 {{ $academy_year->id == request('academic_year_id') ? 'Selected' : '' }}>
                                 {{ $academy_year['name'] }}
                             </option>
                         @endforeach
                     </Select>

                 </div>
                 <div class="form-group col-md-4">
                     <label>Select Class</label>
                     <Select name="class_id" class="form-control @error('class_id') is-invalid @enderror">

                         <option value="" disabled selected>Select Class</option>

                         @foreach ($classes as $class)
                             <option value="{{ $class->id }}" {{ $class->id == request('class_id') ? 'Selected' : '' }}>

                                 {{ $class->name }}
                             </option>
                         @endforeach
                     </Select>

                 </div>

                 <div class=" form-group col-md-4">
                     <button type="submit" class="btn btn-primary">Submit</button>
                 </div>


             </form>
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-12">


                         <div class="card">
                             <div class="card-header">
                                 <h3 class="card-title">Fee Structure List</h3>
                             </div>





                             <div class="card-body">
                                 <table id="example1" class="table table-bordered table-striped">
                                     <thead>
                                         <tr>
                                             <th>ID</th>
                                             <th>Academic Year</th>
                                             <th>Class</th>
                                             <th>Fee Head</th>
                                             @foreach ($months as $month)
                                                 <th>{{ $month }}</th>
                                             @endforeach
                                             <th>Edit</th>
                                             <th>Delete</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach ($data as $item)
                                             <tr>
                                                 <td>{{ $loop->iteration }}</td>
                                                 <td>{{ $item->academicYear->name }}</td>
                                                 <td>{{ $item->classModel->name }}</td>
                                                 <td>{{ $item->feeHead->name }}</td>
                                                 @foreach ($months as $month)
                                                     <td>{{ $item[$month] }}</td>
                                                 @endforeach

                                                 <td><a href="{{ route('fee-structure.edit', $item->id) }}"
                                                         class="btn btn-primary">Edit</a></td>
                                                 <td><a href="{{ route('fee-structure.delete', $item->id) }}"
                                                         class="btn btn-danger"
                                                         onclick="return confirm('Are you sure want to delete?')">Delete</a>
                                                 </td>
                                             </tr>
                                         @endforeach
                                     </tbody>
                                     <tfoot>
                                         <tr>
                                             <th>ID</th>
                                             <th>Academic Year</th>
                                             <th>Class</th>
                                             <th>Fee Head</th>
                                             @foreach ($months as $month)
                                                 <th>{{ $month }}</th>
                                             @endforeach
                                             <th>Edit</th>
                                             <th>Delete</th>
                                         </tr>
                                     </tfoot>
                                 </table>
                             </div>

                         </div>

                     </div>

                 </div>

             </div>

         </section>

     </div>
 @endsection
 @section('customJs')
     <script src="plugins/datatables/jquery.dataTables.min.js"></script>
     <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
     <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
     <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
     <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
     <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
     <script src="plugins/jszip/jszip.min.js"></script>
     <script src="plugins/pdfmake/pdfmake.min.js"></script>
     <script src="plugins/pdfmake/vfs_fonts.js"></script>
     <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
     <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
     <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

     <script src="dist/js/adminlte.min2167.js?v=3.2.0"></script>

     <script src="dist/js/demo.js"></script>

     <script>
         $(function() {
             $("#example1").DataTable({
                 "responsive": true,
                 "lengthChange": false,
                 "autoWidth": false,
                 "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
             }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
             $('#example2').DataTable({
                 "paging": true,
                 "lengthChange": false,
                 "searching": false,
                 "ordering": true,
                 "info": true,
                 "autoWidth": false,
                 "responsive": true,
             });
         });
     </script>
 @endsection
