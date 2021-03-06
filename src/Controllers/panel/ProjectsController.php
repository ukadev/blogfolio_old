<?php

namespace Ukadev\Blogfolio\Controllers\panel;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Ukadev\Blogfolio\Controllers\panel\PanelController as Controller;
use Ukadev\Blogfolio\Model\Post;
use Ukadev\Blogfolio\Model\PostsCategory;
use Ukadev\Blogfolio\Model\Project;
use Ukadev\Blogfolio\Model\ProjectsCategory;

class ProjectsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $projects = Project::get();

        return view('blogfolio::panel.projects.index', ['projects' => $projects]);
    }

    public function add()
    {
        $categories = ProjectsCategory::all();
        return view('blogfolio::panel.projects.add', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                'title' => 'required|max:100',
                'content' => 'required|max:255',
            ]);
        }Catch(ValidationException $e){
            return back();
        }
        $title = $request->get('title');
        $slug = $this->slugify($title);
        $content = $request->get('content');
        $timestaps = date("Y-m-d H:i:s");
        $category = $request->get('category');

        try{
            DB::table('works')->insert([
                'title' => $title,
                'slug' => $slug,
                'content' => $content,
                'category_id' => $category,
                'created_at' => $timestaps

            ]);
        }Catch(Exception $e){
            throw new Exception($e->getMessage());
        }
        return redirect()->route('blogAdmin');
    }

    public function edit($id)
    {
        $categories = PostsCategory::all();
        $post = DB::table('posts')->where('id', '=', $id)->first();
        return view('blogfolio::panel.post.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        if (empty($id) || is_null($id)){
            throw new Exception('Invalid Id');
        }
        try{
            $this->validate($request, [
                'title' => 'required|max:100',
                'content' => 'required|max:255',
                'user_id' => 'required|max:255',
            ]);
        }Catch(ValidationException $e){
            return back();
        }
        $title = $request->get('title');
        $slug = $this->slugify($title);
        $user = $request->get('user_id');
        $content = $request->get('content');
        $category = $request->get('category');

        try{
            DB::table('posts')->where('id' , '=', $id)->update([
                'user_id' => $user,
                'title' => $title,
                'slug' => $slug,
                'content' => $content,
                'category_id' => $category
            ]);
        }Catch(Exception $e){
            throw new Exception($e->getMessage());
        }
        return redirect()->route('blogAdmin');
    }

    public function delete($id)
    {
        if (empty($id) || is_null($id)){
            throw new Exception('Invalid Id');
        }
        try{
            Post::find($id)->delete();
        }Catch(Exception $e){
            throw new Exception($e->getMessage());
        }
        return back();
    }


    public function categoryShow()
    {
        $categories = ProjectsCategory::all();
        return view('blogfolio::panel.projectsCategory.index', ['categories' => $categories]);
    }
}