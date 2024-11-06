@include('components.head')
@include('components.navbars')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
@include('components.topbar')

<div class="container-fluid py-4">

  <div class="alert alert-dismissible fade show d-none" role="alert" id="dynamicAlert">
      <span class="alert-icon text-light"><i class="fas" id="alertIcon"></i></span>
      <span class="alert-text text-light" id="alertMessage"></span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>

    <div class="card">
        <div class="card-header pb-0 mb-0 bg-gradient-light">
          <div class="d-flex justify-content-between">
            <h6> <i class="fas fa-layer-group"></i> Modules</h6>
            <button class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#dynamicModal" onclick="modalContentAdd()"> <i class="fas fa-plus me-1" style="font-size: 11px;"></i> Add Module</button>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2 mt-0">
          <div class="table-responsive px-4">
            <table class="table table-hover align-items-center mb-0" id="user_roles">
              <thead class="bg-light">
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Icon</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Module Name</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created_by</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated_by</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created_at</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">updated_at</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($modules as $per_module)
                <tr>
                  <td class="text-xs font-weight-bold"><i class="{{ $per_module->icon }}"></i></td>
                  <td class="text-xs font-weight-bold">{{ $per_module->module_name }}</td>
                  <td class="align-middle text-center text-xs">
                    @if($per_module->status == 1 )
                      <span class="badge badge-sm bg-gradient-success">Active</span>
                    @else
                      <span class="badge badge-sm bg-gradient-danger">Inactive</span>
                    @endif
                  </td>
                  <td class="align-middle text-center text-xs font-weight-bold">{{ $per_module->createdBy->firstname .' '. $per_module->createdBy->middlename .' '. $per_module->createdBy->lastname}}</td>
                  <td class="align-middle text-center text-xs font-weight-bold">{{ $per_module->updatedBy->firstname .' '. $per_module->updatedBy->middlename .' '. $per_module->updatedBy->lastname}}</td>
                  <td class="align-middle text-center text-xs font-weight-bold">{{ \Carbon\carbon::parse($per_module->created_at)->format('Y-m-d H:i:s') }}</td>
                  <td class="align-middle text-center text-xs font-weight-bold">{{ \Carbon\carbon::parse($per_module->updated_at)->format('Y-m-d H:i:s') }}</td>
                  <td class="align-middle">
                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#modal_menu" onclick="modal_menu(this)" data-id="{{ $per_module->id }}" data-module-name="{{ $per_module->module_name }}">
                      <i class="fas fa-ellipsis-h"></i>
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

<!-- Spinner -->
<div class="spinner-overlay" id="spinner" style="display: none">
    <div class="spinner"></div>
