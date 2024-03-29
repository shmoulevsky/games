"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_admin_views_Common_List_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Common/List.vue?vue&type=script&lang=js":
/*!******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Common/List.vue?vue&type=script&lang=js ***!
  \******************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _services_DataService__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/DataService */ "./resources/js/admin/services/DataService.js");
/* harmony import */ var _Components_Table_TableAdmin__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../Components/Table/TableAdmin */ "./resources/js/admin/views/Components/Table/TableAdmin.vue");
/* harmony import */ var _Components_Table_Pagination__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../Components/Table/Pagination */ "./resources/js/admin/views/Components/Table/Pagination.vue");
/* harmony import */ var _config_TableConfig__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../config/TableConfig */ "./resources/js/admin/config/TableConfig.js");
/* harmony import */ var _common_utils__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../common/utils */ "./resources/js/common/utils.js");





/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      title: {},
      items: {},
      offset: null,
      headers: {},
      per_page: null,
      sort: null,
      dir: null,
      add: '',
      edit: '',
      current_page: 1
    };
  },
  components: {
    TableAdmin: _Components_Table_TableAdmin__WEBPACK_IMPORTED_MODULE_1__["default"],
    VuePagination: _Components_Table_Pagination__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  computed: {},
  methods: {
    getItems: function getItems(page, sort, dir) {
      var _this = this;
      if (sort) this.sort = sort;
      if (dir) this.dir = dir;
      _services_DataService__WEBPACK_IMPORTED_MODULE_0__["default"].getList(this.per_page, page, this.sort, this.dir, '').then(function (response) {
        var _response$data;
        //this.setDefault();
        _this.items = (_response$data = response.data) !== null && _response$data !== void 0 ? _response$data : [];
        var url = new URL(window.location.href);
        url.searchParams["delete"]('page');
        if (page > 1) {
          url.searchParams.set('page', page);
        }
        window.history.replaceState(null, null, url); // or pushState
      });
    },
    setDefault: function setDefault() {
      var _tableConfig$table$ti, _tableConfig$table$he, _tableConfig$table$of, _tableConfig$table$pe, _tableConfig$table$ad, _tableConfig$table$ed;
      var url = window.location.pathname.split("/").pop();
      var table = (0,_common_utils__WEBPACK_IMPORTED_MODULE_4__.camelize)(url).replace('-', '');
      this.title = (_tableConfig$table$ti = _config_TableConfig__WEBPACK_IMPORTED_MODULE_3__["default"][table].title) !== null && _tableConfig$table$ti !== void 0 ? _tableConfig$table$ti : [];
      this.headers = (_tableConfig$table$he = _config_TableConfig__WEBPACK_IMPORTED_MODULE_3__["default"][table].headers) !== null && _tableConfig$table$he !== void 0 ? _tableConfig$table$he : [];
      this.offset = (_tableConfig$table$of = _config_TableConfig__WEBPACK_IMPORTED_MODULE_3__["default"][table].offset) !== null && _tableConfig$table$of !== void 0 ? _tableConfig$table$of : [];
      this.per_page = (_tableConfig$table$pe = _config_TableConfig__WEBPACK_IMPORTED_MODULE_3__["default"][table].per_page) !== null && _tableConfig$table$pe !== void 0 ? _tableConfig$table$pe : [];
      this.add = (_tableConfig$table$ad = _config_TableConfig__WEBPACK_IMPORTED_MODULE_3__["default"][table].add) !== null && _tableConfig$table$ad !== void 0 ? _tableConfig$table$ad : [];
      this.edit = (_tableConfig$table$ed = _config_TableConfig__WEBPACK_IMPORTED_MODULE_3__["default"][table].edit) !== null && _tableConfig$table$ed !== void 0 ? _tableConfig$table$ed : [];
      this.$store.dispatch('setTitle', this.title);
      _services_DataService__WEBPACK_IMPORTED_MODULE_0__["default"].url = url;
      this.getItems();
    }
  },
  mounted: function mounted() {
    _services_DataService__WEBPACK_IMPORTED_MODULE_0__["default"].url = this.$route.params.entity;
    this.setDefault();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=script&lang=js":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: {
    pagination: {
      type: Object
      //required: true
    },

    offset: {
      type: Number,
      "default": 4
    }
  },
  computed: {
    pagesNumber: function pagesNumber() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      for (var page = from; page <= to; page++) {
        pagesArray.push(page);
      }
      return pagesArray;
    }
  },
  methods: {
    changePage: function changePage(page) {
      this.$emit('paginate', page);
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=script&lang=js":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _services_axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../services/axios */ "./resources/js/admin/services/axios.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'Table',
  data: function data() {
    return {};
  },
  methods: {
    filterFields: function filterFields() {
      var _this = this;
      var obj = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
      Object.keys(obj).filter(function (item) {
        return _this.columns.includes(item) === false;
      }).forEach(function (key) {
        return delete obj[key];
      });
      return obj;
    },
    sortColumn: function sortColumn(event) {
      var sort = event.target.dataset.code;
      var dir = event.target.dataset.dir;
      var index = event.target.dataset.index;
      var page = 1;
      for (var key in this.headers) {
        this.headers[key].is_sort = false;
      }
      if (dir === 'desc') {
        dir = 'asc';
      } else {
        dir = 'desc';
      }
      event.target.dataset.dir = dir;
      this.headers[index].dir = dir;
      this.headers[index].is_sort = true;
      this.$emit('updateItems', page, sort, dir);
    }
  },
  props: ['headers', 'items', 'columns', 'route_create_name', 'route_edit_name'],
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Common/List.vue?vue&type=template&id=54772ad3":
/*!**********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Common/List.vue?vue&type=template&id=54772ad3 ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "card card-primary card-outline"
};
var _hoisted_2 = {
  "class": "card-body"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _$data$items$meta;
  var _component_table_admin = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("table-admin");
  var _component_vue_pagination = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("vue-pagination");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_table_admin, {
    route_create_name: $data.add,
    route_edit_name: $data.edit,
    items: $data.items.data,
    headers: $data.headers,
    onUpdateItems: $options.getItems
  }, null, 8 /* PROPS */, ["route_create_name", "route_edit_name", "items", "headers", "onUpdateItems"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_vue_pagination, {
    pagination: (_$data$items$meta = $data.items.meta) !== null && _$data$items$meta !== void 0 ? _$data$items$meta : {},
    onPaginate: $options.getItems,
    offset: $data.per_page
  }, null, 8 /* PROPS */, ["pagination", "onPaginate", "offset"])])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=template&id=44145805":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=template&id=44145805 ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "mt-3",
  "aria-label": "Page navigation"
};
var _hoisted_2 = {
  "class": "pagination"
};
var _hoisted_3 = {
  key: 0,
  "class": "page-item"
};
var _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "aria-hidden": "true"
}, "«", -1 /* HOISTED */);
var _hoisted_5 = [_hoisted_4];
var _hoisted_6 = ["onClick"];
var _hoisted_7 = {
  key: 1,
  "class": "page-item"
};
var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "aria-hidden": "true"
}, "»", -1 /* HOISTED */);
var _hoisted_9 = [_hoisted_8];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("nav", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", _hoisted_2, [$props.pagination.current_page > 1 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    "class": "page-link",
    href: "javascript:void(0)",
    "aria-label": "Previous",
    onClick: _cache[0] || (_cache[0] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $options.changePage($props.pagination.current_page - 1);
    }, ["prevent"]))
  }, _hoisted_5)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($options.pagesNumber, function (page) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["page-item", {
        'active': page == $props.pagination.current_page
      }])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      "class": "page-link",
      href: "javascript:void(0)",
      onClick: (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
        return $options.changePage(page);
      }, ["prevent"])
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(page), 9 /* TEXT, PROPS */, _hoisted_6)], 2 /* CLASS */);
  }), 256 /* UNKEYED_FRAGMENT */)), $props.pagination.current_page < $props.pagination.last_page ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    "class": "page-link",
    href: "javascript:void(0)",
    "aria-label": "Next",
    onClick: _cache[1] || (_cache[1] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $options.changePage($props.pagination.current_page + 1);
    }, ["prevent"]))
  }, _hoisted_9)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=template&id=e030e5e8&scoped=true":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=template&id=e030e5e8&scoped=true ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-e030e5e8"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};
