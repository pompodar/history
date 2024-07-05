<?php
/*
Template Name: Custom Template
*/
get_header();
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Infant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: "Cormorant Infant", serif !important;
        font-weight: 400;
        font-style: normal;
        background: white !important;
        margin:0;
        padding:2em;
        text-align:center;
        height:100%;
        display: flex;
        flex-direction: row;
    }

    #page {
      max-width: 1560px;
      margin: 0 auto;
      display: flex !important;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      margin-left: unset !important;
      width: max-content;
      position: fixed;
    }

    main {
      display: flex;
    }

    @media screen and (max-width: 1024px) {
      main {
        flex-direction: column;
      }      
    }

    ::selection {
        color:#fff;
        background:#00e2ff
    }

    .site-header {
      padding-top: 0 !important;
      padding-bottom: 0 !important;
    }

    .site-title  {
      text-align: left;
      text-transform: none;
    }

    .site-title a  {
        font-family: "Marck Script", cursive !important;
        color: black !important;
        text-shadow:2px 2px 5px rgba(0,0,0,.5);
        padding: 0 !important;
        padding-top: 0 !important;
        font-size:1.75em;
        display:inline-block;
        text-decoration-color: aqua;
    }

    h1 {
      font-size: 32px;
      font-family: "Cormorant Infant", serif !important;
      text-align: center;
      position: relative;
      width: max-content;
      display: block;
      margin: 0 auto;
    }

    h1:before {
      content: "";
      display: block;
      width: 34px;
      height: 3px;
      background: yellow;
      left: 0;
      top: 34px;
      position: absolute;
    }

    p {
      text-indent: 12px;
    }

    p:first-of-type:first-letter {
      font-size: 28px;
      line-height: 1;
    }

    nav {
        margin:0 auto;
        position:relative;
        max-width:480px;
        text-align:left;
        background: aquamarine;
    }

    nav ul {
        padding:0;
        margin:0;
        list-style:none;
        background: grey;
        transition:all .3s ease-in-out;
        -o-transition:all .3s ease-in-out;
        -moz-transition:all .3s ease-in-out;
        -webkit-transition:all .3s ease-in-out
    }

    nav ul li:first-child {
        border-top:0
    }

    nav ul li {
        display:block;
        border-bottom:1px dotted #000
    }

    nav ul li:last-child {
        border-bottom-width:0
    }

    nav ul li a {
        display:block;
        font-family: "Cormorant Infant", serif !important;
        font-family: "Marck Script", cursive !important;
        padding: 12px;
        white-space:nowrap;
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(rgba(0,0,0,0.45)), to(rgba(0,0,0,.65)));
        background-image: -webkit-linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,.65));
        background-image: -moz-linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,.65));
        background-image: -o-linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,.65));
        background-image: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,.65));
        color:#fff;
        font-weight:600;
        text-decoration:none;
        border-left:.5em solid
    }

    nav ul li a strong {
        float:right;
        font-size: 1em;
        margin-top:.10em;
        color: aqua;
    }

    nav ul li a.slider-back {
        color: white;
        background: aqua;
        text-align:right
    }

    nav ul li a.slider-back strong {
        float:left
    }

    nav ul.slider-current {
        left:0;
        display:block
    }

    nav ul.slider-left { left:-100% }
    nav ul.slider-right { left:100% }
    nav ul li ul { left:200% }
    nav ul li ul.slider-current { left:100% }
    nav ul li ul.slider-left { left:0 }
    nav ul li ul.slider-right { left:200% }

    nav ul li.about a { border-left-color:rgba(0,226,255,.85) }

    nav ul li a:hover {
        background: white;
        color: black;
        border-left-color: aqua;
    }

    @media(min-width: 600px) {
        body { 
            -webkit-box-shadow: inset 0 0 250px rgba(0,0,0,.85);
            -moz-box-shadow: inset 0 0 250px rgba(0,0,0,.85);
            box-shadow:inset 0 0 250px rgba(0,0,0,.85);  
        }
        nav { 
            -webkit-box-shadow: 2px 2px 20px rgba(0,0,0,.95);
            -moz-box-shadow: 2px 2px 20px rgba(0,0,0,.95);
            box-shadow:2px 2px 20px rgba(0,0,0,.95);
        }
    }

    .sidebar {
        position: fixed;
        width: 100%;
        max-width: 392px;
        height: fit-content;
        max-height: 800px;
        overflow: auto;
        margin-top: 60px !important;
        margin-bottom: 0 !important;
        box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
    }

    @media screen and (max-width: 1024px) {
      .sidebar {
          position: static;      
        }      
    }

    .main-content {
        width: 75%;
        margin-left: 430px;
        color: black;
        text-align: left;
        margin-top: 60px !important;
        margin-bottom: 0 !important;
        padding: 20px;
        background: white;
        position: relative;
        box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
    }

    .main-content:before {
        content: "";
        height: 30px;
        width: 6px;
        position: absolute;
        right: -4px;
        top: 2px;
        background: yellow;
    }

    .main-content:after {
        content: "";
        width: 40px;
        height: 6px;
        position: absolute;
        right: -4px;
        top: -4px;
        background: yellow;
    }

    nav:before {
        content: "";
        height: 30px;
        width: 6px;
        position: absolute;
        left: -4px;
        top: 2px;
        background: yellow;
    }

    nav:after {
        content: "";
        width: 40px;
        height: 6px;
        position: absolute;
        left: -4px;
        top: -4px;
        background: yellow;
    }

    @media screen and (max-width: 1024px) {
      .main-content {
          width: 100%;   
          margin-left: 0;  
          margin-top: 40px !important; 
        }      
    }

    .breadcrumb {
        margin-left: 180px;
        font-family: "Marck Script", cursive !important;
        position: fixed;
        color: black;
        z-index: 1;
        margin-top: -10px !important;
    }

    .breadcrumb a {
        color: #00e2ff;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .decorative-background {
      position: fixed;
      top: -100px;
      left: 0;
      right: 0;
      height: 250px;
      width: 100%;
      background: grey;
      z-index: -1;
      background: grey;
      background: linear-gradient(100deg, white 0%, aqua 90%);
      background-image: url("https://static.posters.cz/image/750webp/116430.webp");
      /* background-image: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgHgL8PAYiuWmmaRBzJuUKfIZ08h6Bv2X4Zg&s"); */
      background-size: cover;
      background-position: center;
      box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
    }

    .decorative-background__cover {
      position: absolute;
      top: -0;
      bottom: 0;
      left: 0;
      right: 0;
      background: aqua;
      /* background: linear-gradient(100deg, white 0%, aqua 90%); */
      opacity: 0.6;
      z-index: 1;
    }

    .site-footer > .site-info {
      border-top: 3px solid aqua !important;
    }

    footer {
      margin-top: auto !important;
    }
