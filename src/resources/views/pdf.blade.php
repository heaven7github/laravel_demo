<h1>{{ __('products.head') }}</h1><br>
@foreach ($products as $product)
    <h2>Termék azonosító {{ $product->id }}</h2>
    <p>Termék neve {{ $product->name }}</p>
    <i>Termék leírása {{ $product->description }}</i>
@endforeach
