@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Language') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Create Language') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.language.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="language">Language</label>
                        <select name="language" id="language" class="form-control select2">
                            <option value="">--Select Language--</option>
                            @foreach (config('language') as $key => $lang)
                                <option value="{{ $key }}">{{ $lang['name'] }}</option>
                            @endforeach
                        </select>
                        @error('language')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input readonly type="text" name="slug" id="slug" class="form-control">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="default">Is it default?</label>
                        <select name="default" id="default" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yess</option>
                        </select>
                        @error('default')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#language').on('change', function() {
                let value = $(this).val();
                let name = $(this).children(':selected').text();
                $('#slug').val(value);
                $('#name').val(name);
            })
        })
    </script>
@endpush
