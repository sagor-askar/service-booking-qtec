<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      {{-- dropdown --}}
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Service Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('services.index') }}">
              <i class="bi bi-circle"></i><span>Services</span>
            </a>
          </li>
        
          <li>
            <a href="{{ route('bookingslist.index') }}">
              <i class="bi bi-circle"></i><span>Booking List</span>
            </a>
          </li>
        </ul>
      </li>

    </ul>
  </aside>