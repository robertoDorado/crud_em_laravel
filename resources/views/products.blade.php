@extends('layouts.theme')

@section('content')
<div class="content-view">
    @if(session('warning_msg'))
        <div class="alert alert-warning flash-messages">{{ session('warning_msg') }}</div>
    @endif
    @if(session('success_msg'))
        <div class="alert alert-success flash-messages">{{ session('success_msg') }}</div>
    @endif
    <table class="table table-striped table-products">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Product</th>
                <th scope="col">Qtd</th>
                <th scope="col">Price</th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $value)
                <tr>
                    <th scope="row">{{ $value->o_id }}</th>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->product }}</td>
                    <td>{{ $value->qty }}</td>
                    <td>{{ $value->price }}</td>
                    <td><a href="/editar-pedido/{{ $value->hash_order }}" class="btn btn-primary">Editar</a></td>
                    <td><a data-delete="{{ $value->hash_order }}" data-url="/excluir-pedido" href="/excluir-pedido" class="delete-links btn btn-danger">Excluir</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/criar-pedido" class="btn btn-primary btn-criar-pedido">Criar Pedido</a>
</div>
@endsection