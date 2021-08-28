<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    {{-- <link href={{asset("/css/all.min.css")}} rel="stylesheet" type="text/css"> --}}


  <link rel="stylesheet" href={{asset("css/all.min.css")}}>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href={{asset("/css/sb-admin-2.min.css")}} rel="stylesheet">

  <link rel="stylesheet" href={{asset("/fonts/icomoon/style.css")}}>
    <script>
        window.Token="{{ csrf_token() }}"
      </script>

</head>

<body id="page-top">
    <div id="app">
        <div id="wrapper">
            <!-- Sidebar -->
           @include('admin.menu')
           <!-- End of Sidebar -->
    
           <!-- Content Wrapper -->
           <div id="content-wrapper" class="d-flex flex-column">
    
               <!-- Main Content -->
               <div id="content">
    
                   <!-- Topbar -->
                   <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    
                       <!-- Sidebar Toggle (Topbar) -->
                       <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                           <i class="icon-bars"></i>
                       </button>
    
                   
    
                       <!-- Topbar Navbar -->
                       <ul class="navbar-nav ml-auto">
    
                          
                           <!-- Nav Item - User Information -->
                           <li class="nav-item dropdown no-arrow">
                               <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <span class="mr-2 d-none d-lg-inline text-gray-600" style="text-transform: uppercase"> {{Auth::guard('admin')->user()->Role}} </span>
                                   <img class="img-profile rounded-circle"
                                       src={{asset("img/undraw_profile.svg")}}>
                               </a>
                               <!-- Dropdown - User Information -->
                               <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                   aria-labelledby="userDropdown">
                                 
                                   <form 
                                   method="POST"
                                   action="/logout"
                                    class="dropdown-item p-0">
                                    @csrf  
                                    <button type="submit form-control" style="width:100%;border:none;background:none">
                                        <i class="fas icon-close fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                   
                                   </form>
                               </div>
                           </li>
    
                       </ul>
    
                   </nav>
                   <!-- End of Topbar -->
    
                   <router-view></router-view>
                
                   <!-- /.container-fluid -->
    
             
    
    
                </div>
           </div>
           <!-- End of Content Wrapper -->
    
       
        </div>

    </div>
   
    

    
</body>
    <!-- Bootstrap core JavaScript-->
    <script type="text/javascript" src={{asset("js/jquery.min.js")}}></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script type="text/javascript" src={{asset("js/jquery.easing.min.js")}}></script>

    <!-- Custom scripts for all pages-->
    <script type="text/javascript" src={{asset("js/sb-admin-2.min.js")}}></script>

    <!-- Page level plugins -->
    <script type="text/javascript" src={{asset("js/jquery.dataTables.min.js")}}></script>
    <script type="text/javascript" src={{asset("js/dataTables.bootstrap4.min.js")}}></script>

    <!-- Page level custom scripts -->
    {{-- <script type="text/javascript" src={{asset("/js/demo/datatables-demo.js")}}></script> --}}

    @extends('footervue')
</html>