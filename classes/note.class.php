<?php

class Note implements feedable
{
    protected $id;
    protected $feed_item_info;
    public $content;

    public static function storeFolder()
    {
        return 'note';
    }

    public static function contentIdPath($id)
    {
        return static::storeFolder().'/'.$id.'.txt';
    }

    protected static function getFreeId()
    {
        $id = 1;
        while(file_exists(static::contentIdPath($id)))
        {
            $id++;
        }
        return $id;
    }

    public function __construct($id = NULL)
    {
        if ($id !== NULL)
        {
            $this->id = (int) $id;
            $this->load();
        }
    }

    public function load()
    {
		if (file_exists(static::contentIdPath($this->id))) 
		{
			$content = file_get_contents(static::contentIdPath($this->id));
			$this->content = $content;
		}
		else
		{
			header("HTTP/1.0 404 Not Found");
			die("Такой Статьи не обнаружено");			
		}
    }

    public function save()
    {
        if ($this->id === NULL)
        {
            $id = static::getFreeId();
            $this->id = $id;
			$this->add_to_feed();
        }
        return file_put_contents(static::contentIdPath($this->id),$this->content);
    }

    public function feed_item()
    {
        return "<p>".$this->content."</p>";
    }	

    protected static function dataFile()
    {
        return 'feed.json';
    }
	
    public static function loadDataFile()
    {
		return json_decode(file_get_contents(static::dataFile()), true);
    }	

	protected static function className() 
	{
		return "Note";
	}
	
	public function add_to_feed()
	{
		$this->feed_item_info = static::loadDataFile();
		$this->feed_item_info[] = array(static::className(),$this->id);		
		return file_put_contents(static::dataFile(), json_encode($this->feed_item_info));
	}
}
