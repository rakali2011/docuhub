@extends('includes.main')
@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <span class="mb-2 page-title menu-head">Teams</span>
      @can('add team')
      <a class="btn btn-primary float-right" href="{{ route('add_team') }}">Create Team</a>
      @endcan
      <p class="card-text"></p>
      <div class="row my-4">
        <!-- Small table -->
        <div class="col-md-12">
          <div class="card shadow">
            <div class="card-body">
              <!-- table -->
              <table class="table datatables" id="dataTable-1">
                <thead>
                  <tr>
                    <th>Name</th>
                    @role('dev')
                    <th>Company</th>
                    @endrole
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($teams as $item)
                  <tr>
                    <td>{{ $item->name }}</td>

                    @role('dev')
                    <td>{{ @$item->company->name }}</td>
                    @endrole
                    <td>
                      <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-muted sr-only">Action</span>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('edit_team', ['id' => Crypt::encrypt($item->id)]) }}">Edit</a>
                        @can('assign team user')
                        <a class="dropdown-item assign-user" ref="{{ Crypt::encrypt($item->id) }}" href="javascript:;">Assign User</a>
                        @endcan
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div> <!-- simple table -->
      </div> <!-- end section -->
    </div> <!-- .col-12 -->
  </div> <!-- .row -->
</div>
<div class="modal fade" id="assign-user-modal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="{{ route('update_team_users') }}" method="post" id="assign-user-form">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="verticalModalTitle">Assign Team</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group col-12" id="assign-user-body"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn mb-2 btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>
@push('scripts')
<script>
  var ref = '';
  $('.assign-user').click(function() {
    ref = $(this).attr('ref');
    $.ajax({
      type: "post",
      data: {
        ref: ref,
        _token: '{{ csrf_token() }}'
      },
      url: "{{ route('get_users') }}",

      success: function(response) {
        if (response.success == 1) {
          $('#assign-user-body').html(response.content);
          $('.select2-multi').select2({
            theme: 'bootstrap4',
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: response.message,
          });
        }


      }
    });
    $('#assign-user-modal').modal('show');
  });
  var form = document.getElementById('assign-user-form');
  form.addEventListener('submit', event => {
    event.preventDefault();
    let formData = new FormData(form);
    formData.append('ref', ref);
    fetch(form.action, {
        method: "POST",
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();

      })
      .then(data => {
        if (data.success == 1) {
          $('#assign-user-modal').modal('hide');
          $('#assign-user-body').html('');
          ref = "";
          Swal.fire({
            icon: 'success',
            text: data.message,
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.message,
          });
        }
      }).catch(error => console.error("There was a problem with the fetch operation:", error));
  });
</script>
@endpush
@endsection