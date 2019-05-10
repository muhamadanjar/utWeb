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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/datatable_app.js":
/*!**********************************************!*\
  !*** ./resources/assets/js/datatable_app.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/* ------------------------------------------------------------------------------
 *
 *  # Responsive extension for Datatables
 *
 *  Demo JS code for datatable_responsive.html page
 *
 * ---------------------------------------------------------------------------- */
// Setup module
// ------------------------------
var DatatableResponsive = function () {
  //
  // Setup module components
  //
  // Basic Datatable examples
  var _componentDatatableResponsive = function _componentDatatableResponsive() {
    if (!$().DataTable) {
      console.warn('Warning - datatables.min.js is not loaded.');
      return;
    } // Setting datatable defaults


    $.extend($.fn.dataTable.defaults, {
      autoWidth: false,
      responsive: true,
      dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
      language: {
        "decimal": "",
        "emptyTable": "Tidak ada data",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
        "infoFiltered": "(dari _MAX_ total data)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Data _MENU_ ",
        "loadingRecords": "Tunggu Sebentar...",
        "processing": "Proses...",
        "search": "Cari:",
        "zeroRecords": "Tidak ada data yang dicari..",
        "paginate": {
          "first": "<i class='fa fa-step-backward'></i>",
          "last": "<i class='fa fa-step-forward'></i>",
          "next": "<i class='fa fa-forward'></i>",
          "previous": "<i class='fa fa-backward'></i>"
        },
        "aria": {
          "sortAscending": ": activate to sort column ascending",
          "sortDescending": ": activate to sort column descending"
        }
      }
    }); // Basic responsive configuration

    $('.datatable-responsive').DataTable(); // Column controlled child rows

    $('.datatable-responsive-column-controlled').DataTable({
      responsive: {
        details: {
          type: 'column'
        }
      },
      columnDefs: [{
        className: 'control',
        orderable: false,
        targets: 0
      }, {
        width: "100px",
        targets: [6]
      }, {
        orderable: false,
        targets: [6]
      }],
      order: [1, 'asc']
    }); // Control position

    $('.datatable-responsive-control-right').DataTable({
      responsive: {
        details: {
          type: 'column',
          target: -1
        }
      },
      columnDefs: [{
        className: 'control',
        orderable: false,
        targets: -1
      }, {
        width: "100px",
        targets: [5]
      }, {
        orderable: false,
        targets: [5]
      }]
    }); // Whole row as a control

    $('.datatable-responsive-row-control').DataTable({
      responsive: {
        details: {
          type: 'column',
          target: 'tr'
        }
      },
      columnDefs: [{
        className: 'control',
        orderable: false,
        targets: 0
      }, {
        width: "100px",
        targets: [6]
      }, {
        orderable: false,
        targets: [6]
      }],
      order: [1, 'asc']
    });
    var table_dom = $('#table_dom').DataTable();
    var table_user = $('#table_user').DataTable();
    var table_role = $('#table_role').DataTable({});
    var table_jalan = $('#table_jalan').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      ajax: {
        url: Laravel.serverUrl + '/api/jalan?token=' + Laravel.api_token,
        data: function data(d) {
          d.q = $('input#q').val();
        },
        headers: {
          'Authorization': 'Bearer ' + Laravel.api_token,
          'Accept': 'application/json'
        },
        beforeSend: function beforeSend(request) {
          request.setRequestHeader("token", Laravel.api_token);
        }
      },
      columns: [{
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false
      }, {
        data: 'no_ruas',
        name: 'no_ruas'
      }, {
        data: 'nama_ruas',
        name: 'nama_ruas'
      }, {
        data: 'nama_kecamatan',
        name: 'nama_kecamatan'
      }, {
        data: 'panjang',
        name: 'panjang'
      }, {
        data: 'lebar',
        name: 'lebar'
      }, {
        data: 'ptjp_aspal',
        name: 'ptjp_aspal'
      }, {
        data: 'ptjp_beton',
        name: 'ptjp_beton'
      }, {
        data: 'ptjp_kerikil',
        name: 'ptjp_kerikil'
      }, {
        data: 'ptjp_tanah',
        name: 'ptjp_tanah'
      }, {
        data: 'akses_jalan',
        name: 'akses_jalan'
      }, {
        data: 'pembiayaan',
        name: 'pembiayaan'
      }, {
        data: 'tahun',
        name: 'tahun'
      }],
      order: [[1, 'asc']],
      dom: '<"row"<"col-md-5"<"#sc">><"col-md-7"<Bl>><"col-md-12"t><"col-md-5"i><"col-md-7"p>>',
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
      buttons: [{
        extend: 'pdfHtml5',
        text: '<i class="fa fa-file-pdf-o"></i><b> PDF</b>',
        orientation: 'landscape',
        //portrait
        pageSize: 'A4',
        //A3 , A5 , A6 , legal , letter
        className: 'btn btn-danger btn-sm',
        exportOptions: {
          modifier: {
            page: 'current'
          },
          columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
          search: 'applied',
          order: 'applied'
        },
        init: function init(api, node, config) {
          console.log($(config.className).prev());
          $(node.parentElement).removeClass('btn-group');
        }
      }, {
        extend: 'excelHtml5',
        text: '<i class="fa fa-file-excel-o"></i><b> Excel</b>',
        className: 'btn bg-olive btn-sm',
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
        }
      }]
    });
    $('#table_jalan_search_form').on('submit', function (e) {
      table_jalan.draw();
      e.preventDefault();
      console.log(e);
    });
    $("#table_jalan tbody").on("click", "a", function (e) {
      //e.preventDefault();
      var row = table_jalan.row($(this).parents('tr'));
      var data = row.data();
      if ($(this).hasClass('disabled')) return;

      if ($(this).hasClass('btn-delete')) {
        console.log(data);
        var el = $(this).parent();
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');
        var newForm = jQuery('<form>', {
          'action': Laravel.serverUrl + '/backend/jalan/' + data.id,
          'target': '_top',
          'method': 'post'
        }).append(jQuery('<input>', {
          'name': '_method',
          'value': 'DELETE',
          'type': 'hidden'
        })).append($('<input />', {
          'name': '_token',
          'value': $('meta[name="_token"]').attr('content'),
          'type': 'hidden'
        }));
        $('#formConfirm').find('#frm_body').html('<h6>' + msg + '</h6>').append(newForm).end().find('#frm_title').html(title).end().modal('show');
        $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
        $('#formConfirm').on('click', '#frm_submit', function (e) {
          //var id = $(this).attr('data-form');
          //console.log(newForm);
          newForm.submit(); //$(id).submit();
        });
      } else if ($(this).hasClass('btn-stripmap')) {
        var title = 'Strip Map';
        var cvs = document.createElement('canvas');
        cvs.setAttribute('width', 550);
        var ctx = cvs.getContext("2d");
        var colorBaik = '#108F02';
        var colorSedang = '#F7AA0E';
        var colorRusakRingan = '#E25E11';
        var colorRusakBerat = '#E52312';
        var p = 0;
        var w = 0;
        var s = 0;
        var x = 0;
        var y = 0;
        var table = '';
        $.ajax({
          type: 'GET',
          url: Laravel.serverUrl + '/backend/jalan/' + data['id'] + '/stripmap',
          datatype: 'html',
          success: function success(result) {
            table = result;
            $('#formInfo').find('#frm_body').css({
              'overflow-y': 'auto'
            }).append(table).end().find('#frm_title').html(title).end().modal('show'); // for (data in result) {
            //     console.log(Object(result[data]));
            //     p = parseInt(result[data].panjang);
            //     w = (w + p);
            //     p = p / 4;
            //     if (result[data].k_baik != 0) {
            //         ctx.fillStyle = colorBaik;
            //     } else if (result[data].k_sedang != 0) {
            //         ctx.fillStyle = colorSedang;
            //     } else if (result[data].k_rusakringan != 0) {
            //         ctx.fillStyle = colorRusakRingan;
            //     } else {
            //         ctx.fillStyle = colorRusakBerat;
            //     }
            //     ctx.fillRect(x, y, p, 25);
            //     x = x + p + 3;
            //     s = w;
            // }
          },
          error: function error() {
            console.log('There was a problem with mainLoader request.');
          },
          complete: function complete(result) {}
        });
      } else {}
    });
    $("#table_jalan_search_form").appendTo($('#sc'));
    var table_djalan = $('#table_djalan').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      ajax: {
        url: Laravel.serverUrl + '/api/djalan/dt/' + $("input#jalan_id_primary").val(),
        data: function data(d) {
          d.q = $('input#q').val();
        }
      },
      columns: [{
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false
      }, {
        data: 'dari_km',
        name: 'dari_km'
      }, {
        data: 'sampai_km',
        name: 'sampai_km'
      }, {
        data: 'tipe_jalan',
        name: 'tipe_jalan'
      }, {
        data: 'nilai_iri',
        name: 'nilai_iri'
      }, {
        data: 'nilai_sdi',
        name: 'nilai_sdi'
      }, {
        data: 'k_baik',
        name: 'k_baik'
      }, {
        data: 'k_sedang',
        name: 'k_sedang'
      }, {
        data: 'k_rusakringan',
        name: 'k_rusakringan'
      }, {
        data: 'k_rusakberat',
        name: 'k_rusakberat'
      }, {
        data: 'lajur',
        name: 'lajur'
      }],
      order: [[1, 'asc']],
      //dom: '<"row"<"col-md-6"l><"col-md-6"f><t><"col-md-5"i><"col-md-7"p>>'
      dom: '<"row"<t><"col-md-5"i><"col-md7"p>>'
    });
    $("#table_djalan tbody").on("click", "a", function (e) {
      e.preventDefault();
      var row = table_djalan.row($(this).parents('tr'));
      var data = row.data();

      if ($(this).hasClass('btn-edit')) {
        var nilai_iri = $("#form-djalan").find("input[name=nilai_iri]").val();
        $("form#formSKJ").find("input[name=id]").val(data.id);
        $("form#formSKJ").find("input[name=jalan_id]").val(data.jalan_id);
        $("form#formSKJ").find("input[name=dari_km]").val(data.dari_km);
        $("form#formSKJ").find("input[name=sampai_km]").val(data.sampai_km);
        $("form#formSKJ").find("input[name=nilai_iri]").val(data.nilai_iri);
        $("#form-djalan").find("input[name=pp_susunan][value='" + data.pp_susunan + "']").prop('checked', true);
        $("#form-djalan").find("input[name=pp_kondisi][value='" + data.pp_kondisi + "']").prop('checked', true);
        $("#form-djalan").find("input[name=pp_penurunan][value='" + data.pp_penurunan + "']").prop('checked', true);
        $("#form-djalan").find("input[name=pp_tambalan][value='" + data.pp_tambalan + "']").prop('checked', true);
        $("#form-djalan").find("input[name=retak_jenis][value='" + data.retak_jenis + "']").prop('checked', true);
        $("#form-djalan").find("input[name=retak_lebar][value='" + data.retak_lebar + "']").prop('checked', true);
        $("#form-djalan").find("input[name=retak_luas][value='" + data.retak_luas + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kl_jml_lubang][value='" + data.kl_jml_lubang + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kl_ukuran_lubang][value='" + data.kl_ukuran_lubang + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kl_bekas_roda][value='" + data.kl_bekas_roda + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kl_kt_kiri][value='" + data.kl_kt_kiri + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kl_kt_kanan][value='" + data.kl_kt_kanan + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kss_kondisibahu_kiri][value='" + data.kss_kondisibahu_kiri + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kss_kondisibahu_kanan][value='" + data.kss_kondisibahu_kanan + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kss_permukaanbahu_kiri][value='" + data.kss_permukaanbahu_kiri + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kss_permukaanbahu_kanan][value='" + data.kss_permukaanbahu_kanan + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kss_kiri][value='" + data.kss_kiri + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kss_kanan][value='" + data.kss_kanan + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kss_kerusakanlereng_kiri][value='" + data.kss_kerusakanlereng_kiri + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kss_kerusakanlereng_kanan][value='" + data.kss_kerusakanlereng_kanan + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kss_trotoar_kiri][value='" + data.kss_trotoar_kiri + "']").prop('checked', true);
        $("#form-djalan").find("input[name=kss_trotoar_kanan][value='" + data.kss_trotoar_kanan + "']").prop('checked', true);
        var skjtable = getjson(Laravel.serverUrl + '/api/formskj/summary/' + data.retak_luas + '/' + data.retak_lebar + '/' + data.kl_jml_lubang + '/' + data.kl_bekas_roda);
        $("#form-djalan").find("p.p_retakluas").text(skjtable.sdi_retak_luas);
        $("#form-djalan").find("p.p_retaklebar").text(skjtable.sdi_retak_lebar);
        $("#form-djalan").find("p.p_jumlahlubang").text(skjtable.sdi_jumlahlubang);
        $("#form-djalan").find("p.p_bekasroda").text(skjtable.sdi_bekasroda);
        $("#form-djalan").find("p.p_nilaisdi").text(skjtable.nilai_sdi);
        $("#form-djalan").find("input[name=nilai_sdi]").val(skjtable.nilai_sdi);
        var datasdiiri = getjson(Laravel.serverUrl + '/api/formskj/sdiiri/?sampai_km=' + data.sampai_km + '&dari_km=' + data.dari_km + '&nilai_iri=' + nilai_iri + '&nilai_sdi=' + skjtable.nilai_sdi);
        console.log(datasdiiri);
        $("#form-djalan").find("input[name=k_baik]").val(datasdiiri.baik);
        $("#form-djalan").find("input[name=k_sedang]").val(datasdiiri.sedang);
        $("#form-djalan").find("input[name=k_rusakringan]").val(datasdiiri.rusakringan);
        $("#form-djalan").find("input[name=k_rusakberat]").val(datasdiiri.rusakberat);
        $("#form-djalan").find("input[name=pp_kemiringan_melintang]").val(data.pp_kemiringan_melintang);
        $("#form-djalan").find("input[name=pp_erosi_permukaan]").val(data.pp_erosi_permukaan);
        $("#form-djalan").find("input[name=kerikil_ukuranterbanyak]").val(data.kerikil_ukuranterbanyak);
        $("#form-djalan").find("input[name=kerikil_teballapisan]").val(data.kerikil_teballapisan);
        $("#form-djalan").find("input[name=kerikil_distribual]").val(data.kerikil_distribual);
        $("#form-djalan").find("input[name=kl_bergelombang]").val(data.kl_bergelombang);
        $('#form-djalan').modal('show');
      } else {
        var el = $(this).parent();
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');
        var newForm = jQuery('<form>', {
          'action': '/backend/jalan/detil/' + data.id + '/delete',
          'target': '_top',
          'method': 'post'
        }).append(jQuery('<input>', {
          'name': '_method',
          'value': 'DELETE',
          'type': 'hidden'
        })).append($('<input />', {
          'name': '_token',
          'value': $('meta[name="_token"]').attr('content'),
          'type': 'hidden'
        }));
        $('#formConfirm').find('#frm_body').html('<h6>' + msg + '</h6>').append(newForm).end().find('#frm_title').html(title).end().modal('show');
        $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
        $('#formConfirm').on('click', '#frm_submit', function (e) {
          //var id = $(this).attr('data-form');
          //console.log(newForm);
          newForm.submit(); //$(id).submit();
        });
      }
    });
    $("button").on("click", ".btn-tambah-djalan", function (e) {
      $('#form-djalan').modal('show');
    });
    $('#tambahskj').on('click', function () {
      var data = {
        id: $('#id').val(),
        jalan_id: $('#jalan_id').val(),
        dari_km: $('#dari_km').val(),
        sampai_km: $('#sampai_km').val(),
        tipe_jalan: $('#tipe_jalan').val(),
        nilai_iri: $('#nilai_iri').val(),
        nilai_sdi: $('#nilai_sdi').val(),
        pp_susunan: $('input[name="pp_susunan"]:checked').val(),
        pp_kondisi: $('input[name="pp_kondisi"]:checked').val(),
        pp_penurunan: $('input[name="pp_penurunan"]:checked').val(),
        retak_jenis: $('input[name="retak_jenis"]:checked').val(),
        kerikil_ukuranterbanyak: $('input[name="kerikil_ukuranterbanyak"]:checked').val(),
        kerikil_teballapisan: $('input[name="kerikil_teballapisan"]:checked').val(),
        kerikil_distribual: $('input[name="kerikil_distribual"]:checked').val(),
        kl_gelombang: $('input[name="kl_gelombang"]:checked').val(),
        kl_jml_lubang: $('input[name="kl_jml_lubang"]:checked').val(),
        kl_ukuran_lubang: $('input[name="kl_ukuran_lubang"]:checked').val(),
        kl_bekas_roda: $('input[name="kl_bekas_roda"]:checked').val(),
        kl_kt_kiri: $('input[name="kl_kt_kiri"]:checked').val(),
        kl_kt_kanan: $('input[name="kl_kt_kanan"]:checked').val(),
        kss_kondisibahu_kiri: $('input[name="kss_kondisibahu_kiri"]:checked').val(),
        kss_kondisibahu_kanan: $('input[name="kss_kondisibahu_kanan"]:checked').val(),
        kss_permukaanbahu_kiri: $('input[name="kss_permukaanbahu_kiri"]:checked').val(),
        kss_permukaanbahu_kanan: $('input[name="kss_permukaanbahu_kanan"]:checked').val(),
        kss_kiri: $('input[name="kss_kiri"]:checked').val(),
        kss_kanan: $('input[name="kss_kanan"]:checked').val(),
        kss_kerusakanlereng_kiri: $('input[name="kss_kerusakanlereng_kiri"]:checked').val(),
        kss_kerusakanlereng_kanan: $('input[name="kss_kerusakanlereng_kanan"]:checked').val(),
        kss_trotoar_kiri: $('input[name="kss_trotoar_kiri"]:checked').val(),
        kss_trotoar_kanan: $('input[name="kss_trotoar_kanan"]:checked').val(),
        no_ruas: $('input[name="no_ruas"]').val(),
        lajur: $('#lajur').val(),
        panjang: $('input[name="panjang"]').val(),
        lebar: $('input[name="lebar"]').val(),
        k_baik: $('input[name="k_baik"]').val(),
        k_sedang: $('input[name="k_sedang"]').val(),
        k_rusakringan: $('input[name="k_rusakringan"]').val(),
        k_rusakberat: $('input[name="k_rusakberat"]').val()
      };
      var send = $.post("".concat(Laravel.serverUrl, "/backend/jalan/detil/post"), data);
      send.done(function (data) {
        console.log(data);
        $('#form-djalan').modal('hide');
      });
      table_djalan.draw(true);
    }); //Table Layer

    var table_layer = $('#table_layer').DataTable({
      order: [[1, 'asc']],
      dom: '<"row"<"col-md-5"l><"col-md-7"<"#sc"f>><"col-md-12"t><"col-md-5"i><"col-md-7"p>>',
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]]
    });
    $("#table_layer tbody").on("click", "a", function (e) {
      ;
      var row = table_layer.row($(this).parents('tr'));
      var data = row.data();
      if ($(this).hasClass('disabled')) return;

      if ($(this).hasClass('btn-delete')) {
        console.log(data);
        var el = $(this).parent();
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');
        var newForm = jQuery('<form>', {
          'action': Laravel.serverUrl + '/backend/jalan/' + data.id,
          'target': '_top',
          'method': 'post'
        }).append(jQuery('<input>', {
          'name': '_method',
          'value': 'DELETE',
          'type': 'hidden'
        })).append($('<input />', {
          'name': '_token',
          'value': $('meta[name="_token"]').attr('content'),
          'type': 'hidden'
        }));
        $('#formConfirm').find('#frm_body').html('<h6>' + msg + '</h6>').append(newForm).end().find('#frm_title').html(title).end().modal('show');
        $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
        $('#formConfirm').on('click', '#frm_submit', function (e) {
          //var id = $(this).attr('data-form');
          //console.log(newForm);
          newForm.submit(); //$(id).submit();
        });
      }
    });
  }; // Select2 for length menu styling


  var _componentSelect2 = function _componentSelect2() {
    if (!$().select2) {
      console.warn('Warning - select2.min.js is not loaded.');
      return;
    } // Initialize


    $('.dataTables_length select').select2({
      minimumResultsForSearch: Infinity,
      dropdownAutoWidth: true,
      width: 'auto'
    });
  }; //
  // Return objects assigned to module
  //


  return {
    init: function init() {
      _componentDatatableResponsive();

      _componentSelect2();
    }
  };
}(); // Initialize module
// ------------------------------


document.addEventListener('DOMContentLoaded', function () {
  DatatableResponsive.init();
});

/***/ }),

/***/ 2:
/*!****************************************************!*\
  !*** multi ./resources/assets/js/datatable_app.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/muhamadanjar/Sites/rental/resources/assets/js/datatable_app.js */"./resources/assets/js/datatable_app.js");


/***/ })

/******/ });