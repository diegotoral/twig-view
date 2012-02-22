<?php defined('SYSPATH') or die('No direct script access.');

class Twig
{
    /**
     * @var Twig_Environment instance.
     */
    protected static $_instance;
    
    protected $_config;
    
    protected $_environment;
    
    public static function instance(array $config = NULL)
    {
        if ( ! isset(Twig::$_instance))
        {
            if ($config === NULL)
            {
                // Load configuration
                $config = Kohana::$config->load('twig');
            }
            
            Twig::$_instance = new Twig($config);
        }
        
        return Twig::$_instance;
    }
    
    /**
     * Constructor
     */
    final private function __construct($config = array())
    {
        $this->_config = $config;
        
        // Initialize Twig loader and environment
        $loader = new Twig_Loader_Filesystem(Kohana::include_paths());
        $this->_environment = new Twig_Environment($loader, $config->options);
        
        foreach ($config->extensions as $extension)
        {
            $this->_environment->addExtension(new $extension);
        }
    }
    
    public function render($file, $data)
    {
        if ($this->_config->helpers)
        {
            $context = $this->_config->helpers;
        }
        
        $context += $data;
        $file = $this->_config->templates_dir.'/'.$file.'.'.$this->_config->sufix;
        $template = $this->_environment->loadTemplate($file);
        
        return $template->render($context);
    }
}
