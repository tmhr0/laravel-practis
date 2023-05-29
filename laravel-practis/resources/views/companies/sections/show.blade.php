@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2 class="card-header">部署情報　詳細</h2>
                    <div class="card-body">
                        <H2>{{ $company->name }}</H2>
                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>
                            <div class="col-md-6 input-group-text">
                                {{ $section->id }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('部署名') }}</label>
                            <div class="col-md-6 input-group-text">
                                {{ $section->name }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('登録日時') }}</label>
                            <div class="col-md-6 input-group-text">
                                {{ $section->created_at }}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('sections.edit', [$section->company_id, $section->id]) }}">
                                    {{ __('編集') }}
                                </a>
                                <a href="{{ route('sections.index', [$section->company_id, $section->id]) }}">
                                    {{ __('戻る') }}
                                </a>
                            </div>
                        </div>
                        <h3>{{ $section->name }} ユーザー登録 </h3>

                        <form action="/companies/{{ $company->id }}/sections/{{ $section->id }}/users/" method="POST">
                            @csrf
                            <table class="table table-striped">
                                <tr>
                                    <td>
                                        <label for="user_id">ユーザー選択</label>
                                        <select name="user_id" id="user_id" class="form-control" required>
                                            <option value="" disabled selected>選択してください。</option>
                                            @foreach ($company->users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    <td>
                                <tr>
                            </table>
                            <button type="submit" class="btn btn-primary" name='action' value='edit'>
                                {{ __('追加する') }}
                            </button>
                        </form>
                        <h3>所属者一覧</h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($section->users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <form style="display:inline"
                                              action="{{ route('sections.users.destroy', ['company' => $company->id, 'section' => $section->id, 'user' => $user->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('削除') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
