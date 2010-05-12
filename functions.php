<?php

if ( function_exists('register_sidebar') )
register_sidebar(array(
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',
));

// for sidebar.php if needed (remove the // below the if() statement)
// if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : endif;

// We're not going to use prototype / scriptaculous, so feel free to use your own!
remove_action( 'wp_head', 'wp_print_head_scripts', 9);

function page_title($content='')
{
   $title_content = '';
   if ( is_single() ) { single_post_title(); 
   } elseif ( is_home() ) { 
      $title_content = bloginfo('name'); print ' | '; bloginfo('description');
   } elseif ( is_page() ) { 
      $title_content = single_post_title(''); 
   } elseif ( is_search() ) { 
      $title_content = bloginfo('name'); print ' | Search results for ' . wp_specialchars($s);
   } elseif ( is_404() ) { 
      $title_content = bloginfo('name'); print ' | Not Found'; 
   } else { 
      $title_content = bloginfo('name'); wp_title('|');
   }
   
   echo "${content} : ${title_content}";
}

/* links to the js files in your javascripts directory
	 you can pass either a string or array of files... and it should
   include them all
   EXAMPLE:
     for multiple files
     include_js(array('jquery','app'));
     <link href='javascripts/jquery.js' ...
     <link href='javascripts/app.js' ...
     for single files
     include_css('app');
     <link href='javascripts/app.js' ... */

function include_js($files='')
{
  $js_link = '';
  $js_root = get_stylesheet_directory_uri() . "/js";
  
  if (is_array($files)) {
   for ($i=0; $i < count($files); $i++) { 
     $js_link .= "<script type='text/javascript'";
     $js_link .= " src='${js_root}/" . $files[$i] . ".js'></script>\n";
   }
  } else {
    $js_link .= "<script type='text/javascript'";
    $js_link .= " src='${js_root}/" . $files . ".js'></script>\n";
  }
  echo $js_link;
}

// google ajax api hook : include any js library you want courtesy of google!
// EXAMPLE:
//  Single Library
//    include_js_lib('jquery-1.3.2');
//  Multiple Libraries
//    include_js_lib('jquery-1.3.2','jqueryui-1.7.2');
// --
// Google Documentation : http://code.google.com/apis/ajaxlibs/documentation/index.html
function include_js_lib($libs='')
{
  $js_libs = '';
  $content = '<script src="http://www.google.com/jsapi"></script>';
  if (is_array($libs)) {
    for ($i=0; $i < count($libs); $i++) { 
      $_lib = split("-",$libs[$i]);
      $lib = $_lib[0];
      $_version = split("-",$libs[$i]);
      $version = $_version[1];
      $js_libs .= "google.load('${lib}','${version}');";
    }
  } else {
      $_lib = split("-",$libs);
      $lib = $_lib[0];
      $_version = split("-",$libs);
      $version = $_version[1];
      $js_libs = "google.load('${lib}','${version}');";
  }
  $output = $content;
  $output .= '<script type="text/javascript" charset="utf-8">';
  $output .= $js_libs;
  $output .= '</script>';
  echo $output;
}


/* links to the css files in your css directory
	 you can pass either a string or array of files... and it should
   include them all
   EXAMPLE:
     for multiple files
     include_css(array('default','reset'));
     # <link href='css/default.css' ...
     # <link href='css/reset.css' ...
     # for single files
     include_css('reset');
     # <link href='css/reset.css' ... 
     # for 960 css framework
     include_css('960')
     # for 960 css framework with 24 columns
     include_css('960-24')
*/

function include_css($files='')
{
  $css_link = '';
  $css_root = get_stylesheet_directory_uri() . "/css";
  if (is_array($files)) {
   for ($i=0; $i < count($files); $i++) { 
     $css_link .= "<link rel='stylesheet'";
     $css_link .= " href='${css_root}/" . $files[$i] . ".css' type='text/css'";
     $css_link .= " media='screen' />\n";
   }
  } elseif ($files == "960" || $files == "960-24") {
     $ns_files = array('reset','text');
     $cols_type = $files == "960-24" ? "960_24_col" : "960";
     array_push($ns_files, $cols_type);
     for ($i=0; $i < count($ns_files); $i++) { 
       $css_link .= "<link rel='stylesheet'";
       $css_link .= " href='${css_root}/960/code/css/" . $ns_files[$i] . ".css' type='text/css'";
       $css_link .= " media='screen' />\n";
     }
  } else {
    $css_link .= "<link rel='stylesheet'";
    $css_link .= " href='${css_root}/" . $files . ".css' type='text/css' media='screen' />\n";
  }
  echo $css_link;
}

/*

  Inserts an image from the image directory
  
  EX: image('sample.jpg') ;
      // with attributes
      image('sample.jpg', "alt='an image'");

*/

function image($filename='',$attrs='')
{
  $img_path = get_stylesheet_directory_uri() . "/images" . "/${filename}";
  $attrs = $attrs == '' ? "src='${img_path}'" : ("src='${img_path}' " . $attrs);
  output_single_tag('img',$attrs);
}

// write an html tag and return as a string:
// EX : tag('h1','Nice header','title="nice header" class="cool"')
// # => <h1 title="nice header" class="cool">Nice Header</h1>
function tag($name='',$content='',$attrs='')
{
  return "<${name} ${attrs}>${content}</${name}>";
}

// returns a self closing tag such as img or br
// EX : single_tag('img','src="images/google.jpg"');
// # => <img src="images/google.jpg" />
function single_tag($name='', $attrs='')
{
  return "<${name} ${attrs} />";
}

// echos a single tag output
// EX : output_single_tag('img','src="images/google.jpg"');
// # => <img src="images/google.jpg" />
function output_single_tag($name='', $attrs='')
{
  echo single_tag($name,$attrs);
}

// outputs the tag, can be used in your theme templates
// EX : output_tag('h1','Nice Header','title="nice header" class="cool"')
// # => echo <h1 title="nice header" class="cool">Nice Header</h1>
function output_tag($name='',$content='',$attrs='')
{
  echo tag($name,$content,$attrs);
}

// Original PHP code by Chirp Internet: www.chirp.com.au

function truncate($string, $limit, $break=".", $pad="...")
{
 // return with no change if string is shorter than $limit
 if(strlen($string) <= $limit) return $string;

 // is $break present between $limit and the end of the string?
 if(false !== ($breakpoint = strpos($string, $break, $limit))) {
   if($breakpoint < strlen($string) - 1) {
     $string = substr($string, 0, $breakpoint) . $pad;
   }
 }

 return $string;
}

// TODO : add this to the documentation and add the tags method form wp_template
// alias for $_SERVER['HTTP_HOST']
function domain()
{
  return $_SERVER['HTTP_HOST'];
}

?>