var _hoisted_1 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "bi bi-plus"
  }, null, -1 /* HOISTED */);
});
var _hoisted_2 = {
  "class": "styled-table"
};
var _hoisted_3 = ["data-code", "data-dir", "data-index"];
var _hoisted_4 = {
  "class": "heading"
};
var _hoisted_5 = ["src"];
var _hoisted_6 = ["href"];
var _hoisted_7 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "bi bi-pen"
  }, null, -1 /* HOISTED */);
});
var _hoisted_8 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "bi bi-trash"
  }, null, -1 /* HOISTED */);
});

function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_router_link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("router-link");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
    to: {
      name: $props.route_create_name,
      params: {}
    },
    "class": "btn btn-success mb-3"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [_hoisted_1, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.$t('Add')), 1 /* TEXT */)];
    }),

    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["to"])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.headers, function (head, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("td", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([head.is_sort ? 'active' : '', "heading"]),
      "data-code": head.code,
      "data-dir": head.dir,
      "data-index": index,
      onClick: _cache[0] || (_cache[0] = function () {
        return $options.sortColumn && $options.sortColumn.apply($options, arguments);
      }),
      key: head.title
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(head.title) + " ", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["bi", head.dir === 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'])
    }, null, 2 /* CLASS */)], 10 /* CLASS, PROPS */, _hoisted_3);
  }), 128 /* KEYED_FRAGMENT */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.$t('Actions')), 1 /* TEXT */)]), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.items, function (item) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      key: item.id
    }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.headers, function (header, index) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("td", {
        key: index
      }, [header.type === 'img' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("img", {
        key: 0,
        alt: "",
        style: {
          "max-height": "90px"
        },
        src: item[header.code]
      }, null, 8 /* PROPS */, _hoisted_5)) : header.type === 'url' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("a", {
        key: 1,
        href: item[header.url]
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item[header.code]), 9 /* TEXT, PROPS */, _hoisted_6)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
        key: 2
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item[header.code]), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */))]);
    }), 128 /* KEYED_FRAGMENT */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
      "class": "btn icon icon-left btn-primary m-lg-2",
      to: {
        name: $props.route_edit_name,
        params: {
          'id': item.id
        }
      }
    }, {
      "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
        return [_hoisted_7];
      }),
      _: 2 /* DYNAMIC */
    }, 1032 /* PROPS, DYNAMIC_SLOTS */, ["to"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
      "class": "btn icon icon-left btn-danger",
      to: {
        name: $props.route_edit_name,
        params: {
          'id': item.id
        }
      }
    }, {
      "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
        return [_hoisted_8];
      }),
      _: 2 /* DYNAMIC */
    }, 1032 /* PROPS, DYNAMIC_SLOTS */, ["to"])])]);
  }), 128 /* KEYED_FRAGMENT */))])]);
}

