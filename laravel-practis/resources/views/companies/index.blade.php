@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="container">
                <div class="card">
                    <h1 class="card-header">会社 一覧ページ</h1>
                    <div class="card-body">
                    </div>
                    <br>
                    <div class="table-resopnsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('name')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($companies))
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $company->id }}</td>
                                        <td>{{ $company->name }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <br>
                        <br>
                        <button type="button" class="btn btn-primary"
                                onclick="location.href='{{ route('companies.create') }}'">
                            {{ __('追加') }}
                        </button>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
