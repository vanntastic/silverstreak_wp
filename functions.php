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
      $title_content = bloginfo('name'); wp_title('|'); pageGetPageNo(); 
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
  if (is_array($files)) {
   for ($i=0; $i < count($files); $i++) { 
     $js_link .= "<script type='text/javascript'";
     $js_link .= " src='javascripts/" . $files[$i] . ".js'></script>\n";
   }
  } else {
    $js_link .= "<script type='text/javascript'";
    $js_link .= " src='javascripts/" . $files . ".js'></script>\n";
  }
  echo $js_link;
}

?>


