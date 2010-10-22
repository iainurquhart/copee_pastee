<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Copee Pastee Fieldtype for ExpressionEngine 2
 *
 * @package		ExpressionEngine
 * @subpackage	Fieldtypes
 * @category	Fieldtypes
 * @author    	Iain Urquhart <shout@iain.co.nz>
 * @copyright 	Copyright (c) 2010 Iain Urquhart
 * @license   	http://creativecommons.org/licenses/MIT/  MIT License
*/

	class Copee_pastee_ft extends EE_Fieldtype
	{
		var $info = array(
			'name'		=> 'Copee Pastee',
			'version'	=> '1.2'
		);

		public function Copee_pastee_ft()
		{
			parent::EE_Fieldtype();

			$this->EE->lang->loadfile('copee_pastee');

			$this->EE =& get_instance();

			if (! isset($this->EE->session->cache['matrix']['celltypes']['copee_pastee']))
			{
				$this->EE->session->cache['matrix']['celltypes']['copee_pastee'] = array();
			}
			$this->cache =& $this->EE->session->cache['matrix']['celltypes']['copee_pastee'];
		}

		function display_cell($data)
		{

			$theme_url = $this->EE->config->item('theme_folder_url');
			// have we outputted the assets already, if not add css/gfx/js etc to foot
			if (! isset($this->cache['displayed']))
			{
				// include matrix_text.js
				$this->EE->cp->add_to_foot('<script src="'.$theme_url.'third_party/copee_pastee_assets/js/ZeroClipboard.js" type="text/javascript"></script>');
				$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$theme_url.'third_party/copee_pastee_assets/js/jquery.livequery.js"></script>');
			 	$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$theme_url.'third_party/copee_pastee_assets/js/copee_pastee_functions.js"></script>');
			 	$this->EE->cp->add_to_foot('<link rel="stylesheet" href="'.$theme_url.'third_party/copee_pastee_assets/css/copee_pastee_style.css" type="text/css" media="screen" />');
			 	$this->EE->cp->add_to_foot('
			 	<script type="text/javascript">
			 		ZeroClipboard.setMoviePath("'.$theme_url.'third_party/copee_pastee_assets/ZeroClipboard.swf");
			 	</script>
			 	');
				$this->cache['displayed'] = TRUE;
			}

			$r = '<div class="copee-notification"><img src="'.$theme_url.'third_party/copee_pastee_assets/gfx/tick.png" /></div>';
			$r .= '<div class="clipboard row-counter">';
		 	$r .= '{';
		 	$r .= $this->settings['label'];
		 	$r .= '<span></span>';
		 	$r .= '</div>';

			// matrix having a spaz if nothing passed, so whack a hidden input in there
			// see http://help.pixelandtonic.com/brandonkelly/topics/matrix_with_empty_p_t_radio_buttons_throwing_php_errors
		 	$r .= form_hidden($this->cell_name);

			return $r;
		}

		function display_cell_settings($data)
		{
			if (! isset($data['label'])) $data['label'] = 'image-';
			return array(
				array(lang('label'), form_input('label', $data['label'], 'class="matrix-textarea"'))
			);
		}

		public function replace_tag($data, $params = FALSE, $tagdata = FALSE)
		{
			//nothing
		}
		
		public function save($data)
		{
			return $data;
		}
		
		public function validate($data)
		{
			return TRUE;
		}
		
		public function save_settings($data)
		{
			return array();
		}

		public function display_settings($data)
		{
			//nothing
		}

		function install()
		{
			//nothing
		}

		function unsinstall()
		{
			//nothing
		}
	}
	//END CLASS

/* End of file ft.copee_pastee.php */