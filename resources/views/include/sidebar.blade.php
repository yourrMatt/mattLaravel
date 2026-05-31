<aside id="layout-menu" class="d-flex flex-column bg-dark sticky-top" style="width: 260px; height: 100vh; flex-shrink: 0">
  
  <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom border-secondary">
    <a href="index.html" class="d-flex align-items-center text-decoration-none">
      <img src="img/logo.jpg" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%;">
      <span class="text-white fw-bold ms-2 fs-5">Admin</span>
    </a>
    <a href="javascript:void(0);" class="text-white d-xl-none">
      <i class="bx bx-chevron-left fs-4"></i>
    </a>
  </div>

  <nav class="flex-grow-1 py-2">
    <ul class="nav flex-column px-2">

      <li class="nav-item">
        <a href="/dashboard" class="nav-link text-white d-flex align-items-center gap-2 rounded px-3 py-2">
          <i class="bx bx-home-alt fs-5"></i>
          <span>Home</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#scheduleMenu" class="nav-link text-white d-flex align-items-center gap-2 rounded px-3 py-2"
          data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="eventsMenu">
          <i class="bx bx-calendar-event fs-5"></i>
          <span>Schedule</span>
          <i class="bx bx-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="scheduleMenu">
          <ul class="nav flex-column ps-4">
            <li class="nav-item">
              <a href="/calendar" class="nav-link text-white-50 py-1">Calendar</a>
            </li>
            <li class="nav-item">
              <a href="/manageSchedule" class="nav-link text-white-50 py-1">Manage Schedule</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a href="#accountMenu" class="nav-link text-white d-flex align-items-center gap-2 rounded px-3 py-2"
          data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="accountMenu">
          <i class="bx bx-dock-top fs-5"></i>
          <span>Account Settings</span>
          <i class="bx bx-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="accountMenu">
          <ul class="nav flex-column ps-4">
            <li class="nav-item">
              <a href="/users" class="nav-link text-white-50 py-1">Manage Accounts</a>
            </li>
            <li class="nav-item">
              <a href="/profile" class="nav-link text-white-50 py-1">View Profile</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>

  <div class="row justify-content-end pt-2 pb-2 ps-2 border-top">
    <li class="nav-item">
      <form method="post" action="/logout">
        @csrf
        <button type="submit" name="logout" class="nav-link text-white d-flex align-items-center gap-2 rounded px-3 py-2">
          <i class="bx bx-log-out fs-5"></i>
          <span>Logout</span>
        </button>
      </form>
    </li>
  </div>
</aside>