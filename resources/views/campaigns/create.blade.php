@extends('layouts.sidebaremployee')
@section('title','New Campaign')
@section('nav','Campaign')
@section('content')

<div class="row">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">New Campaign</h4>
                <p class="card-category">Campaign Details</p>
            </div>
            <div class="card-body">
                <form action="{{ route('campaigns.createPost') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="row my-3 justify-content-between">
                        <div class="col-md-4">
                            <div class="row my-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Place</label>
                                        <input type="text" name="place" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    <label class="bmd-label-floating">Date</label>
                                    <div class="form-group">
                                        <input type="date" name="date" id="date" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    <label class="bmd-label-floating">Time</label>
                                    <div class="form-group">
                                        <input type="time" name="time" class="form-control datetimepicker" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <label class="bmd-label-floating"><b>Required Foods</b></label>
                            <div class="row my-3 overflow-auto" style="overflow-y: scroll; height: 200px;min-width: 300px;border-style: outset;">
                                @foreach($foods as $food)
                                <div class="col-md-4 col-4">
                                    <button type="button" data-id="{{ $food->id }}" class="m-2 btn btn-warning food-button">{{ $food->name }}</button>
                                </div>
                                @endforeach
                            </div>
                            
                            <div class="row my-1 ">
                                <div class="col-md-12 col-12">
                                    <div class="row my-3">
                                        <div class="col-md-4 col-4">
                                            <label class="bmd-label-floating">Food</label>
                                        </div>
                                        <div class="col-md-4 col-4">
                                            <label class="bmd-label-floating">Quantity</label>
                                        </div>
                                        <div class="col-md-4 col-4">
                                            <label class="bmd-label-floating">Remove</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="cart-items">
                                        <!-- required food -->
                                    </div>
                                    <hr>
                                    <div class="cart-total">
                                        <strong class="cart-total-title">Total : </strong>
                                        <span class="cart-total-quantity"></span>
                                    </div>
                                    <!-- <button class="btn btn-primary btn-purchase" type="button">PURCHASE</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <hr>
                    <a href="{{ route ( 'foods.list' ) }}" class="btn btn-info">Back</a>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("date").setAttribute("min", today);

    if (document.readyState == 'loading') {
        document.addEventListener('DOMContentLoaded', ready)
    } else {
        ready()
    }

    function ready() {
        var removeCartItemButtons = document.getElementsByClassName('btn-danger')
        for (var i = 0; i < removeCartItemButtons.length; i++) {
            var button = removeCartItemButtons[i]
            button.addEventListener('click', removeCartItem)
        }

        var quantityInputs = document.getElementsByClassName('quantity-input')
        for (var i = 0; i < quantityInputs.length; i++) {
            var input = quantityInputs[i]
            input.addEventListener('change', quantityChanged)
        }

        var addToCartButtons = document.getElementsByClassName('food-button')
        for (var i = 0; i < addToCartButtons.length; i++) {
            var button = addToCartButtons[i]
            button.addEventListener('click', addToCartClicked)
        }

    }

    function addToCartClicked(event) {
        var button = event.target
        var foodName = button.innerText
        var foodID = button.getAttribute('data-id');
        addItemToCart(foodName, foodID)
        // updateCartTotal()
    }

    function addItemToCart(foodName, foodID) {
        var cartRow = document.createElement('div')
        cartRow.classList.add('row')
        cartRow.classList.add('my-3')
        cartRow.classList.add('cart-row')
        var cartItems = document.getElementsByClassName('cart-items')[0]
        var cartItemNames = cartItems.getElementsByClassName('cart-item-title')
        for (var i = 0; i < cartItemNames.length; i++) {
            if (cartItemNames[i].value == foodID) {
                alert('This food is already added')
                return
            }
        }
        var cartRowContents = `
            <div class="col-md-4 col-4">
                <label class="bmd-label-floating">${foodName}</label>
                <input type="hidden" name="food_id[]" class="form-control cart-item-title" value="${foodID}" required>
            </div>
            <div class="col-md-4 col-4">
                <input type="number" name="required_quantity[]" class="form-control cart-quantity-input" value="0" min="1" required>
            </div>
            <div class="col-md-4 col-4">
                <button class="btn btn-danger" type="button">REMOVE</button>
            </div>       
        `
        cartRow.innerHTML = cartRowContents
        cartItems.append(cartRow)
        cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
        cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
    }

    function removeCartItem(event) {
        var buttonClicked = event.target
        buttonClicked.parentElement.parentElement.remove()
        updateCartTotal()
    }

    function quantityChanged(event) {
        var input = event.target
        if (isNaN(input.value) || input.value <= 0) {
            input.value = 1
        }
        updateCartTotal()
    }

    function updateCartTotal() {
        var cartItemContainer = document.getElementsByClassName('cart-items')[0]
        var cartRows = cartItemContainer.getElementsByClassName('cart-row')
        var total = 0
        for (var i = 0; i < cartRows.length; i++) {
            var cartRow = cartRows[i]
            // var priceElement = cartRow.getElementsByClassName('cart-price')[0]
            var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
            var quantity = parseFloat(quantityElement.value)
            // var quantity = quantityElement.value
            console.log('quantity: ' + quantity)
            total = total + quantity
            console.log('total: ' + total)
        }
        // total = Math.round(total * 100) / 100
        document.getElementsByClassName('cart-total-quantity')[0].innerText = total
    }
</script>
@endsection