/***/ }),

/***/ "./resources/js/admin/config/TableConfig.js":
/*!**************************************************!*\
  !*** ./resources/js/admin/config/TableConfig.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _tables_users__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./tables/users */ "./resources/js/admin/config/tables/users.js");
/* harmony import */ var _tables_games__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./tables/games */ "./resources/js/admin/config/tables/games.js");
/* harmony import */ var _tables_game_categories__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./tables/game-categories */ "./resources/js/admin/config/tables/game-categories.js");
/* harmony import */ var _tables_pages__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./tables/pages */ "./resources/js/admin/config/tables/pages.js");
/* harmony import */ var _tables_articles__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./tables/articles */ "./resources/js/admin/config/tables/articles.js");
/* harmony import */ var _tables_article_categories__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./tables/article-categories */ "./resources/js/admin/config/tables/article-categories.js");
/* harmony import */ var _tables_page_categories__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./tables/page-categories */ "./resources/js/admin/config/tables/page-categories.js");
/* harmony import */ var _tables_languages__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./tables/languages */ "./resources/js/admin/config/tables/languages.js");
/* harmony import */ var _tables_countries__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./tables/countries */ "./resources/js/admin/config/tables/countries.js");
/* harmony import */ var _tables_user_subscriptions__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./tables/user-subscriptions */ "./resources/js/admin/config/tables/user-subscriptions.js");
/* harmony import */ var _tables_tags__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./tables/tags */ "./resources/js/admin/config/tables/tags.js");
/* harmony import */ var _tables_properties__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./tables/properties */ "./resources/js/admin/config/tables/properties.js");












