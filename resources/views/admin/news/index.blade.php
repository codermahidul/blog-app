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
                                $allNews = \App\Models\News::with('category', 'admin')
                                    ->where('language', $language->slug)
                                    ->latest()
                                    ->get();
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
                                                <th>{{ __('Breaking') }}</th>
                                                <th>{{ __('Slider') }}</th>
                                                <th>{{ __('Popular') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allNews as $news)
                                                <tr>
                                                    <td>{{ ++$loop->index }}</td>
                                                    <td>
                                                        <img width="100" src="{{ asset($news->thumbnail) }}"
                                                            alt="">
                                                    </td>
                                                    <td>{{ $news->category->name }}</td>
                                                    <td>
                                                        {{ $news->admin->name }}
                                                    </td>
                                                    <td>
                                                        {{ $news->title }}
                                                    </td>
                                                    <td>
                                                        <label class="custom-switch mt-2">
                                                            <input {{ $news->is_breaking_news == 'yes' ? 'checked' : '' }}
                                                                type="checkbox" data-name="is_breaking"
                                                                data-id ="{{ $news->id }}"
                                                                class="custom-switch-input toggleStatus">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="custom-switch mt-2">
                                                            <input {{ $news->show_at_slider == 'yes' ? 'checked' : '' }}
                                                                type="checkbox" class="custom-switch-input toggleStatus"
                                                                data-id="{{ $news->id }}" data-name="show_at_slider">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="custom-switch mt-2">
                                                            <input {{ $news->show_at_popular == 'yes' ? 'checked' : '' }}
                                                                type="checkbox" data-id="{{ $news->id }}"
                                                                data-name="show_at_popular"
                                                                class="custom-switch-input toggleStatus">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="custom-switch mt-2">
                                                            <input {{ $news->status == 'active' ? 'checked' : '' }}
                                                                type="checkbox" data-id="{{ $news->id }}"
                                                                data-name="status" class="custom-switch-input toggleStatus">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </td>
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
                }],
                // "order": [[0,'desc']]
            });
        @endforeach

        //Start jQuer

        //     $(document).ready(function(){
        //         $('.toggleStatus').on('click', function(){
        //            let id = $(this).data('id');
        //            let name = $(this).data('name');
        //            let status = $(this).prop('check') ? 1 : 0;

        //            //ajax request
        //            $.ajax({
        //             method: 'GET',
        //             url: '{{ route('admin.toggleNewsStatus') }}',
        //             data: {
        //                 id:id,
        //                 name:name,
        //                 status: status,
        //             }
        //         })
        //     })
        // )}

        $(document).ready(function() {
            $('.toggleStatus').on('click', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let status = $(this).prop('checked');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.toggleNewsStatus') }}",
                    data: {
                        id: id,
                        name: name,
                        status: status,
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            Toast.fire({
                                icon: "success",
                                title: data.message,
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })

            })
            //End
        });
    </script>
@endpush
