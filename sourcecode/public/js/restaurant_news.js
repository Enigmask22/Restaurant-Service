var adult_count = document.getElementById("adult_count");
var child_count = document.getElementById("child_count");

if (document.getElementById("adult_price")) {
  var adult_price = document
    .getElementById("adult_price")
    .getAttribute("value");
}
if (document.getElementById("child_price")) {
  var child_price = document
    .getElementById("child_price")
    .getAttribute("value");
}

var total_price = document.getElementById("total_price");

document.getElementById("adult_price").innerHTML =
  formatNumber(Number(adult_price)) + " đ";
document.getElementById("child_price").innerHTML =
  formatNumber(Number(child_price)) + " đ";

document.getElementById("adult_price");

total_price.innerHTML = formatNumber(Number(adult_price)) + " đ";

adult_count.onchange = function () {
  var price =
    Number(this.value) * Number(adult_price) +
    Number(child_count.value) * Number(child_price);
  total_price.innerHTML = formatNumber(price) + " đ";
};

child_count.onchange = function () {
  var price =
    Number(adult_count.value) * Number(adult_price) +
    Number(this.value) * Number(child_price);
  total_price.innerHTML = formatNumber(price) + " đ";
};

function formatNumber(number) {
  // Using toLocaleString to add commas as a thousand separator
  return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
