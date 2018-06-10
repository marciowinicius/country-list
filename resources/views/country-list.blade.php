@extends('layouts.app')
@section('title')
    Country list
@endsection
@section('content')
    <div class="container w-100 p-5" style="background-color: #eee;">
        <div class="text-center">
            <a href="{{ route('download-csv')  }}" class="badge download-csv">
                <button type="button" class="btn btn-primary">
                    Download CSV
                </button>
            </a>
            <a href="{{ route('download-xls')  }}" class="badge download-xls">
                <button type="button" class="btn btn-primary">
                    Download XLS
                </button>
            </a>
            <table class="table table-striped table-bordered dataTable">
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                </tr>
                </thead>
                <tbody>
                @forelse($countries as $code => $name)
                    <tr>
                        <td> {{$code}} </td>
                        <td> {{$name}} </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('post-script')
    <script>
        $('.dataTable').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            pageLength: 15
        });
    </script>
@endsection
