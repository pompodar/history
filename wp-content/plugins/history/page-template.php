<?php
/*
Template Name: Custom Template
*/
get_header();
?>

<style>
    body {
        font-family:"Helvetica Neue",sans-serif;
        margin:0;
        padding:2em;
        text-align:center;
        height:100%;
        display: flex;
        flex-direction: row;
    }

    main {
      display: flex;
    }

    ::selection {
        color:#fff;
        background:#00e2ff
    }

    .site-header {
      padding-top: 0 !important;
      padding-bottom: 0 !important;
    }

    .site-title a  {
        color:#fff !important;
        text-shadow:2px 2px 5px rgba(0,0,0,.5);
        padding: 0 !important;
        padding-top: 0 !important;
        font-size:1.75em;
        display:inline-block;
    }

    h1:after {
        content:"";
        position:absolute;
        bottom:-21px;
        left:50%;
        border:10px solid transparent;
        border-top-color:rgba(255,255,255,.2);
    }

    nav {
        margin:0 auto;
        position:relative;
        max-width:480px;
        text-align:left;
        background: #131515;
    }

    nav ul {
        padding:0;
        margin:0;
        list-style:none;
        background:#343838;
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
        padding:2em;
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
        font-size:.6em;
        margin-top:.25em
    }

    nav ul li a.slider-back {
        color:#00e2ff;
        background:rgba(0,0,0,.35);
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
    nav ul li.products a { border-left-color:rgba(0,226,255,.65) }
    nav ul li.blog a { border-left-color:rgba(0,226,255,.45) }
    nav ul li.resources a { border-left-color:rgba(0,226,255,.3) }
    nav ul li.contact a { border-left-color:rgba(0,226,255,.125) }

    nav ul li a:hover {
        background:rgba(0,0,0,.35);
        color:#fff;
        border-left-color:#00e2ff
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
        width: 25%;
        height: 500px;
        overflow: auto;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }

    .main-content {
        width: 75%;
        padding-left: 20px;
        color: white;
        text-align: left;
    }
</style>

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

<div class="main-content">
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

                function fetchPostContentByTitle(postId) {
                  $.ajax({
                      url: `/wp-json/wp/v2/posts/${postId}`,
                      method: 'GET',
                      success: function(data) {
                          if (data) {
                            console.log(data);
                              var post = data;
                              // Display post content in the main content area
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
            
                base.$el.on("click", "a."+base.options.classPrefix+'more', function() {
                    base.goToNext($(this));
                    console.log(this.id);

                    fetchPostContentByTitle(this.id);

                    return false;
                });
                
                base.$el.on("click", "a."+base.options.classPrefix+'back', function () {
                    base.goToParent();
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
        backWording: "Back to",
        moreArrow: "&#x25B6;",
        prevArrow: "&#x25C0;",
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
