@extends('layouts.app')
@section('title')
    Country list
@endsection
@section('content')
    <div class="container w-100 p-5" style="background-color: #eee;">
        <div class="text-center">
            <p>Este é um teste para o Grupo Citar</p>
            <a href="{{ route('country-list')  }}" class="badge" style="width: 100%">
                <button type="button" class="btn btn-success" style="width: 100%">
                    Mostrar países
                </button>
            </a>
        </div>
    </div>
@endsection
