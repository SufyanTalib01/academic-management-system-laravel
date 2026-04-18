 @extends('admin.layout')
 @section('customCss')
     <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
     <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
 @endsection
 @section('content')
     <div class="content-wrapper">

         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Third Api Data</h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                             <li class="breadcrumb-item active">Third Api Data List </li>
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
                     <div class="col-12">


                         <div class="card">
                             <div class="card-header">
                                 <h3 class="card-title">Third Api Data List</h3>
                             </div>

                             <div class="card-body">
                                 <table id="example1" class="table table-bordered table-striped">
                                     <thead>
                                         <tr>
                                             <th>ID</th>
                                             <th>Name</th>
                                             <th>Username</th>
                                             <th>Email</th>
                                             <th>Address</th>
                                             <th>Phone</th>
                                             <th>Website</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach ($items as $item)
                                             <tr>
                                                 <td>{{ $loop->iteration }}</td>
                                                 <td>{{ $item['name'] }}</td>
                                                 <td>{{ $item['username'] }}</td>
                                                 <td>{{ $item['email'] }}</td>
                                                 <td>{{ $item['address']['street'] }},
                                                     {{ $item['address']['suite'] }},
                                                     {{ $item['address']['city'] }} -
                                                     {{ $item['address']['zipcode'] }}</td>
                                                 <td>{{ $item['phone'] }}</td>
                                                 <td>{{ $item['website'] }}</td>
                                             </tr>
                                         @endforeach
                                     </tbody>

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
