<x-layouts.main>
    <x-slot:title>
        Postni o'zgartirish #{{ $post->id }}
        </x-slot>

        <x-page-header>
            Postni o'zgartirish #{{ $post->id }}
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

                    <form action="{{ route('posts.update', ['post'=>$post->id]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="control-group mb-4">
                            <input type="text" class="form-control p-4" name="title" value="{{ $post->title }}"
                                placeholder="Sarlavha" />

                            @error('title')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="control-group mb-4">
                            <textarea class="form-control p-4" rows="3" name="short_content"
                                placeholder="Qisqacha Mazmuni">{{ $post->short_content }}</textarea>

                            @error('short_content')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="control-group mb-4">
                            <textarea class="form-control p-4" rows="6" name="content"
                                placeholder="Ma'qola">{{ $post->content }}</textarea>

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

                        <div class="flex">
                            <button class="btn btn-success py-3 px-5" type="submit">
                                Saqlash
                            </button>
                            <a href="{{ route('posts.show', ['post'=>$post->id]) }}" class="btn btn-danger py-3 px-5">
                                Bekor qilish
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


</x-layouts.main>