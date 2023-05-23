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
                        @csrf
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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('登録日時') }}</label>
                            <div class="col-md-6 input-group-text">
                                {{ $section->created_at }}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href='{{ route('companies.sections.edit', $section->id) }}'>
                                    {{ __('編集') }}
                                </a>
                                <a href="{{ route('companies.index') }}">
                                    {{ __('戻る') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
