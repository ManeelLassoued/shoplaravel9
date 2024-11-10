@extends('layout')

  

@section('content')

<div class="card">
    <div class="card-body">
       
         <div class="d-flex justify-content-end mt-4" >
            @php $total = 0 @endphp
            @foreach((array) session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
            @endforeach
        <h4 class="text-primary" id="total">Total:  ${{ $total ?? 0 }}</h4>
        </div>
<table id="cart" class="table table-striped">

    <thead>
        <tr>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Remove</th>
        </tr>
    </thead>
    <tbody>

        @if(session('cart'))
        @foreach(session('cart') as $id => $details)
            <tr data-id="{{ $id }}">
    
                <td data-th="Product">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/image/'.$details['photo'].'') }}" class="me-2" style="width: 80px; height: 50px;" />
                        <h6>{{ $details['product_name'] }}</h6>
                    </div>
                </td>
    
                <td data-th="Price" class="item-price">${{ $details['price'] }}
                    <input type="hidden" class="price" value="{{ $details['price'] }}" />
                </td>
    
                <td data-th="Quantity">
                    <input type="number" class="quantity update-cart" data-id="{{ $id }}" min="1" value="{{ $details['quantity'] }}" class="form-control" />
                </td>
    
                <td data-th="Subtotal" class="item-total" >
                    <div class="subtotal" data-id="{{ $id }}">
                        <p class="text-center">${{ $details['price'] * $details['quantity'] }}</p>
                    </div>
                </td>
    
                <td class="actions" data-th="">
                    <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
 
</table>
<div class="d-flex justify-content-end mt-4">
    <div>
        <a href="{{ route('home') }}" class="btn btn-primary">Proceed to Checkout</a>
        <a href="{{ route('home') }}"  class="btn btn-outline-secondary ms-2">Continue Shopping</a>
    </div>
</div>
    </div>
</div>

@endsection

  

@section('scripts')

<script type="text/javascript">

$(".update-cart").change(function (e) {
    e.preventDefault();

    var prod = $(this);  // The current quantity input field
    var productId = prod.data('id');  // Get the product ID from the data-id attribute
    var price = parseFloat(prod.parents("tr").find(".price").val());  // Get the price from the hidden input field in the same row
    var quantity = parseInt(prod.val(), 10);  // Get the updated quantity value

    // Make AJAX request to update the cart on the server
    $.ajax({
        url: '{{ route('update.cart') }}',
        method: "PATCH",
        data: {
            _token: '{{ csrf_token() }}',
            id: productId,  // Send the product ID to the server
            price: price,
            quantity: quantity
        },
        success: function(response) {
            // Calculate the new total price for the individual item
            var totalprice = price * quantity;

            // Update the individual item total in the table row
            prod.parents("tr").find(".item-total p").text('$' + totalprice.toFixed(2));

            // Now, recalculate the overall cart total
            var grandTotal = 0;

            // Loop through all the item totals to calculate the grand total
            $(".item-total p").each(function() {
                var itemTotal = parseFloat($(this).text().replace('$', '')); // Get item total
                grandTotal += itemTotal;  // Add item total to grand total
            });

             $('#subtotal').text('$' + totalprice.toFixed(2)); 
             $('#total').text('$' + grandTotal.toFixed(2)); 
             $('#totallist').text('$' + grandTotal.toFixed(2)); 

        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    });
});

  

$(".remove-from-cart").click(function (e) {
    e.preventDefault();

    var prod = $(this);
    var row = prod.parents("tr");  
    var productId = row.data('id'); // Get the product ID

    if (confirm("Are you sure you want to remove this item from the cart?")) {
        $.ajax({
            url: '{{ route('remove.from.cart') }}',  // The route to remove the product from the cart
            method: "DELETE",
            data: {
                _token: '{{ csrf_token() }}', 
                id: productId   
            },
            success: function (response) {
                 row.remove();
                 updateCartTotal(response); 
                 window.location.reload();
             },
            error: function(xhr, status, error) {
                console.error('Error removing item from cart:', error);
                alert('There was an error removing the item from your cart.');
            }
        });
    }
});

// Function to update the cart total dynamically after item removal
function updateCartTotal() {
    var grandTotal = 0;

     $(".item-total p").each(function() {
        var itemTotal = parseFloat($(this).text().replace('$', '')); // Get item total
        grandTotal += itemTotal;  // Add item total to grand total
    });

     $('#total').text('$' + grandTotal.toFixed(2)); 
     $('#totallist').text('$' + grandTotal.toFixed(2)); 

     
} 

</script>

@endsection