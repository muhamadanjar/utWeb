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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/rm.js":
/*!***********************************!*\
  !*** ./resources/assets/js/rm.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
  }
});

$.fn.rowCount = function () {
  return $('tr', $(this).find('tbody')).length;
};

window.gMapsCallback = function () {
  $(window).trigger('gMapsLoaded');
};

var permission;
var provinsi = $('select#provinsi');
var kabkota = $('select#kabkota');
var kecamatan = $('select#kecamatan');
var desa = $('select#desa');
$.extend({
  getValues: function getValues(url) {
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
  }
});

var getjson = function getjson(url) {
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

var numeralsOnly = function numeralsOnly(evt) {
  evt = evt ? evt : event;
  var charCode = evt.charCode ? evt.charCode : evt.keyCode ? evt.keyCode : evt.which ? evt.which : 0;
  console.log(charCode);

  if (charCode > 31 && (charCode < 37 || charCode > 40) && (charCode < 48 || charCode > 57) && charCode != 46 && (charCode > 190 || charCode < 190) && (charCode > 116 || charCode < 116)) {
    alert("Hanya Nomor yang bisa di input pada kolom ini."); // console.log(evt);

    return false;
  }

  return true;
};

var lettersOnly = function lettersOnly(evt) {
  evt = evt ? evt : event;
  var charCode = evt.charCode ? evt.charCode : evt.keyCode ? evt.keyCode : evt.which ? evt.which : 0;

  if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
    alert("hanya huruf saja.");
    return false;
  }

  return true;
};

var ynOnly = function ynOnly(evt) {
  evt = evt ? evt : event;
  var charCode = evt.charCode ? evt.charCode : evt.keyCode ? evt.keyCode : evt.which ? evt.which : 0;

  if (charCode > 31 && charCode != 78 && charCode != 89 && charCode != 110 && charCode != 121) {
    alert("Masukan hanya \"Y\" atau \"N\".");
    return false;
  }

  return true;
};

var rangeNumber = function rangeNumber(evt) {
  evt = evt ? evt : event;
  var charCode = evt.charCode ? evt.charCode : evt.keyCode ? evt.keyCode : evt.which ? evt.which : 0;

  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    alert("Hanya Nomor yang bisa di input pada kolom ini.");
    $(this).val(0);
    return false;
  }

  var max = 100;
  var min = 0;

  if ($(this).val() > max) {
    $(this).val(max);
  } else if ($(this).val() < min) {
    $(this).val(min);
  }

  return true;
};

var hasRole = function hasRole(name) {
  permission = getjson('/api/checkpermission');
  var ret = null;

  for (i in permission) {
    console.log(permission[i]);

    if (permission[i] == name) {
      return true;
    }
  }
};

var sendData = function sendData(address, data, typeSend, callback) {
  $.ajax({
    url: address,
    type: typeSend,
    timeout: 30000,
    dataType: 'json',
    data: data,
    cache: false,
    complete: function complete(jqXHR) {
      if (typeof jqXHR.responseJSON === 'undefined') {
        jqXHR.responseJSON = {
          code: jqXHR.status,
          message: jqXHR.statusText
        };
      }

      if (typeof callback === 'function') {
        callback(jqXHR.responseJSON);
      }
    }
  });
};

window.sendData = sendData;

function base64image(resFile) {
  var reader = new FileReader();
  reader.readAsDataURL(resFile);

  reader.onloadend = function (evt) {
    return evt.target.result;
  };
}

var loaddatawilayah = function loaddatawilayah(url, data) {
  return $.ajax({
    url: url,
    dataType: "json",
    beforeSend: function beforeSend() {
      $('.loader').show();
      $("#loader-wrapper").show();
    }
  });
};

function loadProvinsi() {
  loaddatawilayah('/api/getprovinsi').then(function (data) {
    var options = '<option value="0">Pilih Provinsi..</option>';

    for (var x = 0; x < data.length; x++) {
      var selected = data[x]['kode_prov'] == $('#kode_prov').val() ? "selected" : "";
      options += '<option value="' + data[x]['kode_prov'] + '"' + selected + '>' + data[x]['nama_provinsi'] + '</option>';
    }

    provinsi.html(options);
    $("#loader-wrapper").hide();
  });
}

function loadKabupaten(id) {
  kabkota.html("<option value=''>Pilih Kota..</option>");
  loaddatawilayah('/api/getkabupaten/' + id).then(function (data) {
    var options = '<option value="0">Pilih Kota..</option>';

    for (var x = 0; x < data.length; x++) {
      var selected = data[x]['kode_kab'] == $('#kode_kab').val() ? "selected" : "";
      options += '<option value="' + data[x]['kode_kab'] + '"' + selected + '>' + data[x]['nama_kabupaten'] + '</option>';
    }

    kabkota.select2();
    kabkota.html(options);
    $("#loader-wrapper").hide();
  });
}

var loadKecamatan = function loadKecamatan(id) {
  kecamatan.html("<option value=''>Pilih Kecamatan..</option>");
  loaddatawilayah('/api/getkecamatan/' + id).then(function (data) {
    var options = '<option value="0">Pilih Kecamatan..</option>';
    var _data = data.data;

    for (var x = 0; x < _data.length; x++) {
      var selected = _data[x]['kode_kec'] == $('#kode_kec').val() ? "selected" : "";
      options += '<option value="' + _data[x]['kode_kec'] + '" ' + selected + '>' + _data[x]['nama_kecamatan'] + '</option>';
    }

    console.log(data);
    kecamatan.select2();
    kecamatan.html(options);
    $("#loader-wrapper").hide();
  });
};

window.loadKecamatan = loadKecamatan;

function loadDesa(id) {
  desa.html("<option value=''>Pilih Desa/Kelurahan..</option>");
  loaddatawilayah('/api/getdesa/' + id).then(function (data) {
    var options = '<option value="0">Pilih Desa..</option>';

    for (var x = 0; x < data.length; x++) {
      var selected = data[x]['kode_kel'] == $('#kode_kel').val() ? "selected" : "";
      options += '<option value="' + data[x]['kode_kel'] + '" ' + selected + '>' + data[x]['nama_kelurahan'] + '</option>';
    }

    desa.select2();
    desa.html(options);
    $("#loader-wrapper").hide();
  });
}

function loadGoogleMaps() {
  var script_tag = document.createElement('script');
  script_tag.setAttribute("type", "text/javascript");
  script_tag.setAttribute("src", "http://maps.google.com/maps/api/js?key=AIzaSyC-kEXeuhgPWY__PZ9mzePYwJuMwOzLyC0&sensor=false&callback=gMapsCallback");
  (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
}

(function ($, window, document) {
  $("#loader-wrapper").hide(); // nprogress

  $(document).ajaxStart(function () {// NProgress.start();
  });
  $(document).ajaxStop(function () {// NProgress.done();
    //clickable_tr();
  });
})(jQuery, window, document); //Modal


(function ($, window, document) {
  $('.formConfirm').on('click', function (e) {
    e.preventDefault();
    if ($(this).hasClass('disabled')) return;
    var el = $(this).parent();
    var title = el.attr('data-title');
    var msg = el.attr('data-message');
    var dataForm = el.attr('data-form');
    $('#formConfirm').find('#frm_body').html('<h6>' + msg + '</h6>').end().find('#frm_title').html(title).end().modal('show');
    $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
  });
  $('#formConfirm').on('click', '#frm_submit', function (e) {
    var id = $(this).attr('data-form'); //console.log(id);

    $(id).submit();
  });
})(jQuery, window, document); //Upload


(function ($, window, document) {
  // var hasChanged = false;
  // $(window).bind('beforeunload', function () {
  //     if (hasChanged) {
  //         return "You have unsaved changes";
  //         hasChanged = false;
  //     }
  // });
  // $('input[type=text]').change(function () {
  //     hasChanged = true;
  // });
  $('.formUpload').on('click', function (e) {
    var file_input = $(this).closest('span').find('.file');

    if (file_input.length > 0) {
      file_input.trigger('click');
    }
  });
  $('.fileupload:file').change(function () {
    var fileinput = $(this);
    var fileinput_url = fileinput.attr('data-url');
    var fileinput_path = fileinput.attr('data-path');
    var fileinput_type = fileinput.attr('data-type');
    var formData = new FormData($('*formId*')[0]);
    console.log(fileinput);
    formData.append("_token", window.Laravel.csrfToken);

    if (fileinput_type == '' || fileinput_type == 'single') {
      var file = this.files[0];
      name = file.name;
      size = file.size;
      type = file.type;

      if (file.name.length < 1) {} else if (file.size > 209715200) {
        alert("File Terlalu Besar, Maksimal 200 Mb");
      } else if (file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/gif' && file.type != 'image/jpeg' && file.type != 'application/pdf' && file.type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
        alert("File tidak diijinkan untuk di upload");
        $(this).val('');
      } else {
        if (!!file.type.match(/.*/)) {
          formData.append("images", file);
        }

        $.ajax({
          url: fileinput_url
          /*"/kuesioner/bangunan/upload"*/
          ,
          type: "POST",
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          dataType: 'json',
          beforeSend: function beforeSend() {
            $("#loader-wrapper").show();
          },
          complete: function complete() {
            $("#loader-wrapper").hide();
          },
          success: function success(data) {
            if (data.error) return false;

            if ($('.txtfoto').length > 0) {
              fileinput.closest('div.controlupload').find('input.txtfoto').css({
                "color": "peru",
                "border": "2px solid blue"
              }).val(data.filename);
              fileinput.parent().parent().parent().find('img.imgfoto').attr('src', fileinput_path + '/' + data.filename);
            }
          },
          error: errorHandler = function errorHandler(e) {
            alert("Something went wrong!");
            console.log(e);
          }
        });
      }
    } else {
      var file = this.files;
      var ins = file.length;

      for (var x = 0; x < ins; x++) {
        formData.append("images[]", file[x]);
      }

      $.ajax({
        url: fileinput_url,
        type: "POST",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function beforeSend() {
          $("#loader-wrapper").show();
        },
        complete: function complete() {
          $("#loader-wrapper").hide();
        },
        success: function success(data) {
          if (data.error) return false;

          if ($('.txtfoto').length > 0) {
            fileinput.closest('div.controlupload').find('.txtfoto').css({
              "color": "peru",
              "border": "2px solid blue"
            }).val(data[0].filename);
            var img = $('<img id="dynamic">');
            img.attr('class', 'img img-thumbnail');
            img.attr('src', fileinput_path + '/' + data[0].filename); //console.log(base64image(fileinput_path+'/'+data[0].filename));

            fileinput.closest('div.controlupload').prev().append(img);
          }
        },
        error: errorHandler = function errorHandler(e) {
          alert("Something went wrong!");
          console.log(e);
        }
      });
    }
  });
  $('#filedokumentasi').on('change', function () {
    var fileinput = $(this);
    var fileinput_url = fileinput.attr('data-url');
    var fileinput_path = fileinput.attr('data-path');
    var formData = new FormData($('*formId*')[0]);
    formData.append("_token", window.Laravel.csrfToken);
    formData.append("path", fileinput_path);
    var file = this.files[0];
    name = file.name;
    size = file.size;
    type = file.type;

    if (file.name.length < 1) {} else if (file.size > 209715200) {
      alert("File Terlalu Besar, Maksimal 200 Mb");
    } else {
      if (!!file.type.match(/.*/)) {
        formData.append("images", file);
      }

      $.ajax({
        url: fileinput_url,
        type: "POST",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function beforeSend() {
          $("#loader-wrapper").show();
          $('.btn-simpan').prop("disabled", true);
        },
        complete: function complete() {
          $("#loader-wrapper").hide();
          $('.btn-simpan').prop("disabled", false);
        },
        success: function success(data) {
          $('#images_preview').attr('src', "".concat(data.url_location, "/").concat(data.filename)).attr('class', 'img img-thumbnail');
          $('#images_sizes').html(data.sizes);
          $('.txtfiledokumentasi').css({
            "color": "peru",
            "border": "2px solid blue"
          }).val(data.filename);
        },
        error: errorHandler = function errorHandler(e) {
          alert("Something went wrong!");
          console.log(e);
        }
      });
    }
  });
})(jQuery, window, document); //Table


