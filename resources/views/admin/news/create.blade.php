@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('News') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Create News') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="category">{{ __('Category') }}</label>
                        <select name="category" id="category" class="form-control select2">

                        </select>
                        @error('category')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                            <input type="file" name="thumbnail" id="image-upload">

                        </div>
                        @error('thumbnail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" name="title" id="title" class="form-control">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">{{ __('Content') }}</label>
                        <textarea name="content" id="content" class="summernote"></textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tags">{{ __('Tags') }}</label>
                        <input type="text" name="tags" id="tags" class="form-control inputtags">
                        @error('tags')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meta_title">{{ __('Meta Title') }}</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control">
                        @error('meta_title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meta_description">{{ __('Meta Description') }}</label>
                        <textarea name="meta_description" id="meta_description" class="form-control"></textarea>
                        @error('meta_description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">{{ __('Status') }}</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="status" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">{{ __('Is Breaking News?') }}</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="is_breaking_news" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">{{ __('Show at Slider?') }}</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="show_at_slider" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">{{ __('Show at Popular?') }}</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="show_at_popular" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create News') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            //Fatch category by ajax
            $('#language').on('change', function() {
                let value = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.fatchCategory') }}",
                    data: {
                        language: value,
                    },
                    success: function(data) {
                        $('#category').html("");
                        $('#category').html(
                            "<option value=''>{{ __('--Select Category--') }}</option>");

                        $.each(data, function(index, data) {
                            $('#category').append(
                                `<option value='${data.id}'>{{ __('${data.name}') }}</option>`
                                );
                        })
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            })
        })
    </script>
@endpush