var tableConfig = {
  users: _tables_users__WEBPACK_IMPORTED_MODULE_0__["default"],
  userSubscriptions: _tables_user_subscriptions__WEBPACK_IMPORTED_MODULE_9__["default"],
  games: _tables_games__WEBPACK_IMPORTED_MODULE_1__["default"],
  pages: _tables_pages__WEBPACK_IMPORTED_MODULE_3__["default"],
  articles: _tables_articles__WEBPACK_IMPORTED_MODULE_4__["default"],
  gameCategories: _tables_game_categories__WEBPACK_IMPORTED_MODULE_2__["default"],
  articleCategories: _tables_article_categories__WEBPACK_IMPORTED_MODULE_5__["default"],
  pageCategories: _tables_page_categories__WEBPACK_IMPORTED_MODULE_6__["default"],
  languages: _tables_languages__WEBPACK_IMPORTED_MODULE_7__["default"],
  countries: _tables_countries__WEBPACK_IMPORTED_MODULE_8__["default"],
  tags: _tables_tags__WEBPACK_IMPORTED_MODULE_10__["default"],
  properties: _tables_properties__WEBPACK_IMPORTED_MODULE_11__["default"]
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (tableConfig);

/***/ }),

/***/ "./resources/js/admin/config/tables/article-categories.js":
/*!****************************************************************!*\
  !*** ./resources/js/admin/config/tables/article-categories.js ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var articleCategories = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('Article categories list'),
  per_page: 10,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Title"),
    code: "title",
    type: "url",
    url: "url",
    dir: "asc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Picture"),
    code: "thumb",
    type: "img",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Category"),
    code: "parent_id",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Created at"),
    code: "created_at",
    dir: "asc",
    is_sort: true
  }],
  add: "admin.article-categories.add",
  edit: "admin.article-categories.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (articleCategories);

/***/ }),

/***/ "./resources/js/admin/config/tables/articles.js":
/*!******************************************************!*\
  !*** ./resources/js/admin/config/tables/articles.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var articles = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('Articles'),
  per_page: 10,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Title"),
    code: "title",
    type: "url",
    url: "url",
    dir: "asc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Picture"),
    code: "thumb",
    type: "img",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Category"),
    code: "category",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Created at"),
    code: "created_at",
    dir: "asc",
    is_sort: true
  }],
  add: "admin.article.add",
  edit: "admin.article.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (articles);

/***/ }),

/***/ "./resources/js/admin/config/tables/countries.js":
/*!*******************************************************!*\
  !*** ./resources/js/admin/config/tables/countries.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var countries = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('Countries list'),
  per_page: 10,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Title"),
    code: "title",
    dir: "asc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Code"),
    code: "code",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Created at"),
    code: "created_at",
    dir: "asc",
    is_sort: true
  }],
  add: "admin.country.add",
  edit: "admin.country.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (countries);

/***/ }),

/***/ "./resources/js/admin/config/tables/game-categories.js":
/*!*************************************************************!*\
  !*** ./resources/js/admin/config/tables/game-categories.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var gameCategories = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('Game categories list'),
  per_page: 10,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Title"),
    code: "title",
    type: "url",
    url: "url",
    dir: "asc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Picture"),
    code: "thumb",
    type: "img",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Category"),
    code: "parent_id",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Created at"),
    code: "created_at",
    dir: "asc",
    is_sort: true
  }],
  add: "admin.game-categories.add",
  edit: "admin.game-categories.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (gameCategories);

/***/ }),

