@extends('includes.main')
@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <span class="mb-2 page-title menu-head">Tickets</span>
      @can('create ticket')
      <a class="btn btn-primary float-right" href="{{ route('tickets.create') }}">Create Ticket</a>
      @endcan
      <p class="card-text"></p>
      <div class="row my-4">
        <div class="col-md-12">
          <div class="card shadow">
            <div class="card-body">
              <!-- table -->
              <table class="table datatables" id="dataTable-1">
                <thead>
                  <tr>
                    <th>Ticket#</th>
                    <th>Response</th>
                    <th>Created</th>
                    <th>Creator</th>
                    <th>User Name</th>
                    <th>Practice</th>
                    <th>Department</th>
                    <th>Team</th>
                    <th>Subject</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    @role('dev')
                    <th>Company</th>
                    @endrole
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tickets as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->response_at }}</td>
                    <td>{{ date("d/m/y h:i",strtotime($item->created_at)) }}</td>
                    <td>{{ $item->creator }}</td>
                    <td>{{ $item->creator_name }}</td>
                    <td>{{ $item->practice_name }}</td>
                    <td>{{ $item->department_name }}</td>
                    <td>{{ $item->team }}</td>
                    <td>{{ $item->subject }}</td>
                    <td>{{ $item->priority }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->remarks }}</td>
                    @role('dev')
                    <td>{{ @$item->company->name }}</td>
                    @endrole
                    <td>
                      <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-muted sr-only">Action</span>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        @can('update ticket')
                        <a class="dropdown-item" href="{{ route('tickets.edit',$item->id) }}">Edit</a>
                        @endcan
                        @can('delete ticket')
                        {!! Form::open(['method' => 'DELETE','route' => ['tickets.destroy', $item->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'dropdown-item']) !!}
                        {!! Form::close() !!}
                        @endcan
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection