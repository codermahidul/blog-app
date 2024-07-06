@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('News') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All News') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create New') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        @foreach ($languages as $language)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="home-tab" data-toggle="tab"
                                    href="#home{{ $language->id }}" role="tab" aria-controls="home"
                                    aria-selected="true">{{ $language->language }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                        @foreach ($languages as $language)
                        @php
                            $allNews = \App\Models\News::where('language', $language->slug)->latest()->get();
                        @endphp
                            <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}"
                                id="home{{ $language->id }}" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-{{ $language->id }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>{{ __('Thumbnail') }}</th>
                                                <th>{{ __('Category') }}</th>
                                                <th>{{ __('Author') }}</th>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Is Breaking') }}</th>
                                                <th>{{ __('Sho at Slider') }}</th>
                                                <th>{{ __('Sho at Popular') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allNews as $news)
                                            <tr>
                                                <td>{{ ++$loop->index }}</td>
                                                <td>
                                                    <img width="100" src="{{ asset($news->thumbnail) }}" alt="">
                                                </td>
                                                <td>
                                                    @php
                                                        $categoryName = \App\Models\Category::where('id',$news->category_id)->first()->name;
                                                    @endphp
                                                    {{ $categoryName }}
                                                </td>
                                                <td>
                                                    @php
                                                        $author = \App\Models\Admin::where('id',$news->author_id)->first()->name;
                                                    @endphp
                                                    {{ $author }}
                                                </td>
                                                <td>
                                                    {{ $news->title }}
                                                </td>
                                                <td>Breaking News</td>
                                                <td>Show at slider</td>
                                                <td>Show at popular</td>
                                                <td>
                                                    <a href="" class="btn btn-primary"><i
                                                            class="fas fa-edit"></i></a>

                                                    <a href="" class="btn btn-danger delete-item"><i
                                                            class="fas fa-trash"></i></a>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        @foreach ($languages as $language)
            $("#table-{{ $language->id }}").dataTable({
                "columnDefs": [{
                    "sortable": false,
                    "targets": [2, 3]
                }]
            });
        @endforeach
    </script>
@endpush
