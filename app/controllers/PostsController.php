<?php

use Scu\Models\Post;
use Scu\Forms\PostForm;
use Scu\Forms\FormValidationException;

//TODO: CREATE POST FORM

class PresentationsController extends BaseController
{
    protected $postForm;

    public function __construct(PostForm $postForm)
    {
        $this->postForm = $postForm;
    }

    /**
     * TODO
     *
     * @return Response
     */
    public function datatables()
    {

    $query = Presentation::select('id','owner_id','title', 'description', 'public', 'locked', 'config', 'view_count', 'created_at')->get();
    return Datatable::collection($query)
        ->addColumn('title', function($model){
            return ucFirst($model->title);
        })
        ->addColumn('description', function($model){
            return $model->description;
        })
        ->addColumn('owner_id', function($model){
            return $model->owner_id;
        })
        ->addColumn('public', function($model){
            return $model->public;
        })
        ->addColumn('locked', function($model){
            return $model->locked;
        })
        ->addColumn('config', function($model){
            return $model->config;
        })
        ->addColumn('view_count', function($model){
            return $model->view_count;
        })
        ->addColumn('created_at', function($model){
            return date('M j, Y h:i A', strtotime($model->created_at));
        })
        ->addColumn('id', function($model){
            return '<a href="/presentations/' . $model->id . '">view</a>';
        })
        ->searchColumns('title')
        ->orderColumns('title', 'description')
        ->make();
    }

    /**
     * Returns a paginated list of posts
     *
     * @return Response
     */
    public function index()
    {

        //$user = Auth::user();

        //$searchTagSlugs = Black\Tagging\TaggingUtil::makeTagSlugArray(Input::get('tags'));
        //$searchTagNames = Black\Tagging\TaggingUtil::makeTagArray(Input::get('tags'));
        //$tagTitleString = '';

        //$data['user']                   = $user;

        $data['posts'] = Posts::all();

        // if (Input::get('tags')) {
        //     $data['presentations'] = $data['presentations']->filter(function($presentation) use($searchTagSlugs)
        //         {
        //             $tags = $presentation->tagSlugs();
        //             $matchingTags = array_intersect($tags, $searchTagSlugs);
        //             return (bool) $matchingTags;
        //         });

        //     $tagList = array_map('\Str::title', $searchTagNames);
        //     for ($i = 0, $len = count($tagList); $i < $len; $i++ )
        //     {
        //         $tagTitleString .= '"'. $tagList[$i] .'"';
        //         if ($i < ($len-2)){
        //             $tagTitleString .= ', ';
        //         }
        //         if ($i == ($len-2)){
        //             $tagTitleString .= ' or ';
        //         }
        //     }
        // }

        // //paginate the results manually
        // $page = 1;
        // if( !empty(Input::get('page') ) ){
        //     $page = Input::get('page');
        // }

        // $perPage = 5;
        // $offset = (($page-1) * $perPage);
        // $paginator = Paginator::make($data['presentations']->slice($offset,$perPage,true)->all(), $data['presentations']->count(), $perPage);

        // $data['panelTitle'] = "Showing " . $paginator->count() . " of " . $data['presentations']->count() . " Modules";

        // if ($tagTitleString) {
        //     $data['panelTitle'] .= " tagged with " . $tagTitleString;
        // }

        // $data['presentations'] = $paginator;

        return View::make('posts.list', $data);
    }

    /**
     * Display the Post create form
     *
     * @return Response
     */
    public function create()
    {
        return View::make('posts.create');
    }

    public function store()
    {
        try
        {
            $this->postForm->validate(Input::all());
        }
        catch(FormValidationException $e)
        {
            //set up flash error message
            Flash::error('There were errors. Please see below.');

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        $post = new Post;

        $post->fill(Input::all());

        $post->owner_id = Auth::user()->id;

        if (! $post->save() ){
            //set up flash error message
            Flash::error('There were errors. Please see below.');

            return Redirect::back()->withInput()->withErrors($post->getErrors());
        }

        Flash::success($post->title . ' Post Created!');

        return View::make('posts.view')->withPost($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return View::make('posts.view')->withPost($post);
    }

    /**
     * Display the Post edit form
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id)->withOwner();

        $delimitedTags = '';
        // foreach ($presentation->tagNames() as $tagName ){
        //     $delimitedTags .= $tagName . ', ';
        // }

        return View::make('posts.edit')->withPost($post);

        // return View::make('posts.edit')->withPost($post)->withToken(Session::get('apiKey')->key)->withDelimitedTags($delimitedTags);
    }

    /**
     * Update the Post
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        // dd(rtrim(Input::get('tags'), ', '));
        // dd(Input::get('tags'));
        try
        {
            $this->postForm->validate(Input::all());
        }
        catch(FormValidationException $e)
        {
            //set up flash error message
            Flash::error('There were errors. Please see below.');

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        //store function
        $post = Post::findOrFail($id);

        $post->fill(Input::all());

        if (! $post->save() ){
            //set up flash error message
            Flash::error('There were errors. Please see below.');

            return Redirect::back()->withInput()->withErrors($post->getErrors());
        }

        // if (Input::get('tags')){
        //     $presentation->retag(rtrim(Input::get('tags'), ', '));
        // } else {
        //     $presentation->untag();
        // }


        Flash::success($post->title . ' Post has been updated.');

        //return Redirect::route('presentations.view', array('id' => $presentation->id));
        return View::make('posts.view')->withPost($post);
    }

    public function destroy($id)
    {
        try {
            //get presentation
            $post = Post::findOrFail($id);

            //get member id
            $memberId = Auth::user()->id;

            //get owner id
            $owner = $post->owner;

            //if user is not owner, return unauthorized
            if( ! ($owner->id === $memberId)){
                Flash::error('<strong>Whoops!</strong> Only the owner can delete the post.');

                return Redirect::back()->withInput();
            }

            $post->delete();

            Flash::success('Post: ' . '"' . $post->title . '"' . ' has been deleted.<a class = "alert-link" href="'. action('PostsController@restore', $post->id) . '"> Undo </a>');

            return Redirect::route('posts.list');

        } catch (ModelNotFoundException $e) {
            return $this->response->errorNotFound();
        }
    }

    public function restore($id)
    {

        $post = Post::onlyTrashed()->where('id', $id)->first();

        if ( ! $post ) {
            $post = post::findOrFail($id);

            Flash::error('post: "' . $post->title . '" was not deleted and is available to view.');
            return Redirect::route('posts.list');
        }

        Flash::success('Post: "' . $post->title . '" has been restored.');
        return View::make('posts.view')->withPost($post);
    }

    /**
     * Create a duplicate of the post
     *
     * @return post
     */
    public function duplicate($id)
    {
        //find the post
        $originalPost = Post::find($id);

        if ($originalPost) {
            $newPost = $originalPost->replicate(array('id', 'created_at', 'updated_at', 'deleted_at'));
        }

        $newPost->title = 'Copy of ' . $originalPost->title;
        $newPost->owner_id = Auth::user()->id;

        if (! $newPost->save() ){
            //set up flash error message
            Flash::error('There were errors. Please see below.');

            return Redirect::back()->withInput()->withErrors($newPost->getErrors());
        }

        Flash::success($newPost->title . ' Created!');

        return View::make('posts.view')->withPost($post);
    }

    // public function tag($id) {
    //     $tags = Input::get('tags');
    //     $post = Post::findOrFail($id);

    //     $post->tag($tags);
    // }

}