@include('components.head')
@include('components.navbars')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
@include('components.topbar')

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 mb-0">
          <div class="d-flex justify-content-between">
            <h6>User Roles</h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fas fa-plus me-1" style="font-size: 11px;"></i> Add Role</button>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2 mt-0">
          <div class="table-responsive px-4">
            <table class="table table-hover align-items-center mb-0" id="user_roles">
              <thead class="bg-light">
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created_by</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated_by</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created_at</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">updated_at</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($roles as $per_role)
                <tr>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$per_role->name}}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-success">Active</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $per_role->createdBy->firstname .' '. $per_role->createdBy->middlename .' '. $per_role->createdBy->lastname}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $per_role->updatedBy->firstname .' '. $per_role->updatedBy->middlename .' '. $per_role->updatedBy->lastname}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $per_role->created_at }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $per_role->updated_at }}</span>
                  </td>
                  <td class="align-middle">
                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                      Edit
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
</main>

<script>
    $(document).ready(function () {
    $('#user_roles').DataTable({
        language: {
                emptyTable:
                    `<div style="text-align: center;" colspan="2">
                        <img src="https://cdn-icons-png.flaticon.com/128/13983/13983163.png" alt="No Data Icon" style="width: 70px; margin-bottom: 10px; margin-top: 10px;">
                        <p style='font-size: 14px; color: #3C8DBC;'>No data available in the table.</p>
                    </div>`,
                zeroRecords: 
                    `<div style="text-align: center;" colspan="2">
                        <img src="https://cdn-icons-png.flaticon.com/128/13983/13983163.png" alt="No Data Icon" style="width: 70px; margin-bottom: 10px; margin-top: 10px;">
                        <p style='font-size: 14px; color: #3C8DBC;'>No matching Data found.</p>
                    </div>`
            }
    });
});

</script>
@include('components.footer')