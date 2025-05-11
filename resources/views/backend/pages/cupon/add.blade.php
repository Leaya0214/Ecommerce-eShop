@extends('backend/template/template')
@section('content')
  
<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Dashboard||This is Coupon</h4>
      <h5>Make By: Sakib Ul Islam</h5>
      <p class="mg-b-0">Do bigger things with uTEAM, the responsive bootstrap 4 admin template.</p>
    </div>
  </div>


<div class="container ">
    <div class="row mt-5">
       <div class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for="">Cupon Code</label>
                <input type="text" class="form-control cupon_code" placeholder="Type cupon code here" id="cupon_code">
                <span  class="text-danger">
                    @error('.cupon_code')
                    {{ $message }}

                    @enderror
                </span>
            </div>
            <div class="form-group " >
                <label for="">Product Id</label>
                <select name="product_id" id="product_id" class="form-control product_id">
                    <option value="">Select Product</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" data-product-price = "{{$product->product_price}}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
                <span  class="text-danger">
                    @error('.product_id')
                    {{ $message }}

                    @enderror
                </span>
            </div>
            <div class="form-group " >
                <label for="">Cupon discount</label>
                <input type="number" id="discount" class="form-control discount" placeholder="Enter cupon discount here" id="discount">
                <span  class="text-danger">
                    @error('.discount')
                    {{ $message }}

                    @enderror
                </span>
            </div>

            <div class="form-group " >
                <label for="">Cupon discount amount</label>
                <input type="number" id="discount_amount" class="form-control discount_amount " placeholder="Enter cupon discount amount here" id="discount_amount">
                <span  class="text-danger">
                    @error('.discount_amount')
                    {{ $message }}

                    @enderror
                </span>
            </div>
            <div class="form-group " >
                <label for="">Start Date</label>
                <input type="date" class="form-control start_at" placeholder="Start Date" id="start_at">
                <span  class="text-danger">
                    @error('.start_at')
                    {{ $message }}

                    @enderror
                </span>
            </div>
            <div class="form-group " >
                <label for="">End Date</label>
                <input type="date" class="form-control end_at" placeholder="Start Date" id="end_at">
                <span  class="text-danger">
                    @error('.end_at')
                    {{ $message }}

                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="">Cupon Status</label>
                <select id="status" class="status form-control">
                    <option value="0">-----Select Status-----</option>
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                </select>
                <span class="text-danger">
                    @error('.status')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            
            <button name="save" class="mt-3 btn btn-success form-control addcupon">Add Cupon</button>
       </div>
    </div>
       <div class="row">
        <div class="col-md-12 mt-5">
           
                <table class="table">
                    <thead>
                        <tr>
                            <th>Cupon Code</th>
                            <th>Discount</th>
                            <th>Discount Amount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Product Id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="alldata">
                        @foreach ($cupons as $cupon)
                        <tr>
                            <td>{{ $cupon->cupon_code }}</td>
                            <td>{{ $cupon->discount }}</td>
                            <td>{{ $cupon->discount_amount }}</td>
                            <td>{{ $cupon->start_at }}</td>
                            <td>{{ $cupon->end_at }}</td>
                            <td>
                                @if ($cupon->status==1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>{{ $cupon->product_id }}</td>
                            <td>
                                <button class="btn btn-primary edit" id="{{ $cupon->id }}">Edit</button>
                                <button class="btn btn-danger delete" id="{{ $cupon->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
           
        </div>
       </div>
    </div>        
</div>
            {{-- Modal delete start--}}
<!-- Modal -->
<div class="modal fade delete" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation Message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are sure want to delete?
        </div>
        <div class="modal-footer">
          <button type="button" class="btnDelete btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
  {{-- Modal delete end--}}

  {{-- Modal update start --}}
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Cupon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="">Cupon Code</label>
                    <input type="text" class="form-control cupon_code" placeholder="Type cupon code here" id="ucupon_code">

                </div>
                <div class="form-group " >
                    <label for="">Cupon discount</label>
                    <input type="number" class="form-control discount" placeholder="Enter cupon discount here" id="udiscount">

                </div>
                <div class="form-group " >
                    <label for="">Cupon discount amount</label>
                    <input type="number" class="form-control discount_amount " placeholder="Enter cupon discount amount here" id="udiscount_amount">
                </div>
                <div class="form-group " >
                    <label for="">Start Date</label>
                    <input type="date" class="form-control start_at" placeholder="Start Date" id="ustart_at">

                </div>
                <div class="form-group " >
                    <label for="">End Date</label>
                    <input type="date" class="form-control end_at" placeholder="Start Date" id="uend_at">
                </div>
                <div class="form-group">
                    <label for="">Cupon Status</label>
                    <select id="ustatus" class="status form-control">
                        <option value="0">-----Select Status-----</option>
                        <option value="1" >Active</option>
                        <option value="2" >Inactive</option>
                    </select>
                </div>
                {{-- <div class="form-group " >
                    <label for="">Product Id</label>
                    <input type="number" class="form-control cupon_code product_id" placeholder="Product ID" id="product_id">
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button"  class="update btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>


  {{-- Modal update end --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('product_id');
    const discountInput = document.getElementById('discount');
    const discountAmountInput = document.getElementById('discount_amount');

    // Function to calculate discount
    function calculateDiscount() {
        const selectedProduct = productSelect.options[productSelect.selectedIndex];
        const productPrice = parseFloat(selectedProduct.getAttribute('data-product-price')) || 0;
        const discountPercentage = parseFloat(discountInput.value) || 0;

        if (productPrice > 0 && discountPercentage >= 0 && discountPercentage <= 100) {
            const discountAmount = (productPrice * discountPercentage) / 100;
            const finalPrice = productPrice - discountAmount;

            discountAmountInput.value = discountAmount.toFixed(2);
        } else {
            discountAmountInput.value = '';
        }
    }

    // Event listeners
    productSelect.addEventListener('change', calculateDiscount);
    discountInput.addEventListener('input', calculateDiscount);
});
</script>
@endsection
