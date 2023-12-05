// JavaScript Document
function formsubmit(command)
{
	var form = document.getElementById('submitform');
	var error = document.getElementById('form-error');
	var values = validateproductcheckboxes();
	if(values == false)	{error.innerHTML = errormessage("Select A Product"); return false;	}
	else
	{
		if(command == 'view')
		{
			error.innerHTML = '';
			document.getElementById('submitform').action = "../admin/excelcontactdetailsreport-leads.php?id=view";
			//document.getElementById('submitform').attr( 'target', '_blank' );
			document.getElementById('submitform').submit();
		}
		else
		{
			error.innerHTML = '';
			document.getElementById('submitform').action = "../admin/excelcontactdetailsreport-leads.php?id=toexcel";
			document.getElementById('submitform').submit();
		}
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


function enabledisableleaddate()
{
	var form = document.getElementById('submitform');
	if(document.getElementById('leaddate').checked == true)
	{
		document.getElementById('DPC_fromdate').disabled = false;	
		document.getElementById('DPC_todate').disabled = false;	
		document.getElementById("DPC_fromdate").className = "swiftselect-mandatory";
		document.getElementById("DPC_todate").className = "swiftselect-mandatory";
	}
	else 
	{
		document.getElementById('DPC_fromdate').disabled = true;	
		document.getElementById('DPC_todate').disabled = true;	
		document.getElementById("DPC_fromdate").className = "diabledatefield";
		document.getElementById("DPC_todate").className = "diabledatefield";
	}
		
}


function selectdeselectall()
{
	var chkvalues = document.getElementsByName("productname[]");
	var selectordeselect = document.getElementById('selectordeselect');
	if(selectordeselect.checked == true)
	{
		for (var i=0; i < chkvalues.length; i++)
		{
				chkvalues[i].checked = true;
		}
	}
	else
	{
		for (var i=0; i < chkvalues.length; i++)
		{
				chkvalues[i].checked = false;
		}
	}
}

function validateproductcheckboxes()
{
	var chksvalue = document.getElementsByName("productname[]");
	var hasChecked = false;
	for (var i = 0; i < chksvalue.length; i++)
	{
		if (chksvalue[i].checked == true)
		{
			hasChecked = true;
			return true
		}
	}
	if (!hasChecked)
	{
		return false
	}
}