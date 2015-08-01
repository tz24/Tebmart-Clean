<?php
/*
Plugin Name: CP Image Resizer
Description: Custom Image Resizer for WordPress Themes
Version: 1.1
Author: Codestar


# Using - get_the_image('mod', 'id or url', 'width and height', 'timthumb true or false as optional');

get_the_image( 'id', get_post_thumbnail_id(), array(500,300) );
get_the_image( 'url', '1.jpg', array(500,300) );
*/
class CustomImageResizer{
   
	protected $width;
	protected $height;
	protected $src;
	protected $c_dir;
	protected $c_uri;
	protected $quality;
	protected $attachment_id;
	protected $metadata;
	protected $size_ext;
	protected $is_timthumb;
	protected $url;
	protected $path;
   
   public function __construct() {
   
      $uploads             = wp_upload_dir();
		$this->c_dir         = $uploads['path'].'/';
		$this->c_uri         = $uploads['url'].'/';
		$this->c_sdir        = $uploads['subdir'].'/';
		$this->c_bdir        = $uploads['basedir'];
		$this->c_burl        = $uploads['baseurl'];
		$this->quality       = 100;
		$this->is_timthumb   = (get_theme_option('advanced','timthumb')=='on')?true:false;

		$this->date          = $this->c_sdir;
	}
   
   /* resize picture by id */
   public function id($attachment_id, $size, $timthumb=false){

      /* get metadata by id */
      $this->attachment_id = $attachment_id;
      $this->metadata      = wp_get_attachment_metadata($attachment_id);
      
      /* autoheight */
      if( empty($size[1]) ){
			$size[1] = floor( ($this->metadata['height'] * $size[0]) / $this->metadata['width'] );
		}

      /* set width and height */
      $this->width         = $size[0];
		$this->height        = $size[1];
      
      /* is timthumb ? */
      if($this->is_timthumb || $timthumb){
         return $this->timthumb();
      }
      
      /* check resize dimessions */
      if ( $this->metadata['width'] <= $this->width || $this->metadata['height'] <= $this->height ) {
         $src_array = wp_get_attachment_image_src($this->attachment_id, 'full');
         return $src_array[0];
      }

      /* size name ext */
      $this->size_ext = "{$size[0]}x{$size[1]}";
      
      /* if have same sizes, return picture */
		if ( isset( $this->metadata['custom_sizes'][$this->size_ext] ) ){
         $date = $this->metadata['custom_sizes'][$this->size_ext]['date'];
         $date = (isset($date))?$date:'/2012/10/';
         $this->src = $this->c_burl.$date.$this->metadata['custom_sizes'][$this->size_ext]['file'];
		}
      
      /* check wordpress media for same size picture */
      if ( !empty($this->metadata['sizes']) ) {
         
         foreach ( $this->metadata['sizes'] as $_size => $data ) {
         
            if ( $data['width'] == $this->width && $data['height'] == $this->height ) {
					$src_array = wp_get_attachment_image_src($this->attachment_id, $_size);
					$this->src = $src_array[0];
				}
			}
         
		}
      
      /* run resize */
      if( !isset($this->src) ){
         
         /* if type is image */
         if ( !preg_match('!^image/!', get_post_mime_type( $this->attachment_id ))) {
            return T_IMG.'/file_exists.png';
         }
         
         /* get file for resize operation */
         $file = get_attached_file($this->attachment_id);
         $info = @getimagesize($file);
         
         /* check file type for is picture */
         if ( empty($info) || !in_array($info[2], array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))){
            return T_IMG.'/file_exists.png';
         }
         
         /* resize picture with wordpress image resize function */
         $resized_file = image_resize($file, $this->width, $this->height, true, $this->size_ext, $this->c_dir, $this->quality);
         
         if ( is_wp_error($resized_file) ){
            $src_array = wp_get_attachment_image_src($this->attachment_id, 'full');
            return $src_array[0];
         }
      
         /* save new picture size and file */
         $this->metadata['custom_sizes'][$this->size_ext] = array(
            'file'      => wp_basename($resized_file),
            'width'     => intval($this->width),
            'height'    => intval($this->height),
            'date'      => $this->date,
         );
         
         /* save on metadata */
         wp_update_attachment_metadata($this->attachment_id, $this->metadata);
         
			$this->src = $this->c_burl.$this->metadata['custom_sizes'][$this->size_ext]['date'].$this->metadata['custom_sizes'][$this->size_ext]['file'];
         
      }
      
