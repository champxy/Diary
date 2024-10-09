var input = document.getElementById("number1");

input.addEventListener("keyup", function () {
  // Remove any non-numeric characters
  var value = this.value.replace(/[^0-9]/g, '');

  // Format the value with commas and add "฿" at the end
  var formattedValue = Number(value).toLocaleString('th-TH') + " ฿";

  // Set the input value to the formatted value
  this.value = formattedValue;
});

var input = document.getElementById("number2");

input.addEventListener("keyup", function () {
  // Remove any non-numeric characters
  var value = this.value.replace(/[^0-9]/g, '');

  // Format the value with commas and add "฿" at the end
  var formattedValue = Number(value).toLocaleString('th-TH') + " ฿";

  // Set the input value to the formatted value
  this.value = formattedValue;
});




