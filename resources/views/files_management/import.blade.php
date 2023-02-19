@extends('includes.main')
@section('content')
<style>
    .uppy-Dashboard-progressindicators {
            display: none;
        }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title menu-head">Import Files</h2>
        <div class="card shadow mb-4">
        <form action="{{ route('post_file') }}" id="import-files" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="row">

                <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label for="practice">Practice</label>
                      <select class="form-control @error('practice') is-invalid @enderror" name="practice" id="practice" >

                        @foreach ($practices as $item)
                        <option value="{{ Crypt::encrypt($item->id) }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                      @error('practice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                </div>

                <div class="col-13">
                  <div class="form-group mb-3">
                    <div id="uppy"></div>
                  </div>
                </div>

                <div class="col-12">
                  <input type="submit" value="{{ 'Save' }}" class="btn btn-success float-right">
                </div>
              </div>
            </div>
          </form>
        </div> <!-- / .card -->

      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div>
@push('scripts')
    <script>
        var importform = document.getElementById('import-files');
        importform.addEventListener('submit', event => {
        event.preventDefault();
        // access the files data selected by uppy
        const files = uppy.getFiles();
        // Create a FormData object
        const formData = new FormData(importform);

        // Append the files to the FormData object
        files.forEach(file => {
            formData.append('files[]', file.data);
        });
        fetch(importform.action, {
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
                Swal.fire({
                    icon: 'success',
                    text: data.message,
                    });
                    uppy.reset();
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                    });
            }
        })
        .catch(error => console.error("There was a problem with the fetch operation:", error));

    });



    </script>
@endpush
@endsection