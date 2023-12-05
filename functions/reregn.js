// JavaScript Document

function valid(form)
 {
var field = form.product;  
if (!field.value)
{ alert("Please Select a Product."); field.focus(); return false;}

var field = form.version;  
if (!field.value)
{ alert("Please enter Version of the Product.\n You can refer it through Help-> About in the software menu."); field.focus(); field.select(); return false;}

var field = form.slno;  
if (!field.value)
{ alert("Please enter your Scratch Card Serial Number."); field.focus(); field.select(); return false;}

var field = form.pinno;  
if (!field.value)
{ alert("Please enter your Scratch Card PIN Number."); field.focus(); field.select(); return false;}

var field = form.computerid;  
if (!field.value)
{ alert("Enter your Computer ID."); field.focus(); field.select(); return false;}

var field = form.computersign;  
if (!field.value)
{ alert("Enter your Computer Sign."); field.focus(); field.select(); return false;}

var field = form.purchasedealer;  
if (!field.value)
{ alert("Enter your Dealer Name, from whom it has been purchased."); field.focus(); field.select(); return false;}

var field = form.problem;  
if (!field.value)
{ alert("Please enter the Reason for Re-Registration."); field.focus(); field.select(); return false;}

 else
  return true;
 
}

