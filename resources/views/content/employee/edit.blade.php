@extends('body.master')
@section('fillinhere')

<section class="content">
<form action="{{ route('employee.update') }}" method="POST" >
@csrf
<input type="hidden" name="id" value="{{$employee->id}}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Employee</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="firstName">First Name<span class="text-danger">*</span></label>
                        <input type="text" id="firstName" name="firstName" class="form-control"  value="{{ $employee->firstName }}" require>
                        @error('firstName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name<span class="text-danger">*</span></label>
                        <input type="text" id="lastName" name="lastName" value="{{ $employee->lastName }}" class="form-control" require>
                        @error('lastName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="kamboja.kamboja@gmail.com" value="{{ $employee->email }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ $employee->phone }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="company_id">Company</label>
                        <select class="form-control custom-select" name="company_id" >
                            <option value="">Please select one</option>
                            @foreach($companies as $item)
                            <option value="{{$item->id}}" {{ $employee->company_id == $item->id ? 'selected': ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('company_id')
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
            <input type="submit" value="Update Employee" class="btn btn-success float-right">
        </div>
    </div>

</form>
</section>

@endsection