@extends('admin.layouts.app')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Manage Categories</h1>
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
  </div>
  <div class="card-body">
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger" role="alert">{{ $error }}</div>
    @endforeach
    @if(Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <form action="{{ url('admin/category/update')}}" method="POST" style="width: 100%">
        {{ csrf_field() }}
        <input type="hidden" name="category_row_id" value="{{$data['single_info'] ->category_row_id}}"/>
        <div class="form-group">
          <label>Category Name</label>
            <input type="text" required value="{{ $data['single_info']->category_name }}" class ="form-control" id="category_name" name="category_name" placeholder = "Enter category Name">
        </div>
        <div class="form-group">
          <label>Category</label>
            <select name="parent_id" class = "form-control" required>
              <option value="" @if($data['single_info']->parent_id == 0 ) selected = "selected" @endif>Select</option>
             <option value="0" @if($data['single_info']->parent_id == 0 ) selected = "selected" @endif> Main Category </option>
              @foreach( $data['all_records'] as $row)
              <option value="{{ $row->category_row_id }}" @if($data['single_info']->parent_id == $row->category_row_id ) selected = "selected" @endif>
                   @if($row->level == 0) <b>  @endif  
                   @if($row->level == 1) &nbsp; - @endif 
                   @if($row->level == 2) &nbsp; &nbsp; - - @endif 
                   @if($row->level == 2) &nbsp; &nbsp; - - @endif     
                   @if($row->level == 3) &nbsp; &nbsp; &nbsp; - - - @endif       
                   @if($row->level == 4) &nbsp; &nbsp; &nbsp; &nbsp; - - - - @endif       
                   @if($row->level == 5) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  - - - - - @endif       
                   @if($row->level > 5)  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - - - @endif  
                              
                   {{ $row->category_name }} 
                    @if($row->level == 0) </b>  @endif  
               </option>
              @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
</div>
@endsection

     