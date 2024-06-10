@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Language') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Languages') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.language.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create New') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>{{ __('Language Name') }}</th>
                                <th>{{ __('Language Code') }}</th>
                                <th>{{ __('Default') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($languages as $language)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $language->language }}</td>
                                    <td>{{ $language->slug }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $language->default == 1 ? 'primary' : 'warning' }}">{{ $language->default == 1 ? 'Default' : 'No' }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $language->status == 'active' ? 'success' : 'danger' }}">{{ $language->status }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.language.edit', $language->id) }}"
                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>

                                        <a href="{{ route('admin.language.destroy', $language->id) }}"
                                            class="btn btn-danger delete-item"><i
                                                class="fas fa-trash"></i></a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>{{ __('No language found!') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>
@endpush
