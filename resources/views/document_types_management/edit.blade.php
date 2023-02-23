@extends('includes.main')
@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <h2 class="page-title menu-head">Update Status</h2>
      <div class="card shadow mb-4">
        {!! Form::model($documentType, ['method' => 'PATCH','route' => ['document_types.update', $documentType->id]]) !!}
        <div class="card-body">
          <div class="row">
            @role('dev')
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="company">Company</label>
                <select class="form-control @error('company') is-invalid @enderror" name="company" id="company">
                  @foreach (companies() as $item)
                  <option value="{{ $item->id }}" {{ $documentType->company_id==$item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                  @endforeach
                </select>
                @error('company')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            @endrole
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="name">Name</label>
                <input name="name" value="{{ $documentType->name }}" required type="text" id="name" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <input type="submit" value="{{ 'Update' }}" class="btn btn-success float-right">
            </div>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endsection