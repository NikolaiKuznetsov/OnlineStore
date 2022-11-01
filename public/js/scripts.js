/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/scripts.js ***!
  \*********************************/
window.cartAdd = function (product_id) {
  axios.post('/checkout/add', {
    product_id: product_id
  }).then(function (response) {
    if (response.data) {
      document.getElementById('message').innerText = response.data;
      document.getElementById('alert-danger').classList.remove('hidden');
    } else {
      location.reload();
    }
  })["catch"](function (err) {
    console.log(err.response.data);
  });
};
window.reduceQuantity = function (id) {
  axios.post('/checkout/change-quantity', {
    id: id
  }).then(function (response) {
    location.reload();
  })["catch"](function (err) {
    console.log(err.response.data);
  });
};
/******/ })()
;