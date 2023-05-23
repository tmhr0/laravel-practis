<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="container">
            <div class="card">
                <h1 class="card-header">部署情報 一覧ページ</h1>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>会社名</th>
                        <th>作成日</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($sections))
                        @foreach ($sections as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->created_at }}</td>
                                <td>
                                    <a href="{{ route('companies.sections.show', ['company' => $company->id, 'section' => $section->id]) }}">
                                        <div type="button" class="btn btn-primary">
                                            {{ __('詳細') }}
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