(function ($, window, document) {
  var template_transaksi = Handlebars.compile($("#details-transaksi-template").html());
  var table_reservation = $('#table_reservation').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: {
      url: window.Laravel.serverUrl + '/backend/trip_job_data',
      data: function data(d) {
        d.tgl_mulai = $('input[name=tgl_mulai]').val();
        d.status = $('select[name=status]').val();
        d.sq = $('input[name=sq]').val();
      }
    },
    columns: [{
      data: 'rownum',
      name: 'rank',
      orderable: false,
      searchable: false
    }, {
      data: 'trip_type'
    }, {
      data: 'trip_bookby'
    }, {
      data: 'trip_code'
    }, {
      data: 'trip_address_origin'
    }, {
      data: 'trip_date'
    }, {
      data: 'trip_driver'
    }, {
      data: 'trip_total'
    }, {
      data: 'trip_status'
    }, {
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false,
      width: "100px"
    }]
  });
  $('#table_reservation_search_form').on('submit', function (e) {
    table_reservation.draw();
    e.preventDefault();
  });
  $('#table_reservation tbody').on('click', 'a', function (e) {
    var data = table_reservation.row($(this).parents('tr')).data();
    var row = table_reservation.row($(this).parents('tr'));
    var id = data.id;

    if ($(this).hasClass('btn-detail')) {
      e.preventDefault();
      var el = $(this).parent();
      var title = el.attr('data-title');
      var msg = el.attr('data-message');
      var dataForm = el.attr('data-form');
      var tableId = 'transaksi-' + data.id;
      console.log(data);
      $('#formInfo').find('#frm_body').html('').append(template_transaksi(data)).end().find('#frm_title').html('Info').end().modal('show');
      initTableSubTransaksi(tableId, data);
      $(window).bind('gMapsLoaded', initializeMap('map_canvas_' + data.id));
    }
  });

  function initTableSubTransaksi(tableId, data) {
    $('#' + tableId).DataTable({
      processing: true,
      serverSide: true,
      ajax: data.details_url,
      dom: '<"table"t>',
      columns: [{
        data: 'userNamaLengkap',
        name: 'userNamaLengkap'
      }, {
        data: 'namaMobil',
        name: 'namaMobil'
      }, {
        data: 'warna',
        name: 'warna'
      }, {
        data: 'no_plat',
        name: 'no_plat'
      }, {
        data: 'driverTelp',
        name: 'driverTelp'
      }]
    });
  }
})(jQuery, window, document); //Form


