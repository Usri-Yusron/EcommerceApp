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
            width: 300px;
            height: 60px;
        }

        label 
        {
          display: inline-block;
          width: 200px;
          padding: 20px;
        }

        textarea
        {
          width: 450px;
          height: 100px;
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
            <h2 class="h5 no-margin-bottom">Edit Product</h2>
            </div>
        </div>

            {{-- bagain body --}}
            <div class="div_deg">
              <form action="{{ url('edit_product', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                  <label for="">Title</label>
                  <input type="text" name="title" value="{{ $data->title }}">
                </div>

                <div>
                  <label for="">Description</label>
                  <textarea name="description" >{{ $data->description }}</textarea>
                </div>

                <div>
                  <label for="">Price</label>
                  <input type="text" name="price" value="{{ $data->price }}">
                </div>

                <div>
                  <label for="">Quantity</label>
                  <input type="number" name="quantity" value="{{ $data->quantity }}">
                </div>

                <div>
                  <label for="">Category</label>
                  <select name="category" id="">
                    <option value="{{ $data->category }}">{{ $data->category }}</option>

                    @foreach ($category as $item)
                      <option value="{{ $item->category_name }}">{{ $item->category_name }}</option>                        
                    @endforeach
                  </select>
                </div>

                <div>
                  <label for="">Current Image</label>
                  <img width="150" src="/products/{{ $data->image }}" alt="image product">
                </div>

                <div>
                  <label for="">New image</label>
                  <input type="file" name="image" accept="image/*">
                </div>

                <div>
                  <input class="btn btn-success" type="submit" value="Update Product">
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