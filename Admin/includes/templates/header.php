 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?php getTitle() ?></title>

     <!-- jQuery js -->
     <script src="layout/js/jquery-3.6.3.js"></script>

     <!-- Link To Bootstrap -->
     <link rel="stylesheet" href="layout/css/bootstrap.css" type="text/css" />
     <script src="layout/js/bootstrap.js"></script>
     <!-- <script src="layout/js/bootstrap.bundle.min.js"></script> -->

     <!-- Icons Css -->
     <link href="layout/css/icons.min.css" rel="stylesheet" type="text/css" />

     
     <!-- Icons CSS -->
     <link href="layout/css/all.min.css" rel="stylesheet" type="text/css" />



     <link rel="stylesheet" href="layout/css/select2.min.css">
     <script src="layout/js/select2.min.js"></script>


     <!-- FrontEnd Css -->
     <link href="layout/css/frontend.css" rel="stylesheet" type="text/css" />
 </head>

 <body>

     <?php
        if (!isset($noNav)) {
            // if this page doesn't have variable $naNav
        ?>
         <div id="displayMsgSynchro" class="displayMsgSynchro">

         </div>
         <nav class="navbar navbar-expand-lg bg-light">
             <div class="container-fluid">
                 <a class="navbar-brand" href="#">Navbar</a>
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>
                 <div class="collapse navbar-collapse" id="navbarNavDropdown">
                     <ul class="navbar-nav">
                         <li class="nav-item">
                             <a class="nav-link active" aria-current="page" href="#">Home</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#">Features</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#">Pricing</a>
                         </li>
                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 Dropdown link
                             </a>
                             <ul class="dropdown-menu">
                                 <li><a class="dropdown-item" href="#">Action</a></li>
                                 <li><a class="dropdown-item" href="#">Another action</a></li>
                                 <li><a class="dropdown-item" href="#">Something else here</a></li>
                             </ul>
                         </li>
                     </ul>
                 </div>
             </div>
         </nav>
     <?php
        } // end if isset navbar
        ?>