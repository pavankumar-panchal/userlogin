// JavaScript Document

function valid(form)
 {
var field = form.usrname;  
if (!field.value)
{ alert("Please enter your Name."); field.focus(); field.select(); return false;}

var field = form.usrcompany;  
if (!field.value)
{ alert("Please enter your Company Name."); field.focus(); field.select(); return false;}

var field = form.usraddress;  
if (!field.value)
{ alert("Please enter your Address."); field.focus(); field.select(); return false;}

var field = form.usrstdcode;
if(field.value) { if(!validatestdcode(field.value)) { alert('Please enter a Valid STD Code. Only Numbers are allowed.'); field.focus(); return false; } }

var field = form.usrphone;  
/*if (!field.value)
{ alert("Please enter your Phone Number."); field.focus(); field.select(); return false;}*/
if(field.value) { if(!validatephone(field.value)) { alert('Please enter a Valid Phone Number. Only Numbers are allowed.'); field.focus(); return false; } }

var field = form.usrcell;
if(!field.value) { alert("Please enter the Mobile Number. "); field.focus(); return false; }
if(field.value) { if(!validatecell(field.value)) { alert('Please enter a valid Cell Number.'); field.focus(); return false; } }

var field = form.usrplace;  
if (!field.value)
{ alert("Please enter your Place."); field.focus(); field.select(); return false;}

var field = form.usrsecquestion;  
if (!field.value)
{ alert("Please enter a Security Question."); field.focus(); field.select(); return false;}

var field = form.usrsecanswer;  
if (!field.value)
{ alert("Please enter a Security Answer."); field.focus(); field.select(); return false;}

var field = form.agree;  
if (field.checked == false)
{ alert("Check Yes, to update your profile."); field.focus(); return false;}

 else
  return true;
 
}
