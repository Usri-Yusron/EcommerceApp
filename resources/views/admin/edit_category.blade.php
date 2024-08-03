<!DOCTYPE html>
<html>
  <head> 

    <style>
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }

        input[type='text']
        {
            width: 400px;
            height: 50px;
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
            <h2 class="h5 no-margin-bottom">Edit Category</h2>
            </div>
        </div>

            {{-- bagain body --}}
            <h1 class="ml-4" style="color: white">Update Category</h1>
            <div class="div_deg">
                <form action="{{ url('update_category', $data->id) }}" method="post">
                    @csrf
                    <input type="text" value="{{ $data->category_name }}" name="category">
                    <input class="btn btn-secondary" type="submit" value="Update Category">
                </form>
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