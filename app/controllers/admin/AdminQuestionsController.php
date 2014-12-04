<?php

class AdminQuestionsController extends AdminController
{

    /**
     * Question Model
     * @var Question
     */
    protected $question;

    /**
     * Inject the models.
     * @param Question $question
     */
    public function __construct($question)
    {
        parent::__construct();
        $this->question = $question;
    }

    // *
     // * Show a list of all the question posts.
     // *
     // * @return View
     
    // public function getIndex()
    // {
    //     // Title
    //     $title = Lang::get('admin/questions/title.question_management');

    //     // Grab all the question posts
    //     $questions = $this->question;

    //     // Show the page
    //     return View::make('admin/questions/index', compact('questions', 'title'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $question
     * @return Response
     */
	public function getEdit($question)
	{
        // Title
        $title = Lang::get('admin/questions/title.question_update');

        // Show the page
        return View::make('admin/questions/edit', compact('question', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $question
     * @return Response
     */
	public function postEdit($question)
	{
        // Declare the rules for the form validation
        $rules = array(
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the question post data
            $question->content = Input::get('content');

            // Was the question post updated?
            if($question->save())
            {
                // Redirect to the new question post page
                return Redirect::to('admin/questions/' . $question->id . '/edit')->with('success', Lang::get('admin/questions/messages.update.success'));
            }

            // Redirect to the questions post management page
            return Redirect::to('admin/questions/' . $question->id . '/edit')->with('error', Lang::get('admin/questions/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/questions/' . $question->id . '/edit')->withInput()->withErrors($validator);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $question
     * @return Response
     */
	public function getDelete($question)
	{
        // Title
        $title = Lang::get('admin/questions/title.question_delete');

        // Show the page
        return View::make('admin/questions/delete', compact('question', 'title'));
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $question
     * @return Response
     */
	public function postDelete($question)
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
            $id = $question->id;
            $question->delete();

            // Was the question post deleted?
            $question = Comment::find($id);
            if(empty($question))
            {
                // Redirect to the question posts management page
                return Redirect::to('admin/questionnairs')->with('success', Lang::get('admin/questions/messages.delete.success'));
            }
        }
        // There was a problem deleting the question post
        return Redirect::to('admin/questionnairs')->with('error', Lang::get('admin/questions/messages.delete.error'));
	}

    // /**
    //  * Show a list of all the questions formatted for Datatables.
    //  *
    //  * @return Datatables JSON
    //  */
    // public function getData()
    // {
    //     $questions = Comment::leftjoin('posts', 'posts.id', '=', 'questions.post_id')
    //                     ->leftjoin('users', 'users.id', '=','questions.user_id' )
    //                     ->select(array('questions.id as id', 'posts.id as postid','users.id as userid', 'questions.content', 'posts.title as post_name', 'users.username as poster_name', 'questions.created_at'));

    //     return Datatables::of($questions)

    //     ->edit_column('content', '<a href="{{{ URL::to(\'admin/questions/\'. $id .\'/edit\') }}}" class="iframe cboxElement">{{{ Str::limit($content, 40, \'...\') }}}</a>')

    //     ->edit_column('post_name', '<a href="{{{ URL::to(\'admin/blogs/\'. $postid .\'/edit\') }}}" class="iframe cboxElement">{{{ Str::limit($post_name, 40, \'...\') }}}</a>')

    //     ->edit_column('poster_name', '<a href="{{{ URL::to(\'admin/users/\'. $userid .\'/edit\') }}}" class="iframe cboxElement">{{{ $poster_name }}}</a>')

    //     ->add_column('actions', '<a href="{{{ URL::to(\'admin/questions/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-default btn-xs">{{{ Lang::get(\'button.edit\') }}}</a>
    //             <a href="{{{ URL::to(\'admin/questions/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
    //         ')

    //     ->remove_column('id')
    //     ->remove_column('postid')
    //     ->remove_column('userid')

    //     ->make();
    // }

}
