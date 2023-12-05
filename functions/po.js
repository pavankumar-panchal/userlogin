// JavaScript Document

function valid(form)
{
	var field = form.productname;  
	if (!field.value)
	{ alert("Select a Product."); field.focus(); return false;}
	
	 else
	  return true;
}

function confirmdisplay(id1,obj)
{
	if (document.getElementById) 
	 {
	  var a = document.getElementById(id1).style;
	  if (a.display == "block") {
	   a.display = "none"; 
		} else {
	   a.display = "block";	
	  }
	  return false;
	  }
	  else 
	  return true;
}

