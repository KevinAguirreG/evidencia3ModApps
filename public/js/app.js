/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/auth/login.js":
/*!************************************!*\
  !*** ./resources/js/auth/login.js ***!
  \************************************/
/***/ (() => {

$(document).ready(function () {
  $("#passwordResetButton").click(function () {
    var form = $("#passwordResetForm").serializeArray();
    $.ajax({
      url: $("meta[name=app-url]").attr("content") + '/password/email',
      type: 'POST',
      dataType: 'json',
      data: form,
      success: function success(response) {
        console.log(response);
        $("#passwordResetForm #email").removeClass('is-invalid');
        $(".invalid-feedback").html('');
        $("#passwordResetModal").modal('hide');
        $(".alert-success").html(response.message).removeClass('d-none');
      },
      error: function error(response) {
        $("#passwordResetForm #email").addClass('is-invalid');
        $("#passwordResetModal .email-row .invalid-feedback").html('<strong>' + response.responseJSON.errors.email[0] + '</strong>');
      }
    });
  });
  $("#registerButton").click(function () {
    var form = $("#registerForm").serializeArray();
    $.ajax({
      url: $("meta[name=app-url]").attr("content") + '/register',
      type: 'POST',
      dataType: 'json',
      data: form,
      success: function success(response) {},
      error: function error(response) {
        console.log(response);
        if (response.status == 201) {
          $("#registerForm #name,#registerForm #email,#registerForm #password").removeClass('is-invalid');
          $("#registerForm .invalid-feedback").html('');
          $("#registerModal").modal('hide');
          window.location.href = $("meta[name=app-url]").attr("content");
        } else {
          if (response.responseJSON.errors.name[0] != undefined) {
            $("#registerForm #name").addClass('is-invalid');
            $("#registerForm .name-row .invalid-feedback").html('<strong>' + response.responseJSON.errors.name[0] + '</strong>');
          }
          if (response.responseJSON.errors.email[0] != undefined) {
            $("#registerForm #email").addClass('is-invalid');
            $("#registerForm .email-row .invalid-feedback").html('<strong>' + response.responseJSON.errors.email[0] + '</strong>');
          }
          if (response.responseJSON.errors.password[0] != undefined) {
            $("#registerForm #password").addClass('is-invalid');
            $("#registerForm .password-row .invalid-feedback").html('<strong>' + response.responseJSON.errors.password[0] + '</strong>');
          }
        }
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/buyings/modal_confirm_status.js":
/*!******************************************************!*\
  !*** ./resources/js/buyings/modal_confirm_status.js ***!
  \******************************************************/
/***/ (() => {

$(function () {
  window.showConfirmStatusModal = function (entity, id) {
    var _window$i18n$es$title, _window$i18n$es$confi;
    var params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
    //$('#deleterowForm').attr('action', $('meta[name="app-url"]').attr('content')+"/"+entity+"/"+id);
    var title = '';
    var message = '';
    title = (_window$i18n$es$title = window.i18n.es['title_confirm_status']) !== null && _window$i18n$es$title !== void 0 ? _window$i18n$es$title : '';
    message = (_window$i18n$es$confi = window.i18n.es['confirm_status']) !== null && _window$i18n$es$confi !== void 0 ? _window$i18n$es$confi : '';
    if (title != '') {
      $('#confirmrowModal .modal-title').html(title);
    }
    if (message != '') {
      $('#confirmrowModal .alert .alert-message').html(message);
    }
    var params2 = params == null ? null : "'".concat(params, "'");
    $('#confirmrowModal .button-delete').attr('onclick', "updateValue('".concat(entity, "', ").concat(id, ", ").concat(params2, ")"));
    $('#confirmrowModal').modal('show');
  };
  window.updateValue = function (entity, id) {
    var params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
    if (params != null) {
      params = JSON.parse(window.atob(params));
    }
    window.location.href = $('meta[name="app-url"]').attr('content') + '/' + entity + '/changeStatus/' + id;
  };
});

/***/ }),

/***/ "./resources/js/cloud_dirs/modal_create_folder.js":
/*!********************************************************!*\
  !*** ./resources/js/cloud_dirs/modal_create_folder.js ***!
  \********************************************************/
/***/ (() => {

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  window.showCreateFolderModal = function (params) {
    var params = JSON.parse(window.atob(params));
    var cRute = params.route !== undefined ? params.route : params.entity;
    //let entity = params.entity;

    $.ajax({
      url: $('meta[name="app-url"]').attr('content') + "/" + cRute + "/getCreateFolderModal" + (params.father_id !== undefined ? "/" + params.father_id : ""),
      type: 'GET',
      data: {
        params: params
      },
      dataType: 'json',
      success: function success(response) {
        $("." + params.entity + "-modal").remove();
        $("body").append(response);
        $("." + params.entity + "-modal").css('z-index', getModalZIndex()).modal('show');
        loadAutocomplete();
      }
    });
  };
  window.getModalZIndex = function () {
    var zindex = 1050;
    $(".modal").each(function (index, el) {
      if ($(el).hasClass('show')) zindex = $(el).css('z-index');
    });
    return parseFloat(zindex) + 10;
  };
  window.saveQuickAdd = function (params) {
    var _params$action, _params$method;
    $("#btnSave").attr("disabled", true);
    $("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'wait');
    params = JSON.parse(window.atob(params));
    var action = (_params$action = params.action) !== null && _params$action !== void 0 ? _params$action : $("#" + params.entity + "-quickmodal").prop('action');
    var method = (_params$method = params.method) !== null && _params$method !== void 0 ? _params$method : 'POST';

    //Get form data and delete empty fields
    var data = new FormData(document.getElementById(params.entity + "-quickmodal"));
    var _iterator = _createForOfIteratorHelper(data.entries()),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var value = _step.value;
        if (value[1] === "") {
          data["delete"](value[0]);
        }
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
    $("#".concat(params.entity, "-quickmodal")).find("input[type=checkbox]").each(function (index, el) {
      data["delete"]($(this).attr('name'));
      data.append($(this).attr('name'), $(this).is(':checked') ? 1 : 0);
    });

    // for (const pair of data.entries()) {
    // 	console.log(`${pair[0]}, ${pair[1]}`);
    // }
    // return false;

    $.ajax({
      url: action,
      type: method,
      data: data,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function success(response) {
        if (response.data !== undefined) {
          switch (params.inputType) {
            case "autocomplete":
              $("#" + params.targetInputId).val(response.data.id);
              $("#" + params.targetInputDisplay).val(response.data[params.displayValue]);
              break;
            case "select":
              var result = '<option value="' + response.data.id + '">' + response.data[params.displayValue] + '</option>';
              $("#" + params.targetInputId).append(result);
              $("#" + params.targetInputId).val(response.data.id);
              $("#" + params.targetInputId).trigger('change');
              break;
            default:
              break;
          }
          $("#" + params.entity + "-quickadd").trigger("reset");
          $("." + params.entity + "-modal").modal('hide');
          $("." + params.entity + "-modal").remove();
          displayMessage(response.message, response.status ? "success" : "danger");
          if (typeof window[params.saveAditionals] === "function") {
            if (params.isDatatable) {
              location.reload();
            } else {
              var _params$saveAditional;
              window[params.saveAditionals](response.data, (_params$saveAditional = params.saveAditionalsParams) !== null && _params$saveAditional !== void 0 ? _params$saveAditional : null);
            }
          }
        } else {
          var el = $("#" + params.entity + "-quickmodal").find(".message-container");
          displayMessage(response.message, response.status ? "success" : "danger", el);
          $("#btnSave").attr("disabled", false);
          $("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'default');
        }
      }
    }).fail(function (response) {
      //si hubo error en la validación
      if (typeof response.responseJSON.message !== "undefined") {
        var el = $("#" + params.entity + "-quickmodal").find(".message-container");
        displayMessage(response.responseJSON.errors, "danger", el);
      }
      $("#btnSave").attr("disabled", false);
      $("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'default');
    });
  };
});

/***/ }),

/***/ "./resources/js/cloud_dirs/modal_share_permissions.js":
/*!************************************************************!*\
  !*** ./resources/js/cloud_dirs/modal_share_permissions.js ***!
  \************************************************************/
/***/ (() => {

$(function () {
  window.showSharePermissionsModal = function (params) {
    var params = JSON.parse(window.atob(params));
    var cRute = params.route !== undefined ? params.route : params.entity;
    //let entity = params.entity;
    console.log(params.id);
    $.ajax({
      url: $('meta[name="app-url"]').attr('content') + "/cloud_dirs/getsharepermissionsmodal/" + params.id,
      type: 'GET',
      data: {
        params: params
      },
      dataType: 'json',
      success: function success(response) {
        $("." + params.entity + "-modal").remove();
        $("body").append(response);
        $("#sharepermissionModal").modal('show');
        loadAutocomplete();
      }
    });
  };
  window.getModalZIndex = function () {
    var zindex = 1050;
    $(".modal").each(function (index, el) {
      if ($(el).hasClass('show')) zindex = $(el).css('z-index');
    });
    return parseFloat(zindex) + 10;
  };
  window.saveQuickAdd = function (params) {};
});

/***/ }),

/***/ "./resources/js/crud_maker/datatables_customize.js":
/*!*********************************************************!*\
  !*** ./resources/js/crud_maker/datatables_customize.js ***!
  \*********************************************************/
/***/ (() => {

$(function () {
  var entity = $("#entity").val();
  window.isModal = 0;
  window.customizeDatatable = function () {
    var isModal = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
    window.isModal = isModal;
    var filter = $(".dataTables_wrapper .dataTables_filter");
    //Customize the search input
    filter.addClass('search-box me-2 mb-2 row');
    filter.find("input[type=search]").closest("label").addClass('position-relative col-12 col-sm-4').append("<i class=\"bx bx-search-alt search-icon\"></i>");
    filter.find("input[type=search]").addClass('form-control');

    /*let searchInput = filter.find("input[type=search]")[0];
    filter.find("input[type=search]").closest("label").remove();
    filter.append(`
    	<div class="col-12 col-sm-4 section-search">
    		<div class="row">
    			<label class="col-12 col-sm-4 col-xxl-2 text-end">Buscar:</label>
    			<div class="col-12 col-sm-8 col-xxl-10">
    				${searchInput.outerHTML ?? ''}
    			<div>
    		<div>
    	<div>
    `);*/

    //Add buttons section
    filter = buildButtonsSection(filter);

    //Add advanced filters section
    //This code copies the section advancedFilters on dtAdvancedFilters to make it look aside the find input in datatable
    if ($(".advancedFilters").length > 0) {
      if ($(".dtAdvancedFilters").length == 0) {
        var _$$html;
        filter.append("\n\t\t\t\t\t<div class=\"col-12 mt-4 dtAdvancedFilters\">\n\t\t\t\t\t\t".concat((_$$html = $(".advancedFilters").html()) !== null && _$$html !== void 0 ? _$$html : '', "\n\t\t\t\t\t<div>\n\t\t\t\t"));
      }
      $(".advancedFilters").html("");
    }

    //Change pagination links
    var paginate = $(".dataTables_wrapper .dataTables_paginate");
    paginate.addClass('pagination pagination-rounded justify-content-end mb-2');
    paginate.find(".previous").html(addIcon('<i class="mdi mdi-chevron-left"></i>'));
    paginate.find(".next").html(addIcon('<i class="mdi mdi-chevron-right"></i>'));
    paginate.find("> span").css('display', 'inline-flex');
    paginate.find("span a").each(function (index, el) {
      if ($(el).find(".page-item").length == 0) {
        var classList = el.classList;
        var active = false;
        for (var key in classList) {
          if (classList[key] == 'current') {
            active = true;
          }
        }
        $(el).html(addIcon($(el).html(), active));
      }
    });
  };

  /**
   * Build the whole button's section we can add more buttons before or after the CRUD add button
   */
  window.buildButtonsSection = function (filter) {
    if (filter.find('.section-buttons').length == 0) {
      var _$$val, _$$html2, _$$html3;
      var buttonsContent = "\n\t\t\t\t<div class=\"col-12 col-sm-8 section-buttons\">\n\t\t\t\t\t<div class=\"".concat((_$$val = $("#buttonsAlign").val()) !== null && _$$val !== void 0 ? _$$val : 'text-end', "\">\n\t\t\t\t\t\t").concat((_$$html2 = $(".aditionalButtonsBefore").html()) !== null && _$$html2 !== void 0 ? _$$html2 : '', "\n\t\t\t\t\t\t").concat($("#allowAdd").val() == "1" ? getAddButton() : '', "\n\t\t\t\t\t\t").concat((_$$html3 = $(".aditionalButtonsAfter").html()) !== null && _$$html3 !== void 0 ? _$$html3 : '', "\n\t\t\t\t\t</div>\n\t\t\t\t</div>");
      $(".aditionalButtonsBefore").html("");
      $(".aditionalButtonsAfter").html("");
      filter.append(buttonsContent);
    }
    return filter;
  };

  /**
   * The CRUD add button
   */
  window.getAddButton = function () {
    var _urlParams$get;
    var result = '';
    var urlParams = new URLSearchParams(window.location.search);
    var params = window.btoa(JSON.stringify({
      "entity_source": entity,
      "entity": entity,
      //Este es el nombre que se le dará al quick add modal que se creará
      "saveAditionals": 'reloadDatatable',
      "parent": (_urlParams$get = urlParams.get('parent')) !== null && _urlParams$get !== void 0 ? _urlParams$get : false
    }));
    var attr = window.isModal == 1 ? "onclick=\"showQuickAddModal('".concat(params, "')\"") : "href=\"".concat(entity, "/create\"");
    result = "\n\t\t\t\t<a class=\"btn btn-default waves-effect button-add\" ".concat(attr, ">\n\t\t\t\t\t<i class=\"mdi mdi-plus me-1\"></i>\n\t\t\t\t\t").concat(window.i18n.es.Add, "\n\t\t\t\t</a>");
    return result;
  };
  window.addIcon = function (p, a) {
    return "\n\t\t\t<span class='page-item " + (a ? 'active' : '') + "'>\n\t\t\t\t<span class='page-link'>".concat(p, "</span>\n\t\t\t</span>\n\t\t");
  };
  window.reloadDatatable = function (response) {
    var table = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    if (table == null) {
      window.LaravelDataTables[entity + "-table"].draw();
    } else {
      window.LaravelDataTables[table].draw();
    }
    if (typeof window["reloadScreen"] === "function") {
      window["reloadScreen"](response);
    }
  };
});

/***/ }),

/***/ "./resources/js/crud_maker/datatables_sum.js":
/*!***************************************************!*\
  !*** ./resources/js/crud_maker/datatables_sum.js ***!
  \***************************************************/
/***/ (() => {

jQuery.fn.dataTable.Api.register('sum()', function (column, format) {
  var parseNumber = function parseNumber(i) {
    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
  };
  var total = column.data().reduce(function (a, b) {
    return parseNumber(a) + parseNumber(b);
  }, 0);

  //Write the total
  var totalFormat = total;
  if (["number", "money"].includes(format)) {
    totalFormat = totalFormat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
  }
  totalFormat = (format == "money" ? '$ ' : '') + totalFormat;
  //$(column.footer()).html('<span>'+totalFormat+'</span>');

  return totalFormat;
});
$(function () {
  window.addDatatableFooter = function () {
    var param = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
    window.setTimeout(function () {
      var _param;
      param = (_param = param) !== null && _param !== void 0 ? _param : "#" + $("#entity").val() + "-table";
      var footer = "<tfoot><tr>";
      $("table".concat(param, " thead")).find("th").each(function (index, el) {
        footer += "<th class=\"".concat(el.getAttribute("class"), "\"></th>");
      });
      footer += "</tr></tfoot>";
      $("table".concat(param)).append(footer);
    }, 100);
  };
});

/***/ }),

/***/ "./resources/js/crud_maker/dropdown_fill_child.js":
/*!********************************************************!*\
  !*** ./resources/js/crud_maker/dropdown_fill_child.js ***!
  \********************************************************/
/***/ (() => {

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
/**
 * [fillDropdownChild Esta función llena un combobox cuando se ejecuta una acción, el fin es filtrar por el parámetro seleccionado]
 * @param  {[type]} route          [Ruta a donde vamos a consultar los datos del hijo]
 * @param  {[type]} filterColumn   [Columna de por la que queremos filtrar]
 * @param  {[type]} param          [Valor del que vamos a partir]
 * @param  {[type]} target         [Combobox objetivo que se rellenará]
 */
window.fillDropdownChild = function (route, filterColumn, value, target) {
  $.ajax({
    url: $('meta[name="app-url"]').attr('content') + "/" + route,
    type: 'GET',
    data: _defineProperty({}, filterColumn, value),
    dataType: 'json',
    success: function success(response) {
      $("#" + target).html(getDropdownContent(response)).trigger('change');
    }
  });
};
window.getDropdownContent = function (response) {
  var result = '';
  result += '<option value=""></option>';
  $.each(response, function (index, val) {
    result += '<option value="' + index + '">' + val + '</option>';
  });
  return result;
};

/***/ }),

/***/ "./resources/js/crud_maker/filters_datatables.js":
/*!*******************************************************!*\
  !*** ./resources/js/crud_maker/filters_datatables.js ***!
  \*******************************************************/
/***/ (() => {

$(function () {
  var entity = $("#entity").val();
  window.filterData = function (type) {
    if (type == "datatable") {
      filterDatatable();
    } else {
      filterTable(type);
    }
  };
  window.clearFilters = function (type) {
    //Clear filter elements by type
    $('.' + type + '-filter').each(function (index, el) {
      switch ($(el)[0].nodeName.toLowerCase()) {
        case "input":
          $(el).val("");
          $(el).prop("checked", false);
          break;
        case "select":
          $(el).val("").trigger("change");
          break;
        default:
          $(el).val("");
          break;
      }
    });
    if (type == "datatable") {
      clearDatatable();
    } else {
      filterTable();
    }
  };

  /** Filter Table */
  window.filterTable = function (type) {
    var filterSource = $("#filterSource").val();
    var params = {};
    $('.' + type + '-filter').each(function (index, el) {
      if ($(el).attr('source') !== undefined) {
        var dataSource = $(el).attr('source').split(".");
        params[$(el).prop('name') + "[type]"] = "relation";
        params[$(el).prop('name') + "[table]"] = dataSource[0];
        params[$(el).prop('name') + "[field]"] = dataSource[1];
        params[$(el).prop('name') + "[value]"] = $(el).val();
      } else {
        params[$(el).prop('name')] = $(el).val();
      }
    });
    //console.log(params);
    $.ajax({
      url: $('meta[name="app-url"]').attr('content') + "/" + filterSource,
      type: 'GET',
      data: params,
      dataType: 'json',
      success: function success(response) {
        $(".studies-body").html(response);
        if (typeof filterAditionals === "function") {
          filterAditionals(response);
        }
      }
    });
  };
  /** Filter Table */

  /** Filter Datatable */
  window.filterDatatable = function () {
    if (window.LaravelDataTables != undefined) {
      loadDatatable();
      window.LaravelDataTables[entity + "-table"].draw();
    }
  };
  window.clearDatatable = function () {
    if (window.LaravelDataTables != undefined) {
      window.LaravelDataTables[entity + "-table"].draw();
    }
  };

  // Agrega los valores de los filtros a la request de ajax.
  window.loadDatatable = function () {
    if (window.LaravelDataTables != undefined) {
      window.LaravelDataTables[entity + "-table"].on('preXhr.dt', function (e, settings, data) {
        var custom_filters = [];
        $('.datatable-filter').each(function (index, el) {
          //data[$(el).prop('name')] = $(el).val();
          if ($(el).val() != "") {
            var _$$attr;
            custom_filters.push({
              "name": $(el).attr('name'),
              "value": $(el).val(),
              "source": $(el).attr('source'),
              "filter_type": (_$$attr = $(el).attr('filter_type')) !== null && _$$attr !== void 0 ? _$$attr : null
            });
          }
        });
        if (custom_filters.length > 0) {
          data["custom_filters"] = JSON.stringify(custom_filters);
        }
      });
    }
  };
  /** Filter Datatable */
});

/***/ }),

/***/ "./resources/js/crud_maker/functions.js":
/*!**********************************************!*\
  !*** ./resources/js/crud_maker/functions.js ***!
  \**********************************************/
/***/ (() => {

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  window.displayMessage = function (message) {
    var alertType = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "info";
    var el = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
    var content = getMessageAlert(message, alertType);
    if (content != "") {
      if (el == false) {
        el = $(".message-container");
      }
      el.html(content);
    }
  };
  window.getMessageAlert = function (message) {
    var alertType = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "info";
    var content = '';
    if (_typeof(message) === "object") {
      $.each(message, function (index, val) {
        content += "<div class=\"alert alert-".concat(alertType, " dismissible\">").concat(val[0], "</div>");
      });
    } else if (typeof message === "string") {
      content = "<div class=\"alert alert-".concat(alertType, " dismissible\">\n\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-bs-dismiss=\"alert\" aria-label=\"Close\">\n\t\t\t\t\t<i class=\"mdi mdi-window-close icon-edit font-size-18\"></i>\n\t\t\t\t</button>\n\t\t\t\t").concat(message, "\n\t\t\t</div>");
    }
    return content;
  };

  /**
   * [displayOther Muestra el campo otro cuando se selecciona la opción correspondiente]
   * @param  {[type]} param  [Elemento desde donde se seleciona]
   * @param  {[type]} option [Id que hará que se despliegue el campo otro]
   * @param  {[type]} target [id del elemento de destino]
   */
  window.displayOther = function (param, option, target) {
    console.log($(param).val());
    if ($(param).val() == option) {
      $(param).prop("required", true);
      $("." + target + "_container").show();
      $("#" + target).prop("required", true);
    } else {
      $(param).prop("required", false);
      $("." + target + "_container").hide();
      $("#" + target).prop("required", false);
    }
  };
  window.confirmRedirect = function (message, route) {
    if (confirm(message) == true) {
      window.location.href = window.atob(route);
    }
  };
});

/***/ }),

/***/ "./resources/js/crud_maker/input_autocomplete.js":
/*!*******************************************************!*\
  !*** ./resources/js/crud_maker/input_autocomplete.js ***!
  \*******************************************************/
/***/ (() => {

$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  window.inputAutocomplete = function (input) {
    var inputId = $(input).attr("data-hidden-id");
    var _source = $(input).attr("data-source");
    var filter = $(input).attr("data-filter");
    $(input).autocomplete({
      source: function source(request, response) {
        //Verificar si se agregará filtro de parent
        var data = new Object();
        if ($(input).attr("data-parent") !== undefined) {
          data[$(input).attr("data-parent")] = $("#" + $(input).attr("data-parent")).val();
          //data.parent = $(input).attr("data-parent");
          //data.parent_value = $("#"+$(input).attr("data-parent")).val();
        }

        var filters = [];
        if (filter !== null && filter !== void 0 ? filter : false) {
          $.each(filter.split(","), function (index, val) {
            data[val] = request.term;
          });
        } else {
          data["param"] = request.term;
        }
        data['type'] = 'or';
        //data[inputId] = request.term;
        $.ajax({
          url: $('meta[name="app-url"]').attr('content') + "/" + _source,
          type: 'GET',
          data: data,
          dataType: 'json',
          success: function success(data) {
            response(data);
          }
        });
      },
      minLength: 3,
      open: function open() {},
      close: function close() {},
      focus: function focus(event, ui) {},
      select: function select(event, ui) {
        $(input).parent().find("#" + inputId).val(ui.item.id);
        if (typeof window[$(input).attr("data-aditionals")] === "function") {
          window[$(input).attr("data-aditionals")](ui.item, input);
        }
      }
    }).keyup(function () {
      if ($(this).val().length == 0) $(input).parent().find("#" + inputId).val("");
    });
  };
  window.loadAutocomplete = function () {
    $(".input-autocomplete").each(function (index, el) {
      inputAutocomplete($(el));
    });
  };
  loadAutocomplete();
});

/***/ }),

/***/ "./resources/js/crud_maker/input_datepicker.js":
/*!*****************************************************!*\
  !*** ./resources/js/crud_maker/input_datepicker.js ***!
  \*****************************************************/
/***/ (() => {

$(function () {
  window.loadDateTimePicker = function () {
    $('.datepicker2').datetimepicker({
      locale: 'es',
      format: 'DD-MM-YYYY'
    });
    $('.datetimepicker2').datetimepicker({
      locale: 'es',
      format: 'DD-MM-YYYY H:mm'
    });
  };
  window.loadDateTimePickerFilters = function () {
    $('.datepicker-start').datetimepicker({
      locale: 'es',
      format: 'DD-MM-YYYY',
      ignoreReadonly: true
    });
    $('.datepicker-end').datetimepicker({
      useCurrent: false,
      locale: 'es',
      format: 'DD-MM-YYYY',
      ignoreReadonly: true
    });
    $('.timepicker-start').datetimepicker({
      locale: 'es',
      format: 'HH:mm',
      ignoreReadonly: true
    });
    $('.timepicker-end').datetimepicker({
      useCurrent: false,
      locale: 'es',
      format: 'HH:mm',
      ignoreReadonly: true
    });
  };
  loadDateTimePicker();
  loadDateTimePickerFilters();
});

/***/ }),

/***/ "./resources/js/crud_maker/modal_delete.js":
/*!*************************************************!*\
  !*** ./resources/js/crud_maker/modal_delete.js ***!
  \*************************************************/
/***/ (() => {

$(function () {
  window.showDeleteModal = function (entity, id) {
    var params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
    var isDataTable = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : true;
    //$('#deleterowForm').attr('action', $('meta[name="app-url"]').attr('content')+"/"+entity+"/"+id);
    var title = '';
    var message = '';
    if (window.i18n[entity] !== undefined) {
      var _window$i18n$entity$t, _window$i18n$entity$c;
      title = (_window$i18n$entity$t = window.i18n[entity]['title_delete']) !== null && _window$i18n$entity$t !== void 0 ? _window$i18n$entity$t : '';
      message = (_window$i18n$entity$c = window.i18n[entity]['confirm_delete']) !== null && _window$i18n$entity$c !== void 0 ? _window$i18n$entity$c : '';
    }
    if (title != '') {
      $('#deleterowModal .modal-title').html();
    }
    if (message != '') {
      $('#deleterowModal .alert .alert-message').html(message);
    }
    var params2 = params == null ? null : "'".concat(params, "'");
    $('#deleterowModal .button-delete').attr('onclick', "deleteRow('".concat(entity, "', ").concat(id, ", ").concat(params2, ", ").concat(isDataTable, ")"));
    $('#deleterowModal').modal('show');
  };
  window.deleteRow = function (entity, id) {
    var params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
    var isDataTable = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : true;
    if (params != null) {
      params = JSON.parse(window.atob(params));
    }
    // console.log($('meta[name="app-url"]').attr('content')+'/'+entity+'/'+id+'/'+isDataTable);
    $.ajax({
      url: $('meta[name="app-url"]').attr('content') + '/' + entity + '/' + id,
      type: 'DELETE',
      dataType: 'json',
      success: function success(response) {
        $('#deleterowModal').modal('hide');
        displayMessage(response.message, response.status ? "success" : "danger");
        if (params != null) {
          if (typeof window[params.saveAditionals] === "function") {
            window[params.saveAditionals](response.data);
          }
        }
        if (isDataTable) {
          reloadDatatable();
        } else {
          location.reload();
        }
      }
    }).fail(function (response) {
      //si hubo error en la validación
      if (typeof response.responseJSON.message !== "undefined") {
        var el = $(".message-container");
        displayMessage(response.responseJSON.errors, "danger", el);
      }
    });
  };
});

/***/ }),

/***/ "./resources/js/crud_maker/modal_quick_add.js":
/*!****************************************************!*\
  !*** ./resources/js/crud_maker/modal_quick_add.js ***!
  \****************************************************/
/***/ (() => {

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  window.showQuickAddModal = function (params) {
    var params = JSON.parse(window.atob(params));
    var cRute = params.route !== undefined ? params.route : params.entity;
    //let entity = params.entity;

    //Esto solo se ejecuta si se pasó parent (que hará que se seleccione el valor correspondiente del select)
    var parentValue = "";
    if (params.parent !== undefined) {
      parentValue = $("#" + params.parent).val();
      params.parent_value = parentValue;
    }

    //Si se indicó un campo parent pero no se ha seleccionado una opción en ese parent no se lanzará el modal
    if (params.parent !== undefined && parentValue == "") {
      alert("Seleccione " + window.i18n[params.entity_source][params.parent]);
    } else {
      $.ajax({
        url: $('meta[name="app-url"]').attr('content') + "/" + cRute + "/getquickmodalcontent" + (params.id !== undefined ? "/" + params.id : ""),
        type: 'GET',
        data: {
          params: params
        },
        dataType: 'json',
        success: function success(response) {
          $("." + params.entity + "-modal").remove();
          $("body").append(response);

          //Esto solo se ejecuta si se pasó parent
          if (params.parent !== undefined) {
            switch (params.inputType) {
              case "autocomplete":
                //Con el id que tenemos buscamos el input que muestra el texto y lo ponemos como readonly y quitamos clase de atutocomplete
                $("." + params.entity + "-modal #" + params.parent).parent().find("input[type=text]").removeClass("input-autocomplete").attr("readonly", true);
                break;
              case "select":
                $("." + params.entity + "-modal #" + params.parent_target).val(parentValue);
                var textDisplay = $("." + params.entity + "-modal #" + params.parent_target + " option:selected").text();
                $("." + params.entity + "-modal #" + params.parent_target).parent().html("\n\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"" + params.parent_target + "\" id=\"" + params.parent_target + "\" value=\"" + parentValue + "\" />\n\t\t\t\t\t\t\t\t\t<input type=\"text\"  value=\"" + textDisplay + "\" class=\"form-control\" readonly />\n\t\t\t\t\t\t\t\t");
                break;
              default:
                break;
            }
          }
          $("." + params.entity + "-modal").css('z-index', getModalZIndex()).modal('show');
          loadAutocomplete();
        }
      });
    }
  };
  window.getModalZIndex = function () {
    var zindex = 1050;
    $(".modal").each(function (index, el) {
      if ($(el).hasClass('show')) zindex = $(el).css('z-index');
    });
    return parseFloat(zindex) + 10;
  };
  window.saveQuickAdd = function (params) {
    var _params$action, _params$method;
    $("#btnSave").attr("disabled", true);
    $("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'wait');
    params = JSON.parse(window.atob(params));
    var action = (_params$action = params.action) !== null && _params$action !== void 0 ? _params$action : $("#" + params.entity + "-quickmodal").prop('action');
    var method = (_params$method = params.method) !== null && _params$method !== void 0 ? _params$method : 'POST';

    //Get form data and delete empty fields
    var data = new FormData(document.getElementById(params.entity + "-quickmodal"));
    var _iterator = _createForOfIteratorHelper(data.entries()),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var value = _step.value;
        if (value[1] === "") {
          data["delete"](value[0]);
        }
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
    $("#".concat(params.entity, "-quickmodal")).find("input[type=checkbox]").each(function (index, el) {
      data["delete"]($(this).attr('name'));
      data.append($(this).attr('name'), $(this).is(':checked') ? 1 : 0);
    });

    // for (const pair of data.entries()) {
    // 	console.log(`${pair[0]}, ${pair[1]}`);
    // }
    // return false;

    $.ajax({
      url: action,
      type: method,
      data: data,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function success(response) {
        if (response.data !== undefined) {
          switch (params.inputType) {
            case "autocomplete":
              $("#" + params.targetInputId).val(response.data.id);
              $("#" + params.targetInputDisplay).val(response.data[params.displayValue]);
              break;
            case "select":
              var result = '<option value="' + response.data.id + '">' + response.data[params.displayValue] + '</option>';
              $("#" + params.targetInputId).append(result);
              $("#" + params.targetInputId).val(response.data.id);
              $("#" + params.targetInputId).trigger('change');
              break;
            default:
              break;
          }
          $("#" + params.entity + "-quickadd").trigger("reset");
          $("." + params.entity + "-modal").modal('hide');
          $("." + params.entity + "-modal").remove();
          displayMessage(response.message, response.status ? "success" : "danger");
          if (typeof window[params.saveAditionals] === "function") {
            if (params.isDatatable) {
              location.reload();
            } else {
              var _params$saveAditional;
              window[params.saveAditionals](response.data, (_params$saveAditional = params.saveAditionalsParams) !== null && _params$saveAditional !== void 0 ? _params$saveAditional : null);
            }
          }
        } else {
          var el = $("#" + params.entity + "-quickmodal").find(".message-container");
          displayMessage(response.message, response.status ? "success" : "danger", el);
          $("#btnSave").attr("disabled", false);
          $("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'default');
        }
      }
    }).fail(function (response) {
      //si hubo error en la validación
      if (typeof response.responseJSON.message !== "undefined") {
        var el = $("#" + params.entity + "-quickmodal").find(".message-container");
        displayMessage(response.responseJSON.errors, "danger", el);
      }
      $("#btnSave").attr("disabled", false);
      $("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'default');
    });
  };
});

/***/ }),

/***/ "./resources/js/crud_maker/multirow_functions.js":
/*!*******************************************************!*\
  !*** ./resources/js/crud_maker/multirow_functions.js ***!
  \*******************************************************/
/***/ (() => {

$(function () {
  var route = $("#route").val();

  //region CRUD
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  window.addRow = function () {
    var amount = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
    var data = {
      "rowNumber": parseFloat($(".table-body .row").length) + 1,
      "amount": amount
    };
    $.ajax({
      url: $('meta[name="app-url"]').attr('content') + "/" + route + "/addrow",
      type: "GET",
      dataType: 'json',
      data: data,
      success: function success(result) {
        //console.log(result);
        $(".table-body").append(result);
        $(".table-body input[type=text]").keyup(function () {
          validateRow($(this));
        });
        if (typeof inputAddSettings === "function") {
          inputAddSettings();
        }
      }
    });
  };
  window.saveAll = function () {
    $(".table-body .row").each(function (index, el) {
      if ($(el).find(".btn-unsaved").hasClass("d-inline")) {
        saveRow($(el).find(".btn-save"));
      }
    });
  };
  window.saveRow = function (param) {
    var row = $(param).closest(".table-row");
    var id = $(row).find("input[name=id]").val();
    var data = {};
    $(row).find(".row-input").each(function (index, el) {
      data[$(el).attr("name")] = $(el).val();
    });
    data["isAJAXRequest"] = "true";
    console.log(data);
    if (id == "") {
      $.ajax({
        url: $('meta[name="app-url"]').attr('content') + "/" + route,
        type: "POST",
        data: data,
        dataType: 'json',
        success: function success(result) {
          if (result["status"]) {
            console.log(result["data"]["id"]);
            $(row).find("input[name=id]").val(result["data"]["id"]);
            $(row).find(".btn-unsaved").removeClass("d-inline").addClass("d-none");
            $(row).find(".btn-saved").removeClass("d-none").addClass("d-inline");
            clearErrorMessages(row);
          }
        }
      }).fail(function (response) {
        //si hubo error en la validación
        if (typeof response.responseJSON.message !== "undefined") {
          showValidationError(response.responseJSON.errors, row);
        }
      });
    } else {
      $.ajax({
        url: $('meta[name="app-url"]').attr('content') + "/" + route + "/" + id,
        type: "PUT",
        data: data,
        dataType: 'json',
        success: function success(result) {
          if (result["status"]) {
            console.log(result["data"]["id"]);
            $(row).find("input[name=id]").val(result["data"]["id"]);
            $(row).find(".btn-unsaved").removeClass("d-inline").addClass("d-none");
            $(row).find(".btn-saved").removeClass("d-none").addClass("d-inline");
            clearErrorMessages(row);
          }
        }
      });
    }
  };
  window.deleteRow = function (param) {
    var row = $(param).closest(".table-row");
    var id = $(row).find("input[name=id]").val();
    if (id != "") {
      if (confirm("Este registro ya ha sido guardado, se borrará de la base de datos")) {
        $.ajax({
          url: $('meta[name="app-url"]').attr('content') + "/" + route + "/deleteAJAX/" + id,
          type: "DELETE",
          dataType: 'json',
          success: function success(result) {
            removeRowElement(param);
          }
        });
      }
    } else {
      //console.log("Tiene cambios no guardados");
      removeRowElement(param);
    }
  };
  window.removeRowElement = function (param) {
    $(param).closest(".table-row").remove();
    if (typeof deleteRowAditionals === "function") {
      deleteRowAditionals();
    }
  };
  //endregion CRUD

  //region validations
  /**
   * [Evento que se ejecuta cuando se escribe algo en los input generales]
   */
  $(".table-body input[type=text]").keyup(function () {
    validateRow($(this));
  });

  /**
   * [autocompleteAditionals Función que se ejecuta cuando se selecciona una opción del dropdown]
   */
  window.autocompleteAditionals = function (param) {
    validateRow($(param));
  };

  /**
   * [datepickerSelect Función que se ejecuta cuando se selecciona una fecha del datepicker]
   */
  window.datepickerSelect = function () {
    $('.datetimepicker2').on("change.datetimepicker", function (e) {
      validateRow(e.currentTarget);
    });
  };

  /**
   * [validateRow Revisa cada campo en el row que se esté editando
   * y si al menos 1 tiene datos muestra el ícono de que no se ha guardado]
   */
  window.validateRow = function (param) {
    var row = $(param).closest(".table-row");
    var allEmpty = true;
    clearErrorMessages(row);
    $(row).find(".row-input").each(function (index, el) {
      if ($(el).val() != "") {
        allEmpty = false;
        return;
      }
    });
    if (!allEmpty) {
      $(row).find(".btn-unsaved").removeClass("d-none").addClass("d-inline");
      $(row).find(".btn-saved").removeClass("d-inline").addClass("d-none");
    } else {
      $(row).find(".btn-unsaved").removeClass("d-inline").addClass("d-none");
    }
  };

  /**
   * [showValidationError Muestra mensaje de error debajo del input correspondiente]
   */
  window.showValidationError = function (message, row) {
    $.each(message, function (index, val) {
      $(row).find("." + index + "-error").html(val);
    });
  };

  /**
   * [clearErrorMessages Quita todos los mensajes de error del row que se esté editando]
   */
  window.clearErrorMessages = function (row) {
    $(row).find(".validation-error").html("");
  };
  //endregion validations

  /**
   * [autocompleteLoad Crea un componente autocomplete dropdown]
   */
  window.autocompleteLoad = function () {
    $(".input-autocomplete").comboboxUI();
    $("#toggle").on("click", function () {
      $(".input-autocomplete").toggle();
    });
  };

  /**
   * [inputAddSettings Esta función se encarga de cargar las funcionalidades de los input 
   * (datepicker, dropdown, etc)]
   * Se manda llamar también después de que se agrega un nuevo row
   */
  window.inputAddSettings = function () {
    loadDateTimePicker();
    datepickerSelect();
    //autocompleteLoad();
  };

  inputAddSettings();
});

/***/ }),

/***/ "./resources/js/dashboard/charts.js":
/*!******************************************!*\
  !*** ./resources/js/dashboard/charts.js ***!
  \******************************************/
/***/ (() => {

$(function () {
  window.drawChart = function (params) {
    var _params$categories, _params$title, _params$subtitle, _params$categories2, _params$title_y_axis, _params$y_axis, _params$series, _params$tooltip, _params$colors, _params$series_title;
    //Default chart params
    var chart = {
      lang: {
        downloadCSV: "Descargar CSV",
        downloadJPEG: "Descargar imagen JPEG",
        downloadPDF: "Descargar documento PDF",
        downloadPNG: "Descargar imagen PNG",
        downloadSVG: "Descargar imagen SVG",
        downloadXLS: "Descargar XLS",
        viewData: "Ver tabla de datos",
        hideData: "Ocultar tabla de datos",
        viewFullscreen: "Ver en pantalla completa",
        exitFullscreen: "Salir de pantalla completa",
        printChart: "Imprimir gráfica"
      }
      //exporting: { buttons: { contextButton: { menuItems: ["printChart", "downloadPNG", "downloadJPEG", "downloadPDF", "downloadSVG"] } } }
    };

    //Optional params
    if ((_params$categories = params.categories) !== null && _params$categories !== void 0 ? _params$categories : false) {
      chart.chart = {
        type: params.type
      };
    }
    if ((_params$title = params.title) !== null && _params$title !== void 0 ? _params$title : false) {
      chart.title = {
        text: params.title
      };
    }
    if ((_params$subtitle = params.subtitle) !== null && _params$subtitle !== void 0 ? _params$subtitle : false) {
      chart.subtitle = {
        text: params.subtitle
      };
    }
    if ((_params$categories2 = params.categories) !== null && _params$categories2 !== void 0 ? _params$categories2 : false) {
      chart.xAxis = {
        categories: params.categories
      };
    }
    if ((_params$title_y_axis = params.title_y_axis) !== null && _params$title_y_axis !== void 0 ? _params$title_y_axis : false) {
      chart.yAxis = {
        title: {
          text: params.title_y_axis
        }
      };
    }
    if ((_params$y_axis = params.y_axis) !== null && _params$y_axis !== void 0 ? _params$y_axis : false) {
      chart.yAxis = params.y_axis;
    }
    if ((_params$series = params.series) !== null && _params$series !== void 0 ? _params$series : false) {
      chart.series = params.series;
    }
    if ((_params$tooltip = params.tooltip) !== null && _params$tooltip !== void 0 ? _params$tooltip : false) {
      chart.tooltip = params.tooltip;
    }
    if ((_params$colors = params.colors) !== null && _params$colors !== void 0 ? _params$colors : false) {
      chart.colors = params.colors;
    }

    //Aditional params by chart type
    switch (params.type) {
      case "line":
        chart.plotOptions = {
          line: {
            dataLabels: {
              enabled: true
            },
            enableMouseTracking: false
          }
        };
        break;
      case "pie":
        chart.chart = {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        };
        chart.legend = {
          backgroundColor: '#4b89a8',
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle',
          enabled: true,
          labelFormatter: function labelFormatter() {
            return this.name + ': ' + this.percentage.toFixed(2) + ' %';
          },
          useHTML: true
        };
        chart.plotOptions = {
          pie: {
            colors: ['#008000', '#FF0000'],
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: false,
              format: '<b>{point.name}</b>: {point.percentage:.1f} % <br>Total: {point.y}'
            },
            showInLegend: true
          }
        };
        chart.series = [{
          name: (_params$series_title = params.series_title) !== null && _params$series_title !== void 0 ? _params$series_title : '',
          colorByPoint: true,
          data: params.series
        }];
        break;
      case "stacked-bars":
        chart.legend = {
          reversed: true
        };
        chart.plotOptions = {
          series: {
            stacking: 'normal'
          }
        };
        break;
      default:
        break;
    }
    console.log(chart);

    //Draw chart
    Highcharts.chart(params.container, chart);
  };
});

/***/ }),

/***/ "./resources/js/dashboard/collapse_functions.js":
/*!******************************************************!*\
  !*** ./resources/js/dashboard/collapse_functions.js ***!
  \******************************************************/
/***/ (() => {

$(function () {
  //On collapse section we alternate the arrow icon
  $('.card > a[data-bs-toggle="collapse"]').click(function () {
    if ($(this).attr('aria-expanded') == "true") $(this).find('i.fa-caret-left').removeClass('fa-caret-left').addClass('fa-caret-down');else $(this).find('i.fa-caret-down').removeClass('fa-caret-down').addClass('fa-caret-left');
  });
});

/***/ }),

/***/ "./resources/js/lang.js":
/*!******************************!*\
  !*** ./resources/js/lang.js ***!
  \******************************/
/***/ (() => {

window.i18n = {
  "auth": {
    "failed": "Estas credenciales no coinciden con nuestros registros.",
    "password": "Contrase\xF1a",
    "throttle": "Demasiados intentos de acceso. Por favor int\xE9ntelo de nuevo en :seconds segundos.",
    "unauthenticated": "Inicie sesi\xF3n para ver este recurso",
    "validation_error": "Error de validaci\xF3n",
    "user_not_found": "No se encontr\xF3 el usuario",
    "password_mismatch": "La contrase\xF1a es incorrecta",
    "logout_success": "La sesi\xF3n se cerr\xF3 correctamente",
    "email_sent": "Se ha enviado el correo de recuperaci\xF3n",
    "login_title": "Bienvenido\/a",
    "login_subtitle": "Inicie sesi\xF3n para continuar",
    "reset_password_title": "Recuperar contrase\xF1a",
    "register_title": "Registrarme",
    "name": "Nombre",
    "paternal_surname": "Apellido paterno",
    "maternal_surname": "Apellido materno",
    "email": "Correo",
    "password_confirmation": "Confirmar contrase\xF1a",
    "remember_me": "Recordarme",
    "login_button": "Iniciar sesi\xF3n",
    "password_recover": "\xBFOlvidaste tu contrase\xF1a?",
    "register_label": "\xBFNo tienes una cuenta?",
    "register_link": "Registrate aqu\xED",
    "button_password_reset": "Enviar correo",
    "button_reset_password": "Cambiar contrase\xF1a",
    "button_register": "Registrarme",
    "button_cancel": "Cancelar"
  },
  "buying_rows": {
    "title_index": "Detalles de compra",
    "title_add": "Agregar detalles de compra",
    "title_show": "Ver detalles de compra",
    "title_edit": "Modificar detalles de compra",
    "title_delete": "Eliminar detalles de compra",
    "id": "id",
    "buying_id": "Compra",
    "product_id": "Nombre del producto",
    "barcode": "C\xF3digo de barras",
    "zamexco_code": "C\xF3digo del producto en Zamexco",
    "amount": "Cantidad",
    "price": "Precio",
    "total": "Precio total",
    "document": "Documento de excel",
    "downloadTemplate": "Descargar la plantilla de excel",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "buying_status_id": "Estatus de compra",
    "confirm_delete": "Se borrar\xE1 el detalle de compra de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Detalle de compra creado correctamente",
    "Successfully updated": "Detalle de compra modificado correctamente",
    "Successfully deleted": "Detalle de compra eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el detalle de compra de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el detalle de compra, hay tablas que dependen de este",
    "Successfully sent to inventory": "Detalle de compra enviado al inventario correctamente"
  },
  "buying_statuses": {
    "title_index": "Estatus de compra",
    "title_add": "Agregar estatus de compra",
    "title_show": "Ver estatus de compra",
    "title_edit": "Modificar estatus de compra",
    "title_delete": "Eliminar estatus de compra",
    "id": "id",
    "name": "Nombre",
    "description": "Descripci\xF3n",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "confirm_delete": "Se borrar\xE1 el estatus de compra de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Estatus de compra creado correctamente",
    "Successfully updated": "Estatus de compra modificado correctamente",
    "Successfully deleted": "Estatus de compra eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el estatus de compra de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el estatus de compra, hay tablas que dependen de este"
  },
  "buyings": {
    "title_index": "Compras",
    "title_add": "Agregar compras",
    "title_show": "Ver compras",
    "title_edit": "Modificar compras",
    "title_delete": "Eliminar compras",
    "id": "id",
    "date": "Fecha de compra",
    "seller_id": "Proveedor",
    "subtotal": "Subtotal",
    "iva": "IVA",
    "total": "Total",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "buying_status_id": "Estatus de compra",
    "draft": "Borrador de compra",
    "sent": "Compra enviada",
    "send_to_inventory": "Enviar a inventario",
    "confirm_delete": "Se borrar\xE1 la compra de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Compra creada correctamente",
    "Successfully updated": "Compra modificada correctamente",
    "Successfully deleted": "Compra eliminada correctamente",
    "delete_error_message": "Error al intentar eliminar la compra de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar la compra, hay tablas que dependen de este",
    "Successfully sent to inventory": "Compra enviada al inventario correctamente"
  },
  "cfdi_uses": {
    "title_index": "Usos de CFDI",
    "title_add": "Agregar Uso de CFDI",
    "title_show": "Ver Uso de CFDI",
    "title_edit": "Modificar Uso de CFDI",
    "title_delete": "Eliminar Uso de CFDI",
    "id": "id",
    "name": "Nombre",
    "description": "Descripci\xF3n",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "confirm_delete": "Se borrar\xE1 el Uso de CFDI de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Uso de CFDI creado correctamente",
    "Successfully updated": "Uso de CFDI modificado correctamente",
    "Successfully deleted": "Uso de CFDI eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el Uso de CFDI de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el Uso de CFDI, hay tablas que dependen de este"
  },
  "clients": {
    "title_index": "Clientes",
    "title_add": "Agregar cliente",
    "title_show": "Ver cliente",
    "title_edit": "Modificar cliente",
    "title_delete": "Eliminar cliente",
    "id": "Id",
    "name": "Nombre",
    "folio": "Folio \/ Serie",
    "company_name": "Raz\xF3n social",
    "rfc": "RFC",
    "regime_id": "R\xE9gimen fiscal",
    "zipcode": "C\xF3digo postal (Domicilio fiscal xml)",
    "tax_address": "Direcci\xF3n fiscal",
    "cfdi_use_id": "Uso de CFDI",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "receptor": "RECEPTOR",
    "confirm_delete": "Se borrar\xE1 el cliente de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Cliente creado correctamente",
    "Successfully updated": "Cliente modificado correctamente",
    "Successfully deleted": "Cliente eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el cliente de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el cliente, hay tablas que dependen de este"
  },
  "config_general": {
    "title_index": "Temas",
    "general": "Generales",
    "datatables": "Datatables y botones",
    "header": "Encabezado",
    "logo": "Logo",
    "background_color": "Color de fondo",
    "font_color": "Color de fuente",
    "font_hover_color": "Color de hover",
    "font": "Fuente",
    "menu": "Men\xFA",
    "position": "Posici\xF3n",
    "left": "Izquierda",
    "top": "Arriba",
    "show_menu_icons": "Mostrar iconos del men\xFA",
    "body": "Cuerpo",
    "footer": "Pie de p\xE1gina",
    "data[general_header_font_id]": "Fuente",
    "data[general_menu_font_id]": "Fuente",
    "data[general_body_font_id]": "Fuente",
    "data[general_footer_font_id]": "Fuente"
  },
  "configuration": {
    "title_index": "Configuraci\xF3n"
  },
  "dashboard": {
    "title_index": "Dashboard",
    "title_add": "Agregar dashboard",
    "title_show": "Ver dashboard",
    "title_edit": "Modificar dashboard",
    "chart_sellings_title": "Reporte de ventas",
    "chart_sellings_subtitle": "Cantidad de productos vendidos en :param meses",
    "chart_sellings_range_dates": "Cantidad de \xD3rdenes de compra",
    "chart_sellings_y_axis_title": "Cantidad",
    "chart_buyings_title": "Reporte de compras",
    "chart_buyings_subtitle": "Cantidad de productos comprados en :param meses",
    "chart_buyings_y_axis_title": "Cantidad",
    "chart_inventories_title": "Reporte de inventarios",
    "chart_inventories_subtitle": "Cantidad de productos en inventario a final de mes en :param meses",
    "inventories_criticals_subtitle": "Reporte de productos en inventario con cr\xEDticos en los meses :param",
    "chart_inventories_y_axis_title": "Cantidad",
    "product_name": "Producto",
    "amount": "Cantidad en inventario",
    "count_sales": "Cantidad de ventas",
    "amount_sold": "Cantidad vendida",
    "avg_sold": "Promedio vendido"
  },
  "departments": {
    "title_index": "Departamento",
    "title_add": "Agregar departamento",
    "title_show": "Ver departamento",
    "title_edit": "Modificar departamento",
    "title_delete": "Eliminar departamento",
    "id": "id",
    "name": "Nombre",
    "description": "Descripci\xF3n",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "confirm_delete": "Se borrar\xE1 el departamento de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Departamento creado correctamente",
    "Successfully updated": "Departamento modificado correctamente",
    "Successfully deleted": "Departamento eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el departamento de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el departamento, hay tablas que dependen de este"
  },
  "inventories": {
    "title_index": "Inventarios",
    "title_add": "Agregar inventario",
    "title_show": "Ver inventario",
    "title_edit": "Modificar inventario",
    "title_delete": "Eliminar inventario",
    "id": "Id",
    "product_id": "Producto",
    "product_name": "Producto",
    "upc": "UPC",
    "department": "Departamento",
    "amount": "Cantidad",
    "is_notifiable": "Notificaciones",
    "is_critical": "Cr\xEDtico",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "count_sales": "Facturas timbradas <br /> (\xDAltimos 3 meses)",
    "amount_sold": "Cantidad vendida <br /> (\xDAltimos 3 meses)",
    "avg_sold": "Promedio vendido <br /> (\xDAltimos 3 meses)",
    "export_count_sales": "Facturas timbradas (\xDAltimos 3 meses)",
    "export_amount_sold": "Cantidad vendida (\xDAltimos 3 meses)",
    "export_avg_sold": "Promedio vendido (\xDAltimos 3 meses)",
    "download_inventories": "Descargar inventarios",
    "inventory_does_not_exist": "No existe el producto :product en inventario",
    "product_does_not_exist": "No existe el producto :product en inventario",
    "inventory_empty": "El producto :product no tiene existencias en inventario",
    "inventory_decrease_error": "La cantidad de :product que desea descontar es mayor a la existencia en inventario",
    "inventory_downloaded_successfully": "Compras sincronizadas correctamente",
    "confirm_delete": "Se borrar\xE1 el inventario de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Inventario creado correctamente",
    "Successfully updated": "Inventario modificado correctamente",
    "Successfully deleted": "Inventario eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el inventario de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el inventario, hay tablas que dependen de este"
  },
  "inventory_logs": {
    "title_index": "Historial de inventarios",
    "title_add": "Agregar historial de inventario",
    "title_show": "Ver historial de inventario",
    "title_edit": "Modificar historial de inventario",
    "title_delete": "Eliminar historial de inventario",
    "id": "id",
    "product_id": "Producto",
    "inventory_id": "Inventario",
    "move_date": "Fecha de operaci\xF3n",
    "amount": "Cantidad",
    "delta_amount": "Cantidad final",
    "movement_type_id": "Tipo de movimiento",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "confirm_delete": "Se borrar\xE1 el historial de inventario de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Historial de inventario creado correctamente",
    "Successfully updated": "Historial de inventario modificado correctamente",
    "Successfully deleted": "Historial de inventario eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el historial de inventario de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el historial de inventario, hay tablas que dependen de este"
  },
  "mails": {
    "daily_report_subject": "Reporte diario de productos cr\xEDticos :param",
    "monthly_report_subject": "Reporte mensual :param",
    "successfully_sent": "Email enviado correctamente"
  },
  "movement_types": {
    "title_index": "Tipos de movimiento",
    "title_add": "Agregar tipo de movimiento",
    "title_show": "Ver tipo de movimiento",
    "title_edit": "Modificar tipo de movimiento",
    "title_delete": "Eliminar tipo de movimiento",
    "id": "id",
    "name": "Nombre",
    "description": "Descripci\xF3n",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "confirm_delete": "Se borrar\xE1 el tipo de movimiento de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Tipo de movimiento creado correctamente",
    "Successfully updated": "Tipo de movimiento modificado correctamente",
    "Successfully deleted": "Tipo de movimiento eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el tipo de movimiento de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el tipo de movimiento, hay tablas que dependen de este"
  },
  "order_credit_notes": {
    "title_index": "order_credit_notes",
    "title_add": "Agregar order_credit_note",
    "title_show": "Ver order_credit_note",
    "title_edit": "Modificar order_credit_note",
    "title_delete": "Eliminar order_credit_note",
    "id": "id",
    "order_stamp_id": "order_stamp_id",
    "facturama_id": "facturama_id",
    "uuid": "uuid",
    "stamp_date": "stamp_date",
    "cfd_seal": "cfd_seal",
    "sat_certificate": "sat_certificate",
    "sat_seal": "sat_seal",
    "xml": "xml",
    "total": "total",
    "cancel_date": "cancel_date",
    "original_string": "original_string",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "invoicexml": "Descargar XML",
    "invoicepdf": "Descargar PDF",
    "cancel_cfdi": "Cancelar nota de cr\xE9dito",
    "successfully_canceled": "Nota de cr\xE9dito cancelado correctamente",
    "is_canceled": "Cancelado",
    "confirm_cancel_cfdi": "\xBFEst\xE1 seguro que desea cancelar la nota de cr\xE9dito :param?",
    "confirm_delete": "Se borrar\xE1 order_credit_note de la base de datos. \xBFDesea continuar?",
    "Successfully created": "order_credit_note creado correctamente",
    "Successfully updated": "order_credit_note modificado correctamente",
    "Successfully deleted": "order_credit_note eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar order_credit_note de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar order_credit_note, hay tablas que dependen de este"
  },
  "order_payments": {
    "title_index": "Complementos de pago / notas de cr\xE9dito",
    "title_add": "Agregar complemento de pago \/ nota",
    "title_show": "Ver complemento de pago \/ nota",
    "title_edit": "Modificar complemento de pago \/ nota",
    "title_delete": "Eliminar complemento de pago \/ nota",
    "id": "Folio",
    "order_stamp_id": "order_stamp_id",
    "facturama_id": "facturama_id",
    "uuid": "Folio Fiscal",
    "stamp_date": "Fecha de emisi\xF3n",
    "cfd_seal": "cfd_seal",
    "sat_certificate": "sat_certificate",
    "sat_seal": "sat_seal",
    "xml": "xml",
    "total": "total",
    "cancel_date": "cancel_date",
    "original_string": "original_string",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "payment": "Complemento de pago",
    "credit_note": "Nota de cr\xE9dito",
    "request": {
      "facturama_id": "Id timbrado",
      "total": "Cantidad a pagar",
      "notes": "Notas"
    },
    "save": "Timbrar el complemento\/nota",
    "type": "Complemento de pago \/ nota",
    "payment_info": "INFORMACI\xD3N DEL PAGO",
    "payment_form": "Forma de Pago",
    "payment_date": "Fecha de Pago",
    "currency_payment": "Moneda de Pago",
    "amount": "Monto",
    "folio": "Folio",
    "parciality": "Parcialidad",
    "currency": "Moneda",
    "total_payment": "Monto Comprobante",
    "previous_balance": "Importe Saldo Anterior",
    "order_account": "Cuenta Ordenante",
    "total_paid": "Importe Pagado",
    "operation_nuber": "N\xFAmero de Operaci\xF3n",
    "pending_amount": "Saldo Insoluto",
    "invoicexml": "Descargar XML",
    "invoicepdf": "Descargar PDF",
    "cancel_cfdi": "Cancelar complemento de pago",
    "successfully_canceled": "Complemento de pago cancelado correctamente",
    "is_canceled": "Cancelado",
    "confirm_cancel_cfdi": "\xBFEst\xE1 seguro que desea cancelar el complemento de pago :param?",
    "confirm_delete": "Se borrar\xE1 el complemento de pago / nota de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Complemento de pago \/ nota creado correctamente",
    "Successfully updated": "Complemento de pago \/ nota modificado correctamente",
    "Successfully deleted": "Complemento de pago \/ nota eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el complemento de pago \/ nota de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el complemento de pago \/ nota, hay tablas que dependen de este"
  },
  "order_rows": {
    "title_index": "Detalles de \xF3rden",
    "title_add": "Agregar detalle de \xF3rden",
    "title_show": "Ver detalle de \xF3rden",
    "title_edit": "Modificar detalle de \xF3rden",
    "title_delete": "Eliminar detalle de \xF3rden",
    "id": "id",
    "order_id": "\xD3rden de compra",
    "product_id": "Descripci\xF3n",
    "product_code": "C\xF3digo de producto",
    "product_name": "Producto",
    "line": "Linea",
    "stock_number": "Nro Stock de Prov",
    "color": "Color",
    "size": "Tama\xF1o",
    "amount": "Cantidad",
    "uom": "UOM",
    "package": "Paquete",
    "cost": "P.U.",
    "cost_total": "Importe",
    "description": "Descripci\xF3n",
    "provider_number": "Cve. Prov",
    "capacity": "Capac.",
    "unit": "U. Comp",
    "units_casepack": "U. por CasePack",
    "total_casepack": "Tot. Pedido Casepack",
    "pieces": "Tot. Pedido Unidades",
    "price_limit_date": "Precio Lista Vigente",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "ps": "P \/ S",
    "um": "U.M.",
    "tax_type": "T. Impuesto",
    "tax_amount": "Impuesto",
    "confirm_delete": "Se borrar\xE1 detalle de \xF3rden de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Detalle de \xF3rden creado correctamente",
    "Successfully updated": "Detalle de \xF3rden modificado correctamente",
    "Successfully deleted": "Detalle de \xF3rden eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar detalle de \xF3rden de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar detalle de \xF3rden, hay tablas que dependen de este"
  },
  "orders": {
    "title_index": "\xD3rdenes de compra",
    "title_add": "Agregar \xF3rden de compra",
    "title_show": "Ver \xF3rden de compra",
    "title_edit": "Modificar \xF3rden de compra",
    "title_delete": "Eliminar \xF3rden de compra",
    "id": "Folio",
    "client_id": "Cliente",
    "order_number_dates": "Numero De Oc Y Fechas",
    "order_number": "N\xFAmero de \xF3rden",
    "order_date": "Fecha de \xF3rden",
    "shipping_date": "Fecha de env\xEDo",
    "cancel_date": "Fecha de cancelaci\xF3n",
    "aditional_details": "Detalles Adicionales",
    "branch_code": "C\xF3digo de CEDIS",
    "order_type": "Tipo de \xF3rden",
    "currency_type": "Moneda",
    "payment_type": "Forma Pago",
    "payment_method": "M\xE9todo de Pago",
    "payment_type_id": "Forma Pago",
    "payment_method_id": "M\xE9todo de Pago",
    "department": "Department",
    "promotional_event": "Promotional Event",
    "payment_terms": "Payment Terms",
    "fob": "F.O.B.",
    "fob_details": "F.O.B. Punto DeEntrega Punto De Embarque",
    "carrier": "Portador",
    "ship_to": "Enviar a",
    "pay_to": "Pagar a",
    "store": "Formato De Tienda",
    "supplier": "Proveedor",
    "supplier_name": "Nombre De Proveedor",
    "supplier_number": "Supplier Number",
    "addenda": "Addenda",
    "subtotal": "SUBTOTAL",
    "discount": "DESCUENTO",
    "total": "Total",
    "notes": "Notas",
    "is_stamp": "Timbrado",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "download_files": "Descargar facturas",
    "select_invoices": "Seleccione las facturas a descargar",
    "regime": "Regimen Fiscal",
    "amount_letter": "CANTIDAD CON LETRA",
    "aditional_data": "DATOS COMPLEMENTARIOS DE PAGO",
    "taxes": "IMPUESTOS",
    "invoice_total": "TOTAL",
    "complements_title": "DATOS COMPLEMENTARIOS CFDI",
    "folio": "Folio Fiscal",
    "no_cert": "CSD del Emisor",
    "exp": "Lugar Expedici\xF3n",
    "exp_date": "Fecha Emisi\xF3n",
    "cert_date": "Fecha y Hora de certificaci\xF3n",
    "cfdi_type": "Tipo de CFDI",
    "rows": "Art\xEDculos",
    "order": "Pegue aqu\xED el contenido de la \xF3rden de compra",
    "order_header": "Encabezado de la \xF3rden",
    "order_content": "Detalles de la \xF3rden",
    "order_param_not_found": "No se encontr\xF3 el dato :param",
    "order_product_not_found": "No se encontr\xF3 el producto :product",
    "stamp": "Timbrar factura",
    "invoicexml": "Descargar XML",
    "invoicepdf": "Descargar PDF",
    "save_and_stamp": "Guardar y timbrar",
    "xml_file_not_found": "No se encontr\xF3 un archivo XML para descargar.",
    "original_string": "Cadena Original del complemento de certificaci\xF3n digital del SAT",
    "digital_seal": "Sello digital",
    "digital_seal_pac": "Sello digital PAC",
    "rfc_provider": "RFC Proveedor",
    "no_serie": "No. Serie CSD SAT",
    "footer_disclaimer": "ESTE DOCUMENTO ES UNA REPRESENTACI\xD3N IMPRESA DE UN CFDI 4.0",
    "confirm_stamp": "\xBFEst\xE1 seguro que desea timbrar la factura :param?",
    "confirm_cancel_cfdi": "\xBFEst\xE1 seguro que desea cancelar la factura :param?",
    "confirm_payment": "\xBFEst\xE1 seguro que desea generar el complemento de pago de la factura :param?",
    "cancel_cfdi": "Cancelar Factura",
    "successfully_canceled": "Factura cancelada correctamente",
    "is_canceled": "Cancelado",
    "payment": "Generar complemento de pago",
    "successfully_generated_payment": "Complemento de pago generado correctamente",
    "has_payment": "Pagado",
    "paymentxml": "Descargar XML de complemento de pago",
    "confirm_delete": "Se borrar\xE1 la \xF3rden de la base de datos. \xBFDesea continuar?",
    "Successfully created": "\xD3rden creada correctamente",
    "Successfully updated": "\xD3rden modificada correctamente",
    "Successfully deleted": "\xD3rden eliminada correctamente",
    "Successfully stamped": "\xD3rden timbrada correctamente",
    "delete_error_message": "Error al intentar eliminar la \xF3rden de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar la \xF3rden, hay tablas que dependen de este"
  },
  "other_movements": {
    "title_index": "Movimientos fuera de facturas",
    "title_add": "Agregar movimientos fuera de facturas",
    "title_show": "Ver movimientos fuera de facturas",
    "title_edit": "Modificar movimientos fuera de facturas",
    "title_delete": "Eliminar movimientos fuera de facturas",
    "id": "id",
    "description": "Descripci\xF3n",
    "product_id": "Producto",
    "amount": "Cantidad",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "confirm_delete": "Se borrar\xE1 other_movement de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Movimiento fuera de facturas creado correctamente",
    "Successfully updated": "Movimiento fuera de facturas modificado correctamente",
    "Successfully deleted": "Movimiento fuera de facturas eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar movimiento fuera de facturas de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar movimiento fuera de facturas, hay tablas que dependen de este"
  },
  "pagination": {
    "previous": "&laquo; Anterior",
    "next": "Siguiente &raquo;"
  },
  "passwords": {
    "password": "Las contrase\xF1as deben tener al menos seis caracteres y coincidir con la confirmaci\xF3n.",
    "reset": "\xA1Su contrase\xF1a ha sido restablecida!",
    "sent": "\xA1Recordatorio de contrase\xF1a enviado!",
    "throttled": "Por favor espere antes de volver a intentarlo.",
    "token": "Este token de restablecimiento de contrase\xF1a es inv\xE1lido.",
    "user": "No se ha encontrado un usuario con esa direcci\xF3n de correo."
  },
  "permissions": {
    "Users": "Usuarios",
    "Sells": "Ventas",
    "Employees": "Empleados",
    "Cards": "Tarjetas",
    "studies": "Estudios",
    "samples": "Muestras",
    "results": "Resultados",
    "index": "Listar",
    "show": "Ver",
    "create": "Vista guardar",
    "store": "Guardar",
    "edit": "Vista editar",
    "update": "Editar",
    "destroy": "Eliminar",
    "getbyparam": "Autocomplete",
    "getquickaddcontent": "Modal quick add",
    "permissions": "Permisos",
    "savePermissions": "Guardar permisos",
    "getAll": "Obtener listado",
    "getDetailsData": "Detalles",
    "editAJAX": "Editar via ajax",
    "deleteAJAX": "Eliminar via ajax",
    "addrow": "Agregar row (tabla multirow)"
  },
  "products": {
    "title_index": "Productos",
    "title_add": "Agregar producto",
    "title_show": "Ver producto",
    "title_edit": "Modificar producto",
    "title_delete": "Eliminar producto",
    "id": "Id",
    "name": "Nombre",
    "client_id": "Cliente",
    "description": "Descripci\xF3n",
    "upc": "UPC (C\xF3digo de Barras)",
    "pieces": "Cantidad Piezas por caja",
    "department_id": "Departamento",
    "price": "Precio",
    "product_number": "Art\xEDculo",
    "capacity": "Capacidad",
    "packing_type": "Empaquetado",
    "product_code": "Clave de producto",
    "unit_code": "Clave de unidad",
    "unit": "Unidad",
    "gtin_type": "Tipo GTIN",
    "tax_id": "Impuesto",
    "tax_type": "Tipo de impuesto",
    "tax_rate": "Porcentaje de impuesto",
    "factor_type": "Tipo factor",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "confirm_delete": "Se borrar\xE1 el producto de la base de datos. \xBFDesea continuar?",
    "Successfully created": "Producto creado correctamente",
    "Successfully updated": "Producto modificado correctamente",
    "Successfully deleted": "Producto eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el producto de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el producto, hay tablas que dependen de este"
  },
  "regimenes": {
    "title_index": "R\xE9gimenes fiscales",
    "title_add": "Agregar r\xE9gimen",
    "title_show": "Ver r\xE9gimen",
    "title_edit": "Modificar r\xE9gimen",
    "title_delete": "Eliminar r\xE9gimen",
    "id": "id",
    "name": "Nombre",
    "description": "Descripci\xF3n",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "confirm_delete": "Se borrar\xE1 el r\xE9gimen de la base de datos. \xBFDesea continuar?",
    "Successfully created": "R\xE9gimen creado correctamente",
    "Successfully updated": "R\xE9gimen modificado correctamente",
    "Successfully deleted": "R\xE9gimen eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el r\xE9gimen de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el r\xE9gimen, hay tablas que dependen de este"
  },
  "regimes": {
    "title_index": "Reg\xEDmenes",
    "title_add": "Agregar r\xE9gimen",
    "title_show": "Ver r\xE9gimen",
    "title_edit": "Modificar r\xE9gimen",
    "title_delete": "Eliminar r\xE9gimen",
    "id": "Id",
    "name": "Nombre",
    "description": "Descripci\xF3n",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "confirm_delete": "Se borrar\xE1 el r\xE9gimen de la base de datos. \xBFDesea continuar?",
    "Successfully created": "R\xE9gimen creado correctamente",
    "Successfully updated": "R\xE9gimen modificado correctamente",
    "Successfully deleted": "R\xE9gimen eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el r\xE9gimen de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el r\xE9gimen, hay tablas que dependen de este"
  },
  "roles": {
    "title_index": "Roles de usuario",
    "title_add": "Agregar rol de usuario",
    "title_show": "Ver rol de usuario",
    "title_edit": "Modificar rol de usuario",
    "permissions": "Permisos de rol de usuario",
    "id": "id",
    "name": "Nombre",
    "description": "Descripci\xF3n",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "Successfully created": "Creado correctamente",
    "Successfully updated": "Modificado correctamente",
    "Successfully deleted": "Eliminado correctamente",
    "constraint_error_delete_message": "Error al intentar eliminar de la base de datos",
    "Successfully saved permissions": "Permisos guardados correctamente"
  },
  "sellers": {
    "title_index": "Proveedores",
    "title_add": "Agregar proveedor",
    "title_show": "Ver proveedor",
    "title_edit": "Modificar proveedor",
    "title_delete": "Eliminar proveedor",
    "id": "Proveedor",
    "name": "Nombre",
    "company_name": "Raz\xF3n social",
    "notes": "Notas",
    "is_active": "Activo",
    "created_by": "Creado por",
    "updated_by": "Modificado por",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "confirm_delete": "Se borrar\xE1 el proveedor de la base de datos, \xBFDesea continuar?",
    "Successfully created": "Proveedor creado correctamente",
    "Successfully updated": "Proveedor modificado correctamente",
    "Successfully deleted": "Proveedor eliminado correctamente",
    "delete_error_message": "Error al intentar eliminar el proveedor de la base de datos",
    "delete_error_message_constraint": "No se puede eliminar el proveedor, hay tablas que dependen de este"
  },
  "sidebar": [],
  "templates": {
    "data[id]": "Tema"
  },
  "translation": {
    "Menu": "Men\xFA",
    "Dashboards": "Cuadros de mando",
    "Default": "Defecto",
    "Saas": "Saas",
    "Crypto": "Cripto",
    "Blog": "Blog",
    "Layouts": "Dise\xF1os",
    "Vertical": "Vertical",
    "Light_Sidebar": "Barra lateral ligera",
    "Compact_Sidebar": "Barra lateral compacta",
    "Icon_Sidebar": "Barra lateral de iconos",
    "Boxed_Width": "Ancho en caja",
    "Preloader": "Precargador",
    "Colored_Sidebar": "Barra lateral coloreada",
    "Scrollable": "Desplazable",
    "Horizontal": "Horizontal",
    "Topbar_Light": "Luz de barra superior",
    "Colored_Header": "Encabezado de color",
    "Apps": "Aplicaciones",
    "Calendars": "Calendarios",
    "TUI_Calendar": "Calendario TUI",
    "Full_Calendar": "Calendario completo",
    "Chat": "Charla",
    "New": "Nuevo",
    "File_Manager": "Administrador de archivos",
    "Ecommerce": "Comercio electr\xF3nico",
    "Products": "Productos",
    "Product_Detail": "Detalle del producto",
    "Orders": "Pedidos",
    "Customers": "Clientes",
    "Cart": "Carro",
    "Checkout": "Revisa",
    "Shops": "Tiendas",
    "Add_Product": "Agregar producto",
    "Wallet": "Billetera",
    "Buy_Sell": "Compra venta",
    "Exchange": "Intercambiar",
    "Lending": "Pr\xE9stamo",
    "KYC_Application": "Aplicaci\xF3n KYC",
    "ICO_Landing": "Aterrizaje de ICO",
    "Email": "Email",
    "Inbox": "Bandeja de entrada",
    "Read_Email": "Leer el correo electr\xF3nico",
    "Templates": "Plantillas",
    "Basic_Action": "Acci\xF3n b\xE1sica",
    "Alert_Email": "Correo electr\xF3nico de alerta",
    "Billing_Email": "Correo Electr\xF3nico de Facturas",
    "Invoices": "Facturas",
    "Invoice_List": "Lista de facturas",
    "Invoice_Detail": "Detalle de la factura",
    "Projects": "Proyectos",
    "Projects_Grid": "Cuadr\xEDcula de proyectos",
    "Projects_List": "Lista de proyectos",
    "Project_Overview": "Descripci\xF3n del proyecto",
    "Create_New": "Crear nuevo",
    "Tasks": "Tareas",
    "Task_List": "Lista de tareas",
    "Kanban_Board": "Tablero Kanban",
    "Create_Task": "Crear tarea",
    "Contacts": "Contactos",
    "User_Grid": "Cuadr\xEDcula de usuario",
    "User_List": "Lista de usuarios",
    "Profile": "Perfil",
    "Blog_List": "Lista de blogs",
    "Blog_Grid": "Blog Grid",
    "Blog_Details": "Detalles del blog",
    "Pages": "P\xE1ginas",
    "Authentication": "Autenticaci\xF3n",
    "Login": "Iniciar sesi\xF3n",
    "Register": "Registrarse",
    "Recover_Password": "Recuperar contrase\xF1a",
    "Lock_Screen": "Bloquear pantalla",
    "Confirm_Mail": "Confirmar correo",
    "Email_verification": "Verificacion de email",
    "Two_step_verification": "Verificaci\xF3n de dos pasos",
    "Utility": "Utilidad",
    "Starter_Page": "P\xE1gina de inicio",
    "Maintenance": "Mantenimiento",
    "Coming_Soon": "Pr\xF3ximamente",
    "Timeline": "Cronolog\xEDa",
    "FAQs": "Preguntas frecuentes",
    "Pricing": "Precios",
    "Error_404": "error 404",
    "Error_500": "Error 500",
    "Components": "Componentes",
    "UI_Elements": "Elementos de la interfaz de usuario",
    "Alerts": "Alertas",
    "Buttons": "Botones",
    "Cards": "Tarjetas",
    "Carousel": "Carrusel",
    "Dropdowns": "Listas deplegables",
    "Grid": "Cuadr\xEDcula",
    "Images": "Imagenes",
    "Lightbox": "Caja ligera",
    "Modals": "Modales",
    "Offcanvas": "Fuera del lienzo",
    "Range_Slider": "Control deslizante de rango",
    "Session_Timeout": "Hora de t\xE9rmino de la sesi\xF3n",
    "Progress_Bars": "Barras de progreso",
    "Sweet_Alert": "Alerta dulce",
    "Tabs_&_Accordions": "Pesta\xF1as y acordeones",
    "Typography": "Tipograf\xEDa",
    "Video": "V\xEDdeo",
    "General": "General",
    "Colors": "Colores",
    "Rating": "Clasificaci\xF3n",
    "Notifications": "Notificaciones",
    "Forms": "Formularios",
    "Form_Elements": "Elementos de formulario",
    "Form_Layouts": "Dise\xF1os de formulario",
    "Form_Validation": "Validaci\xF3n de formulario",
    "Form_Advanced": "Formulario avanzado",
    "Form_Editors": "Editores de formularios",
    "Form_File_Upload": "Carga de archivo de formulario",
    "Form_Xeditable": "Formulario Xeditable",
    "Form_Repeater": "Repetidor de formulario",
    "Form_Wizard": "Asistente de formulario",
    "Form_Mask": "M\xE1scara de forma",
    "Tables": "Mesas",
    "Basic_Tables": "Tablas b\xE1sicas",
    "Data_Tables": "Tablas de datos",
    "Responsive_Table": "Tabla receptiva",
    "Editable_Table": "Tabla editable",
    "Charts": "Gr\xE1ficos",
    "Apex_Charts": "Gr\xE1ficos de Apex",
    "E_Charts": "Gr\xE1ficos E",
    "Chartjs_Charts": "Gr\xE1ficos de Chartjs",
    "Flot_Charts": "Gr\xE1ficos de Flot",
    "Toast_UI_Charts": "Gr\xE1ficos de interfaz de usuario de Toast",
    "Jquery_Knob_Charts": "Gr\xE1ficos de perillas de Jquery",
    "Sparkline_Charts": "Minigr\xE1ficos",
    "Icons": "Iconos",
    "Boxicons": "Boxicones",
    "Material_Design": "Dise\xF1o de materiales",
    "Dripicons": "Dripicons",
    "Font_awesome": "Fuente impresionante",
    "Maps": "Mapas",
    "Google_Maps": "mapas de Google",
    "Vector_Maps": "Mapas vectoriales",
    "Leaflet_Maps": "Mapas de folletos",
    "Multi_Level": "Multi nivel",
    "Level_1.1": "Nivel 1.1",
    "Level_1.2": "Nivel 1.2",
    "Level_2.1": "Nivel 2.1",
    "Level_2.2": "Nivel 2.2",
    "Search": "Buscar...",
    "Mega_Menu": "Mega men\xFA",
    "UI_Components": "Componentes de UI",
    "Applications": "Aplicaciones",
    "Extra_Pages": "P\xE1ginas extra",
    "Horizontal_layout": "Disposici\xF3n horizontal",
    "View_All": "Ver todo",
    "Your_order_is_placed": "Se realiza tu pedido",
    "If_several_languages_coalesce_the_grammar": "Si varios idiomas fusionan la gram\xE1tica",
    "3_min_ago": "Hace 3 minutos",
    "James_Lemire": "James Lemire",
    "It_will_seem_like_simplified_English": "Parecer\xE1 un ingl\xE9s simplificado.",
    "1_hours_ago": "Hace 1 hora",
    "Your_item_is_shipped": "Tu art\xEDculo es enviado",
    "Salena_Layfield": "Salena Layfield",
    "As_a_skeptical_Cambridge_friend_of_mine_occidental": "Como esc\xE9ptico amigo m\xEDo occidental de Cambridge.",
    "View_More": "Ver m\xE1s..",
    "My_Wallet": "Mi billetera",
    "Settings": "Configuraciones",
    "Lock_screen": "Bloquear pantalla",
    "Logout": "Cerrar sesi\xF3n",
    "Edit_Details": "Editar detalles",
    "Placeholders": "Marcadores de posici\xF3n",
    "Toasts": "Tostadas"
  },
  "users": {
    "title_index": "Usuarios",
    "title_add": "Agregar usuario",
    "title_show": "Ver usuario",
    "title_edit": "Modificar usuario",
    "id": "Id",
    "role_id": "Rol",
    "name": "Nombre",
    "paternal_surname": "Apellido paterno",
    "maternal_surname": "Apellido materno",
    "picture": "picture",
    "email": "email",
    "email_verified_at": "email_verified_at",
    "password": "Contrase\xF1a",
    "remember_token": "remember_token",
    "created_at": "Fecha creado",
    "updated_at": "Fecha modificado",
    "Successfully created": "Creado correctamente",
    "Successfully updated": "Modificado correctamente",
    "Successfully deleted": "Eliminado correctamente",
    "constraint_error_delete_message": "Error al intentar eliminar de la base de datos",
    "Successfully saved permissions": "Permisos guardados correctamente"
  },
  "validation": {
    "accepted": "El campo :attribute debe ser aceptado.",
    "accepted_if": "El campo :attribute debe ser aceptado cuando :other es :value.",
    "active_url": "El campo :attribute no es una URL v\xE1lida.",
    "after": "El campo :attribute debe ser una fecha posterior a :date.",
    "after_or_equal": "El campo :attribute debe ser una fecha posterior o igual a :date.",
    "alpha": "El campo :attribute solo puede contener letras.",
    "alpha_dash": "El campo :attribute solo puede contener letras, n\xFAmeros, guiones y guiones bajos.",
    "alpha_num": "El campo :attribute solo puede contener letras y n\xFAmeros.",
    "array": "El campo :attribute debe ser un array.",
    "before": "El campo :attribute debe ser una fecha anterior a :date.",
    "before_or_equal": "El campo :attribute debe ser una fecha anterior o igual a :date.",
    "between": {
      "array": "El campo :attribute debe contener entre :min y :max elementos.",
      "file": "El archivo :attribute debe pesar entre :min y :max kilobytes.",
      "numeric": "El campo :attribute debe ser un valor entre :min y :max.",
      "string": "El campo :attribute debe contener entre :min y :max caracteres."
    },
    "boolean": "El campo :attribute debe ser verdadero o falso.",
    "confirmed": "El campo confirmaci\xF3n de :attribute no coincide.",
    "current_password": "La contrase\xF1a es incorrecta.",
    "date": "El campo :attribute no corresponde con una fecha v\xE1lida.",
    "date_equals": "El campo :attribute debe ser una fecha igual a :date.",
    "date_format": "El campo :attribute no corresponde con el formato de fecha :format.",
    "declined": "El campo :attribute debe ser rechazado.",
    "declined_if": "El campo :attribute debe ser rechazado cuando :other es :value.",
    "different": "Los campos :attribute y :other deben ser diferentes.",
    "digits": "El campo :attribute debe ser un n\xFAmero de :digits d\xEDgitos.",
    "digits_between": "El campo :attribute debe contener entre :min y :max d\xEDgitos.",
    "dimensions": "El campo :attribute tiene dimensiones de imagen inv\xE1lidas.",
    "distinct": "El campo :attribute tiene un valor duplicado.",
    "email": "El campo :attribute debe ser una direcci\xF3n de correo v\xE1lida.",
    "ends_with": "El campo :attribute debe finalizar con alguno de los siguientes valores: :values",
    "enum": "The selected :attribute is invalid.",
    "exists": "El campo :attribute seleccionado no existe.",
    "file": "El campo :attribute debe ser un archivo.",
    "filled": "El campo :attribute debe tener un valor.",
    "gt": {
      "array": "El campo :attribute debe contener m\xE1s de :value elementos.",
      "file": "El archivo :attribute debe pesar m\xE1s de :value kilobytes.",
      "numeric": "El campo :attribute debe ser mayor a :value.",
      "string": "El campo :attribute debe contener m\xE1s de :value caracteres."
    },
    "gte": {
      "array": "El campo :attribute debe contener :value o m\xE1s elementos.",
      "file": "El archivo :attribute debe pesar :value o m\xE1s kilobytes.",
      "numeric": "El campo :attribute debe ser mayor o igual a :value.",
      "string": "El campo :attribute debe contener :value o m\xE1s caracteres."
    },
    "image": "El campo :attribute debe ser una imagen.",
    "in": "El campo :attribute es inv\xE1lido.",
    "in_array": "El campo :attribute no existe en :other.",
    "integer": "El campo :attribute debe ser un n\xFAmero entero.",
    "ip": "El campo :attribute debe ser una direcci\xF3n IP v\xE1lida.",
    "ipv4": "El campo :attribute debe ser una direcci\xF3n IPv4 v\xE1lida.",
    "ipv6": "El campo :attribute debe ser una direcci\xF3n IPv6 v\xE1lida.",
    "json": "El campo :attribute debe ser una cadena de texto JSON v\xE1lida.",
    "lt": {
      "array": "El campo :attribute debe contener menos de :value elementos.",
      "file": "El archivo :attribute debe pesar menos de :value kilobytes.",
      "numeric": "El campo :attribute debe ser menor a :value.",
      "string": "El campo :attribute debe contener menos de :value caracteres."
    },
    "lte": {
      "array": "El campo :attribute debe contener :value o menos elementos.",
      "file": "El archivo :attribute debe pesar :value o menos kilobytes.",
      "numeric": "El campo :attribute debe ser menor o igual a :value.",
      "string": "El campo :attribute debe contener :value o menos caracteres."
    },
    "mac_address": "El campo :attribute debe ser una direcci\xF3n MAC v\xE1lida.",
    "max": {
      "array": "El campo :attribute no debe contener m\xE1s de :max elementos.",
      "file": "El archivo :attribute no debe pesar m\xE1s de :max kilobytes.",
      "numeric": "El campo :attribute no debe ser mayor a :max.",
      "string": "El campo :attribute no debe contener m\xE1s de :max caracteres."
    },
    "mimes": "El campo :attribute debe ser un archivo de tipo: :values.",
    "mimetypes": "El campo :attribute debe ser un archivo de tipo: :values.",
    "min": {
      "array": "El campo :attribute debe contener al menos :min elementos.",
      "file": "El archivo :attribute debe pesar al menos :min kilobytes.",
      "numeric": "El campo :attribute debe ser al menos :min.",
      "string": "El campo :attribute debe contener al menos :min caracteres."
    },
    "multiple_of": "The :attribute must be a multiple of :value.",
    "not_in": "El campo :attribute seleccionado es inv\xE1lido.",
    "not_regex": "El formato del campo :attribute es inv\xE1lido.",
    "numeric": "El campo :attribute debe ser un n\xFAmero.",
    "password": "La contrase\xF1a es incorrecta.",
    "present": "El campo :attribute debe estar presente.",
    "prohibited": "El campo :attribute no es admitido.",
    "prohibited_if": "El campo :attribute no es admitido cuando :other es :value.",
    "prohibited_unless": "El campo :attribute no es admitido hasta que :other es :values.",
    "prohibits": "El campo :attribute no admite :other.",
    "regex": "El formato del campo :attribute es inv\xE1lido.",
    "required": "El campo :attribute es obligatorio.",
    "required_array_keys": "The :attribute field must contain entries for: :values.",
    "required_if": "El campo :attribute es obligatorio cuando el campo :other es :value.",
    "required_unless": "El campo :attribute es requerido a menos que :other se encuentre en :values.",
    "required_with": "El campo :attribute es obligatorio cuando :values est\xE1 presente.",
    "required_with_all": "El campo :attribute es obligatorio cuando :values est\xE1n presentes.",
    "required_without": "El campo :attribute es obligatorio cuando :values no est\xE1 presente.",
    "required_without_all": "El campo :attribute es obligatorio cuando ninguno de los campos :values est\xE1n presentes.",
    "same": "Los campos :attribute y :other deben ser iguales.",
    "size": {
      "array": "El campo :attribute debe contener :size elementos.",
      "file": "El archivo :attribute debe pesar :size kilobytes.",
      "numeric": "El campo :attribute debe ser :size.",
      "string": "El campo :attribute debe contener :size caracteres."
    },
    "starts_with": "El campo :attribute debe comenzar con uno de los siguientes valores: :values",
    "string": "El campo :attribute debe ser una cadena de caracteres.",
    "timezone": "El campo :attribute debe ser una zona horaria v\xE1lida.",
    "unique": "El valor del campo :attribute ya est\xE1 en uso.",
    "uploaded": "El campo :attribute no se pudo subir.",
    "url": "El formato del campo :attribute es inv\xE1lido.",
    "uuid": "El campo :attribute debe ser un UUID v\xE1lido.",
    "custom": {
      "attribute-name": {
        "rule-name": "custom-message"
      },
      "user_id": {
        "gt": "El campo :attribute debe tener un valor v\xE1lido"
      }
    },
    "attributes": []
  }
};

/***/ }),

/***/ "./resources/js/layout/cookie.js":
/*!***************************************!*\
  !*** ./resources/js/layout/cookie.js ***!
  \***************************************/
/***/ (() => {

$(document).ready(function () {
  //store a cookie
  window.writeCookie = function (name, value, days) {
    var date, expires;
    if (days) {
      date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = "; expires=" + date.toGMTString();
    } else {
      expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
  };

  //retrive a cookie
  window.readCookie = function (name) {
    var i,
      c,
      ca,
      nameEQ = name + "=";
    ca = document.cookie.split(';');
    for (i = 0; i < ca.length; i++) {
      c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1, c.length);
      }
      if (c.indexOf(nameEQ) == 0) {
        return c.substring(nameEQ.length, c.length);
      }
    }
    return '';
  };
});

/***/ }),

/***/ "./resources/js/layout/image_preview.js":
/*!**********************************************!*\
  !*** ./resources/js/layout/image_preview.js ***!
  \**********************************************/
/***/ (() => {

$(document).ready(function () {
  // Cuando se suba una imagen...
  $("#imageInput").change(function () {
    // Llama la función que muestra el preview.
    readURL(this);
  });
});
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#imagePreview').attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

/***/ }),

/***/ "./resources/js/layout/sidebar.js":
/*!****************************************!*\
  !*** ./resources/js/layout/sidebar.js ***!
  \****************************************/
/***/ (() => {

$(function () {
  //En móvil la barra de navegación inicia contraída y en las demás resoluciones inicia expandida
  if (isMobile) $('#navbar').removeClass("navbar-expanded").addClass("navbar-collapsed");else $('#navbar').removeClass("navbar-collapsed").addClass("navbar-expanded");

  //Al hacer cambiar tamaño de la ventana actualizar la variable que indica si estamos en móvil
  $(window).resize(function () {
    isMobile = $(window).width() < mobileWidth ? true : false;
  });

  /**
   * [Al dar click en el botón para minimizar menú le agrega la clase collapsed a la barra de menú y llama a la función que cambia la visualización]
   */
  $("#navbar-toggler").click(function (event) {
    var collapse = false;
    $.each($('#navbar').attr('class').split(' '), function (index, val) {
      if (val == "navbar-collapsed") collapse = false;else if (val == "navbar-expanded") collapse = true;
    });
    collapseMenu(collapse);
  });

  //Al dar clic sobre un submenú girar la flecha
  $(".nav-item > a.nav-submenu").click(function (e) {
    if ($(this).attr("aria-expanded") == "false") {
      $(this).find(".dropdown-icon").removeClass('icon-expanded').addClass('icon-collapsed');
    } else {
      $(this).find(".dropdown-icon").removeClass('icon-collapsed').addClass('icon-expanded');
    }
  });

  //Al dar clic en un item que no es submenú cierra el navbar para que no estorbe
  $(".nav-item > a.nav-item").click(function (e) {
    if (isMobile) collapseMenu(true);
  });

  /**
   * [collapseMenu Contrae o expande la barra de navegación]
   * @param  {[Boolean]} collapse [Booleando para indicar si el menú debe collapsarse o no]
   */
  window.collapseMenu = function (collapse) {
    if (collapse) {
      if (isMobile) {
        $('#main').attr('style', 'display: flex!important');
      }
      $('#navbar').removeClass("navbar-expanded").addClass("navbar-collapsed");
      //$('#navbar i').css("font-size", "20px");
      //$(".navbar-submenu").removeClass('pl-sm-3');
      $(".nav-item > a > span").removeClass().addClass("d-none d-sm-none");
    } else {
      if (isMobile) {
        $('#main').attr('style', 'display: none!important');
      }
      $('#navbar').removeClass("navbar-collapsed").addClass("navbar-expanded");
      //$('#navbar i').css("font-size", "14px");
      //$(".navbar-submenu").addClass('pl-sm-3');
      $(".nav-item > a > span").removeClass().addClass("d-sm-inline d-sm-inline");
    }
    writeCookie("collapse", collapse, 1);
  };
  collapseMenu(readCookie("collapse") != "false");
});

/***/ }),

/***/ "./resources/js/layout/var.js":
/*!************************************!*\
  !*** ./resources/js/layout/var.js ***!
  \************************************/
/***/ (() => {

//En este apartado declaramos el tamaño de lo que será la pantalla de móvil.
window.mobileWidth = 578;
window.isMobile = $(window).width() < mobileWidth ? true : false;

/***/ }),

/***/ "./resources/js/mod_permissions/roles_permissions.js":
/*!***********************************************************!*\
  !*** ./resources/js/mod_permissions/roles_permissions.js ***!
  \***********************************************************/
/***/ (() => {

$(function () {
  /** Funciones para seleccionar secciones de permisos */
  window.permissionsChecking = function () {
    $(".permissionsContainer input[type=checkbox]").change(function (event) {
      //Los checkbox que son secciones tienen hijos
      if ($(this).attr("class") == "checkSection") {
        window.checkChild($(this).attr("id"), $(this).is(":checked"));
      }
      window.checkParent($(this).attr("data-parent"));
    });
  };

  /**
   * [checkChild Busca elementos hijos de un id dado y los selecciona o deselecciona
   * alguno de los elementos hijos es una sección se vuelve a llamar esta función]
   * @param  {String}  currentId [Id del elemento actual que vamos a buscar si tiene hijos para seleccionar]
   * @param  {Boolean} isChecked [Condición para ver si los hijos se van a seleccionar o deseleccionar]
   */
  window.checkChild = function (currentId, isChecked) {
    $(".permissionsContainer input[data-parent=" + currentId + "]").each(function (index, el) {
      if ($(el).prop("disabled") != true) {
        $(el).prop("checked", isChecked);
        if ($(el).attr("class") == "checkSection") {
          window.checkChild($(el).attr("id"), isChecked);
        }
      }
    });
  };

  /**
   * [checkParent Si el elemento tiene padre intenta seleccionarlo.
   * Si el padre seleccionado tiene un elemento padre se vuelve a llamar esta función]
   * @param  {String} parentId [Id del elemento padre del elemento]
   */
  window.checkParent = function (parentId) {
    if (parentId != "0") {
      //Verificar si voy a seleccionar la sección
      var isChecked = true;
      $(".permissionsContainer input[data-parent=" + parentId + "]").each(function (index, el) {
        if (!$(el).is(":checked")) {
          isChecked = false;
        }
      });
      var section = $("#" + parentId);
      section.prop("checked", isChecked);
      //Si la sección que se seleccionó tiene parent, entonces vuelve a llamar esta función para evaluar si se seleccionará la sección padre
      if (section.attr("data-parent") != "0") {
        window.checkParent(section.attr("data-parent"));
      }
    }
  };
  $(".checkPermission").each(function (index, el) {
    if ($(this).is(":checked")) {
      if ($(this).attr("data-parent") != "0") {
        window.checkParent($(this).attr("data-parent"));
      }
    }
  });
  permissionsChecking();
});

/***/ }),

/***/ "./resources/js/orders/credit_notes_functions.js":
/*!*******************************************************!*\
  !*** ./resources/js/orders/credit_notes_functions.js ***!
  \*******************************************************/
/***/ (() => {

$(function () {
  window.calculateTotal = function (input) {
    var totalBase = parseFloat($(input).val());
    var iva = parseFloat((totalBase * 0.16).toFixed(6));
    var total = (totalBase + iva).toFixed(6);
    var totalDisplay = window.customRound(total, "ceil", 2);
    $(input).closest("form").find("#iva").val(iva.toFixed(6));
    $(input).closest("form").find("#total").val(total);
    $(input).closest("form").find("#total_display").val(parseFloat(totalDisplay).toFixed(6));
  };
});

/***/ }),

/***/ "./resources/js/orders/payments_functions.js":
/*!***************************************************!*\
  !*** ./resources/js/orders/payments_functions.js ***!
  \***************************************************/
/***/ (() => {

$(function () {
  window.loadPayment = function (data, input) {
    var row = $(input).closest(".payment-row");
    $(row).find("input#amount").attr({
      "type": "number",
      "placeholder": data.total_pending,
      "max": data.total_pending,
      "step": 100,
      "value": data.total_pending
    });
  };
  window.addAndNext = function (button) {
    var row = $(button).closest(".payment-row");
    var validate = window.validateRow(row);
    if (validate.status) {
      $(row).addClass("row-checked");
      $(row).find("input#order_input").attr("readonly", true);
      $(row).find("input#amount").attr("readonly", true).val(window.customRound($(row).find("input#amount").val()));
      $(row).find("div.row-check").addClass("d-none");
      $(row).find("div.row-delete").removeClass("d-none");
      calculateTotal();
      addRow();
    } else {
      handleMessage(validate);
    }
  };
  window.addRow = function () {
    $.ajax({
      url: $('meta[name="app-url"]').attr('content') + "/order_payments/add_payment_row",
      type: 'GET',
      dataType: 'json',
      success: function success(response) {
        $(".payments-container").append(response);
        loadAutocomplete();
      }
    });
  };
  window.deleteModalRow = function (button) {
    if (confirm("Está seguro que desea eliminar este pago")) {
      $(button).closest(".payment-row").remove();
      window.calculateTotal();
    }
  };
  window.calculateTotal = function (row) {
    var total_payment = parseFloat($("#total").val());
    var total_paid = window.getTotalPaid();

    //$("#display_total_payment").html(moneyFormat(total_payment));
    $("#display_total_paid").html(window.moneyFormat(total_paid));
    //$("#display_total_pending").html(moneyFormat(total_payment-total_paid));
  };

  window.getTotalPaid = function () {
    var total_paid = 0;
    $(".payments-container .payment-row").each(function (index, el) {
      if ($(this).hasClass("row-checked")) {
        total_paid += parseFloat($(this).find("#amount").val());
      }
    });
    return total_paid;
  };
  window.availableAmountToAdd = function (amount) {
    var total_payment = parseFloat($("#total").val());
    var total_paid = window.getTotalPaid();
    console.log(total_paid + parseFloat(amount), total_payment);
    return total_paid + parseFloat(amount) <= total_payment;
  };
  window.customRound = function (value) {
    var type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "floor";
    var exp = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 2;
    var temp = Math[type]("".concat(Number(value), "e").concat(Number(exp)));
    return Number("".concat(temp, "e").concat(Number(-exp))).toFixed(exp);
  };
  window.moneyFormat = function (param) {
    return "$ " + parseFloat(param).toFixed(2);
  };
  window.savePayments = function (params) {
    var validate = window.validateForm("#order_payments-quickmodal");
    if (validate.status) {
      $("#btnSave").attr("disabled", true);
      $("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'wait');
      var payments = [];
      $(".payments-container .payment-row").each(function (index, el) {
        if ($(this).hasClass("row-checked")) {
          payments.push({
            "order_id": $(this).find("input#order_id").val(),
            "amount": $(this).find("input#amount").val()
          });
        }
      });
      $.ajax({
        url: $('meta[name="app-url"]').attr('content') + "/order_payments",
        type: 'POST',
        data: {
          //total: $("form#order_payments-quickmodal #total").val(),
          total: window.getTotalPaid(),
          client_id: $("form#order_payments-quickmodal #client_id").val(),
          payment_date: $("form#order_payments-quickmodal #payment_date").val(),
          payment_type_id: $("form#order_payments-quickmodal #payment_type_id").val(),
          payment_method_id: $("form#order_payments-quickmodal #payment_method_id").val(),
          payments: payments
        },
        dataType: 'json',
        success: function success(response) {
          if (response.data !== undefined) {
            $("#order_payments-quickadd").trigger("reset");
            $(".order_payments-modal").modal('hide');
            $(".order_payments-modal").remove();
            displayMessage(response.message, response.status ? "success" : "danger");
            var dt = window.LaravelDataTables["order_payments-table"];
            dt.ajax.reload();
          } else {
            var el = $("#order_payments-quickmodal").find(".message-container");
            displayMessage(response.message, response.status ? "success" : "danger", el);
            $("#btnSave").attr("disabled", false);
            $("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'default');
          }
        }
      }).fail(function (response) {
        //si hubo error en la validación
        if (typeof response.responseJSON.message !== "undefined") {
          var el = $("#order_payments-quickmodal").find(".message-container");
          displayMessage(response.responseJSON.errors, "danger", el);
        }
        $("#btnSave").attr("disabled", false);
        $("#btnSave, .modal-content *, .modal-backdrop").css('cursor', 'default');
      });
    } else {
      handleMessage(validate);
    }
  };

  //#region Validations
  window.validateRow = function (row) {
    var result = {
      status: true,
      message: ""
    };
    //clear
    clearErrors();
    if ($(row).find("input#order_id").val() == "") {
      result.status = false;
      result.message = "Necesita seleccionar una factura válida";
      result.target = $(row).find("input#order_input");
    }
    if (result.status && $(row).find("input#amount").val() == "") {
      result.status = false;
      result.message = "Necesita ingresar una cantidad a pagar válida";
      result.target = $(row).find("input#amount");
    }
    if (result.status && $(row).find("input#amount").hasClass("text-danger")) {
      result.status = false;
      result.message = "La cantidad ingresada sobrepasa el saldo insoluto de la factura";
      result.target = $(row).find("input#amount");
    }
    /*if (result.status && !availableAmountToAdd($(row).find("input#amount").val())) {
    	result.status = false;
    	result.message = "La cantidad ingresada sobrepasa el saldo del complemento";
    	result.target = $(row).find("input#amount");
    }*/
    return result;
  };
  window.validateForm = function () {
    var result = {
      status: true,
      message: ""
    };

    //clear
    clearErrors();

    /*if ($("form#order_payments-quickmodal").find("#total").val() == "") {
    	result.status = false;
    	result.message = "Necesita ingresar un total válido";
    	result.target = $("form#order_payments-quickmodal").find("#total");
    }*/
    if (result.status && $("form#order_payments-quickmodal").find("#client_id").val() == "") {
      result.status = false;
      result.message = "Necesita seleccionar un cliente válido";
      result.target = $("form#order_payments-quickmodal").find("#client_id");
    }
    if (result.status && $("form#order_payments-quickmodal").find("#payment_date").val() == "") {
      result.status = false;
      result.message = "Necesita ingresar una fecha de pago válida";
      result.target = $("form#order_payments-quickmodal").find("#payment_date");
    }
    if (result.status && $("form#order_payments-quickmodal").find("#payment_type_id").val() == "") {
      result.status = false;
      result.message = "Necesita seleccionar una forma de pago válida";
      result.target = $("form#order_payments-quickmodal").find("#payment_type_id");
    }
    if (result.status && $("form#order_payments-quickmodal").find("#payment_method_id").val() == "") {
      result.status = false;
      result.message = "Necesita seleccionar un método de pago válido";
      result.target = $("form#order_payments-quickmodal").find("#payment_method_id");
    }
    if (result.status && getTotalPaid() == 0) {
      result.status = false;
      result.message = "Necesita ingresar un pago válido";
      result.target = $("form#order_payments-quickmodal").find("input#order_input");
    }
    getTotalPaid;
    return result;
  };
  window.validateAmount = function (input) {
    if (parseFloat($(input).val()) > parseFloat($(input).attr("max"))) {
      $(input).addClass("text-danger");
    } else {
      $(input).removeClass("text-danger");
    }
  };
  window.clearErrors = function () {
    var fields = ["#total", "#client_id", "#payment_date", "#payment_type_id", "#payment_method_id", "#order_input", "input[name=order_input]", "input[name=amount]"];
    $.each(fields, function (index, val) {
      $(val).removeClass("validate-error");
    });
  };
  window.handleMessage = function (validate) {
    alert(validate.message);
    $(validate.target).addClass("validate-error").trigger("focus");
  };
  //#endregion
});

/***/ }),

/***/ "./resources/js/theme.js":
/*!*******************************!*\
  !*** ./resources/js/theme.js ***!
  \*******************************/
/***/ (() => {

/*
Template Name: Skote - Admin & Dashboard Template
Author: Themesbrand
Version: 3.3.0.
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Main Js File
*/

(function ($) {
  'use strict';

  function initMetisMenu() {
    //metis menu
    $("#side-menu").metisMenu();
  }
  function initLeftMenuCollapse() {
    $('#vertical-menu-btn').on('click', function (event) {
      event.preventDefault();
      $('body').toggleClass('sidebar-enable');
      if ($(window).width() >= 992) {
        $('body').toggleClass('vertical-collpsed');
      } else {
        $('body').removeClass('vertical-collpsed');
      }
    });
  }
  function initActiveMenu() {
    // === following js will activate the menu in left side bar based on url ====
    $("#sidebar-menu a").each(function () {
      var pageUrl = window.location.href.split(/[?#]/)[0];
      if (this.href == pageUrl) {
        $(this).addClass("active");
        $(this).parent().addClass("mm-active"); // add active to li of the current link
        $(this).parent().parent().addClass("mm-show");
        $(this).parent().parent().prev().addClass("mm-active"); // add active class to an anchor
        $(this).parent().parent().parent().addClass("mm-active");
        $(this).parent().parent().parent().parent().addClass("mm-show"); // add active to li of the current link
        $(this).parent().parent().parent().parent().parent().addClass("mm-active");
      }
    });
  }
  function initMenuItemScroll() {
    // focus active menu in left sidebar
    $(document).ready(function () {
      if ($("#sidebar-menu").length > 0 && $("#sidebar-menu .mm-active .active").length > 0) {
        var activeMenu = $("#sidebar-menu .mm-active .active").offset().top;
        if (activeMenu > 300) {
          activeMenu = activeMenu - 300;
          $(".vertical-menu .simplebar-content-wrapper").animate({
            scrollTop: activeMenu
          }, "slow");
        }
      }
    });
  }
  function initHoriMenuActive() {
    $(".navbar-nav a").each(function () {
      var pageUrl = window.location.href.split(/[?#]/)[0];
      if (this.href == pageUrl) {
        $(this).addClass("active");
        $(this).parent().addClass("active");
        $(this).parent().parent().addClass("active");
        $(this).parent().parent().parent().addClass("active");
        $(this).parent().parent().parent().parent().addClass("active");
        $(this).parent().parent().parent().parent().parent().addClass("active");
        $(this).parent().parent().parent().parent().parent().parent().addClass("active");
      }
    });
  }
  function initFullScreen() {
    $('[data-bs-toggle="fullscreen"]').on("click", function (e) {
      e.preventDefault();
      $('body').toggleClass('fullscreen-enable');
      if (!document.fullscreenElement && /* alternative standard method */!document.mozFullScreenElement && !document.webkitFullscreenElement) {
        // current working methods
        if (document.documentElement.requestFullscreen) {
          document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
          document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
      } else {
        if (document.cancelFullScreen) {
          document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        }
      }
    });
    document.addEventListener('fullscreenchange', exitHandler);
    document.addEventListener("webkitfullscreenchange", exitHandler);
    document.addEventListener("mozfullscreenchange", exitHandler);
    function exitHandler() {
      if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
        console.log('pressed');
        $('body').removeClass('fullscreen-enable');
      }
    }
  }
  function initRightSidebar() {
    // right side-bar toggle
    $('.right-bar-toggle').on('click', function (e) {
      $('body').toggleClass('right-bar-enabled');
    });
    $(document).on('click', 'body', function (e) {
      if ($(e.target).closest('.right-bar-toggle, .right-bar').length > 0) {
        return;
      }
      $('body').removeClass('right-bar-enabled');
      return;
    });
  }
  function initDropdownMenu() {
    if (document.getElementById("topnav-menu-content")) {
      var elements = document.getElementById("topnav-menu-content").getElementsByTagName("a");
      for (var i = 0, len = elements.length; i < len; i++) {
        elements[i].onclick = function (elem) {
          if (elem.target.getAttribute("href") === "#") {
            elem.target.parentElement.classList.toggle("active");
            elem.target.nextElementSibling.classList.toggle("show");
          }
        };
      }
      window.addEventListener("resize", updateMenu);
    }
  }
  function updateMenu() {
    var elements = document.getElementById("topnav-menu-content").getElementsByTagName("a");
    for (var i = 0, len = elements.length; i < len; i++) {
      if (elements[i].parentElement.getAttribute("class") === "nav-item dropdown active") {
        elements[i].parentElement.classList.remove("active");
        if (elements[i].nextElementSibling !== null) {
          elements[i].nextElementSibling.classList.remove("show");
        }
      }
    }
  }
  function initComponents() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl);
    });
    var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'));
    var offcanvasList = offcanvasElementList.map(function (offcanvasEl) {
      return new bootstrap.Offcanvas(offcanvasEl);
    });
  }
  function initPreloader() {
    $(window).on('load', function () {
      $('#status').fadeOut();
      $('#preloader').delay(350).fadeOut('slow');
    });
  }
  function initSettings() {
    if (window.sessionStorage) {
      var alreadyVisited = sessionStorage.getItem("is_visited");
      if (!alreadyVisited) {
        sessionStorage.setItem("is_visited", "light-mode-switch");
      } else {
        $(".right-bar input:checkbox").prop('checked', false);
        $("#" + alreadyVisited).prop('checked', true);
        updateThemeSetting(alreadyVisited);
      }
    }
    $("#light-mode-switch, #dark-mode-switch, #rtl-mode-switch, #dark-rtl-mode-switch").on("change", function (e) {
      updateThemeSetting(e.target.id);
    });

    // show password input value
    $("#password-addon").on('click', function () {
      if ($(this).siblings('input').length > 0) {
        $(this).siblings('input').attr('type') == "password" ? $(this).siblings('input').attr('type', 'input') : $(this).siblings('input').attr('type', 'password');
      }
    });
  }
  function updateThemeSetting(id) {
    if ($("#light-mode-switch").prop("checked") == true && id === "light-mode-switch") {
      $("html").removeAttr("dir");
      $("#dark-mode-switch").prop("checked", false);
      $("#rtl-mode-switch").prop("checked", false);
      $("#dark-rtl-mode-switch").prop("checked", false);
      $("#bootstrap-style").attr('href', 'assets/css/bootstrap.min.css');
      $("#app-style").attr('href', 'assets/css/app.min.css');
      sessionStorage.setItem("is_visited", "light-mode-switch");
    } else if ($("#dark-mode-switch").prop("checked") == true && id === "dark-mode-switch") {
      $("html").removeAttr("dir");
      $("#light-mode-switch").prop("checked", false);
      $("#rtl-mode-switch").prop("checked", false);
      $("#dark-rtl-mode-switch").prop("checked", false);
      $("#bootstrap-style").attr('href', 'assets/css/bootstrap-dark.min.css');
      $("#app-style").attr('href', 'assets/css/app-dark.min.css');
      sessionStorage.setItem("is_visited", "dark-mode-switch");
    } else if ($("#rtl-mode-switch").prop("checked") == true && id === "rtl-mode-switch") {
      $("#light-mode-switch").prop("checked", false);
      $("#dark-mode-switch").prop("checked", false);
      $("#dark-rtl-mode-switch").prop("checked", false);
      $("#bootstrap-style").attr('href', 'assets/css/bootstrap.rtl.css');
      $("#app-style").attr('href', 'assets/css/app.rtl.css');
      $("html").attr("dir", 'rtl');
      sessionStorage.setItem("is_visited", "rtl-mode-switch");
    } else if ($("#dark-rtl-mode-switch").prop("checked") == true && id === "dark-rtl-mode-switch") {
      $("#light-mode-switch").prop("checked", false);
      $("#rtl-mode-switch").prop("checked", false);
      $("#dark-mode-switch").prop("checked", false);
      $("#bootstrap-style").attr('href', 'assets/css/bootstrap-dark.rtl.css');
      $("#app-style").attr('href', 'assets/css/app-dark.rtl.css');
      $("html").attr("dir", 'rtl');
      sessionStorage.setItem("is_visited", "dark-rtl-mode-switch");
    }
  }
  function initCheckAll() {
    $('#checkAll').on('change', function () {
      $('.table-check .form-check-input').prop('checked', $(this).prop("checked"));
    });
    $('.table-check .form-check-input').change(function () {
      if ($('.table-check .form-check-input:checked').length == $('.table-check .form-check-input').length) {
        $('#checkAll').prop('checked', true);
      } else {
        $('#checkAll').prop('checked', false);
      }
    });
  }
  function init() {
    initMetisMenu();
    initLeftMenuCollapse();
    initActiveMenu();
    initMenuItemScroll();
    initHoriMenuActive();
    initFullScreen();
    initRightSidebar();
    initDropdownMenu();
    initComponents();
    initSettings();
    initPreloader();
    Waves.init();
    initCheckAll();
  }
  init();
})(jQuery);

/***/ }),

/***/ "./lang/es.json":
/*!**********************!*\
  !*** ./lang/es.json ***!
  \**********************/
/***/ ((module) => {

"use strict";
module.exports = JSON.parse('{"The :attribute must contain at least one letter.":"El campo :attribute debe contener al menos una letra.","The :attribute must contain at least one number.":"El campo :attribute debe contener al menos un número.","The :attribute must contain at least one symbol.":"El campo :attribute debe contener al menos un símbolo.","The :attribute must contain at least one uppercase and one lowercase letter.":"El campo :attribute debe contener al menos una mayuscula y una minúscula.","The given :attribute has appeared in a data leak. Please choose a different :attribute.":"El campo :attribute está en la lista de datos no seguros. Por favor selecione un :attribute diferente.","title_confirm_status":"Confirmar envío de compra","confirm_status":"¿Estás seguro de que deseas enviar la compra al inventario? No podrás hacer modificaciones después.","Write your E-Mail Address":"Escribe tu correo electrónico","E-Mail Address":"Correo electrónico","Password":"Contraseña","Remember Me":"Recuérdame","Login":"Iniciar sesión","Forgot Your Password?":"¿Olvidaste tu contraseña?","Register":"Registro","Name":"Nombre","Confirm Password":"Confirmar contraseña","Reset Password":"Recuperar contraseña","Reset Password Notification":"Aviso para restablecer contraseña","You are receiving this email because we received a password reset request for your account.":"Estás recibiendo este email porque se ha solicitado un cambio de contraseña para tu cuenta.","This password reset link will expire in :count minutes.":"Este enlace para restablecer la contraseña caduca en :count minutos.","If you did not request a password reset, no further action is required.":"Si no has solicitado un cambio de contraseña, puedes ignorar o eliminar este e-mail.","Please confirm your password before continuing.":"Por favor confirme su contraseña antes de continuar.","Regards":"Saludos","Whoops!":"¡Ups!","Hello!":"¡Hola!","If you’re having trouble clicking the :actionText button, copy and paste the URL below\\ninto your web browser: [:actionURL](:actionURL)":"Si tienes problemas haciendo click en el botón :actionText, copia y pega el siguiente\\nenlace en tu navegador: [:actionURL](:actionURL)","If you’re having trouble clicking the :actionText button, copy and paste the URL below\\ninto your web browser: [:displayableActionUrl](:actionURL)":"Si tienes problemas haciendo click en el botón :actionText, copia y pega el siguiente\\nenlace en tu navegador: [:displayableActionUrl](:actionURL)","If you’re having trouble clicking the :actionText button, copy and paste the URL below\\ninto your web browser:":"Si tienes problemas haciendo click en el botón :actionText, copia y pega el siguiente\\nenlace en tu navegador:","Are you sure you want to delete this row?":"¿Estás seguro que quieres eliminar este registro?","Send Password Reset Link":"Enviar correo de recuperación","Logout":"Cerrar sesión","Sign in":"Registrate","Verify Email Address":"Confirmar correo electrónico","Please click the button below to verify your email address.":"Por favor pulsa el siguiente botón para confirmar tu correo electrónico.","Please select":"Selecciona una opción.","Select":"Seleccione","If you did not create an account, no further action is required.":"Si no has creado ninguna cuenta, puedes ignorar o eliminar este e-mail.","Verify Your Email Address":"Confirma tu correo electrónico","A fresh verification link has been sent to your email address.":"Se ha enviado un nuevo enlace de verificación a tu correo electrónico.","Before proceeding, please check your email for a verification link.":"Antes de poder continuar, por favor, confirma tu correo electrónico con el enlace que te hemos enviado.","If you did not receive the email":"Si no has recibido el email","click here to request another":"pulsa aquí para que te enviemos otro","All rights reserved.":"Todos los derechos reservados.","actions":"Acciones","action":"Acciones","show":"Ver detalles","edit":"Modificar","delete":"Eliminar","destroy":"Eliminar","generate":"Generar","Save":"Guardar","close":"Cerrar","Yes":"Si","load":"Cargar","description":"Descripción","id":"Id","Table":"Tabla","Grid":"Cuadricula","constraint_error_delete_message":"No se puede eliminar este registro porque hay entidades que dependen de el","Cancel":"Regresar","Save all":"Guardar todo","Search":"Buscar","Clear filters":"Limpiar filtros","Check out":"Salida","The given data was invalid.":"Datos incorrectos","Show details":"Mostrar detalles","Show all":"Mostrar todo","Add":"Agregar","print":"Imprimir","preview":"Vista Previa","help":"Ayuda","Advanced filters":"Filtros avanzados","Send email":"Enviar correo electrónico","Upload":"Subir archivos","Download File":"Descargar archivo"}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
// require('./bootstrap');
// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

//Layout
__webpack_require__(/*! ./theme.js */ "./resources/js/theme.js");
__webpack_require__(/*! ./layout/cookie.js */ "./resources/js/layout/cookie.js");
__webpack_require__(/*! ./layout/image_preview.js */ "./resources/js/layout/image_preview.js");
__webpack_require__(/*! ./layout/sidebar */ "./resources/js/layout/sidebar.js");
__webpack_require__(/*! ./layout/var.js */ "./resources/js/layout/var.js");

//Auth
__webpack_require__(/*! ./auth/login.js */ "./resources/js/auth/login.js");

//Mod permissions
__webpack_require__(/*! ./mod_permissions/roles_permissions.js */ "./resources/js/mod_permissions/roles_permissions.js");

//Mod Crud maker
__webpack_require__(/*! ./crud_maker/functions.js */ "./resources/js/crud_maker/functions.js");
__webpack_require__(/*! ./crud_maker/filters_datatables.js */ "./resources/js/crud_maker/filters_datatables.js");
__webpack_require__(/*! ./crud_maker/input_autocomplete.js */ "./resources/js/crud_maker/input_autocomplete.js");
__webpack_require__(/*! ./crud_maker/input_datepicker.js */ "./resources/js/crud_maker/input_datepicker.js");
__webpack_require__(/*! ./crud_maker/multirow_functions.js */ "./resources/js/crud_maker/multirow_functions.js");
__webpack_require__(/*! ./crud_maker/dropdown_fill_child.js */ "./resources/js/crud_maker/dropdown_fill_child.js");
__webpack_require__(/*! ./crud_maker/modal_quick_add.js */ "./resources/js/crud_maker/modal_quick_add.js");
__webpack_require__(/*! ./crud_maker/modal_delete.js */ "./resources/js/crud_maker/modal_delete.js");
__webpack_require__(/*! ./crud_maker/datatables_customize.js */ "./resources/js/crud_maker/datatables_customize.js");
__webpack_require__(/*! ./crud_maker/datatables_sum.js */ "./resources/js/crud_maker/datatables_sum.js");

//Dashboard
__webpack_require__(/*! ./dashboard/collapse_functions.js */ "./resources/js/dashboard/collapse_functions.js");
__webpack_require__(/*! ./dashboard/charts.js */ "./resources/js/dashboard/charts.js");

//lang files
__webpack_require__(/*! ./lang.js */ "./resources/js/lang.js");
window.i18n.es = __webpack_require__(/*! ./../../lang/es.json */ "./lang/es.json");

//Orders
__webpack_require__(/*! ./orders/payments_functions.js */ "./resources/js/orders/payments_functions.js");
__webpack_require__(/*! ./orders/credit_notes_functions.js */ "./resources/js/orders/credit_notes_functions.js");

//Buyings
__webpack_require__(/*! ./buyings/modal_confirm_status.js */ "./resources/js/buyings/modal_confirm_status.js");

//Cloud Dirs
__webpack_require__(/*! ./cloud_dirs/modal_share_permissions.js */ "./resources/js/cloud_dirs/modal_share_permissions.js");
__webpack_require__(/*! ./cloud_dirs/modal_create_folder.js */ "./resources/js/cloud_dirs/modal_create_folder.js");
//require('./deliveries.js');
})();

/******/ })()
;