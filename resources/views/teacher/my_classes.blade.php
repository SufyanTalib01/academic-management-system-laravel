 @extends('teacher.layout')
 @section('customCss')
     <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
     <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
     <style>
         .table-responsive {
             overflow-x: auto;
             -webkit-overflow-scrolling: touch;
         }

         #example1 {
             width: 100% !important;
             margin-bottom: 0;
         }

         #example1 thead th {
             background-color: #f8f9fa;
             font-weight: 600;
             border-bottom: 2px solid #dee2e6;
         }

         #example1 tbody tr:hover {
             background-color: #f5f5f5;
         }
     </style>
 @endsection
 @section('content')
     <div class="row mb-2">
         <div class="col-sm-6">
             <h1>My Class and Subject List</h1>
         </div>
         <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                 <li class="breadcrumb-item active">My Class and Subject List</li>
             </ol>
         </div>
     </div>

     @if (Session::has('success'))
         <div class="alert alert-success">
             {{ Session::get('success') }}
         </div>
     @endif

     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-header">
                     <h3 class="card-title">My Classes and Subjects</h3>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <table id="example1" class="table table-bordered table-striped table-hover">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Class Name</th>
                                     <th>Subject Name</th>
                                     <th>Theory/Practical</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($assignTeacher as $item)
                                     <tr>
                                         <td>{{ $loop->iteration }}</td>
                                         <td>{{ $item->class->name }}</td>
                                         <td>{{ $item->subject->name }}</td>
                                         <td>{{ $item->subject->type }}</td>
                                     </tr>
                                 @endforeach
                             </tbody>
                             <tfoot>
                                 <tr>
                                     <th>ID</th>
                                     <th>Class Name</th>
                                     <th>Subject Name</th>
                                     <th>Theory/Practical</th>
                                 </tr>
                             </tfoot>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
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
