//   Run PHP script searchusername.php on form submit (form)

$("#addFriends").submit(function(e){
    e.preventDefault();
    $.ajax({
        type:"POST",
        url: "../searchusername.php",
        data: {data: JSON.stringify($("#searchuname").val())},
        cache: false,
        success: function(response){
            $("#postData").html(response);
        }
    });
});

//   Run PHP script addFriend.php on button click (username)
function addFriend(){
	var username = $("#friend").attr("data-friendName");
    	alert(username);
	$.ajax({
        type: "POST",
        url: "../addFriend.php",
        data: {uname: JSON.stringify(username)},
        cache: false,
        success: function(response){
            $("#postData").html(response);
        }
    });
}

function acceptRequest(element){
    alert("Accepted "+ element.getAttribute("data-friendName"));
    var username = element.getAttribute("data-friendName");
    $.ajax({
	type: "POST",
	url: "../pendingRequests.php",
	data: {action: 'add', uname: JSON.stringify(username)},
	cache: false,
	success: function(response){
	    $("#pendingData").html(response);
	}
    });
}

function denyRequest(element){
    alert("Denied "+element.getAttribute("data-friendName"));
    var username = element.getAttribute("data-friendName");
    $.ajax({
        type: "POST",
	url: "../pendingRequests.php",
	data: {action: 'deny', uname: JSON.stringify(username)},
	cache: false,
	success: function(response){
	    $("#pendingData").html(response);
	}
    });
}
