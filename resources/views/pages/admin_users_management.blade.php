@include('components.head')
@include('components.navbars')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
@include('components.topbar')

<div class="container-fluid py-4">

  <div class="alert alert-dismissible fade show d-none rounded-3" role="alert" id="dynamicAlert">
      <span class="alert-icon text-light"><i class="fas" id="alertIcon"></i></span>
      <span class="alert-text text-light" id="alertMessage"></span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>

    <div class="card">
        <div class="card-header pb-0 mb-0 bg-gradient-light">
          <div class="d-flex justify-content-between">
            <h6> <i class="fas fa-users"></i> Users Management</h6>
            <button class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#dynamicModal" onclick="modalContentAdd()"> <i class="fas fa-plus me-1" style="font-size: 11px;"></i> Add User</button>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2 mt-0">
          <div class="table-responsive px-4">
            <table class="table table-hover align-items-center mb-0" id="user_management">
              <thead class="bg-light">
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Profile</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created_by</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated_by</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created_at</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">updated_at</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $per_user)
                <tr>
                  <td class="text-xs"><img class="w-10 rounded" src="../storage/{{$per_user->profile}}" alt="Profile Image" /></td>
                  <td class="text-xs">{{ $per_user->firstname, $per_user->middlename, $per_user->lastname  }}</td>
                  <td class="text-xs">{{ $per_user->email }}</td>
                  <td class="align-middle text-center text-xs">
                    <span class="badge badge-sm bg-gradient-{{ $per_user->status == 1 ? 'success' : 'danger' }}">
                        {{ $per_user->status == 1 ? 'Active' : 'Inactive' }}
                    </span>                    
                  </td>
                  <td class="align-middle text-center text-xs"></td>
                  <td class="align-middle text-center text-xs"></td>
                  <td class="align-middle text-center text-xs">{{ $per_user->created_at->format('Y-m-d H:i:s') }}</td>
                  <td class="align-middle text-center text-xs">{{ $per_user->updated_at->format('Y-m-d H:i:s') }}</td>
                  <td class="align-middle">
                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#modal_menu" onclick="modal_menu({{$per_user->id}})">
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
        $('#user_management').DataTable({
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

    function setModule(id){
      alert(id)
    }

    function modal_menu(id){
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
                <button onclick="setModule(${id})" type="button" class="w-100 btn bg-gradient-secondary me-2"><i class="fas fa-key"></i> Settings</button>
              </div>
            </div>`);
    }

    function modalContentAdd(size = 'modal-lg'){
        $('#dynamicModal #modal-dialog').removeClass('modal-sm modal-lg modal-xl');

        if (size) {
            $('#dynamicModal #modal-dialog').addClass(size);
        }

        $('#modalTitle').html(`<div class="text-light text-bold"><i class="fas fa-plus"></i> Add User</div>`);
        $('#modalBody').html(`
            <form autocomplete="off">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-1">
                            <label for="community">Community</label>
                            <select class="form-select" id="community">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Role / Position</label>
                            <select class="form-select" id="role">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-1">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter firstname" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="middlename">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" placeholder="Enter middlename" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter lastname" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Mobile Number</label>
                            <input type="number" class="form-control" id="phone" placeholder="Enter mobile number" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="name@email.com" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="••••••••" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="profile">Upload Profile</label>
                            <input class="form-control" type="file" id="profile">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-secondary me-2" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-gradient-success" id="btnSave">Save</button>
                </div>
            </form>`);

        const community = {!! json_encode($community) !!};
        const roles = {!! json_encode($roles) !!};

        $('#community').empty().append('<option selected disabled>Select Community</option>');
        community.forEach(function(item) {
            $('#community').append(`<option value="${item.id}">${item.name}</option>`);
        });

        $('#role').empty().append('<option selected disabled>Select Role / Position</option>');
        roles.forEach(function(item) {
            $('#role').append(`<option value="${item.id}">${item.name}</option>`);
        });
    }

    $(document).on('click', '#btnSave', function() {
        const community = $('#community').val();
        const role = $('#role').val();
        const firstname = $('#firstname').val();
        const middlename = $('#middlename').val();
        const lastname = $('#lastname').val();
        const phone = $('#phone').val();
        const email = $('#email').val();
        const password = $('#password').val();
        const profileImg = $('#profile')[0].files[0];

        // Clear previous validation 
        $('.form-control').removeClass('is-invalid');

        let isValid = true;

        if (!community) {
            $('#community').addClass('is-invalid');
            isValid = false;
        }
        if (!role) {
            $('#role').addClass('is-invalid');
            isValid = false;
        }
        if (!firstname) {
            $('#firstname').addClass('is-invalid');
            isValid = false;
        }
        if (!lastname) {
            $('#lastname').addClass('is-invalid');
            isValid = false;
        }
        if (!phone || !/^[0-9]{10}$/.test(phone)) {
            $('#phone').addClass('is-invalid');
            isValid = false;
        }
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $('#email').addClass('is-invalid');
            isValid = false;
        }
        if (!password || password.length < 6) {
            $('#password').addClass('is-invalid');
            isValid = false;
        }
        if (!profileImg) {
            $('#profile').addClass('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            return; 
        }

        let formData = new FormData();
        formData.append('community', community);
        formData.append('role', role);
        formData.append('firstname', firstname);
        formData.append('middlename', middlename);
        formData.append('lastname', lastname);
        formData.append('phone', phone);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('profileImg', profileImg); 
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $('#spinner').show();

        $.ajax({
            url: '{{route("postUser")}}',
            method: 'POST',
            data: formData,
            processData: false, 
            contentType: false,
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

                  const tbody = $('#user_management tbody');
                    tbody.empty();
                    response.data.forEach(function(row) {
                    const badgeStatus = row.status === 1
                      ? '<span class="badge badge-sm bg-gradient-success">Active</span>'
                      : '<span class="badge badge-sm bg-gradient-danger">Inactive</span>';

                      const tr = '<tr>' +
                        '<td class="text-xs"><img class="w-10 rounded" src="../storage/'+ row.profile +'" /></td>' +
                        '<td class="text-xs">' + row.firstname + ' ' + (row.middlename || '') + ' ' + row.lastname + '</td>' +
                        '<td class="text-xs">' + row.email + '</td>' +
                        '<td class="align-middle text-center text-xs">' + badgeStatus + '</td>' +
                        '<td class="align-middle text-center text-xs">' + (row.additionalField1 || '') + '</td>' +
                        '<td class="align-middle text-center text-xs">' + (row.additionalField2 || '') + '</td>' +
                        '<td class="align-middle text-center text-xs">' + (row.created_date ? row.created_date : '') + '</td>' +
                        '<td class="align-middle text-center text-xs">' + (row.updated_date ? row.updated_date : '') + '</td>' +
                        '<td class="align-middle">' +
                          '<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#modal_menu" onclick="modal_menu('+ row.id +')">' +
                            '<i class="fas fa-ellipsis-h"></i>' +
                          '</a>' +
                        '</td>' +
                      '</tr>';
                      tbody.append(tr);
                    });

                    //for refresh DataTable instance
                    $('#user_management').DataTable().clear().rows.add(tbody.find('tr')).draw();
            
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