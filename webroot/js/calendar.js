Effect.SlideUpAndDown = function(element,dur) {
  element = $(element);
  if(Element.visible(element)) new Effect.SlideUp(element, {duration:dur});
  else new Effect.SlideDown(element, {duration:dur});
}