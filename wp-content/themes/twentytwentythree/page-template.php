<?php
/*
Template Name: Custom Template
*/
get_header();
?>

<style>
    body {
    font-family:"Helvetica Neue",sans-serif;
    /* background image from http://photosof.org/ */
    background:url(https://s.cdpn.io/44759/dark_blue_background-wide.jpg) no-repeat top center #343838;
    margin:0;
    padding:2em;
    text-align:center;
    height:100%
    }

    ::selection {
    color:#fff;
    background:#00e2ff
    }

    h1 {
    color:#fff;
    text-shadow:2px 2px 5px rgba(0,0,0,.5);
    margin:1em 0;
    padding-bottom:.5em;
    font-size:1.75em;
    border-bottom:1px solid rgba(255,255,255,.2);
    display:inline-block;
    position:relative;
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
    margin:1em auto;
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
</style>

  <h1>Sliding Navigation</h1>
  <nav id="navigation">
    <ul>
        <li class="about"><a href="#">About</a>
            <ul>
                <li><a href="#">History</a></li>
                <li><a href="#">Media</a>
                    <ul>
                        <li><a href="#">Brochures</a></li>
                        <li><a href="#">Videos</a></li>
                        <li><a href="#">Downloads</a></li>
                    </ul>
                </li>
                <li><a href="#">Staff</a></li>
            </ul>
        </li>
        <li class="products"><a href="#">Products</a>
            <ul>
                <li><a href="#">Widgets</a></li>
                <li><a href="#">Contraptions</a></li>
                <li><a href="#">Gizmos</a></li>
            </ul>
        </li>

        <li class="resources"><a href="#">Resources</a>
            <ul>
                <li><a href="#">Manuals</a></li>
                <li><a href="#">Knowledgebase</a></li>
                <li><a href="#">Support</a></li>
            </ul>
        </li>
        <li class="contact"><a href="#">Contact</a></li>
    </ul>
</nav>

<script>
    **/
;(function ($) {

    // initialize namespace if it doesn't exist
    if (!$.responsive) {
            $.responsive = {};
  };
    
  $.responsive.slider = function ( el, options ) {
    // To avoid scope issues, use 'base' instead of 'this'
    // to reference this class from internal events and functions.
    var base = this;

    // Access to jQuery and DOM versions of element
    base.$el = $(el);
    base.el = el;

    // Add a reverse reference to the DOM object
    base.$el.data( "responsive.slider" , base );
    
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
      
      transitionsSupported = Modernizr.csstransitions;
      
      if(base.options.initPlugin)
        base.create();
    };
    
    // item - list item containing the sub menu
    base.goToNext = function(item) {
      var currUl = currentNav;
      var nextUl = item.siblings("ul:first");
      var divContainer = false;

            if(!isAnimating)
      {
                isAnimating = true;
                if(nextUl.length < 1)
                {
                    divContainer = item.siblings("div");
                    nextUl = $("ul:first", divContainer);
                }
                
                nextUl.prepend('<li><a class="'+base.options.classPrefix+'back'+'" href="#">'+base.options.backWording+' '+item.html()+'</a></li>');
                $('a.'+base.options.classPrefix+'back'+' strong', nextUl).html(base.options.prevArrow);

                if(!transitionsSupported)
                {
                    nextUl.css("left", nextUl.position().left+"px");
                    nextUl.animate({ left: "0" }, base.options.transitionTime, "swing", function()
                    {
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
      var prevUl = currUl.parents("ul:first"); // get first parent <ul>
      var moveLeft; // value to animate left to
      
            if(!isAnimating) {
                isAnimating = true;
                if(!transitionsSupported) {
                    if(prevUl.position().left < 0)
                        moveLeft = "0";
                    else
                        moveLeft = "100%";
                        
                    prevUl.css("left", prevUl.position().left+"px");
                    prevUl.animate({ left: moveLeft }, base.options.transitionTime, "linear", function()
                    {
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
    
    base.transitionSupport = function() {
      return true;
      var d = document.createElement("detect"),
        CSSprefix = "Webkit,Moz,O,ms,Khtml".split(","),
        All = ("transition " + CSSprefix.join("Transition,") + "Transition").split(",");
      for (var n = 0, np = All.length; n < np; n++) {
        if (d.style[All[n]] === "") {
          return true;
        }
      }

      return false;
    };
    
    base.create = function(){

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
          if($(this).children("ul").length > 0 || $(this).children('div').children('ul').length > 0)
          {
            $(this).children("ul","div").addClass(base.options.classPrefix+'right');
            $(this).children("a").append('<strong>'+base.options.moreArrow+'</strong>').addClass(base.options.classPrefix+'more');
          }
        });
      
        base.$el.on("click", "a."+base.options.classPrefix+'more', function() {
          base.goToNext($(this));
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

<?php
get_footer();
