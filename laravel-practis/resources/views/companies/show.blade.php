@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2 class="card-header">会社情報　詳細</h2>
                    <div class="card-body">
                        @csrf
                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>
                            <div class="col-md-6 input-group-text">
                                {{ $company->id }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('会社名') }}</label>
                            <div class="col-md-6 input-group-text">
                                {{ $company->name }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('登録日時') }}</label>
                            <div class="col-md-6 input-group-text">
                                {{ $company->created_at }}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('companies.edit', $company->id) }}">
                                    <div type="button" class="btn btn-primary">
                                    {{ __('編集') }}
                                    </div>
                                </a>

                                <a href="{{ route('sections.index', $company->id) }}">
                                    <div type="button" class="btn btn-primary">
                                    {{ __('部署情報を確認する') }}
                                    </div>
                                </a>
                                <a href="{{ route('companies.index') }}" >
                                    <div type="button" class="btn btn-danger">
                                    {{ __('戻る') }}
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
