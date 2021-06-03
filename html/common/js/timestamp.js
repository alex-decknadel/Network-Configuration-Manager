$.fn.setNow = function (onlyBlank) 
{		
  var now = new Date($.now()), year, month, date, hour, minutes, formattedDateTime;
  year = now.getFullYear();
	month = now.getMonth().toString().length === 1 ? '0' + (now.getMonth() + 1).toString() : now.getMonth() + 1;
	date = now.getDate().toString().length === 1 ? '0' + (now.getDate()).toString() : now.getDate();
	hours = hours = now.getHours().toString().length === 1 ? '0' + now.getHours().toString() : now.getHours();
	minutes = now.getMinutes().toString().length === 1 ? '0' + now.getMinutes().toString() : now.getMinutes();
	formattedDateTime = year + '-' + month + '-' + date + 'T' + hours + ':' + minutes;

	if ( onlyBlank === true && $(this).val() ) 
	{
		return this;
	}

	$(this).val(formattedDateTime);
	return this;
}