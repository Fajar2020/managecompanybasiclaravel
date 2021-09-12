@extends('body.master')
@section('fillinhere')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<section class="content">
<form action="{{ route('store.company') }}" method="POST" enctype="multipart/form-data">
@csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Company</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" require>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="kamboja.kamboja@gmail.com">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="logo" class="form-label">Image</label><br />
                        <a class = "thumbnail"><img id="showImage" width="150px"></a>
                    
                        <input type="file" class="form-control" name="logo" id="logo" >
                        @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Website</label>
                        <input type="text" id="website" name="website" class="form-control" placeholder="https://laravel.com/">
                        @error('website')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    
                    </div>
                
                
                </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="submit" value="Add New Company" class="btn btn-success float-right">
        </div>
    </div>

</form>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        $('#logo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>





@endsection