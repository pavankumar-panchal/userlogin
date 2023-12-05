// JavaScript Document

function districtselect(inputid,outputid)
{
	
	var code = document.getElementById(inputid).value;
	var outputselect = document.getElementById(outputid);
	var xRequest = createajax();

	// Create a function that will receive data sent from the server
	xRequest.onreadystatechange = function(){
		if(xRequest.readyState == 4){
		outputselect.innerHTML = xRequest.responseText;
		}
	}
	var queryString = "./ajax/districtselect.php?type=" + inputid + "&code=" + code + "&dummy=" + Math.floor(Math.random()*10019200000);
	xRequest.open("GET", queryString, true);
	xRequest.send(null); 
	if(inputid != "district")
	{
		document.getElementById('regiondiv').innerHTML = '<select name="region" id="region"><option value = "">- - - -Select a District First - - - -</option></select>';
	}
}

//-----------------------------------------------------------------------------------------------------------------

function valid(form)
 {
var em=form.usremailid;
 
  if (!em.value)
  {
    alert("Enter your Email Address.");
    em.focus();
    em.select();
    return false;
  }
   else
  {
  var str=em.value; 
  var a=checkemail(str);
   if(a==false)
   {
   alert("Enter a Valid Email Address");
   em.focus()
   em.select() 
   return false;
   }
   }

var field = form.usrcompany;  
if (!field.value)
{ alert("Please enter your Company Name."); field.focus(); field.select(); return false;}

var field = form.usrname;  
if (!field.value)
{ alert("Please enter your Name."); field.focus(); field.select(); return false;}

var field = form.usraddress;  
if (!field.value)
{ alert("Please enter your Address."); field.focus(); field.select(); return false;}

/*var field = form.usrphone;  
if (!field.value)
{ alert("Please enter your Phone Number."); field.focus(); field.select(); return false;}
else 
{ 
	var a=chkNumeric(field.value); 
	if(a==false) 
		{
			alert("Please enter a Valid Phone Number. Only Numbers are allowed."); 
			field.focus(); 
			field.select(); 
			return false;
		}
}*/
var field = form.usrstdcode;
if(field.value) { if(!validatestdcode(field.value)) { alert('Please enter a Valid STD Code. Only Numbers are allowed.'); field.focus(); return false; } }

var field = form.usrphone;
//if(!field.value) { alert("Please enter your Phone Number. "); field.focus(); return false; }
if(field.value) { if(!validatephone(field.value)) { alert('Please enter a Valid Phone Number. Only Numbers are allowed.'); field.focus(); return false; } }

var field = form.usrcell;
if(!field.value) { alert("Please enter the Mobile Number. "); field.focus(); return false; }
if(field.value) { if(!validatecell(field.value)) { alert('Please enter a valid Cell Number.'); field.focus(); return false; } }


var field = form.usrplace;  
if (!field.value)
{ alert("Please enter your Place."); field.focus(); field.select(); return false;}

var field = form.state;  
if (!field.value)
{ alert("Please enter your State."); field.focus(); return false;}

var field = form.district;  
if (!field.value)
{ alert("Please Select your District."); field.focus(); return false;}

var field = form.region;  
if (!field.value)
{ alert("Please Select your Region."); field.focus(); return false;}

var field = form.usrsecquestion;  
if (!field.value)
{ alert("Please enter a Security Question."); field.focus(); field.select(); return false;}

var field = form.usrsecanswer;  
if (!field.value)
{ alert("Please enter a Security Answer."); field.focus(); field.select(); return false;}

var field = form.usrexistingcust;  
if (!field.value)
{ alert("Are your Relyon Customer?."); field.focus(); return false;}

var field = form.usrrefer;  
if (!field.value)
{ alert("From where you referred about Us?."); field.focus(); return false;}

var field = form.agreeonline;  
if (field.checked == false)
{ alert("To Create User, you should agree to Relyon Online Services Agreement."); field.focus(); return false;}

var field = form.agreeprivacy;  
if (field.checked == false)
{ alert("To Create User, you should agree to Relyon Online Privacy Policy."); field.focus(); return false;}

 else
  return true;
 
}

//-----------------------------------------------------------------------------------------------------------------

