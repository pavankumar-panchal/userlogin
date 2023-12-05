// JavaScript Document

function productselection()
{
	var productselected = getradiovalue(document.buy_form.buy_product);
	var usagetype = getradiovalue(document.buy_form.buy_usage);
	var purchasetype = getradiovalue(document.buy_form.buy_purchase);

	enabledisable(productselected);

	var licensecost = getprice(productselected,usagetype,purchasetype);
	var licensecoststring = licensecost + "/- Rs"
	var tax = Math.round(licensecost * 0.103);
	var taxstring = tax + "/- Rs";
	var totalprice = Math.round(licensecost + tax);
	var totalpricestring = totalprice + "/- Rs";

	if(productselected == "sppamc")
	{
		licensecoststring = "Value of your Relyon Currency";
		taxstring = "Value of your Relyon Currency";
		totalpricestring = "Value of your Relyon Currency";
	}

	document.getElementById("buy_licensecost").innerHTML = licensecoststring;
	document.getElementById("buy_tax").innerHTML = taxstring;
	document.getElementById("buy_totalprice").innerHTML = totalpricestring;
	document.getElementById("buy_totalprice_hidden").value = totalprice;
	
}

function getprice(productselected,usagetype,purchasetype)
{
	var licensecost = 0;
	switch(productselected)
	{
		case "tdsp":
			if(usagetype == "su")
				licensecost = (purchasetype == "new")?2000:1000;
			else
				licensecost = (purchasetype == "new")?3000:1500;
			break;
		case "tdsc":
			if(usagetype == "su")
				licensecost = (purchasetype == "new")?2000:1000;
			else
				licensecost = (purchasetype == "new")?3000:1500;
			break;
		case "tdsi":
			if(usagetype == "su")
				licensecost = (purchasetype == "new")?2000:1000;
			else
				licensecost = (purchasetype == "new")?3000:1500;
			break;
		case "sit":
			if(usagetype == "su")
				licensecost = (purchasetype == "new")?2000:1000;
			else
				licensecost = (purchasetype == "new")?3000:1500;
			break;
		case "sto":
			if(usagetype == "su")
				licensecost = (purchasetype == "new")?2000:1000;
			else
				licensecost = (purchasetype == "new")?3000:1500;
			break;
		case "ses":
			licensecost = 5000;
			break;
		case "sppamc":
			licensecost = 0;
			break;
	}
	return licensecost;
}

function enabledisable(productselected)
{
	if(productselected == "sppamc")
	{
		document.getElementById("buy_usage1").disabled = true;
		document.getElementById("buy_usage2").disabled = true;
		document.getElementById("buy_purchase1").disabled = true;
		document.getElementById("buy_purchase2").disabled = true;
		document.getElementById("buy_applicability").innerHTML = "(NOT APPLICABLE)";
	}
	else if(productselected == "ses")
	{
		document.getElementById("buy_usage1").checked = true;
		document.getElementById("buy_usage1").disabled = false;
		document.getElementById("buy_usage2").disabled = true;
		document.getElementById("buy_purchase1").checked = true;
		document.getElementById("buy_purchase1").disabled = false;
		document.getElementById("buy_purchase2").disabled = true;
		document.getElementById("buy_applicability").innerHTML = "";
	}
	else
	{
		document.getElementById("buy_usage1").disabled = false;
		document.getElementById("buy_usage2").disabled = false;
		document.getElementById("buy_purchase1").disabled = false;
		document.getElementById("buy_purchase2").disabled = false;
		document.getElementById("buy_applicability").innerHTML = "";
	}
	
	
}

function buyformsubmit()
{
	var paymenttype = getradiovalue(document.buy_form.buy_paymenttype);
	var buyform = document.buy_form;
	
	if(paymenttype)
	{
		buyform.action = "./buythrurc.php";
		buyform.submit();
	}
	else
	{
		return false;	
	}
}

function buycurrencysubmit()
{
	var pinno = document.buy_currency.buy_currencyno.value;
	var buy_currency = document.buy_currency;
	
	if(validatepinno())
	{
		buy_currency.action = "./buythrurc.php";
		buy_currency.submit();
	}
}


function validatepinno()
{
	var pinno = document.buy_currency.buy_currencyno;
	
	if(pinno.value == "")
	{alert("Please enter the PIN No."); pinno.focus(); pinno.select(); return false;}
	else if(pinno.value.length != 14)
	{alert("PIN No should be 14 Digits."); pinno.focus(); pinno.select(); return false;}
	else
		return true;
}

