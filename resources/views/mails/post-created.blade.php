<div>
    <h1>Hurmatli {{ $post->user->name }}!</h1>
    <h5> Siz {{ $post->created_at }} da yangi post yaratdingiz.</h5>
    <p>Post ID:  {{  $post->id }}</p>
    <p>{{ $post->title }}</p>
    <p>{{ $post->short_content }}</p>
    <p>{{ $post->content }}</p>
    <strong>Rahmat!</strong>
</div>