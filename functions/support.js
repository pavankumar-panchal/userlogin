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
{ alert("Please enter your Scratch Card or Hardware Lock Serial Number."); field.focus(); field.select(); return false;}

var field = form.os;  
if (!field.value)
{ alert("Select The Operating System."); field.focus(); return false;}

var field = form.sp;  
if (!field.value)
{ alert("Select whether service pack is present or not in the operation system."); field.focus(); return false;}

var field = form.problem;  
if (!field.value)
{ alert("Please enter the details of the Problem."); field.focus(); field.select(); return false;}

 else
  return true;
 
}