      return $this->src;
      
   }
   
   public function url($url, $size, $timthumb=false){
      
      $this->url     = $url;
      $this->width   = $size[0];
      $this->height  = $size[1];
		
      /* is timthumb ? */
      if($this->is_timthumb || $timthumb){
         return $this->timthumb();
      }
      
      /* getting url informations */
      $url_info      = parse_url($url);
      
      /* checking url for external links */
      if(isset($url_info['host']) && preg_replace('/^www\./i', '', strtolower($url_info['host'])) != strtolower(preg_replace('/^www\./i', '', $_SERVER['HTTP_HOST']))){
			return $this->src = $url;
		}else{
			$this->path       = $this->get_image_path($url);
			$this->size_ext  = "{$size[0]}x{$size[1]}";
		}
     
      
      /* if url not external, retun resize */
      if($this->path){
         $info = pathinfo($this->path);
         $ext  = $info['extension'];
         $name = wp_basename($this->path, ".$ext");
         $filename = "{$name}-{$this->size_ext}.{$ext}";
         $dirname = ltrim($info['dirname'], '/\\').'/'.$filename;
         $cached_file = ABSPATH.$dirname;
         if(is_file($cached_file)){
            return $this->src = site_url($dirname);
         }
      }

      /* set absolute path */
      $path = ltrim($this->path, '/\\');
		$file = ABSPATH.$path;
      
      /* getting image size */
      if( function_exists('getimagesize') ){
         $image_data = @getimagesize($file);
         if ( $image_data[0] <= $this->width || $image_data[1] <= $this->height ) {
            return $this->url;
         }         
      }
      
      /* check file */
      if(!is_file($file)){ return T_IMG.'/file_exists.png'; }
      
      /* resize picture with wordpress image resize function */
      $resized_file = image_resize($file, $this->width, $this->height, true, $this->size_ext, $this->c_dir, $this->quality);
      
      if ( is_wp_error($resized_file) ){
			return $this->url;
		}
      
      return $this->c_uri . wp_basename($resized_file);

   }
  
   protected function timthumb(){
   
      /* timthumb resize image by id */
      if( isset($this->attachment_id) ){
         $out = wp_get_attachment_image_src($this->attachment_id, 'full');
         $src = $out[0];
      }
      
      /* timthumb resize image by url */
      if( isset($this->url) ){
         $src = $this->url;
      }
      
      /* getting width and height for timthumb resize operation */
 		$width = $this->width;
		$height = $this->height;
      $quality = $this->quality;
      
		return get_template_directory_uri().'/cache/timthumb.php?src='.get_option('siteurl').$this->get_image_path($src).((empty($height))?'':'&h='.$height).'&w='. $width .'&zc=1'.($quality?'&q='.$quality:'');
      
   }
   
   protected function get_image_path($src){
      
      /* fixing path for multisite */
      if(is_multisite()){
         
         global $blog_id;
         if( isset($blog_id) && $blog_id > 0 ){
         
            $image_path = explode('/files/', $src);
            if ( isset($image_path[1]) ) {
               return '/wp-content/blogs.dir/' . $blog_id . '/files/' . $image_path[1];
            }
         }
      }
      
      if(0 === strpos($src, get_option('siteurl'))){
         return str_replace(get_option('siteurl'), '', $src);
      }else{
         return $src;
      }
      
   }
   
}

function get_the_image($function){
   $custom_resizer = new CustomImageResizer;
   $args = array_slice( func_get_args(), 1 );
   return call_user_func_array(array( &$custom_resizer, $function ), $args );
}