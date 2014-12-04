<?php

class AdminQuestionnairsController extends AdminController {


    /**
     * Model
     * @var Questionnair
     */
    protected $questionnair;

    /**
     * Inject the models.
     * @param Questionnair $questionnair
     */
    public function __construct(Post $questionnair)
    {
        parent::__construct();
        $this->questionnair = $questionnair;
    }

    /**
     * Show a list
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/questionnairs/title.questionnair_management');

        // Grab all the questionnair
        $questionnairs = $this->questionnair;

        // Show the page
        return View::make('admin/questionnairs/index', compact('questionnairs', 'title'));
    }

	/**
	 * Show the form for creating a new one
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/questionnairs/title.create_a_new_questionnair');

        // Show the page
        return View::make('admin/questionnairs/create_edit', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            //'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create
            $user = Auth::user();

            // Update 
            $this->questionnair->title            = Input::get('title');
            $this->questionnair->slug             = Str::slug(Input::get('title'));
            $this->questionnair->user_id          = $user->id;

            // Was the created?
            if($this->questionnair->save())
            {
                // Redirect to the new page
                return Redirect::to('admin/questionnairs/' . $this->questionnair->id . '/edit')->with('success', Lang::get('admin/questionnairs/messages.create.success'));
            }

            // Redirect to the create page
            return Redirect::to('admin/questionnairs/create')->with('error', Lang::get('admin/questionnairs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/questionnairs/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $questionnair
     * @return Response
     */
	public function getShow($questionnair)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $questionnair
     * @return Response
     */
	public function getEdit($questionnair)
	{
        // Title
        $title = Lang::get('admin/questionnairs/title.questionnair_update');

        // Show the page
        return View::make('admin/questionnairs/create_edit', compact('questionnair', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $questionnair
     * @return Response
     */
	public function postEdit($questionnair)
	{

        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the blog post data
            $questionnair->title            = Input::get('title');
            $questionnair->slug             = Str::slug(Input::get('title'));

            // Was the blog post updated?
            if($questionnair->save())
            {
                // Redirect to the new blog post page
                return Redirect::to('admin/questionnairs/' . $questionnair->id . '/edit')->with('success', Lang::get('admin/questionnairs/messages.update.success'));
            }

            // Redirect to the blogs post management page
            return Redirect::to('admin/questionnairs/' . $questionnair->id . '/edit')->with('error', Lang::get('admin/questionnairs/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/questionnairs/' . $questionnair->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $questionnair
     * @return Response
     */
    public function getDelete($questionnair)
    {
        // Title
        $title = Lang::get('admin/questionnairs/title.questionnair_delete');

        // Show the page
        return View::make('admin/questionnairs/delete', compact('questionnair', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $questionnair
     * @return Response
     */
    public function postDelete($questionnair)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $questionnair->id;
            $questionnair->delete();

            // Was the blog post deleted?
            $questionnair = Post::find($id);
            if(empty($questionnair))
            {
                // Redirect to the blog posts management page
                return Redirect::to('admin/questionnairs')->with('success', Lang::get('admin/questionnairs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog post
        return Redirect::to('admin/questionnairs')->with('error', Lang::get('admin/questionnairs/messages.delete.error'));
    }
}