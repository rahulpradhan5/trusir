   <!--  Header Start -->
   <header class="app-header">
       <nav class="navbar navbar-expand-lg navbar-light">
           <ul class="navbar-nav">
               <li class="nav-item d-block d-xl-none">
                   <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                       <i class="ti ti-menu-2"></i>
                   </a>
               </li>

           </ul>
           <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
               <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                   <li class="nav-item dropdown">
                       <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                           <img src="../images/user.svg" alt="" width="35" height="35" class="rounded-circle">
                       </a>
                       <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                           <div class="message-body">
                               <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                   <i class="ti ti-gear-fill fs-6"></i>
                                   <p class="mb-0 fs-3">Settings</p>
                               </a>
                               <a href="/logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                           </div>
                       </div>
                   </li>
               </ul>
           </div>
       </nav>
   </header>
   <style>
    .ale-succ{
       background-color: #0080003d; 
       color: #008021;
       display: flex !important;
    }
    .ale-dan{
       background-color: #8006003d; 
       color: #800600;
       display: flex !important;
    }
   </style>
   <!-- alert -->
  <div  style="display: none;align-items:center;z-index:50;position:fixed;right:0;top:0;width:78%;padding:10px;border-bottom-left-radius:10px;border-top-left-radius:10px;  " id="alert">
    Success
  </div>