</style>

<div class="decorative-background">
  <div class="decorative-background__cover"></div>
</div>

<div class="sidebar">
<?php
function generate_nav_menu() {
    // Fetch all posts
    $all_posts = get_posts(array(
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    ));

    // Create a mapping of sanitized post titles to posts
    $title_to_post = array();
    foreach ($all_posts as $post) {
        $sanitized_title = sanitize_title(get_the_title($post->ID));
        $title_to_post[$sanitized_title] = $post;
    }

    // Create a mapping of post ID to child posts
    $post_to_children = array();
    foreach ($all_posts as $post) {
        $post_categories = get_the_category($post->ID);
        foreach ($post_categories as $post_category) {
            $sanitized_category_name = sanitize_title($post_category->name);
            if (isset($title_to_post[$sanitized_category_name])) {
                $parent_post = $title_to_post[$sanitized_category_name];
                if (!isset($post_to_children[$parent_post->ID])) {
                    $post_to_children[$parent_post->ID] = array();
                }
                $post_to_children[$parent_post->ID][] = $post;
            }
        }
    }

    // Function to display posts and their children as HTML
    function display_posts_and_children($posts, $post_to_children) {
        echo '<ul>';
        foreach ($posts as $post) {
            echo '<li><a id="' . ($post->ID) . '">' . esc_html(get_the_title($post->ID)) . '</a>';
            if (isset($post_to_children[$post->ID])) {
                display_posts_and_children($post_to_children[$post->ID], $post_to_children);
            }
            echo '</li>';
        }
        echo '</ul>';
    }

    // Find root posts (posts that do not appear as children in the mapping)
    $root_posts = array_filter($all_posts, function($post) use ($post_to_children) {
        foreach ($post_to_children as $children) {
            if (in_array($post, $children)) {
                return false;
            }
        }
        return true;
    });

    // Display the navigation menu
    echo '<nav id="navigation">';
    display_posts_and_children($root_posts, $post_to_children);
    echo '</nav>';
}

