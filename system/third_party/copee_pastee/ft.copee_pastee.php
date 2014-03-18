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

/**
 * < EE 2.6.0
 */
if ( ! function_exists('ee'))
{
	function ee()
	{
		static $EE;
		if ( ! $EE) $EE = get_instance();
		return $EE;
	}
}


class Copee_pastee_ft extends EE_Fieldtype
{
	var $info = array(
		'name'		=> 'Copee Pastee',
		'version'	=> '1.2.1'
	);

	// --------------------------------------------------------------------

	/**
	 * constructor
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		
		ee()->lang->loadfile('copee_pastee');

		if (! isset(ee()->session->cache['matrix']['celltypes']['copee_pastee']))
		{
			ee()->session->cache['matrix']['celltypes']['copee_pastee'] = array();
		}
		$this->cache =& ee()->session->cache['matrix']['celltypes']['copee_pastee'];
		$this->asset_path	= defined('URL_THIRD_THEMES') ? URL_THIRD_THEMES . '/copee_pastee/' : ee()->config->item('theme_folder_url') . '/third_party/copee_pastee/';
	}

	public function display_cell($data)
	{

		// have we outputted the assets already, if not add css/gfx/js etc to foot
		if (! isset($this->cache['displayed']))
		{
			// include matrix_text.js
			ee()->cp->add_to_foot('<script src="'.$this->asset_path.'js/ZeroClipboard.js" type="text/javascript"></script>');
		 	ee()->cp->add_to_foot('<script type="text/javascript" src="'.$this->asset_path.'js/copee_pastee_functions.js"></script>');
		 	ee()->cp->add_to_foot('<link rel="stylesheet" href="'.$this->asset_path.'css/copee_pastee_style.css" type="text/css" media="screen" />');
		 	ee()->cp->add_to_foot('
		 	<script type="text/javascript">
		 		ZeroClipboard.setMoviePath("'.$this->asset_path.'ZeroClipboard.swf");
		 	</script>
		 	');
			$this->cache['displayed'] = TRUE;
		}

		$r = '<div class="copee-notification"><img src="'.$this->asset_path.'gfx/tick.png" /></div>';
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

	public function display_cell_settings($data)
	{
		if (! isset($data['label'])) $data['label'] = 'image-';
		return array(
			array(lang('label'), form_input('label', $data['label'], 'class="matrix-textarea"'))
		);
	}

	public function display_field($data)
	{
	    //nothing
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
