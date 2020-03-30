@extends('main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <h4>Редактирование поста</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('posts.update', [$post]) }}" class="form-horizontal" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title"> Заголовок  </label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}"/>
                </div>

                <div class="form-group">
                    <label for="text"> Содержание </label>
                    <textarea class="form-control" id="text" name="text">{{$post->text }}</textarea>
                </div>

                <div class="form-group">
                    <label for="author">Автор</label>
                    <select id="author" name="author_id" class="form-control col-sm-4">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}"
                                @if($author->id === $post->author_id) selected @endif
                            >{{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <a class="btn btn-primary" href="{{ route('posts.show',$post->id) }}"> Назад</a>
                @method('PUT')
                <button type="submit" class="btn btn-success">
                    Сохранить
                </button>

            </form>
        </div>
    </div>

@endsection
