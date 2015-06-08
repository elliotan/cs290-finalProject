$(document).ready(function() {
  $("#login").click(function (event) {
    event.preventDefault();
    $.ajax({
      method: "POST",
      url: "login.php",
      data: $( "#login_form" ).serialize(),
      success: function(data) {
        if (data == "valid") window.location = "main.php?login=true";
        else if (data == "enterUser") $("#error").html('<p>Please Enter a Username</p>');
        else if (data == "enterPass") $("#error").html('<p>Please Enter a Password</p>');
        else $("#error").html('<p>Username and Password combination incorrect</p>');
      }
    });
  });
});

$(document).ready(function() {
  $("#create").click(function (event) {
    event.preventDefault();
    $.ajax({
      method: "POST",
      url: "login.php",
      data: $( "#login_form2" ).serialize(),  
      success: function(data) {
        if (data == "valid") window.location = "main.php?login=true";
        else if (data == "enterUser") $("#error2").html('<p>Please Enter a Username</p>');
        else if (data == "enterPass") $("#error2").html('<p>Please Enter a Password</p>');
        else if (data == "userTaken") $("#error2").html('<p>Username is taken</p>');
      }
    });
  });
});