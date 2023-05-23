@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="container">
                <div class="card">
                    <h1 class="card-header">会社 一覧ページ</h1>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>会社名</th>
                            <th>作成日</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($companies))
                            @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->created_at }}</td>
                                    <td>
                                        <a href="{{ route('sections.create', ['company' => $company->id]) }}">
                                            <div type="button" class="btn btn-primary">
                                                {{ __('部署登録') }}
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/companies/{{ $company->id }}">
                                            <div type="button" class="btn btn-primary">
                                                {{ __('詳細') }}
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <form style="display:inline"
                                              action="{{ route('companies.destroy', $company->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('削除') }}
                                            </button>
                                        </form>
                                    </td>
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
@endsection
