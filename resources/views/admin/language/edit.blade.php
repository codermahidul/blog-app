@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Language') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Edit Language') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.language.update',$language->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="language">{{ __('Language') }}</label>
                        <select name="language" id="language" class="form-control select2">
                            <option value="">{{ __('--Select Language--') }}</option>
                            @foreach (config('language') as $key => $lang)
                                <option @if($language->language == $lang['name']) selected @endif value="{{ $key }}">{{ $lang['name'] }}</option>
                            @endforeach
                        </select>
                        @error('language')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="name" id="name" class="form-control" value="{{ $language->language }}">
                    </div>
                    <div class="form-group">
                        <label for="slug">{{ __('Slug') }}</label>
                        <input readonly type="text" name="slug" id="slug" class="form-control" value="{{ $language->slug }}">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="default">{{ __('Is it default?') }}</label>
                        <select name="default" id="default" class="form-control">
                            <option @if($language->default == '0') selected @endif value="0">{{ __('No') }}</option>
                            <option @if($language->default == '1') selected @endif value="1">{{ __('Yess') }}</option>
                        </select>
                        @error('default')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">{{ __('Status') }}</label>
                        <select name="status" id="status" class="form-control">
                            <option @if($language->status == 'active') selected @endif value="active">{{ __('Active') }}</option>
                            <option @if($language->status == 'inactive') selected @endif value="inactive">{{ __('Inactive') }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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
