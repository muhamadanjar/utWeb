/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/calculatesdiiri.js":
/*!************************************************!*\
  !*** ./resources/assets/js/calculatesdiiri.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.getjson = function (url) {
  var result = null;
  $.ajax({
    url: url,
    type: 'get',
    dataType: 'json',
    async: false,
    success: function success(data) {
      result = data;
    }
  });
  return result;
};

window.getSdiIri = function (sampai_km, dari_km, nilai_sdi, nilai_iri) {
  var panjang_km = sampai_km - dari_km;
  var baik = 0,
      sedang = 0,
      rusakringan = 0,
      rusakberat = 0;
  var mantap = 0,
      tdkmantap = 0;
  nilai_sdi = parseInt(nilai_sdi);
  var datasdiiri = getjson('/api/formskj/sdiiri/?sampai_km=' + sampai_km + '&dari_km=' + dari_km + '&nilai_iri=' + nilai_iri + '&nilai_sdi=' + nilai_sdi);
  baik = datasdiiri.baik;
  sedang = datasdiiri.sedang;
  rusakringan = datasdiiri.rusakringan;
  rusakberat = datasdiiri.rusakberat;
  mantap = baik + sedang;
  tdkmantap = rusakringan + rusakberat;
  console.log(baik, sedang, rusakringan, rusakberat);
  $('input.k_baik').val(datasdiiri.baik);
  $('input.k_sedang').val(datasdiiri.sedang);
  $('input.k_rusakringan').val(datasdiiri.rusakringan);
  $('input.k_rusakberat').val(datasdiiri.rusakberat);
};

window.getSdi = function () {
  var retak_luas = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
  var retak_lebar = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
  var jumlah_lubang = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;
  var bekasroda = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 0;
  console.log(retak_luas, retak_lebar, jumlah_lubang, bekasroda);
  var bantu = 0;
  var sdi_retaklebar = 0,
      sdi_retakluas = 0;

  if (retak_luas == 1) {
    sdi_retakluas = 0;
  } else if (retak_luas == 2) {
    sdi_retakluas = 5;
  } else if (retak_luas == 3) {
    sdi_retakluas = 20;
  } else if (retak_luas == 4) {
    sdi_retakluas = 40;
  } else {
    sdi_retakluas = 0;
  }

  sdi_retaklebar = retak_lebar == 4 ? sdi_retakluas * 2 : 0;
  bantu = sdi_retaklebar == 0 ? sdi_retakluas : sdi_retaklebar;

  if (jumlah_lubang == 1) {
    sdi_jumlahlubang = bantu;
  } else if (jumlah_lubang == 2) {
    sdi_jumlahlubang = bantu + 15;
  } else if (jumlah_lubang == 3) {
    sdi_jumlahlubang = bantu + 75;
  } else if (jumlah_lubang == 4) {
    sdi_jumlahlubang = bantu + 255;
  } else {
    sdi_jumlahlubang = 0;
  }

  if (bekasroda == 1) {
    sdi_bekasroda = sdi_jumlahlubang;
  } else if (bekasroda == 2) {
    sdi_bekasroda = sdi_jumlahlubang + 5 * 0.5;
  } else if (bekasroda == 3) {
    sdi_bekasroda = sdi_jumlahlubang + 5 * 2;
  } else if (bekasroda == 4) {
    sdi_bekasroda = sdi_jumlahlubang + 5 * 4;
  } else {
    sdi_bekasroda = 0;
  }

  nilai_sdi = sdi_bekasroda > 0 ? sdi_bekasroda : 0;
  $('p.p_retaklebar').text(sdi_retaklebar);
  $('p.p_jumlahlubang').text(sdi_jumlahlubang);
  $('p.p_bekas_roda').text(sdi_bekasroda);
  $('input#nilai_sdi').val(nilai_sdi);
  $('p.p_nilaisdi').text(nilai_sdi);
};

/***/ }),

/***/ 1:
/*!******************************************************!*\
  !*** multi ./resources/assets/js/calculatesdiiri.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/muhamadanjar/Sites/rental/resources/assets/js/calculatesdiiri.js */"./resources/assets/js/calculatesdiiri.js");


/***/ })

/******/ });