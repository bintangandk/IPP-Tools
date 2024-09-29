 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item">
             <a class="nav-link" href="{{ url('dashboard') }}">
                 <i class="icon-grid menu-icon"></i>
                 <span class="menu-title">Dashboard</span>
             </a>
         </li>
         @if (Auth::user()->level == 'Admin')
         <li class="nav-item">
            <a class="nav-link" href="{{ url('management-user') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">User Managemet</span>
            </a>
        </li>
         @endif
         <li class="nav-item">
             <a class="nav-link" href="{{ url('registered-partner') }}">
                 <i class="icon-columns menu-icon"></i>
                 <span class="menu-title">Register Partner</span>
             </a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="{{ url('deleted-partner') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Deleted Partner</span>
            </a>
        </li>
     </ul>
 </nav>
