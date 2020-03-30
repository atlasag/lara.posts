@extends('main')
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <span>{{ $message }}</span>
        </div>
    @endif

    <div class="row pb-1">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Новый пост</a>
            <form class="form-inline">
                <label  class="mr-sm-2" for="sortPosts">Популярность просмотров за:  </label>
                <select id="sortPosts" name="sortSelected" class="form-control col-sm-4">
                    @foreach($sortPosts as $key=>$value)
                        <option value="{{ $key }}"
                                @if($key == $sortSelected) selected @endif
                        >{{ $value }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary ml-sm-2">Применить</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 pb-2">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">Всего постов: {{ @count($posts)}} </a>

                @foreach($posts as $post)
                <div class="list-group-item">
                    <h4 class="list-group-item-heading">
                        <span class="badge badge-secondary badge-pill float-right">{{ $post->views}}</span>
                      <a href="/posts/{{ $post->id }}"> {{$post->title}} </a>
                    </h4>
                    <div class="row small">
                        <div class="col-sm-6 col-md-6">
                            Автор: {{ $post->name}}</br>
                            Id: {{ $post->id}}
                        </div>
                        <div class="col-sm-6 col-md-6">
                            Создан: {{ $post->created_at}}</br>
                            Изменен: {{ $post->updated_at}}
                        </div>
                    </div>
                </div>
                @endforeach

                <a href="#" class="list-group-item list-group-item-action active justify-content-between">Наверх</a>
            </div>
        </div>

        <div class="col-md-4 pb-2">
            <div class="list-group">
                <div class="list-group-item list-group-item-action active">
                    Авторы по популярности просмотров
                </div>

                @foreach($topAuthors as $author)
                <div class="list-group-item">
                    <span>{{$author->name}}</span>
                    <span class="float-right badge badge-secondary badge-pill"> {{$author->views}}</span>
                </div>
                @endforeach

                <a href="#" class="list-group-item list-group-item-action active justify-content-between">Наверх</a>
            </div>

        </div>
    </div>
@endsection
