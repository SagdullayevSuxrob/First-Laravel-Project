<x-layouts.main>
    <x-slot:title>
        Post Yaratish
        </x-slot>

        <x-page-header>
            Yangi Post Yaratish
        </x-page-header>


        <div class="container">
            <div class="w-50 py-4">
                <div class="contact-form">
                    <div id="success"></div>

                    {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif --}}

                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="control-group mb-4">
                            <input type="text" class="form-control p-4" name="title" value="{{ old('title') }}"
                                placeholder="Sarlavha" />

                            @error('title')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror

                        </div>

                        <label>Kategoriyalar</label>
                        <div class="control-group mb-4">
                            <select class="form-control" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label>Taglar</label>
                        <div class="control-group mb-4">
                            <select class="form-control" name="tags[]" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="control-group mb-4">
                            <textarea class="form-control p-4" rows="3" name="short_content"
                                placeholder="Qisqacha Mazmuni">{{ old('short_content') }}</textarea>

                            @error('short_content')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="control-group mb-4">
                            <textarea class="form-control p-4" rows="6" name="content"
                                placeholder="Ma'qola">{{ old('content') }}</textarea>

                            @error('content')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="control-group mb-4">
                            <input name="photo" type="file" class="form-control p-4" id="subject" placeholder="Rasm" />
                            @error('photo')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button class="btn btn-primary btn-block py-3 px-5" type="submit">
                                Saqlash
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


</x-layouts.main>