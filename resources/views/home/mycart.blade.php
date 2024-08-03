<!DOCTYPE html>
<html>

<head>
    @include('home.css')

    <style>
        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }

        .cart_value{
            text-align: center;
            margin-bottom: 70px;
            padding: 7px;
        }

        .order_deg{
            padding-right: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            /* margin-top: -100px; */
        }

        .div_gap{
            padding: 20px;
        }

        label{
            display: inline-block;
            width: 150px;
        }

        table{
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }

        th{
            border: 2px solid black;
            text-align: center;
            color: white;
            font: 20px;
            font-weight: bold;
            background-color: black;
        }

        td{
            border: 1px solid skyblue;
        }
    </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
        @include('home.header')
    <!-- end header section -->
  </div>

  {{-- hero start area --}}
  <div class="div_deg">

    <table>
        <tr>
            <th>Product Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Aksi</th>
        </tr>  

        <?php
            $value = 0;
        ?>

        @foreach ($cart as $item)
            <tr>
                {{-- product dari function yg ada di model cart --}}
                <td>{{ $item->product->title }}</td>
                <td>{{ $item->product->price }}</td>
                <td>
                    <img width="150px" src="/products/{{ $item->product->image }}" alt="image product">
                </td>
                <td>
                    <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_cart', $item->id) }}">Remove</a>
                </td>
            </tr>    
            
        <?php 
            $value = $value + $item->product->price;
        ?>

        @endforeach
    </table>
  </div>

  <div class="cart_value">
    <h3>Total Value of Cart is: Rp.{{ $value }}</h3>
  </div>

  
  <div class="order_deg">
    <form action="{{ url('comfirm_order') }}" method="POST">
        @csrf
        <div class="div_gap">
            <label for="">Receiver Name</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}">
        </div>
        <div class="div_gap">
            <label for="">Receiver Address</label>
            <textarea name="address">{{ Auth::user()->address }}</textarea>
        </div>
        <div class="div_gap">
            <label for="">Receiver Phone</label>
            <input type="text" name="phone" value="{{ Auth::user()->phone }}">
        </div>
        <div class="div_gap">
            <input class="btn btn-primary" type="submit" value="Cash On Delivery">
            <a class="btn btn-success" href="{{ url('stripe', $value) }}">Pay Using Card</a>
        </div>
    </form>
</div>
  <!-- end hero area -->

  <!-- info and footer section -->
        @include('home.footer')
  <!-- end info and footer section -->

</body>

</html>