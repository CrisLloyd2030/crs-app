<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-light shadow">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="?">
        <img src="{{ asset('assets/img/fav.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">MHS | System</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav" id="modulesList">
        @foreach($modules_data as $module)
          <li class="nav-item">
            <a class="nav-link" href="{{ route("$module->route") }}">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="{{ $module->icon }} text-dark"></i>
              </div>
              <span class="nav-link-text ms-1">{{ $module->module_name }}</span>
            </a>
          </li>
        @endforeach

        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#submenu" aria-expanded="false" href="javascript:void(0);">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="text-dark"></i>
              </div>
              <span class="nav-link-text ms-1">Levels<b class="caret"></b></span>
          </a>
          <div class="collapse" id="submenu">
              <ul class="nav nav-sm flex-column custom-indent">
                  <li class="nav-item">
                      <a class="nav-link" href="#subItem1">
                          1st Year
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#subItem2">
                          2nd Year
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#subItem3">
                          3rd Year
                      </a>
                  </li>
              </ul>
          </div>
      </li>

      </ul>
    </div>

    <div class="sidenav-footer">
    <hr class="horizontal dark mt-0 mb-0">
      <ul class="navbar-nav">
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Super Admin pages</h6>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('roles')}}">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-user-shield text-dark"></i>
              </div>
              <span class="nav-link-text ms-1">User Roles</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('modules')}}">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-folder-minus text-dark"></i>
              </div>
              <span class="nav-link-text ms-1">Modules</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('admin-users')}}">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-users text-dark"></i>
              </div>
              <span class="nav-link-text ms-1">Users Management</span>
            </a>
          </li>
      </ul>
    </div>
  </aside>

  <script>
    function getModulesLive() {
        $.ajax({
            url: '{{ route("get-modules") }}',
            method: 'GET',
            success: function(response) {
                const modules = response.modules_data;
                $('#modulesList').empty();
                modules.forEach(function(module) {
                    $('#modulesList').append(`
                        <li class="nav-item">
                          <a class="nav-link" href="${module.router}">
                                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="${module.icon} text-dark"></i>
                                </div>
                                <span class="nav-link-text ms-1">${module.module_name}</span>
                            </a>
                        </li>
                    `);
                });
            },
            error: function(xhr, status, error) {
                alert("Error:", status, error);
            }
        });
    }
  </script>