// Use the function in a template file where you want the menu to appear
generate_nav_menu();
?>
</div>

<div class="breadcrumb">
</div>

<div class="main-content">
  <h1>
    Історія
  </h1>
  <p>
    Зазвичай говорять про “систему трьох епох”: кам’яної, залізної і бронзової. Цей поділ ввів у 1836 році данський археолог Крістіан Томсен; це система часових відносин, заснована на критеріях розвитку знарядь праці, які використовували первісні люди.

    Н. Дейвіс Європа. Історія
  </p>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
(function ($) {
    if (!$.responsive) {
        $.responsive = {};
    };
    
    $.responsive.slider = function (el, options) {
        var base = this;
        base.$el = $(el);
        base.el = el;
        base.$el.data("responsive.slider", base);
        var currentNav = $('ul:first', base.el);
        var transitionsSupported = false;
        var isCreated = false;
        var isAnimating = false;

        base.init = function () {
            base.options = $.extend({}, $.responsive.slider.defaultOptions, options);
            base.$el.bind("createslider", function() {
                base.create();
            });
            base.$el.bind("destroyslider", function() {
                base.destroy();
            });
            if(base.options.initPlugin)
                base.create();
        };
        
        base.goToNext = function(item) {
            var currUl = currentNav;
            var nextUl = item.siblings("ul:first");
            var divContainer = false;

            if(!isAnimating) {
                isAnimating = true;
                if(nextUl.length < 1) {
                    divContainer = item.siblings("div");
                    nextUl = $("ul:first", divContainer);
                }
                
                nextUl.prepend('<li><a class="'+base.options.classPrefix+'back'+'" href="#">'+base.options.backWording+' '+item.html()+'</a></li>');
                $('a.'+base.options.classPrefix+'back'+' strong', nextUl).html(base.options.prevArrow);

                if(!transitionsSupported) {
                    nextUl.css("left", nextUl.position().left+"px");
                    nextUl.animate({ left: "0" }, base.options.transitionTime, "swing", function() {
                        base.switchClassesNext(currUl, nextUl);
                        isAnimating = false;
                    });
                } else {
                    base.switchClassesNext(currUl, nextUl);
                    isAnimating = false;
                }
      
                currentNav = nextUl;
            }
        };
        
        base.goToParent = function() {
            var currUl = currentNav;
            var prevUl = currUl.parents("ul:first");

            if(!isAnimating) {
                isAnimating = true;
                if(!transitionsSupported) {
                    if(prevUl.position().left < 0)
                        moveLeft = "0";
                    else
                        moveLeft = "100%";
                        
                    prevUl.css("left", prevUl.position().left+"px");
                    prevUl.animate({ left: moveLeft }, base.options.transitionTime, "linear", function() {
                        base.switchClassesPrevious(currUl, prevUl);
                        isAnimating = false;
                    });
                } else {
                    base.switchClassesPrevious(currUl, prevUl);
                    isAnimating = false;
                }
      
                currentNav = prevUl;
            }
        };
        
        base.switchClassesNext = function(current, next) {
            current.removeClass(base.options.classPrefix+'current');
            current.addClass(base.options.classPrefix+'left');
            next.addClass(base.options.classPrefix+'current');
            next.removeClass(base.options.classPrefix+'right');
            base.$el.height(next.height());
            next.css("left", "");
        };
        
        base.switchClassesPrevious = function(current, previous) {
            current.removeClass(base.options.classPrefix+'current');
            current.addClass(base.options.classPrefix+'right');
            previous.addClass(base.options.classPrefix+'current').css("left", "");
            previous.removeClass(base.options.classPrefix+'left').css("left", "");
            current.find("li:first").remove();
            base.$el.height(previous.height());
        };

        base.create = function() {
            if(!isCreated) {
                base.$el.css('overflow', 'hidden');
                
                $('ul', base.el).css({ 
                    'position': 'absolute', 
                    'width': '100%', 
                    'top': '0px' 
                });
                
                base.$el.find("ul:first").addClass(base.options.classPrefix+'current');
                
                base.$el.css({
                    height: base.$el.find("ul:first").height()
                });
                
                $("li", base.el).each(function() {
                    if($(this).children("ul").length > 0 || $(this).children('div').children('ul').length > 0) {
                        $(this).children("ul","div").addClass(base.options.classPrefix+'right');
                        $(this).children("a").append('<strong>'+base.options.moreArrow+'</strong>').addClass(base.options.classPrefix+'more');
                    }
                });

                function updateBreadcumb ($t, isBack = false) {
                    var breadcrumb = $('.breadcrumb');

                    var currentPath = breadcrumb.text()
                    .split(' > ');

                    if (isBack) {
                        currentPath.pop();
                    } else {
                        currentPath.push($t.replace('>', ''));
                    }

                    breadcrumb.html(currentPath.join(' > '));
                };

                function fetchPostContentByTitle(postId) {
                  $.ajax({
                      url: `/wp-json/wp/v2/posts/${postId}`,
                      method: 'GET',
                      success: function(data) {
                          if (data) {
                            console.log(data);
                              var post = data;
                              $('.main-content').html(`<h1>${post.title.rendered}</h1>${post.content.rendered}`);
                          } else {
                              $('.main-content').html('<p>No post found.</p>');
                          }
                      },
                      error: function(error) {
                          console.log(error);
                          $('.main-content').html('<p>Failed to fetch post content.</p>');
                      }
                  });
              }

                base.$el.on("click", "a", function() {
                    fetchPostContentByTitle(this.id);

                    return false;
                });
            
                base.$el.on("click", "a."+base.options.classPrefix+'more', function() {
                    base.goToNext($(this));

                    // fetchPostContentByTitle(this.id);

                    updateBreadcumb(this.textContent);

                    return false;
                });
                
                base.$el.on("click", "a."+base.options.classPrefix+'back', function () {
                    base.goToParent();

                    updateBreadcumb(this.textContent, true);

                    return false;
                });
                
                isCreated = true;
            }
        };

        base.destroy = function() {
            base.$el.removeAttr('style');
            base.$el.off("click", "**");
            $('.'+base.options.classPrefix+'current', base.el).removeClass(base.options.classPrefix+'current');
            $('.'+base.options.classPrefix+'right', base.el).removeClass(base.options.classPrefix+'right');
            $('.'+base.options.classPrefix+'left', base.el).removeClass(base.options.classPrefix+'left');
            $('.'+base.options.classPrefix+'more'+' strong', base.el).remove();
            $('.'+base.options.classPrefix+'more', base.el).removeClass(base.options.classPrefix+'more');
            $('ul', base.el).removeAttr('style');
            $('.'+base.options.classPrefix+'back').parent().remove();
            isCreated = false;
        };
        
        base.init();
    };
    
    $.responsive.slider.defaultOptions = {
        classPrefix: 'slider-',
        transitionTime: 200,
        backWording: "назад до",
        moreArrow: ">",
        prevArrow: ">",
        initPlugin: true
        // TODO: Add option for max levels
    };
    
    $.fn.slider = function( options ) {
        return this.each(function () {
            (new $.responsive.slider(this, options));
        });
    };
})( jQuery );

$(document).ready(function() {
    $('nav').slider();
});
</script>

<?php get_footer(); ?>
