<?php

/*
 * cody@codybaker.org 2008-07-30
 */

/**
 * sfWidgetFormTextarea represents a textarea HTML tag.
 *
 * @package    symfony
 * @subpackage widget
 */
class sfWidgetFormRichTextEditorFCK extends sfWidgetForm
{
  /**
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->attributes = array_merge($this->attributes, $attributes);
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    //return $this->renderContentTag('textarea', self::escapeOnce($value), array_merge(array('name' => $name), $attributes));

    // we need to know the id for things the rich text editor
    // in advance of building the tag
    $id = isset($this->attributes['id']) ? $this->attributes['id'] : $name;

    $php_file = sfConfig::get('app_fck_editor').DIRECTORY_SEPARATOR.'fckeditor_php5.php';
   

    if (!is_readable(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.$php_file))
    {
      throw new sfConfigurationException('You must install FCKEditor to use this helper (see rich_text_fck_js_dir settings).');
    }

    // FCKEditor.php class is written with backward compatibility of PHP4.
    // This reportings are to turn off errors with public properties and already declared constructor
    $error_reporting = error_reporting(E_ALL);

    require_once(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.$php_file);

    // turn error reporting back to your settings
    error_reporting($error_reporting);

    $fckeditor           = new FCKeditor($name);
    $fckeditor->BasePath = sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/'.sfConfig::get('app_fck_js').'/';
    
    $fckeditor->Value    = $value;

    if (isset($this->attributes['width']))
    {
      $fckeditor->Width = $this->attributes['width'];
    }
    elseif (isset($this->attributes['cols']))
    {
      $fckeditor->Width = (string)((int) $this->attributes['cols'] * 10).'px';
    }

    if (isset($this->attributes['height']))
    {
      $fckeditor->Height = $this->attributes['height'];
    }
    elseif (isset($this->attributes['rows']))
    {
      $fckeditor->Height = (string)((int) $this->attributes['rows'] * 10).'px';
    }

    if (isset($this->attributes['tool']))
    {
      $fckeditor->ToolbarSet = $this->attributes['tool'];
    }

    if (isset($this->attributes['config']))
    {
      $fckeditor->Config['CustomConfigurationsPath'] = javascript_path($this->attributes['config']);
    }

    $content = $fckeditor->CreateHtml();
    

    // fix for http://trac.symfony-project.com/ticket/732
    // fields need to be of type text to be picked up by fillin. they are hidden by inline css anyway:
    // <input type="hidden" id="name" name="name" style="display:none" value="&lt;p&gt;default&lt;/p&gt;">
    $content = str_replace('type="hidden"','type="text"',$content);

    return $content;
  }

}
  ?>