</div>

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

    function viewModule(id){
      alert(id)
    }

    function editModule(id){
      alert(id)
    }

    function archiveModule(id){
      alert(id)
    }

    function setModule(elements){
      const id = elements.getAttribute("data-id");
      const moduleName = elements.getAttribute("data-module-name");

      $('#dynamicModal').modal('show');
      $('#modal_menu').modal('hide');
      $('#modalTitle').html(`<div class="text-light text-bold"><i class="fas fa-cogs"></i> Config ${moduleName}</div>`);
        $('#modalBody').html(`
            <form autocomplete="off">
                <div class="form-group">
                    <label for="module_name">Module Name</label>
                    <input type="text" class="form-control" id="module_name" placeholder="Enter module name" autocomplete="off" value="${moduleName}" readonly>
                </div>
                <div class="from-group mb-3 mt-2">
                    <label for="module_name">Module Permission</label>
                    <select class="js-example-basic-multiple" name="roles[]" id="roles" multiple="multiple">
                    </select>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-secondary me-2" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-gradient-success" data-id="${id}" id="savePermission">Save</button>
                </div>
            </form>`);

            $('.js-example-basic-multiple').select2({
                placeholder: "Select Roles",
                width: "100%",
                dropdownParent: $('#dynamicModal'),
            });

        const roles = {!! json_encode($roles) !!};
        const allRoleIds = roles.map(item => item.id).join(',');
        $('#roles').append(`<option value="all">All</option>`);
          roles.forEach(function(item) {
          $('#roles').append(`<option value="${item.id}">${item.name}</option>`);
        });
        
    }

      function modal_menu(elements){
        const id = elements.getAttribute("data-id");
        const moduleName = elements.getAttribute("data-module-name");
        
        $('#modal_body').html(`
          <div class="row">
            <div class="col-md-6">
              <button onclick="viewModule(${id})" type="button" class="w-100 btn bg-gradient-success me-2"><i class="fas fa-file-alt"></i> View</button>
            </div>
            <div class="col-md-6">
              <button onclick="editModule(${id})" type="button" class="w-100 btn bg-gradient-info me-2"><i class="fas fa-pen"></i> Edit</button>
            </div>
            <div class="col-md-6">
              <button onclick="archiveModule(${id})" type="button" class="w-100 btn bg-gradient-danger me-2"><i class="fas fa-archive"></i> Archive</button>
            </div>
            <div class="col-md-6">
              <button onclick="setModule(this)" data-id="${id}" data-module-name="${moduleName}" type="button" class="w-100 btn bg-gradient-secondary me-2"><i class="fas fa-key"></i> Settings</button>
            </div>
          </div>`);
    }

    function modalContentAdd(){
        $('#modalTitle').html(`<div class="text-light text-bold"><i class="fas fa-plus"></i> Add Module</div>`);
        $('#modalBody').html(`
            <form autocomplete="off">
                <div class="form-group mb-1">
                    <label for="icon">Module Icon</label>
                    <input type="text" class="form-control" id="icon" placeholder="Enter module icon" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="module_name">Module Name</label>
                    <input type="text" class="form-control" id="module_name" placeholder="Enter module name" autocomplete="off">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-secondary me-2" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-gradient-success" id="btnSave">Save</button>
                </div>
            </form>`);
    }

    $(document).on('click', '#btnSave', function() {
        const micon = $('#icon').val();
        const mname = $('#module_name').val();

        if (micon == ""){
            $('#icon').addClass('is-invalid');
        } else {
            $('#icon').removeClass('is-invalid')
        }
        if (mname == ""){
            $('#module_name').addClass('is-invalid');
        } else {
            $('#module_name').removeClass('is-invalid')
        }

        if (mname == "" || micon == ""){
            return;
        }

        $('#spinner').show();

        $.ajax({
            url: '{{route("postModule")}}',
            method: 'POST',
            data: {
              micon: micon,
              mname: mname,
              _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
              if(response.success === true){
                  getModulesLive();
                  $('#dynamicAlert').addClass('alert-success');
                  $('#dynamicAlert').removeClass('d-none');
                  $('#alertIcon').addClass('fa-thumbs-up');
                  $('#alertMessage').html('<strong>Success</strong> <small>'+ response.message +'</small>');

                  setTimeout(function() {
                      $('#dynamicAlert').removeClass('alert-success');
                      $('#dynamicAlert').addClass('d-none');
                      $('#alertIcon').removeClass('fa-thumbs-up');
                  }, 3000);

                  const tbody = $('#user_roles tbody');
                    tbody.empty();
                    response.data.forEach(function(row) {
                      const badgeStatus = (row.status === 1)
                        ? '<span class="badge badge-sm bg-gradient-success">Active</span>'
                        : '<span class="badge badge-sm bg-gradient-danger">Inactive</span>';

                        const tr = '<tr>' +
                            '<td class="text-xs"><i class="'+ row.icon +'"></i></td>' +
                            '<td class="text-xs">' + row.module_name + '</td>' +
                            '<td class="align-middle text-center text-xs">' + badgeStatus + '</td>' +
                            '<td class="align-middle text-center text-xs">' + row.createdBy +'</td>' +
                            '<td class="align-middle text-center text-xs">' + row.updatedBy + '</td>' +
                            '<td class="align-middle text-center text-xs">' + row.created_date + '</td>' +
                            '<td class="align-middle text-center text-xs">' + row.updated_date + '</td>' +
                            '<td class="align-middle"><a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">Edit</a></td>' +
                            '</tr>';
                        tbody.append(tr); // Add the new row to the table body
                    });

                    //for refresh DataTable instance
                    $('#user_roles').DataTable().clear().rows.add(tbody.find('tr')).draw();
            
              } else if (response.error) {
                alert('Request failed!');
              }
              $('#dynamicModal').modal('hide');
              $('#spinner').hide();
            },
            error: function(xhr, status, error){
              $('#dynamicAlert').addClass('alert-danger');
              $('#dynamicAlert').removeClass('d-none');
              $('#alertIcon').addClass('fa-exclamation-circle');
              $('#alertMessage').html('<strong>Error</strong> <small>'+ error +'</small>');
              $('#dynamicModal').modal('hide');
              $('#spinner').hide();

              setTimeout(function() {
                $('#dynamicAlert').removeClass('alert-danger');
                $('#dynamicAlert').addClass('d-none');
                $('#alertIcon').removeClass('fa-exclamation-circle');
              }, 3000);
            }
        })
    });

    $(document).on('click', '#savePermission', function(){
      const module_id = this.getAttribute('data-id');
      const module_permission = $('#roles').val();
      
      if (!module_permission || module_permission.length === 0) {
        alert('Please select at least one permission.');
            return; 
      }
    
      $('#spinner').show();
      $.ajax({
            url: '{{route("postModulePermission")}}',
            method: 'POST',
            data: {
              module_id: module_id,
              module_permission: module_permission,
              _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
              if(response.success === true){
                  getModulesLive();
                  $('#dynamicAlert').addClass('alert-success');
                  $('#dynamicAlert').removeClass('d-none');
                  $('#alertIcon').addClass('fa-thumbs-up');
                  $('#alertMessage').html('<strong>Success</strong> <small>'+ response.message +'</small>');

                  setTimeout(function() {
                      $('#dynamicAlert').removeClass('alert-success');
                      $('#dynamicAlert').addClass('d-none');
                      $('#alertIcon').removeClass('fa-thumbs-up');
                  }, 3000);  

              } else if (response.error) {
                alert('Request failed!');
              }
              $('#dynamicModal').modal('hide');
              $('#spinner').hide();
            },
            error: function(xhr){
              if (xhr.status === 422) {
                  const errors = xhr.responseJSON.messages;
                  let errorMessage = '<strong>Validation Errors:</strong><ul>';
                  for (const [key, value] of Object.entries(errors)) {
                      errorMessage += `<li class="text-sm">${value[0]}</li>`; 
                  }
                  errorMessage += '</ul>';
                  $('#dynamicAlert').addClass('alert-danger');
                  $('#dynamicAlert').removeClass('d-none');
                  $('#alertIcon').addClass('fa-exclamation-circle');
                  $('#alertMessage').html(errorMessage);
              } else {
                  $('#dynamicAlert').addClass('alert-danger');
                  $('#dynamicAlert').removeClass('d-none');
                  $('#alertIcon').addClass('fa-exclamation-circle');
                  $('#alertMessage').html('<strong>Error</strong> <small>' + xhr.statusText + '</small>');
              }
              $('#dynamicModal').modal('hide');
              $('#spinner').hide();
          }
        })
    });
</script>

@include('components.modal')
@include('components.footer')