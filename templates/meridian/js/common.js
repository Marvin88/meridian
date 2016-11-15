
function scrollToEl(element){
      $('html, body').animate({
        scrollTop: $(element).offset().top
    }, 1000);
}

function topMenuActiveTrigger(obj){
}

function getActivZone(scrollNow, scrlElmts){
    var activeZone;
    $.each(scrlElmts , function( index, obj ) {
        offset = obj.offset();
        console.log($('div[data-scroll="'+index+'"]').height());
        //console.log(offset.top);
//        console.log("Скролл: "+scrollNow);
        if(offset!== undefined){
            if(offset.top-$(index).height() < scrollNow){
                //console.log('activeZone определен!');
                activeZone = obj;
            }
        }
    })
    return activeZone;
}

function scrollingNavCheck(scrollNow, soderzhanie, rekomendatsii, otzivi, media, author, buy){
    console.log(scrollNow);

}
(function($){
$( window ).on('resize', function(){
     $('.triggers-other-book').height($('.others-item-bg1').outerHeight());
     $('.muscul-other-book').height($('.others-item-bg1').outerHeight());
     console.log('resize');
})

$(document).ready(function(){
    viewport = $('.windowHeight').height();
    if(viewport!=''){
        $('.windowHeight').remove();
        console.log('viewport is:'+viewport);
    }
  $('.my-dropdown-menu').css('height', viewport-53);
  $('.inner-menu-wrapper').height($('#inner-menu').outerHeight());
  o = $('#inner-menu').offset();


    scrlElmts =new Object();
    scrlElmts.soderzhanie   = $('div[data-scroll="soderzhanie"]');
    scrlElmts.rekomendatsii = $('div[data-scroll="rekomendatsii"]');
    scrlElmts.otzivi        = $('div[data-scroll="otzivi"]');
    scrlElmts.media         = $('div[data-scroll="media"]');
    scrlElmts.author        = $('div[data-scroll="author"]');
    scrlElmts.buy           = $('div[data-scroll="buy"]');
    scrlElmts.poster        = $('div[data-scroll="poster"]');

$(document).on( "scroll", function(){
    scrollNow= window.pageYOffset;
        if(scrollNow>o.top){
            $('#inner-menu').addClass('fixed-top-block-2');
            $('.hidden-menu-fixed').fadeIn();
            console.log("top: "+$('.fixed-top-block-2').outerHeight());
            $('.my-dropdown-menu').css('top', $('.fixed-top-block-2').outerHeight()+'px');
            $('.my-dropdown-menu').css('height', viewport-$('.fixed-top-block-2').outerHeight());
            $('.my-dropdown-menu').css('overflow-y','scroll');
        }
        else{
            $('#inner-menu').removeClass('fixed-top-block-2');
            $('.hidden-menu-fixed').fadeOut();
            $('.my-dropdown-menu').css('top', $('.fixed-top-block-2').outerHeight()+'px');
            $('.my-dropdown-menu').css('height', viewport-76);
            $('.my-dropdown-menu').css('overflow-y','scroll');

        }

    activeZone = getActivZone($("body").scrollTop(),scrlElmts);
   // console.log(activeZone.attr('data-scroll'));

    if(!!activeZone){
        activeZoneDataScroll = $(activeZone).attr('data-scroll');
        //console.log($('.menu-item').find('a[href="#'+activeZoneDataScroll+'"]'));
        $('.menu-item').each(function(index, value){
            if($(value).hasClass('active')){
                $(value).removeClass('active');
            }
        })
        $('.menu-item').find('a[href="#'+activeZoneDataScroll+'"]').parent().addClass('active');
    }
    //scrollingNavCheck($("body").scrollTop(),scrlElmts.soderzhanie, scrlElmts.rekomendatsii, scrlElmts.otzivi, scrlElmts.media, scrlElmts.author, scrlElmts.buy);
});

//------media tabs triger ---------//
    $('.media-nav-btn').click(function(){
        status = $(this).attr('data-active');
        child  = $(this).attr('data-link');
        //console.log(status, child);
        $('.media-page[data-visible="y"]').attr('data-visible','n');
        $('div[data-id="'+child+'"]').attr('data-visible','y');
        $('.media-nav-btn[data-active="y"]').attr('data-active', 'n');
        $(this).attr('data-active','y');
    })
//------media tabs triger ---------//

//------top menu scroll actions --------//
    $('.menu-item').click(function(event){
        event.preventDefault();
        scrollTo = $(this).find('a').attr('href');
        scrollTo = scrollTo.replace('#',''); 
        scrollToEl($('div[data-scroll="'+scrollTo+'"]'));
        console.log(scrollTo);
    })
//------top menu scroll actions --------//

//------conf-form-switcher ---------//
    $('.form-switcher .switch-btn').click(function(){
        var activeBtnIndex = '';
        $('.form-switcher .switch-btn').each(function(index, value){
            $(this).removeClass('active');
        })
        $(this).addClass('active');

         $('.form-switcher .switch-btn').each(function(index, value){
            if($(value).hasClass('active')){
              activeBtnIndex = $(value).index();
            }
        })
        console.log(activeBtnIndex);
        switch(activeBtnIndex) {
            case 0:
                $('.reg-form').addClass('reg-listner-bg');
                $('.reg-form').removeClass('spik-bg');
                break;
            case 1:
                $('.reg-form').addClass('spik-bg');
                $('.reg-form').removeClass('reg-listner-bg');
                break;
        }

        console.log($(this).index());
        thisIndex = $(this).index();
        $('.form-spikeri-wrapper').each(function(index, value){
           if(index!=thisIndex) {
            $('.form-spikeri-wrapper').eq(index).removeClass('active');
           }
        });
        $('.form-spikeri-wrapper').eq(thisIndex).addClass('active');
    })


//------conf-form-switcher ---------//
//----MENU-----//
$('.menu-overlay').on('click', function(){
    $('.menu-overlay').removeClass('active');
        $('.burder').removeClass('menu-show');
        $('.my-dropdown-menu').removeClass('active');
})
$('.menu-js').click(function(){
    overlayPaddingTop = $('.header-block').height();
    console.log(overlayPaddingTop = $('.header-block').height());
    if($('.burder').hasClass('menu-show')){
        $('.menu-overlay').removeClass('active');
        $('.burder').removeClass('menu-show');
        $(this).removeClass('active');
        $('.my-dropdown-menu').removeClass('active');
    }
    else{
        $('.menu-overlay').addClass('active');
        $('.menu-overlay').css('height',$('body').height()-76);
        $('.burder').addClass('menu-show');
        $(this).addClass('active');
        $('.my-dropdown-menu').addClass('active');
        //$('.my-dropdown-menu').css('top', )
    }
    }
)
$('.bottom-cart-block-wrapper').height($('.bottom-cart-block').outerHeight());
var cartFooterBlock = $('.bottom-cart-block-wrapper').offset();

var allHeight = Math.max(
  document.body.scrollHeight, document.documentElement.scrollHeight,
  document.body.offsetHeight, document.documentElement.offsetHeight,
  document.body.clientHeight, document.documentElement.clientHeight
);
console.log(allHeight);
console.log(cartFooterBlock.top);
m = allHeight - cartFooterBlock.top;
point = allHeight - window.innerHeight-m+$('.bottom-cart-block').outerHeight();
var html = document.documentElement;
html.clientHeight;
   //console.log();
$(document).on('scroll', function(){
    scrollNow= window.pageYOffset;
    console.log(scrollNow);

    //console.log(document.documentElement.clientHeight);
//    breakPoint = carFooterBlock.top -$('.bottom-cart-block').outerHeight()*2;
   breakPoint = point-$('.bottom-cart-block').outerHeight()*2;
    console.log(point);
    if(point<scrollNow){
        $('.bottom-cart-block').removeClass('fixed');
    }
    else{
        $('.bottom-cart-block').addClass('fixed');
    }
})

setTimeout(function(){
   $('.triggers-other-book').height($('.others-item-bg1').outerHeight());
   $('.muscul-other-book').height($('.others-item-bg1').outerHeight());
},300);

setTimeout(function(){
   $('.triggers-other-book').height($('.others-item-bg1').outerHeight());
   $('.muscul-other-book').height($('.others-item-bg1').outerHeight());
},2000);

})
})(jQuery);