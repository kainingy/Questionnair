<?php

use Illuminate\Support\Facades\URL;

class Questionnair extends Eloquent {

	/**
	 * Delete
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Delete the questions
		$this->questions()->delete();

		// Delete the questionnair
		return parent::delete();
	}

	/**
	 * Returns a formatted Questionnair entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	//public function content()
	//{
	//	return nl2br($this->content);
	//}

	/**
	 * Get the Questionnair's author.
	 *
	 * @return User
	 */
	public function author()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/**
	 * Get the Questions
	 *
	 * @return array
	 */
	public function questions()
	{
		return $this->hasMany('Question');
	}

    /**
     * Get the date created.
     *
     * @param \Carbon|null $date
     * @return string
     */
    public function date($date=null)
    {
        if(is_null($date)) {
            $date = $this->created_at;
        }

        return String::date($date);
    }

	/**
	 * Get the URL.
	 *
	 * @return string
	 */
	public function url()
	{
		return Url::to($this->slug);
	}

	/**
	 * Returns the date of creation,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function created_at()
	{
		return $this->date($this->created_at);
	}

	/**
	 * Returns the date of last update,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function updated_at()
	{
        return $this->date($this->updated_at);
	}

}
