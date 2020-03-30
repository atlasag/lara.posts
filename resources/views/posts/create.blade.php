@extends('main')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
                <h4>Создание нового поста</h4>
        </div>
    </div>

    <form class="form-horizontal" method="POST" action="{{ route('posts.store') }}">
        @csrf

        <div class="row">
            <div class="col-sm-12">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('posts.index') }}"> Назад</a>
                    <button type="submit" class="btn btn-success"> Сохранить  </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="form-group">
                    <label for="title"> Заголовок  </label>
                    <input type="text" class="form-control" id="title" name="title"/>
                </div>

                <div class="form-group">
                    <label for="text"> Содержание </label>
                    <textarea class="form-control" id="text" name="text"></textarea>
                </div>

                <div class="form-group">
                    <label for="author">Автор</label>
                    <select id="author" name="author_id" class="form-control col-sm-4">
                        @foreach($authors as $author)
                          <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
    </form>

@endsection
