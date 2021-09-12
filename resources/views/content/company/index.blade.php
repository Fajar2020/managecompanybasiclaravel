@extends('body.master')
@section('fillinhere')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Companies</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Index</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Website</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  @foreach($companies as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td><img width="100px" src="{{ (!empty($item->logo)) ? url($item->logo) : url('storage/app/public/no_image.jpg')}}" alt=""></td>
                        <td><a href="{{$item->website}}" target=“_blank”>{{$item->website}}</a></td>
                        <td>
                          <a href="{{ route('company.edit',$item->id) }}" class="btn btn-info" title="Edit Data">
                              <i class="fas fa-edit"></i>
                          </a>
                          <a href="{{ route('company.softdelete',$item->id) }}" class="btn btn-danger" title="Delete Data">
                              <i class="fa fa-trash"></i>
                          </a>
                        </td>
                    </tr>
                  @endforeach
                    
                    
                  </tbody>
                </table>

                {{$companies->links('vendor.pagination.bootstrap-4')}}
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>



@endsection