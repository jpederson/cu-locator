/**************************************************
	API FUNCTION
	Takes an "action" and additional parameters
	and makes an AJAX call to the API using 
	jQuery.post(). The final parameter is a 
	callback function in which we include a 
	single parameter of the data returned by 
	the API.
***************************************************/
function api_call( action, params, callback ) {
	$.post( "./?action="+action+"&"+params, function(data){
		callback(data);
	});
}
