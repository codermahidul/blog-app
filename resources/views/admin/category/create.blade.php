@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Category') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Create Category') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="language">{{ __('Language') }}</label>
                        <select name="language" id="language" class="form-control select2">
                            <option value="">{{ __('--Select Language--') }}</option>
                            @foreach ($language as $lang)
                                <option value="{{ $lang->slug }}">{{ $lang->language }}</option>
                            @endforeach
                        </select>
                        @error('language')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" class="form-control">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">{{ __('Slug') }}</label>
                        <input readonly type="text" name="slug" id="slug" class="form-control">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="show_at_nav">{{ __('Show at Nav') }}</label>
                        <select name="show_at_nav" id="show_at_nav" class="form-control">
                            <option value="no">{{ __('No') }}</option>
                            <option value="yess">{{ __('Yes') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">{{ __('Status') }}</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active">{{ __('Active') }}</option>
                            <option value="inactive">{{ __('Inactive') }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                let value = $(this).val().toLowerCase().replace(/\s+/g, '-');
                $('#slug').val(value);
            })
        })
    </script>
@endpush
