<?php

namespace App\Http\Controllers;

use App\Postview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;

class PostsController extends Controller
{
    private $sortPosts = [
        0       => 'Всё время',
        2       => 'Последние 2 часа',
        24*3    => 'Последние 3 дня',
        24*5    => 'Последние 5 дней',
        24*10   => 'Последние 10 дней',
        ];

    /**
     * Display a listing of posts and authors
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Получим выбранный пользователем вариант сортировки постов,
        // и определим метку времени для выборки просмотров и авторов
        $request = Request::capture();
        $lastView = ($request->sortSelected > 0) ? now()->subHours($request->sortSelected) : 0;

        // Возможно следующие запросы стоит перписать на ORM для наглядности,
        // а также вынести их в модели
        // но для экономии времени написал здесь на SQL

        // Выбираем все статьи, с учетом кол-ва просмотров
        $posts = DB::select('select p.*,  a.name,
                               (select count(pv.post_id) from postviews pv
                                where pv.post_id=p.id and pv.created_at >= :lastView
                                ) as views
                             from posts p
                              left join authors a on a.id=p.author_id
                             order by views desc, updated_at desc',
            ['lastView' =>$lastView]);

        // Выбираем всех автором, с учетом кол-ва просмотров их статей
        $topAuthors = DB::select('select a.*, count(p2.id) as views
                        from authors a
                           left join posts p on a.id = p.author_id
                            left join postviews p2 on
                                p.id = p2.post_id and
                                p2.created_at > :lastView
                        group by a.id
                        order by views desc',
            ['lastView' =>$lastView]);

        return view('posts.index')
            ->with(['posts' => $posts,
                    'topAuthors' => $topAuthors,
                    'sortPosts' => $this->sortPosts,
                    'sortSelected' => $request->sortSelected,
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Получим список авторов для выбора автора поста
        $authors = DB::table('authors')->get();

        return view('posts.create')->with('authors',$authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->text  = $request->text;
        $post->author_id = $request->author_id;
        $post->save();

        return redirect()->route('posts.index')
            ->with('success','Новый пост создан');
    }

    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Увеличиваем счетчик просмотров поста
        Post::addViewCounts($id);
        // Получаем поля для отображения поста
        $post = Post::find($id);
        $views = Postview::where("post_id",$id)->orderBy('created_at','desc')->get();

        return view('posts.show')
            ->with(['post' =>$post, 'views' => $views]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Получим список авторов для выбора автора поста
        $authors = DB::table('authors')->get();
        // Получим поля поста для предзаполнения формы
        $post = Post::find($id);

        return view('posts.edit')
            ->with(['post' => $post, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Post::find($id)->update($request->all());

        return redirect()->route('posts.index')
            ->with('success','Пост обновлен успешно ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Сначала удалим все просмотры поста
        Postview::where('post_id',$id)->delete();
        // Затем удалим сам пост
        Post::find($id)->delete();

        return redirect()->route('posts.index')
            ->with('success','Пост удален');
    }

}
