@extends('main')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('posts.index') }}"> Назад</a>
                <a class="btn btn-success" href="{{ route('posts.edit',$post->id)}}"> Изменить</a>
                <div class="float-right">
                    <form action="{{ route('posts.destroy', $post->id) }}"  method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger"> Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <br>
                <h4>{{ $post->title}}</h4>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <p>{{ $post->text}}</p>
            </div>
        </div>
    </div>

    <div class="row pb-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="list-group small col-xl-3 col-lg-4 col-md-6">
                <div class="list-group-item active">
                    Просмотрено в:
                </div>
                @foreach($views as $view)
                <div class="list-group-item">
                    {{$view->created_at}}
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

