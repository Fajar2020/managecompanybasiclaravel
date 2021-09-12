@extends('body.master')
@section('fillinhere')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employees</h3>
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

                  @foreach($employees as $item)
                   <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->fullName}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td><a href="{{$item->company->website}}" title="{{$item->company->website}}" id="open">{{$item->company->name}}</a></td>
                        <td>
                          <a href="{{ route('employee.edit',$item->id) }}" class="btn btn-info" title="Edit Data">
                              <i class="fas fa-edit"></i>
                          </a>
                          <a href="{{ route('employee.softdelete',$item->id) }}" class="btn btn-danger" title="Delete Data">
                              <i class="fa fa-trash"></i>
                          </a>
                        </td>
                    </tr>
                  @endforeach
                    
                    
                  </tbody>
                </table>

                {{$employees->links('vendor.pagination.bootstrap-4')}}
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>



@endsection