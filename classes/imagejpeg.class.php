<?php

class ImageJpeg extends Note implements feedable
{
	public $url;
	public $upload;
	
    public static function storeFolder()
    {
        return 'img';
    }

    public static function contentIdPath($id)
    {
        return static::storeFolder().'/'.$id.'.jpg';
    }

    public function load()
    {
		return "<img src=\"".static::contentIdPath($this->id)."\">";
    }

    public function save()
    {
		parent::save();
		$content = file_get_contents($this->url);
        return file_put_contents(static::contentIdPath($this->id), $content);
    }
	
	public function uploadFile() 
	{
		return move_uploaded_file($this->upload, static::contentIdPath($this->id));	
	}

	protected static function className() {
		return "ImageJpeg";
	}	
	
    public function feed_item()
	{
		return "<p>".$this->load()."</p>";
	}	
	
	public function __get($field)
	{
		if ($field === 'format') return 'format';
		if ($field === 'size') return 'size';
		if ($field === 'date') return 'date';
	}
}
