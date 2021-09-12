@extends('body.master')
@section('fillinhere')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employees in Recycle</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Index</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  @foreach($softDelEmployees as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->fullName}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td><a href="{{$item->company->website}}" target=“_blank”>{{$item->company->name}}</a></td>
                        <td>
                            <a href="{{ url('employee/restore/'.$item->id) }}" class="btn btn-info" title="Restore Employee"><i class="fas fa-trash-restore"></i></a>
                            <a href="{{ url('employee/pdelete/'.$item->id) }}" class="btn btn-danger" title="Delete Permanenly" id="delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                  @endforeach
                    
                    
                  </tbody>
                </table>

                {{$softDelEmployees->links('vendor.pagination.bootstrap-4')}}
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>



@endsection