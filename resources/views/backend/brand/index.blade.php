@extends('backend/template/template')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="br-pagetitle">
  <i class="icon ion-ios-home-outline"></i>
  <div>
    <h4>Dashboard||Here are  Your  all Brand</h4>
    <p class="mg-b-0 " >Here are all description all slider.</p>
  </div>
</div>




<div class="container">
  <div class="row mt-5">
    <div class="col-md-6">
      <div class="AddSlider">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              Add New Brand
          </button>
      </div>
  </div>
    {{-- <div class="col-md-6" style="text-align: right;">
      <div class="AddSlider">
          <a href="{{route('slider.multi')}}" class="btn btn-primary">Images/Galleries</a>
      </div>
  </div> --}}
  </div>
    <div class="row">
        <div class="col-md-12 mt-5">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl=1; ?>
                    @foreach ($brands as $brand)
                   
                        <tr>
                            <td>{{$sl}}</td>
                            <td>{{$brand->name}}</td>                            <td>
                              <img height="100px" src="{{asset('backend/brand/'.$brand->logo)}}" alt="">
                            </td>
                            <td>
                                @if($brand->status==1)
                                    <a href="{{ route('slider.status',$brand->id) }}" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></a>
                                @else
                                <a href="{{ route('slider.status',$brand->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-minus-circle"></i></a>
                                @endif
                            </td>
                        </tr>
                        <?php $sl++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
    
</div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addSliderModalLabel">Add New Brand</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="br-pagetitle">
                  <i class="icon ion-ios-home-outline"></i>
                  <div>
                      <h4> Add Your Brand</h4>
                  </div>
              </div>

              <div class="container">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  <input type="text" name="name" class="title form-control" placeholder="Small Title">
                                  <input type="file" name="logo" class="image form-control mt-3">
                                  <button type="submit" class="btn btn-success mt-3 form-control">Save</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>


  
  {{-- <!-- Modal for delete -->
  <div class="modal fade" id="delete" value="{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation Message!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want delete this Slider?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
          
          <a href="{{ route('slider.delete',$slider->id) }}" class="btn btn-danger btn-sm">Yes</a>
        </div>
      </div>
    </div>
  </div> --}}

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

  <script>
   $('#myModal').on('shown.bs.modal', function () {
    $('#summernote').summernote({
        height: 300,
        focus: true
    });
});
  </script>
@endsection
