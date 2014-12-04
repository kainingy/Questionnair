<?php

class Question extends Eloquent {

	/**
	 * Get the Question's content.
	 *
	 * @return string
	 */
	public function content()
	{
		return $this->content;
	}

	/**
	 * Get the Question's Questionnair's.
	 *
	 * @return Questionnair
	 */
	public function questionnair()
	{
		return $this->belongsTo('Questionnair');
	}

