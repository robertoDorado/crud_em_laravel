@extends('layouts.theme')

@section('content')
<div class="content-view">
    <h1>Create Product</h1>
    <form method="POST" action="/criar-pedido">
        @csrf
        <div class="form-group">
            <label for="userName">Nome do usuário</label>
            <input name="name" type="text" class="form-control" id="user-name" aria-describedby="userName" placeholder="Nome do usuário">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input name="product_name" type="text" class="form-control" id="product_name" aria-describedby="productName" placeholder="Nome do produto">
        </div>
        <div class="form-group">
            <label for="qty">Quantity</label>
            <input name="qty" type="text" class="form-control" id="quantity" aria-describedby="qty" placeholder="Quantidade">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" type="text" class="form-control" id="price" aria-describedby="price" placeholder="Preço">
        </div><br />
        <button type="submit" class="btn btn-primary">Criar Pedido</button>
    </form>
    <div class="wrap-link-back">
        <a href="/">Voltar</a>
    </div>
</div>
@endsection