(function ($, window, document) {
  // if (!$().datepicker) {
  //     console.warn('Warning - datepicker is not loaded.');
  //     return;
  // }
  // $('.datepicker').datepicker({
  //     autoclose: true,
  //     format: 'yyyy-mm-dd',
  //     startDate: '-3d'
  // });
  if ($('.start_at').length > 0) {
    $('.start_at').datetimepicker({
      //defaultDate: new Date(),
      dateFormat: "yy-mm-dd",
      timeFormat: "HH:mm"
    });
  }

  if ($('.end_at').length > 0) {
    $('.end_at').datetimepicker({
      //defaultDate: new Date(),
      dateFormat: "yy-mm-dd",
      timeFormat: "HH:mm"
    });
  }

  $('input.numberonly').on('keypress keydown', function (e) {
    return numeralsOnly(e);
  });
  $('input.letteronly').on('keypress', function (e) {
    return lettersOnly(e);
  });
  var checkall = 'th.check-all';
  $(checkall).on('change', function () {
    console.log(this);
    var $this = $(this),
        index = $this.index() + 1,
        checkbox = $this.find('input[type="checkbox"]'),
        table = $this.parents('table'); // Make sure to affect only the correct checkbox column

    table.find('tbody > tr > td:nth-child(' + index + ') input[type="checkbox"]').prop('checked', checkbox[0].checked);
  });
  loadProvinsi();

  if ($('#kode_prov').val() != null) {
    loadKabupaten($('#kode_prov').val());
  }

  provinsi.on('change', function () {
    loadKabupaten($(this).val());
  });

  if ($('#kode_kab').val() != null) {
    loadKecamatan($('#kode_kab').val());
  }

  kabkota.on('change', function () {
    loadKecamatan($(this).val());
  });

  if ($('#kode_kec').val() != null) {
    loadDesa($('#kode_kec').val());
  }

  kecamatan.on('change', function () {
    loadDesa($(this).val());
  });
  $('#checkmap').click(function () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        $('input[name=latitude]').val(position.coords.latitude);
        $('input[name=longitude]').val(position.coords.longitude);
      }, function () {});
    } else {
      // Browser doesn't support Geolocation
      alert('Browser anda tidak mendukung Geolocation');
    }
  });
  $('#dari_km').on('change focusout', function () {
    $('#sampai_km').attr('data-max', parseInt($(this).val()) + 100);
    $('#sampai_km').attr('data-min', parseInt($(this).val()));
  });
  $('#sampai_km').on('change keyup', function () {
    var i = $(this);

    if (parseInt(i.val()) > parseInt(i.attr('data-max'))) {
      i.val(i.attr('data-max'));
    } else if (parseInt(i.val()) < parseInt(i.attr('data-min'))) {
      alert('Data Sampai KM tidak boleh lebih kecil');
    }
  });
  $('input#ptk_baik_persentase').on('keyup change paste', function (e) {
    var v = $(this).val();
    if (v > 100) v = 100;
    $(this).val(v);
    var persen = v / 100;
    var result = persen * $('input#panjang').val();
    $('input#ptk_baik_km').val(result.toFixed(2));
  });
  $('input#ptk_baik_km').on('keyup change paste', function (e) {
    var v = $(this).val();
    var panjang = $('input#panjang').val();
    if (v > panjang) v = panjang;
    $(this).val(v);
    var km = v / panjang * 100;
    var result = Math.round(km);
    $('input#ptk_baik_persentase').val(result);
  }); //Sedang

  $('input#ptk_sedang_persentase').on('keyup change paste', function (e) {
    var v = $(this).val();
    if (v > 100) v = 100;
    $(this).val(v);
    var persen = v / 100;
    var result = persen * $('input#panjang').val();
    $('input#ptk_sedang_km').val(result.toFixed(2));
  });
  $('input#ptk_sedang_km').on('keyup change paste', function (e) {
    var v = $(this).val();
    var panjang = $('input#panjang').val();
    if (v > panjang) v = panjang;
    $(this).val(v);
    var km = v / panjang * 100;
    var result = Math.round(km);
    $('input#ptk_sedang_persentase').val(result);
  }); //Rusak Ringan

  $('input#ptk_rusakringan_persentase').on('keyup change paste', function (e) {
    var v = $(this).val();
    if (v > 100) v = 100;
    $(this).val(v);
    var persen = v / 100;
    var result = persen * $('input#panjang').val();
    $('input#ptk_rusakringan_km').val(result.toFixed(2));
  });
  $('input#ptk_rusakringan_km').on('keyup change paste', function (e) {
    var v = $(this).val();
    var panjang = $('input#panjang').val();
    if (v > panjang) v = panjang;
    $(this).val(v);
    var km = v / panjang * 100;
    var result = Math.round(km);
    $('input#ptk_rusakringan_persentase').val(result);
  }); //Rusak Berat

  $('input#ptk_rusakberat_persentase').on('keyup change paste', function (e) {
    var v = $(this).val();
    if (v > 100) v = 100;
    $(this).val(v);
    var persen = v / 100;
    var result = persen * $('input#panjang').val();
    $('input#ptk_rusakberat_km').val(result.toFixed(2));
  });
  $('input#ptk_rusakberat_km').on('keyup change paste', function (e) {
    var v = $(this).val();
    var panjang = $('input#panjang').val();
    if (v > panjang) v = panjang;
    $(this).val(v);
    var km = v / panjang * 100;
    var result = Math.round(km);
    $('input#ptk_rusakberat_persentase').val(result);
  }); //==========================================================

  $('form#formSKJ input#nilai_sdi').on('keyup change paste', function (e) {
    var sampai = $('input#sampai_km').val();
    var dari = $('input#dari_km').val();
    var nilai_iri = $('input#nilai_iri').val();
    var nilai_sdi = $('input#nilai_sdi').val();
    getSdiIri(sampai, dari, nilai_sdi, nilai_iri);
  });
  $('form#formSKJ input#nilai_iri').on('keyup change paste', function (e) {
    var sampai = $('input#sampai_km').val();
    var dari = $('input#dari_km').val();
    var nilai_iri = $('input#nilai_iri').val();
    var nilai_sdi = $('input#nilai_sdi').val();
    console.log(sampai, dari, nilai_sdi, nilai_iri);
    getSdiIri(sampai, dari, nilai_sdi, nilai_iri);
  });
  $('form#formSKJ input.kl_jml_lubang').on('keyup change paste', function (e) {
    var $checked = $(this).filter(function () {
      return $(this).prop('checked');
    });
    var retak_luas = $('input.retak_luas:checked').val();
    var retak_lebar = $('input.retak_lebar:checked').val();
    var jumlah_lubang = $checked.val();
    var bekasroda = $('input.kl_bekas_roda:checked').val();
    getSdi(retak_luas, retak_lebar, jumlah_lubang, bekasroda);
    getSdiIri($('input#sampai_km').val(), $('input#dari_km').val(), $('input#nilai_sdi').val(), $('input#nilai_iri').val());
  });
  $('form#formSKJ input.kl_bekas_roda').on('keyup change paste', function (e) {
    var $checked = $(this).filter(function () {
      return $(this).prop('checked');
    });
    var retak_luas = $('input.retak_luas:checked').val();
    var retak_lebar = $('input.retak_lebar:checked').val();
    var jumlah_lubang = $('input.kl_jml_lubang:checked').val();
    var bekasroda = $checked.val();
    getSdi(retak_luas, retak_lebar, jumlah_lubang, bekasroda);
    getSdiIri($('input#sampai_km').val(), $('input#dari_km').val(), $('input#nilai_sdi').val(), $('input#nilai_iri').val());
  });

  String.prototype.replaces = function (search, replacement) {
    var str = this;

    if (str.indexOf(search) === -1) {
      return str;
    }

    return str.replace(search, replacement).replaces(search, replacement);
  };

  var format = function format(num) {
    var str = num.toString().replace("$", ""),
        parts = false,
        output = [],
        i = 1,
        formatted = null;

    if (str.indexOf(".") > 0) {
      parts = str.split(".");
      str = parts[0];
    }

    str = str.split("").reverse();

    for (var j = 0, len = str.length; j < len; j++) {
      if (str[j] != ",") {
        output.push(str[j]);

        if (i % 3 == 0 && j < len - 1) {
          output.push(",");
        }

        i++;
      }
    }

    formatted = output.reverse().join("");
    return formatted + (parts ? "." + parts[1].substr(0, 2) : "");
  };

  $('.currency, .number').on('keyup', function () {
    $(this).val(format($(this).val()));
  });
  $('#btnMStation').on('click', function () {
    sendData('http://ptnkonekthing.localhost/welcome/managestat', 'station=' + $('#mStation').val(), 'POST', function (a) {
      a.code === 200 ? window.location.reload(true) : alert(a.message);
    });
  });
})(jQuery, window, document);

/***/ }),

/***/ 0:
/*!*****************************************!*\
  !*** multi ./resources/assets/js/rm.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/muhamadanjar/Sites/rental/resources/assets/js/rm.js */"./resources/assets/js/rm.js");


/***/ })

/******/ });