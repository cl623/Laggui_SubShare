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
function addFriend(username){
    $.ajax({
        type: "POST",
        url: "../addFriend.php",
        data: {uname: username},
        cache: false,
        success: function(response){
            $("#postData").html(response);
        }
    });
}
