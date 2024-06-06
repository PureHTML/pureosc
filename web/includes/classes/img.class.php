<?php
 /*
	iaTermark
	Created by Silvio Rainoldi
	www.ianaz.ch
 */
class img 
{	
	var $thumb_w = 172; // larghezza thumb
	var $thumb_h = 130; // altezza thumb
	var $max_w = 720; // larghezza max
	var $max_h = 540; // altezza max
	var $pos_x = "RIGHT"; // posizione logo
	var $pos_y = "BOTTOM"; // posizione logo
	var $img_folder = ""; // cartella immagine grande
	var $thumb_folder = ""; // cartella immagine thumb
	var $saveBIG = 1; //salvare immagine grande
	var $saveTHUMB = 1; //salvare thumb
	var $name = ""; //nome immagine senza estensione

	function AddLogo($image, $logo = NULL)
	{
		$this->im = $this->createImgage($image);
		$this->im_width = imagesx($this->im);
		$this->im_height = imagesy($this->im);
		$this->wt_x = $this->calc_pos_x($this->pos_x);
		$this->wt_y = $this->calc_pos_y($this->pos_y);
		$this->new_image = $this->resizeImg();
		
		$this->resizeForThumb();
		if ($logo != NULL) {
			$this->createTheLogo($logo);				
		}
		if ($this->name=="") {
			$this->name = substr($image, 0 , strrpos($image, "."));
		}
		if ($this->saveBIG == 1) {
			imagepng($this->new_image, $this->img_folder.$this->name."_watermark.png");
		}
		if ($this->saveTHUMB == 1) {
			imagepng($this->thumb, $this->thumb_folder.$this->name."_small.png");
		}
		
	}
	
	function createImgage($image) {
		$type = strtolower(substr($image, strrpos($image, "."), strlen($image)-strrpos($image, ".")));
		if ($type==".jpeg" || $type==".jpg") {
			return imagecreatefromjpeg($image);
		} elseif ($type==".gif") {
			return imagecreatefromgif($image);
		} elseif ($type==".png") {
			return imagecreatefrompng($image);
		} else {
			die("NOT VALID IMAGE !");
		}
	}
	
	function createTheLogo($logo)
	{
		$this->logo = $this->createImgage($logo);
		$this->logo_width = imagesx($this->logo);
		$this->logo_height = imagesy($this->logo);
		$this->wt_x = $this->calc_pos_x($this->pos_x);
		$this->wt_y = $this->calc_pos_y($this->pos_y);
		imagecopymerge($this->new_image, $this->logo, $this->wt_x, $this->wt_y, 0, 0, $this->logo_width, $this->logo_height, 100);
	}
        
        
	function resizeImg()
	{

		if($this->im_width > $this->max_w && $this->im_height < $this->max_h)
		{
		
			$rapporto = $this->max_w / $this->im_width;
			
			$this->new_im_w = $this->im_width * $rapporto;
			$this->new_im_h = $this->im_height * $rapporto;
			
		}
		
		else if($this->im_width < $this->max_w && $this->im_height > $this->max_h)
		{
		
			$rapporto = $this->max_h / $this->im_height;
			
			$this->new_im_w = $this->im_width * $rapporto;
			$this->new_im_h = $this->im_height * $rapporto;
		
		}
		else if($this->im_width > $this->max_w && $this->im_height > $this->max_h)
		{
		
			$rapporto_1 = $this->max_w / $this->im_width;
			$rapporto_2 = $this->max_h / $this->im_height;
				if($rapporto_1 > $rapporto_2)
				{
					$rapporto = $rapporto_2;
				}
				else
				{
					$rapporto = $rapporto_1;
				}
					
					$this->new_im_w = $this->im_width * $rapporto;
					$this->new_im_h = $this->im_height * $rapporto;
		
		}
		
		else
		{
			$this->new_im_w = $this->im_width;
			$this->new_im_h = $this->im_height;
		}
		
		$this->new_image = imagecreatetruecolor($this->new_im_w, $this->new_im_h);
		imagecopyresized($this->new_image, $this->im, 0, 0, 0, 0, $this->new_im_w, $this->new_im_h, $this->im_width, $this->im_height);
		
		return $this->new_image;

	}
        function resizeForThumb()
        {
		$thumb_w = $this->thumb_w;
		$thumb_h = $this->thumb_h;
		if($this->im_width > $this->im_height)
		{
			$rapporto = $this->im_height / $this->im_width;
			$thumb_h = $this->thumb_h * $rapporto;
			$thumb_w = $this->thumb_w * $rapporto;
		}	
		else if($this->im_width < $this->im_height)
		{
			$rapporto = $this->im_width / $this->im_height;
			$thumb_w = $this->thumb_w * $rapporto;
		}
		else
		{
			$thumb_w = $this->thumb_w;
			$thumb_h = $this->thumb_h;
		}
		$this->thumb = imagecreatetruecolor($thumb_w, $thumb_h);
		imagecopyresized($this->thumb, $this->new_image, 0, 0, 0, 0, $thumb_w, $thumb_h, $this->new_im_w, $this->new_im_h);

        }
		
	function calc_pos_x($position_x)
        {
		$x = 0;
		switch($position_x)
		{
			case 'LEFT':
			    $x = 0;
			    break;
			case 'CENTER':
			    $x = @$this->new_im_w / 2 - @$this->logo_width / 2;
			    break;
			case 'RIGHT':
			    $x = @$this->new_im_w - @$this->logo_width;
			    break;
			default:
			    $x = 0;
		}
            return $x;
        
        }
        
        function calc_pos_y($position_y)
        {
		$y = 0;
		switch($position_y)
		{
			case 'TOP':
			    $y = 0;
			    break;
			case 'MIDDLE':
			    $y = @$this->new_im_h / 2 - @$this->logo_height / 2;
			    break;
			case 'BOTTOM':
			    $y = @$this->new_im_h - @$this->logo_height;
			    break;
			default:
			    $y = 0;
		}
	return $y;
        
        }
        
}
    
?> 