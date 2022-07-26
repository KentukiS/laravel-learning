@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn-primary btn" href="{{ route('blog.admin.posts.create') }}"> Написать</a>
                </nav>
            </div>
        </div>
        <table>
            <thead>
                <tr>#</tr>
                <tr>Автор</tr>
                <tr>Категория</tr>
                <tr>Заголовок</tr>
                <tr>Дата публикации</tr>
            </thead>
            @foreach($paginator as $post)
                @php
                /** @var \App\Models\BlogPost $post */
                @endphp
                <tr @if(!$post->is_published) style="background-color: #ccc;" @endif>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->category->title }}</td>
                    <td>
                        <a href="{{ route('blog.admin.posts.edit',$post->id) }}">{{ $post->title }}</a>
                    </td>
                    <td>{{ $post->published_at }}</td>
                </tr>
            @endforeach
        </table>
        @if($paginator->total() > $paginator->count())
            <div>
                {{ $paginator->links() }}
            </div>
        @endif
    </div>
@endsection