/***/ "./resources/js/admin/config/tables/games.js":
/*!***************************************************!*\
  !*** ./resources/js/admin/config/tables/games.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var games = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('Games list'),
  per_page: 10,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Title"),
    code: "title",
    type: "url",
    url: "url",
    dir: "asc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Picture"),
    code: "thumb",
    type: "img",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Category"),
    code: "category",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Created at"),
    code: "created_at",
    dir: "asc",
    is_sort: true
  }],
  add: "admin.game.add",
  edit: "admin.game.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (games);

/***/ }),

/***/ "./resources/js/admin/config/tables/languages.js":
/*!*******************************************************!*\
  !*** ./resources/js/admin/config/tables/languages.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var languages = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('Languages list'),
  per_page: 10,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Title"),
    code: "title",
    dir: "asc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Code"),
    code: "code",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Created at"),
    code: "created_at",
    dir: "asc",
    is_sort: true
  }],
  add: "admin.language.add",
  edit: "admin.language.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (languages);

/***/ }),

/***/ "./resources/js/admin/config/tables/page-categories.js":
/*!*************************************************************!*\
  !*** ./resources/js/admin/config/tables/page-categories.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var pageCategories = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('Page categories list'),
  per_page: 10,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Title"),
    code: "title",
    type: "url",
    url: "url",
    dir: "asc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Picture"),
    code: "thumb",
    type: "img",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Category"),
    code: "parent_id",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Created at"),
    code: "created_at",
    dir: "asc",
    is_sort: true
  }],
  add: "admin.page-categories.add",
  edit: "admin.page-categories.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (pageCategories);

/***/ }),

/***/ "./resources/js/admin/config/tables/pages.js":
/*!***************************************************!*\
  !*** ./resources/js/admin/config/tables/pages.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var pages = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('Pages list'),
  per_page: 10,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Title"),
    code: "title",
    type: "url",
    url: "url",
    dir: "asc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Picture"),
    code: "thumb",
    type: "img",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Category"),
    code: "category",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Created at"),
    code: "created_at",
    dir: "asc",
    is_sort: true
  }],
  add: "admin.page.add",
  edit: "admin.page.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (pages);

/***/ }),

/***/ "./resources/js/admin/config/tables/properties.js":
/*!********************************************************!*\
  !*** ./resources/js/admin/config/tables/properties.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var properties = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('Properties list'),
  per_page: 10,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Title"),
    code: "title",
    type: "url",
    url: "url",
    dir: "asc",
    is_sort: true
  }],
  add: "admin.property.add",
  edit: "admin.property.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (properties);

/***/ }),

/***/ "./resources/js/admin/config/tables/tags.js":
/*!**************************************************!*\
  !*** ./resources/js/admin/config/tables/tags.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var tags = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('Tags list'),
  per_page: 10,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Title"),
    code: "title",
    type: "url",
    url: "url",
    dir: "asc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Created at"),
    code: "created_at",
    dir: "asc",
    is_sort: true
  }],
  add: "admin.tag.add",
  edit: "admin.tag.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (tags);

/***/ }),

/***/ "./resources/js/admin/config/tables/user-subscriptions.js":
/*!****************************************************************!*\
  !*** ./resources/js/admin/config/tables/user-subscriptions.js ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var usersSubscriptions = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('User list'),
  per_page: 2,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Created at"),
    code: "created_at",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("From"),
    code: "from",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Till"),
    code: "till",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("E-mail"),
    code: "email",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Name"),
    code: "name",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Last name"),
    code: "lastname",
    dir: "asc",
    is_sort: false
  }],
  add: "admin.user-subscriptions.add",
  edit: "admin.user-subscriptions.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (usersSubscriptions);

/***/ }),

/***/ "./resources/js/admin/config/tables/users.js":
/*!***************************************************!*\
  !*** ./resources/js/admin/config/tables/users.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-vue-i18n */ "./node_modules/laravel-vue-i18n/dist/index.js");

