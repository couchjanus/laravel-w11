<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\StatusType;
use App\Entities\Article;
// use App\Repositories\ArticleRepository;

use App\Repositories\ArticleRepositoryInterface;

class ArticleController
{
   protected $model;

//    public function __construct(ArticleRepository $article)
//    {
//         $this->model = $article;
//    }
   
   public function __construct(ArticleRepositoryInterface $article)
   {
        $this->model = $article;
   }
   
   public function index()
   {
    $posts = $this->model->paginate(5);
    return view('articles.index')->withPosts($posts)->withTitle('Awesome Blog');       
   }

   public function store(Request $request)
   {
       $this->validate($request, [
           'title' => 'required|unique:posts|max:255',
           'content' => 'required',
       ]);

       // create record and pass in only fields that are fillable
       return $this->model->create($request->only($this->model->getModel()->fillable));
   }

   public function show($id)
   {
        $post = $this->model->find($id);
        return view('articles.show', ['post' => $post]);
   }

   public function update(Request $request, $id)
   {
       // update model and only pass in the fillable fields
       $this->model->update($request->only($this->model->getModel()->fillable), $id);

       return $this->model->find($id);
   }

   public function destroy($id)
   {
       return $this->model->delete($id);
   }
}