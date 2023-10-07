@extends('layout.app')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 mt-4">
            <div class="card p-4">
                <p>Name : <b>{{$products->name}}</b></p>
                <p>description : <b>{{$products->description}}</b></p>
                <img src="/products/{{$products->image}}" alt="" class="rounded" width="50%">
            </div>
        </div>
    </div>
</div>


@endsection