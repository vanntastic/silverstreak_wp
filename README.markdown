Silverstreak WP
===============

This is a stripped down blank theme, meant to be used as a parent theme. It includes alot of functions borrowed
from the silverstreak mini framework: http://github.com/vanntastic/silverstreak. I felt that alot of the wordpress functions could be more simplified and easier to use. This theme attempts to be pragmatic and allows you to keep your code elegant. It also makes assumptions for you, so you don't have to worry about trivial things such as where your images, js, or css directories are.

Dependencies
============

- Rake (if you want to use the setup task) : http://rake.rubyforge.org/


Usage and Installation
======================

1. Clone the git repo into your wordpress theme directory
    
        git clone git@github.com:vanntastic/silverstreak_wp.git /path/to/your/wp-site/wp-content/themes/silverstreak_wp
      
2. Cd into the root of the silverstreak_wp theme directory
    
        cd /path/to/your/wp-site/wp-content/themes/silverstreak_wp
    
2. Run:

        rake ss:setup FOR='name_of_theme'
        
   That should setup your child theme folder and the necessary directories, if you are on a mac and have 
   textmate installed, then it also has the added bonus of opening up the _header.php_ file in textmate.
   

3. Start working on your theme!


Functions
=========

image
-----

Inserts an image tag from the images directory.

      image($filename, $attrs)
      
USAGE

      image('header.png',"title='header'");
      
      
page_title
----------

Inserts a dynamic page title, place this in between your title tags.

      page_title($content)
      
USAGE

      page_title('Welcome to my site!');
      

include_js
----------

Includes a javascript library from the js folder.

        include_js($libs)
        
USAGE

        include_js('app');
        // including multiple js files
        include_js(array('app','loader'))
        
include_js_lib
--------------

Include google's ajax libraries

      include_js_lib($libs)
      
USAGE

      include_js_lib('jquery-1.3.2');
      //multiple libraries
      include_js_lib('jquery-1.3.2', 'jqueryui-1.7.2');
      
      
include_css
-----------

Includes a css file from the css folder.

        include_css($libs)

USAGE

        include_css('app');
        // including multiple css files
        include_css(array('app','print'))      
