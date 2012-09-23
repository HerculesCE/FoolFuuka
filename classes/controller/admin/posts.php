<?php

namespace Foolfuuka;

class Controller_Admin_Posts extends \Controller_Admin
{

	public function before()
	{
		parent::before();

		if ( ! \Auth::has_access('comment.reports'))
		{
			\Response::redirect('admin');
		}

		$this->_views['controller_title'] = __('Posts');
	}

	public function action_reports()
	{
		$this->_views['method_title'] = __('Reports');

		$theme = \Theme::forge('foolfuuka');
		$theme->set_module('foolfuuka');
		$theme->set_theme($theme);
		$theme->set_layout('chan');
		$theme->bind('modifiers', array(
			'post_show_board_name' => true,
			'post_show_view_button' => true
		));

		$reports = \Report::get_all();

		foreach ($reports as $key => $report)
		{
			foreach ($reports as $k => $r)
			{
				if ($key < $k && $report->doc_id === $r->doc_id && $report->board_id === $r->board_id)
				{
					unset($reports[$k]);
				}
			}
		}

		$pass = \Cookie::get('reply_password');
		$name = \Cookie::get('reply_name');
		$email = \Cookie::get('reply_email');

		// get the password needed for the reply field
		if(!$pass || $pass < 3)
		{
			$pass = \Str::random('alnum', 7);
			\Cookie::set('reply_password', $pass, 60*60*24*30);
		}

		// KEEP THIS IN SYNC WITH THE ONE IN THE CHAN CONTROLLER
		$backend_vars = array(
			'user_name' => $name,
			'user_email' => $email,
			'user_pass' => $pass,
			'site_url'  => \Uri::base(),
			'default_url'  => \Uri::base(),
			'archive_url'  => \Uri::base(),
			'system_url'  => \Uri::base(),
			'api_url'   => \Uri::base(),
			'cookie_domain' => \Config::get('foolframe.config.cookie_domain'),
			'cookie_prefix' => \Config::get('foolframe.config.cookie_prefix'),
			'selected_theme' => isset($this->_theme)?$this->_theme->get_selected_theme():'',
			'csrf_token_key' => \Config::get('security.csrf_token_key'),
			'images' => array(
				'banned_image' => \Uri::base() . 'content/themes/default/images/banned-image.png',
				'banned_image_width' => 150,
				'banned_image_height' => 150,
				'missing_image' => \Uri::base() . 'content/themes/default/images/missing-image.jpg',
				'missing_image_width' => 150,
				'missing_image_height' => 150,
			),
			'gettext' => array(
				'submit_state' => __('Submitting'),
				'thread_is_real_time' => __('This thread is being displayed in real time.'),
				'update_now' => __('Update now')
			)
		);

		$this->_views['main_content_view'] = \View::forge('foolfuuka::admin/reports/manage', array('backend_vars' => $backend_vars, 'theme' => $theme, 'reports' => $reports));
		return \Response::forge(\View::forge('admin/default', $this->_views));
	}


}

/* end of file posts.php */