var users = {
  title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)('User list'),
  per_page: 2,
  items: {},
  headers: [{
    title: "ID",
    code: "id",
    dir: "desc",
    is_sort: true
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Created at"),
    code: "created_at",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("E-mail"),
    code: "email",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Name"),
    code: "name",
    dir: "asc",
    is_sort: false
  }, {
    title: (0,laravel_vue_i18n__WEBPACK_IMPORTED_MODULE_0__.trans)("Last name"),
    code: "lastname",
    dir: "asc",
    is_sort: false
  }],
  columns: ["id", "created_at", "email", "name", "lastname"],
  add: "admin.user.add",
  edit: "admin.user.edit"
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (users);

/***/ }),

/***/ "./resources/js/admin/services/DataService.js":
/*!****************************************************!*\
  !*** ./resources/js/admin/services/DataService.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./axios */ "./resources/js/admin/services/axios.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var DataService = /*#__PURE__*/function () {
  function DataService() {
    _classCallCheck(this, DataService);
  }
  _createClass(DataService, [{
    key: "getList",
    value: function getList() {
      var count = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 10;
      var page = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
      var sort = arguments.length > 2 ? arguments[2] : undefined;
      var dir = arguments.length > 3 ? arguments[3] : undefined;
      var filter = arguments.length > 4 ? arguments[4] : undefined;
      var url = "/admin/" + this.url + '?count=' + count + '&page=' + page;
      if (sort) {
        url += '&sort=' + sort;
      }
      if (dir) {
        url += '&dir=' + dir;
      }
      if (filter) {
        url += '&filter=' + filter;
      }
      return _axios__WEBPACK_IMPORTED_MODULE_0__["default"].get(url);
    }
  }, {
    key: "getById",
    value: function getById(id) {
      return _axios__WEBPACK_IMPORTED_MODULE_0__["default"].get("/admin/" + this.url + "/" + id, {
        params: {
          id: id
        }
      });
    }
  }, {
    key: "get",
    value: function get(url) {
      return _axios__WEBPACK_IMPORTED_MODULE_0__["default"].get(url);
    }
  }, {
    key: "post",
    value: function post(url, data) {
      return _axios__WEBPACK_IMPORTED_MODULE_0__["default"].post(url, data);
    }
  }]);
  return DataService;
}();
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (new DataService());

/***/ }),

/***/ "./resources/js/common/utils.js":
/*!**************************************!*\
  !*** ./resources/js/common/utils.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "camelize": () => (/* binding */ camelize),
/* harmony export */   "readUrlHash": () => (/* binding */ readUrlHash)
/* harmony export */ });
function camelize(str) {
  return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function (word, index) {
    return index === 0 ? word.toLowerCase() : word.toUpperCase();
  }).replace(/\s+/g, '');
}
function readUrlHash() {
  var result = {};
  var hashParam = window.location.hash.substring(1);
  var params = hashParam.split("&");
  for (var index in params) {
    var paramSet = params[index].split("=");
    if (typeof paramSet[1] !== "undefined") {
      result[paramSet[0]] = decodeURIComponent(paramSet[1]);
    } else {
      result[paramSet[0]] = "";
    }
  }
  return result;
}

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.styled-table[data-v-e030e5e8]{\n        width: 100%;\n        border-collapse: collapse;\n}\n.styled-table td[data-v-e030e5e8]{\n       padding: 5px 10px;\n       border-bottom: 1px solid #ccc;\n}\ntd.heading[data-v-e030e5e8]{\n        font-weight: bold;\n        background-color: #2d499d;\n        border-color: #2d499d;\n        color: #fff;\n        padding: 15px 10px;\n}\n.heading.active[data-v-e030e5e8]{\n        background-color: #4c6ac7;\n}\n\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_10_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_10_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TableAdmin_vue_vue_type_style_index_0_id_e030e5e8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_10_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_10_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TableAdmin_vue_vue_type_style_index_0_id_e030e5e8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_10_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_10_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TableAdmin_vue_vue_type_style_index_0_id_e030e5e8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/admin/views/Common/List.vue":
/*!**************************************************!*\
  !*** ./resources/js/admin/views/Common/List.vue ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _List_vue_vue_type_template_id_54772ad3__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./List.vue?vue&type=template&id=54772ad3 */ "./resources/js/admin/views/Common/List.vue?vue&type=template&id=54772ad3");
