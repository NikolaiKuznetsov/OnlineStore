/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/scripts.js ***!
  \*********************************/
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e2) { throw _e2; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e3) { didErr = true; err = _e3; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
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
var form = document.getElementById('reg-form');
window.onload = function () {
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    var elements = form.querySelectorAll('p');
    var inputs = form.getElementsByClassName('border-red-500');
    var _iterator = _createForOfIteratorHelper(elements),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var elem = _step.value;
        elem.innerHTML = '';
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
    var _iterator2 = _createForOfIteratorHelper(inputs),
      _step2;
    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        var input = _step2.value;
        input.classList.remove('border-red-500');
      }
    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
    }
    if (!form.elements.rules.checked) {
      document.getElementById('rules-checkbox-text').classList.remove('hidden');
      return false;
    }
    axios.post(form.action, {
      name: form.elements.name.value,
      surname: form.elements.surname.value,
      patronymic: form.elements.patronymic.value,
      login: form.elements.login.value,
      email: form.elements.email.value,
      password: form.elements.password.value,
      password_confirmation: form.elements.password_confirmation.value,
      rules: form.elements.rules.value
    }).then(function (response) {
      window.location.replace("/");
    })["catch"](function (err) {
      if ('errors' in err.response.data) {
        var errorsArr = err.response.data.errors;
        for (var _i = 0, _Object$entries = Object.entries(errorsArr); _i < _Object$entries.length; _i++) {
          var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
            key = _Object$entries$_i[0],
            value = _Object$entries$_i[1];
          document.getElementById(key).classList.add('border-red-500');
          document.getElementById(key + '-message').innerText = value;
        }
        console.log(err.response.data);
      }
    });
    return false;
  });
};
/******/ })()
;