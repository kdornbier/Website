// Call & init
$(document).ready(function(){
  $('.ba-slider').each(function(){
    var cur = $(this);
    // Adjust the slider
    var width = cur.width()+'px';
    cur.find('.resize img').css('width', width);
    // Bind dragging events
    drags(cur.find('.handle'), cur.find('.resize'), cur);
  });

  /* https://stackoverflow.com/questions/21561480/trigger-event-when-user-scroll-to-specific-element-with-jquery */
  //scroll jQuery
  var skills_position = $('#skills').offset().top;
  var bio_skills_position = $('#bio-skills').offset().top;
  var screen_height = $(window).height();
  var activation_offset = 0.5;//determines how far up the the page the element needs to be before triggering the function
  var skills_activation_point = skills_position - (screen_height * activation_offset);
  var bio_skills_activation_point = bio_skills_position - (screen_height * activation_offset);
  var max_scroll_height = $('body').height() - screen_height - 5;//-5 for a little bit of buffer
  var replaySkillsTransition = false;
  var replayBioSkillsTransition = false;
  //Does something when user scrolls to it OR
  //Does it when user has reached the bottom of the page and hasn't triggered the function yet
  $(window).on('scroll', function() {
      var y_scroll_pos = window.pageYOffset;
      var skills_element_in_view = y_scroll_pos > skills_activation_point;
      var bio_skills_element_in_view = y_scroll_pos > bio_skills_activation_point;
      
      if((skills_element_in_view && replaySkillsTransition)) {

          var skills = document.getElementById("skills");
          var repeatSkills = skills.cloneNode(true);
          skills.parentNode.replaceChild(repeatSkills, skills);

          replaySkillsTransition = false;
      } else if(!skills_element_in_view) {
        replaySkillsTransition = true;
      } 

      if((bio_skills_element_in_view && replayBioSkillsTransition)) {
          var bioSkills = document.getElementById("bio-skills");
          var repeatBioSkills = bioSkills.cloneNode(true);
          bioSkills.parentNode.replaceChild(repeatBioSkills, bioSkills);

          replayBioSkillsTransition = false;
      } else if(!bio_skills_element_in_view) {
        replayBioSkillsTransition = true;
      }
  });

});

// Update sliders on resize. 
// Because we all do this: i.imgur.com/YkbaV.gif
$(window).resize(function(){
  $('.ba-slider').each(function(){
    var cur = $(this);
    var width = cur.width()+'px';
    cur.find('.resize img').css('width', width);
  });
});

function drags(dragElement, resizeElement, container) {
	
  // Initialize the dragging event on mousedown.
  dragElement.on('mousedown touchstart', function(e) {
    
    dragElement.addClass('draggable');
    resizeElement.addClass('resizable');
    
    // Check if it's a mouse or touch event and pass along the correct value
    var startX = (e.pageX) ? e.pageX : e.originalEvent.touches[0].pageX;
    
    // Get the initial position
    var dragWidth = dragElement.outerWidth(),
        posX = dragElement.offset().left + dragWidth - startX,
        containerOffset = container.offset().left,
        containerWidth = container.outerWidth();
 
    // Set limits
    minLeft = containerOffset + 10;
    maxLeft = containerOffset + containerWidth - dragWidth - 10;
    
    // Calculate the dragging distance on mousemove.
    dragElement.parents().on("mousemove touchmove", function(e) {
    	
      // Check if it's a mouse or touch event and pass along the correct value
      var moveX = (e.pageX) ? e.pageX : e.originalEvent.touches[0].pageX;
      
      leftValue = moveX + posX - dragWidth;
      
      // Prevent going off limits
      if ( leftValue < minLeft) {
        leftValue = minLeft;
      } else if (leftValue > maxLeft) {
        leftValue = maxLeft;
      }
      
      // Translate the handle's left value to masked divs width.
      widthValue = (leftValue + dragWidth/2 - containerOffset)*100/containerWidth+'%';
			
      // Set the new values for the slider and the handle. 
      // Bind mouseup events to stop dragging.
      $('.draggable').css('left', widthValue).on('mouseup touchend touchcancel', function () {
        $(this).removeClass('draggable');
        resizeElement.removeClass('resizable');
      });
      $('.resizable').css('width', widthValue);
    }).on('mouseup touchend touchcancel', function(){
      dragElement.removeClass('draggable');
      resizeElement.removeClass('resizable');
    });
    e.preventDefault();
  }).on('mouseup touchend touchcancel', function(e){
    dragElement.removeClass('draggable');
    resizeElement.removeClass('resizable');
  });
}
