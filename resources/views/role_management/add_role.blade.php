@extends('includes.main')
@section('content')
<style>
  .form-group {
    margin-top: 15px;
  }

  .form-check.form-check-inline {
    display: block;
  }

  [name="check-all"] {
    margin-left: 5px;
  }

  strong.btn-success {
    padding: 5px 5px 0 5px;
  }
</style>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <h2 class="page-title menu-head">{{(@$role) ? 'Update Role' : 'Add Role' }}</h2>
      <div class="card shadow mb-4">
        <form action="{{(@$role) ? route('update_role', ['id' => Crypt::encrypt($role->id)]) : route('post_role')  }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">
              @role('dev')
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="type">Company</label>
                  <select class="form-control @error('company') is-invalid @enderror" name="company" id="company">
                    @foreach (companies() as $item)
                    <option value="{{ $item->id }}" {{(@$role) ? (@$role->company_id==$item->id ? 'selected' : '') : '' }}>{{ $item->name }}</option>
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
                  <input name="name" value="{{ (@$role)?@$role->display_name:old('name') }}" required type="text" id="name" class="form-control @error('name') is-invalid @enderror">
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-bottom:20px;">
                <strong class="btn-primary">Permissions:</strong>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="activity">Activity</label><input type="checkbox" name="check-all" id="activity" {{ @$check_all["activity"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="activity")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input activity','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="application">Application</label><input type="checkbox" name="check-all" id="application" {{ @$check_all["application"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="application")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input application','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="client">Client</label><input type="checkbox" name="check-all" id="client" {{ @$check_all["client"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="client")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input client','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="department">Department</label><input type="checkbox" name="check-all" id="department" {{ @$check_all["department"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="department")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input department','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="document">Document</label><input type="checkbox" name="check-all" id="document" {{ @$check_all["document"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="document")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input document','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="file">File</label><input type="checkbox" name="check-all" id="file" {{ @$check_all["file"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="file")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input file','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="payer">Payer</label><input type="checkbox" name="check-all" id="payer" {{ @$check_all["payer"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="payer")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input payer','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="practice">Practice</label><input type="checkbox" name="check-all" id="practice" {{ @$check_all["practice"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="practice")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input practice','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="provider">Provider</label><input type="checkbox" name="check-all" id="provider" {{ @$check_all["provider"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="provider")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input provider','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="reports">Reports</label><input type="checkbox" name="check-all" id="reports" {{ @$check_all["reports"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="reports")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input reports','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="role">Role</label><input type="checkbox" name="check-all" id="role" {{ @$check_all["role"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="role")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input role','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="team">Team</label><input type="checkbox" name="check-all" id="team" {{ @$check_all["team"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="team")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input team','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="ticket">Ticket</label><input type="checkbox" name="check-all" id="ticket" {{ @$check_all["ticket"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="ticket")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input ticket','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3">
                <strong class="btn-success"><label for="user">User</label><input type="checkbox" name="check-all" id="user" {{ @$check_all["user"] }}></strong>
                <div class="form-group">
                  @foreach($permissions as $value)
                  @if($value->type=="user")
                  <div class="form-check form-check-inline">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, @$assign_permissions) ? true : false, array('class' => 'form-check-input user','id'=>$value->name)) }}
                    <label for="{{ $value->name }}" class="form-check-label">{{ ucwords(str_replace("-"," ",$value->name)) }}</label>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>



              <div class="col-12">
                <input type="submit" value="{{ (@$role) ? 'Update' : 'Save' }}" class="btn btn-success float-right">
              </div>
            </div>
          </div>
        </form>
      </div> <!-- / .card -->

    </div> <!-- .col-12 -->
  </div> <!-- .row -->
</div>
@endsection