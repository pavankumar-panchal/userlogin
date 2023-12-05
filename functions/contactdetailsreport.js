// JavaScript Document
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var error = document.getElementById('form-error');

	if(command == 'view')
	{
		error.innerHTML = '';
		document.getElementById('submitform').action = "../admin/excelcontactdetailsreport.php?id=view";
		//document.getElementById('submitform').attr( 'target', '_blank' );
		document.getElementById('submitform').submit();
	}
	else
	{
		error.innerHTML = '';
		document.getElementById('submitform').action = "../admin/excelcontactdetailsreport.php?id=toexcel";
		document.getElementById('submitform').submit();
	}
}

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
	var queryString = "../ajax/districtselect.php?type=" + 'statenew' + "&code=" + code + "&dummy=" + Math.floor(Math.random()*10019200000);
	xRequest.open("GET", queryString, true);
	xRequest.send(null); 
	
}
