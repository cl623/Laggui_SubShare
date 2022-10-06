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
    element.innerHTML = "<div class='loader small-loader'></div>";
    var username = element.getAttribute("data-friendName");
    $.ajax({
        type: "POST",
        url: "../pendingRequests.php",
        data: {action: 'add', uname: username},
        cache: false,
        success: function(response){
            if(response == "Added"){
                alert(response);
                location.reload();
            }
            else if(response == "Fail"){
                alert(response);
                location.reload();
            }
	    },
        error: function(response){
            element.innerHTML = "add";
        }
    });
}

function denyRequest(element){
    element.innerHTML = "<div class='loader small-loader'></div>";
    var username = element.getAttribute("data-friendName");
    $.ajax({
        type: "POST",
        url: "../pendingRequests.php",
        data: {action: 'deny', uname: username},
        cache: false,
        success: function(response){
            if(response == "Blocked"){
                alert(response);
                location.reload();
            }
            else if(response == "Fail"){
                alert(response);
                location.reload();
            }
        },
        error: function(response){
            element.innerHTML = "block";
        }
    });
}

/* Dropdown Action per friend*/
function listFriendActions(id) {
    document.getElementById(id).classList.toggle("show");
  }
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }


function inviteToGroup(element){
    alert("Invite " + element.getAttribute('data-friendName'));
}

function deleteFriend(element){
    var friendName = element.getAttribute('data-friendName');
    alert("Delete " + friendName);
    document.getElementById("unfriendModal").style.display = "block";
    document.getElementById("friendName").innerHTML = friendName;
    document.getElementById("confirmDelete").setAttribute("data-friendName") = friendName;
}