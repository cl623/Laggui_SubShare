
/*$("#addFriends").on("submit", function(e){
    e.preventDefault();
    $.ajax({
        url: "searchusername.php",
        type: "POST",
        data: $(this).serialize(),
        success: function(response){
            //Do something with the returned data. Let the user add the user after successfully searching them up.
            $("#postData").html(response);
        },
        error: function(response){
            $("#postData").html("Error: " + response);
        }
    });
});*/
$("#addfriends").on("submit",function(e){
	e.preventDefault();
	$.ajax({
		type:"POST",
		url: "../searchusername.php",
		data:"JDoe1",
		cache: false,
		success: function(response){
		$("#postData").html(response);
		}
	});
});
