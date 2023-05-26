@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('layouts.message')
                <div class="card">
                    <div class="card-header">会社情報　編集</div>
                    <div class="card-body">
                        <form action="/companies/{{ $company->id }}/sections/{{ $section->id }}/" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('名前') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name',$section->name) }}">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name='action' value='edit'>
                                        {{ __('更新') }}
                                    </button>
                                    <a href="{{ route('sections.show', [$section->company_id, $section->id]) }}">
                                        <div type="button" class="btn btn-danger">
                                            {{ __('戻る') }}
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
