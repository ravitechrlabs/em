/*$ = jQuery.noConflict();


jQuery(document).ready(function ($) {

  jQuery('#checkbox').change(function(){
    setInterval(function () {
        moveRight();
    }, 3000);
  });
  
	var slideCount = jQuery('#slider ul li').length;
	var slideWidth = jQuery('#slider ul li').width();
	var slideHeight = jQuery('#slider ul li').height();
	var sliderUlWidth = slideCount * slideWidth;
	
	jQuery('#slider').css({ width: slideWidth, height: slideHeight });
	
	jQuery('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
	
    jQuery('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        jQuery('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            jQuery('#slider ul li:last-child').prependTo('#slider ul');
            jQuery('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        jQuery('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            jQuery('#slider ul li:first-child').appendTo('#slider ul');
            jQuery('#slider ul').css('left', '');
        });
    };

    jQuery('a.control_prev').click(function () {
        moveLeft();
    });

    jQuery('a.control_next').click(function () {
        moveRight();
    });

});    
*/
$ = jQuery.noConflict();

jQuery(document).ready(function(){
	
    jQuery('.bxslider').bxSlider({
  auto: true,
  autoControls: false,
  slideWidth: 200,
  slideMargin: 100,
  pager: false,
/*  nextSelector: '#slider-next',
  prevSelector: '#slider-prev',
  nextText: 'Onward →',
  prevText: '← Go back',*/
  autoHover: true,
  autoDelay : 2,
  controls: true,
  stopAuto:false
	
  
});
    
	

});

