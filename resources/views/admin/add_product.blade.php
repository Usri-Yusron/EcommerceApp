<!DOCTYPE html>
<html>
  <head> 

    <style>
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        label
        {
            display: inline-block;
            width: 250px;
            font-size: 18px !important;
            color: white !important;
        }

        input[type='text']
        {
            width: 200px;
            height: 50px;
        }

        .input_deg
        {
            padding: 5px;
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
            <h2 class="h5 no-margin-bottom">Add Product</h2>
          </div>
        </div>

            {{-- bagain body --}}
            <h1 class="ml-5" style="color: white">Add Product</h1>
            <div class="div_deg">
                <form action="{{ url('upload_product') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input_deg">
                        <label for="">Product Tittle</label>
                        <input type="text" name="title" required>
                    </div>
                    
                    <div class="input_deg">
                        <label for="">Description</label>
                        <textarea name="description" cols="34" rows="5" required></textarea>
                    </div>

                    <div class="input_deg">
                        <label for="">Price</label>
                        <input type="text" name="price" required>
                    </div>

                    <div class="input_deg">
                        <label for="">Quantity</label>
                        <input type="number" name="qty" required>
                    </div>

                    <div class="input_deg">
                        <label for="">Product Category</label>
                        <select name="category" required>
                            <option value="">Select a option</option>

                            @foreach ($category as $item)
                                <option value="{{ $item->category_name }}">{{ $item->category_name }}</option>                                    
                            @endforeach
                        </select>
                    </div>

                    <div class="input_deg">
                        <label for="">Product Image</label>
                        <input type="file" name="image" accept="image/*" required>
                    </div>

                    <div class="input_deg">
                        <input class="btn btn-success" type="submit" value="Add Product">
                    </div>
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