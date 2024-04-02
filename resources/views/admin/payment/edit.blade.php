<x-app-layout>
    <div class="container" >
        <div class="row mt-3 mb-3 text-aline-center">
            <div class="card col-12 p-4 ">
                <form action="{{ route('admin.payment.update', $payment->id) }}" method="POST" class=""
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label for="client_name" class="form-label">Client Name</label>
                        <input type="text" class="form-control" id="client_name" value="{{ old('client_name', $payment->client_name)}}" name="client_name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" value="{{ old('description', $payment->description)}}" name="description">
                    </div>
                    <h3 class="p-3">Cart</h3>

                    @foreach($payment->cart as $product)
                   
                    <div class="card p-3 m-3">
                        <div class="mb-3 d-flex">
                            <div class="px-3">
                                <label for="product_name" class="form-label">Add product</label>
                                <input type="text" class="form-control" id="product_name[]" value="{{ old('product_name[]', $product->product_name)}}" name="product_name[]">
                            </div>

                            <div class="px-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity[]" value="{{ old('quantity[]', $product->quantity)}}" name="quantity[]">
                            </div>

                            <div class="px-3">
                                <label for="product_price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="product_price[]" value="{{ old('product_price[]',  $product->quantity)}}" name="product_price[]" v-model="product_price">
                            </div>
                        </div>
                    </div>

                    @endforeach


                    <div class="py-3">
                        <p>Prezzo Totale : </p>
                        <input type="text" name="total_price" value="10" readonly>
                    </div>

                    <button type="submit" id='submit'class="btn btn-primary">Submit</button>
                </form>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <script>

    </script>

</x-app-layout>