/* harmony import */ var _List_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./List.vue?vue&type=script&lang=js */ "./resources/js/admin/views/Common/List.vue?vue&type=script&lang=js");
/* harmony import */ var _app_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_app_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_List_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_List_vue_vue_type_template_id_54772ad3__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/admin/views/Common/List.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/admin/views/Components/Table/Pagination.vue":
/*!******************************************************************!*\
  !*** ./resources/js/admin/views/Components/Table/Pagination.vue ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Pagination_vue_vue_type_template_id_44145805__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Pagination.vue?vue&type=template&id=44145805 */ "./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=template&id=44145805");
/* harmony import */ var _Pagination_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Pagination.vue?vue&type=script&lang=js */ "./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=script&lang=js");
/* harmony import */ var _app_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_app_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_Pagination_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Pagination_vue_vue_type_template_id_44145805__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/admin/views/Components/Table/Pagination.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/admin/views/Components/Table/TableAdmin.vue":
/*!******************************************************************!*\
  !*** ./resources/js/admin/views/Components/Table/TableAdmin.vue ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _TableAdmin_vue_vue_type_template_id_e030e5e8_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TableAdmin.vue?vue&type=template&id=e030e5e8&scoped=true */ "./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=template&id=e030e5e8&scoped=true");
/* harmony import */ var _TableAdmin_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TableAdmin.vue?vue&type=script&lang=js */ "./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=script&lang=js");
/* harmony import */ var _TableAdmin_vue_vue_type_style_index_0_id_e030e5e8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css */ "./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css");
/* harmony import */ var _app_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,_app_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_TableAdmin_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_TableAdmin_vue_vue_type_template_id_e030e5e8_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-e030e5e8"],['__file',"resources/js/admin/views/Components/Table/TableAdmin.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/admin/views/Common/List.vue?vue&type=script&lang=js":
/*!**************************************************************************!*\
  !*** ./resources/js/admin/views/Common/List.vue?vue&type=script&lang=js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_List_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_List_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./List.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Common/List.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=script&lang=js":
/*!******************************************************************************************!*\
  !*** ./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=script&lang=js ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Pagination_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Pagination_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Pagination.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=script&lang=js":
/*!******************************************************************************************!*\
  !*** ./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=script&lang=js ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TableAdmin_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TableAdmin_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./TableAdmin.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/admin/views/Common/List.vue?vue&type=template&id=54772ad3":
/*!********************************************************************************!*\
  !*** ./resources/js/admin/views/Common/List.vue?vue&type=template&id=54772ad3 ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_List_vue_vue_type_template_id_54772ad3__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_List_vue_vue_type_template_id_54772ad3__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./List.vue?vue&type=template&id=54772ad3 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Common/List.vue?vue&type=template&id=54772ad3");


/***/ }),

/***/ "./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=template&id=44145805":
/*!************************************************************************************************!*\
  !*** ./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=template&id=44145805 ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Pagination_vue_vue_type_template_id_44145805__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Pagination_vue_vue_type_template_id_44145805__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Pagination.vue?vue&type=template&id=44145805 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/Pagination.vue?vue&type=template&id=44145805");


/***/ }),

/***/ "./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=template&id=e030e5e8&scoped=true":
/*!************************************************************************************************************!*\
  !*** ./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=template&id=e030e5e8&scoped=true ***!
  \************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TableAdmin_vue_vue_type_template_id_e030e5e8_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TableAdmin_vue_vue_type_template_id_e030e5e8_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./TableAdmin.vue?vue&type=template&id=e030e5e8&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=template&id=e030e5e8&scoped=true");


/***/ }),

/***/ "./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css":
/*!**************************************************************************************************************************!*\
  !*** ./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css ***!
  \**************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_10_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_10_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TableAdmin_vue_vue_type_style_index_0_id_e030e5e8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader/dist/cjs.js!../../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-10.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-10.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/admin/views/Components/Table/TableAdmin.vue?vue&type=style&index=0&id=e030e5e8&scoped=true&lang=css");


/***/ })

}]);