<!DOCTYPE html>
<html>
  <head> 

    <style>
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px
        }

        .link_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .table_deg
        {
            border: 2px solid greenyellow;
        }

        th
        {
            background-color: skyblue;
            color: white;
            font-size: 19px;
            font-weight: bold;
            padding: 15px;
        }

        td
        {
            border: 1px solid skyblue;
            text-align: center;
            color: white;
        }

        input[type="search"]
        {
          width: 500px;
          height: 60px;
          margin-left: 50px;
        }
    </style>

    @include('admin.css')
  </head>
  <body>
    {{-- bagian header --}}
        @include('admin.header')
    {{-- bagian header selesai --}}
    
    {{-- bagian sidebar --}}
        @include('admin.sidebar')
    {{-- bagian sidebar selesai --}}

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Product</h2>
          </div>
        </div>

            {{-- bagain body --}}
            {{-- search --}}
            <form action="{{ url('product_search') }}" method="get">
              @csrf
              <input type="search" name="search">
              <input class="btn btn-secondary" type="submit" name="submit" value="Search">
            </form>

            <div class="div_deg">
                <table class="table_deg">
                    <tr>
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Aksi</th>
                    </tr>

                    @foreach ($product as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td style="padding: 3px">{{ $item->description }}</td>
                        <td>{{ $item->category }}</td>
                        <td>Rp. {{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            <img height="100" width="100" src="products/{{ $item->image }}" alt="">
                        </td>
                        {{-- buat button --}}
                        <td>
                          <a class="btn btn-success" href="{{ url('update_product', $item->id) }}">Edit</a>
                          <a class="btn btn-danger m-1" onclick="confirmation(event)" href="{{ url('delete_product', $item->id) }}">Delete</a>
                        </td>
                    </tr>                        
                    @endforeach
                </table>
            </div>
            
            {{-- bikin page per produk --}}
            {{-- jgan lupa ubah di file App\providers\AppServiceProvider.php di dalam function boot --}}
            <div class="link_deg">
                {{ $product->links() }}
            </div>
            {{-- bagian body selesai --}}

          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    {{-- sweet alert --}}
    <script type="text/javascript">
        function confirmation(ev){
          ev.preventDefault();
  
          var urlToRedirect = ev.currentTarget.getAttribute('href');
  
          console.log(urlToRedirect);
  
          swal({
            title: "Are You Sure To Delete This",
            text: "This delete will be parmanent",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
  
          .then((willCancel)=>{
            if(willCancel){
              window.location.href = urlToRedirect;
            }
          });
        }
      </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    {{-- sweet alert selesai --}}
    
    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
  </body>
</html>