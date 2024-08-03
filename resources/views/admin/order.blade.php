<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style>
        table{
            border: 2px solid skyblue;
            text-align: center;
        }

        th{
            background-color: skyblue;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: white;
        }

        .table_center{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        td{
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
        }
    </style>
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
            <h2 class="h5 no-margin-bottom">Orders</h2>
          </div>
        </div>

            {{-- bagain body --}}
            <div class="table_center">
                <table>
                    <tr>
                        <th>Costumer Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Change Status</th>
                        <th>Print PDF</th>
                    </tr>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->rec_address }}</td>
                        <td>{{ $item->phone }}</td>
                        {{-- product diambil dari model order --}}
                        <td>{{ $item->product->title }}</td>
                        <td>{{ $item->product->price }}</td>
                        <td>
                            <img width="150" src="/products/{{ $item->product->image }}" alt="image produk">
                        </td>
                        <td>
                            @if( $item->status == 'in progress')
                                <span style="color: red">{{ $item->status }}</span>
                            @elseif( $item->status == 'On the Way')
                                <span style="color: skyblue">{{ $item->status }}</span>
                            @else
                                <span style="color: yellow">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ url('on_the_way', $item->id) }}">On the way</a>
                            <a class="btn btn-success" href="{{ url('delivered', $item->id) }}">Delivered</a>
                        </td>
                        <td>
                            <a class="btn btn-secondary" href="{{ url('print_pdf', $item->id) }}">Print PDF</a>
                        </td>
                    </tr>
                        
                    @endforeach
                </table>
            </div>
            {{-- bagian body selesai --}}

          </div>
      </div>
    </div>
    <!-- JavaScript files-->
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