<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Twig_View extends Kohana_View
{

    public static function factory($file = NULL, array $data = NULL)
    {
        return new Twig_View($file, $data);
    }
    
    protected static function capture($kotwig_view_filename, array $kotwig_view_data)
    {
        $context = $kotwig_view_data;
        
        if (Twig_View::$_global_data)
        {
            $context += Twig_View::$_global_data;
        }
        
        $twig = Twig::instance();
        
        // Load and render the template
        return $twig->render($kotwig_view_filename, $context);
    }
    
    public function __construct($file = NULL, array $data = NULL)
    {
        parent::__construct($file, $data);
    }
    
    public function set_filename($file)
    {
        $this->_file = $file;
        
        return $this;
    }
    
    public function render($file = NULL)
    {
        if ($file !== NULL)
        {
            $this->set_filename($file);
        }
        
        if (empty($this->_file))
        {
            throw new View_Exception('You must set the file to use within your view before rendering');
        }
        
        return Twig_View::capture($this->_file, $this->_data);
    }
}
