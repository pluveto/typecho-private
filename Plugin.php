<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 配合自定义字段功能实现指定内容仅注册会员可读。
 * 
 * @package Private
 * @author Pluveto
 * @version 1.0.0beta
 * @dependence 13.12.12-*
 * @link https://github.com/pluveto/typecho-private
 */
class Private_Plugin implements Typecho_Plugin_Interface
{
	/**
	 * 激活插件方法,如果激活失败,直接抛出异常
	 * 
	 * @access public
	 * @return void
	 * @throws Typecho_Plugin_Exception
	 */
	public static function activate()
	{
		Typecho_Plugin::factory('Widget_Archive')->beforeRender = array('Private_Plugin','filtcontent');
	}

	/**
	 * 禁用插件方法,如果禁用失败,直接抛出异常
	 * 
	 * @static
	 * @access public
	 * @return void
	 * @throws Typecho_Plugin_Exception
	 */
	public static function deactivate(){}

	/**
	 * 个人用户的配置面板
	 * 
	 * @access public
	 * @param Typecho_Widget_Helper_Form $form
	 * @return void
	 */
	public static function personalConfig(Typecho_Widget_Helper_Form $form){}

	/**
	 * 个人用户的配置面板
	 * 
	 * @access public
	 * @param Typecho_Widget_Helper_Form $form
	 * @return void
	 */
	public static function config(Typecho_Widget_Helper_Form $form){}

	/**
	 * 内容输出过滤
	 * 
	 * @access public
	 * @param string $content
	 * @return string
	 */
	public static function filtcontent()
	{
	    if(Typecho_Widget::widget('Widget_User')->hasLogin()){
	        return;
	    }
//		$loginUrl = Helper::options()->loginAction;
//		$siteUrl = Helper::options()->siteUrl;
?>
<html><body>Unauthorized.</body></html>
<?php
        header('HTTP/1.1 401 Unauthorized');
        exit();
		
	}

}
