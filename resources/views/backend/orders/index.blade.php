@extends('backend/template/template')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Dashboard||Orders</h4>
            <p class="mg-b-0 ">Here are all Order.</p>
        </div>
    </div>




    <div class="container">
        <div class="row mt-5">
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
                            <th>Transaction ID</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Phone</th>
                            <th>Customer Address</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Currency</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sl = 1; ?>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $sl }}</td>
                                <td>{{ $order->transaction_id }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_email }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td>{{ $order->customer_address }}</td>
                                <td>{{ $order->city }}</td>
                                <td>
                                    @if ($order->status == 1)
                                        <span class="badge badge-success">Completed</span>
                                    @elseif($order->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-secondary">Unknown</span>
                                    @endif
                                </td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->currency }}</td>
                                <td>
                                    {{-- <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form> --}}
                                </td>
                            </tr>
                            <?php $sl++; ?>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-md-12 d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>


        </div>

    </div>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#summernote').summernote({
                height: 300,
                focus: true
            });
        });
    </script>
@endsection
