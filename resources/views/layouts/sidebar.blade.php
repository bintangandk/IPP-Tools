 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item">
             <a class="nav-link" href="#">
                 <i class="icon-grid menu-icon"></i>
                 <span class="menu-title">Dashboard</span>
             </a>
         </li>
         @if (Auth::user()->level == 'Admin')
         <li class="nav-item">
            <a class="nav-link">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">User Managemet</span>
            </a>
        </li>
         @endif
         <li class="nav-item">
             <a class="nav-link">
                 <i class="icon-columns menu-icon"></i>
                 <span class="menu-title">Register Partner</span>
             </a>
         </li>
         @if (Auth::user()->level == 'Admin')
         <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Deleted Partner</span>
            </a>
        </li>
         @endif
     </ul>
 </nav>
