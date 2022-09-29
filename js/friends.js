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
    element.innerHTML("<div class='loader small-loader'></div>");
    var username = element.getAttribute("data-friendName");
    $.ajax({
        type: "POST",
        url: "../pendingRequests.php",
        data: {action: 'add', uname: JSON.stringify(username)},
        cache: false,
        success: function(response){
            if(response == "Success"){
                alert(response);
                location.reload();
            }
            else if(response == "Fail"){
                alert(reponse);
                location.reload();
            }
	    },
        error: function(response){
            element.innerHTML("add");
        }
    });
}

function denyRequest(element){
    element.innerHTML("<div class='loader small-loader'></div>");
    var username = element.getAttribute("data-friendName");
    $.ajax({
        type: "POST",
        url: "../pendingRequests.php",
        data: {action: 'deny', uname: JSON.stringify(username)},
        cache: false,
        success: function(response){
            if(response == "Blocked"){
                alert(response);
                location.reload();
            }
            else if(response == "Fail"){
                alert(reponse);
                location.reload();
            }
        },
        error: function(response){
            element.innerHTML("block");
        }
    });
}
