let container = document.getElementById("Games");
container.onmouseover = container.onmouseout = handler;

function handler(event) 
{
    var Elem = event.target.closest('.Game-Box');
    if (event.type == 'mouseover') 
    {
        Elem.children[0].style = "height: 0%; transition: 0.5s";
        Elem.children[1].style = "display: block; height: 100%; transition: 0.5s";
    }
    if (event.type == 'mouseout') 
    {
      
    }
}