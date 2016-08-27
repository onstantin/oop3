<?php

class News extends Note implements feedable
{
    public $title;

    public static function storeFolder()
    {
        return 'news';
    }

    public static function titleIdPath($id)
    {
        return static::storeFolder().'/title'.$id.'.txt';
    }

    public function load()
    {
		if (file_exists(static::titleIdPath($this->id)))
		{
			$title = file_get_contents(static::titleIdPath($this->id));
			$this->title = $title;			
		}   
		else
		{
			header("HTTP/1.0 404 Not Found");
			die("Такой Новости не обнаружено");			
		}		
		parent::load();
    }

    public function save()
    {
        $result = parent::save();
        if ($result)
        {
            return file_put_contents(static::titleIdPath($this->id),$this->title);
        }
        else
        {
            return $result;
        }
    }

    public function feed_item()
    {
        return "<h2>".$this->title."</h2>".parent::feed_item();
    }

	protected static function className() 
	{
		return "News";
	}
	
}
