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
/******/ 	return __webpack_require__(__webpack_require__.s = 56);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/editors/quill.js":
/*!*****************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/editors/quill.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// Class definition\nvar KTQuilDemos = function () {\n  // Private functions\n  var demo1 = function demo1() {\n    var quill = new Quill('#kt_quil_1', {\n      modules: {\n        toolbar: [[{\n          header: [1, 2, false]\n        }], ['bold', 'italic', 'underline'], ['image', 'code-block']]\n      },\n      placeholder: 'Type your text here...',\n      theme: 'snow' // or 'bubble'\n\n    });\n  };\n\n  var demo2 = function demo2() {\n    var Delta = Quill[\"import\"]('delta');\n    var quill = new Quill('#kt_quil_2', {\n      modules: {\n        toolbar: true\n      },\n      placeholder: 'Type your text here...',\n      theme: 'snow'\n    }); // Store accumulated changes\n\n    var change = new Delta();\n    quill.on('text-change', function (delta) {\n      change = change.compose(delta);\n    }); // Save periodically\n\n    setInterval(function () {\n      if (change.length() > 0) {\n        console.log('Saving changes', change);\n        /*\n        Send partial changes\n        $.post('/your-endpoint', {\n          partial: JSON.stringify(change)\n        });\n         Send entire document\n        $.post('/your-endpoint', {\n          doc: JSON.stringify(quill.getContents())\n        });\n        */\n\n        change = new Delta();\n      }\n    }, 5 * 1000); // Check for unsaved data\n\n    window.onbeforeunload = function () {\n      if (change.length() > 0) {\n        return 'There are unsaved changes. Are you sure you want to leave?';\n      }\n    };\n  };\n\n  return {\n    // public functions\n    init: function init() {\n      demo1();\n      demo2();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTQuilDemos.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3J1ZC9mb3Jtcy9lZGl0b3JzL3F1aWxsLmpzPzE5NTEiXSwibmFtZXMiOlsiS1RRdWlsRGVtb3MiLCJkZW1vMSIsInF1aWxsIiwiUXVpbGwiLCJtb2R1bGVzIiwidG9vbGJhciIsImhlYWRlciIsInBsYWNlaG9sZGVyIiwidGhlbWUiLCJkZW1vMiIsIkRlbHRhIiwiY2hhbmdlIiwib24iLCJkZWx0YSIsImNvbXBvc2UiLCJzZXRJbnRlcnZhbCIsImxlbmd0aCIsImNvbnNvbGUiLCJsb2ciLCJ3aW5kb3ciLCJvbmJlZm9yZXVubG9hZCIsImluaXQiLCJqUXVlcnkiLCJkb2N1bWVudCIsInJlYWR5Il0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBLElBQUlBLFdBQVcsR0FBRyxZQUFXO0FBRXpCO0FBQ0EsTUFBSUMsS0FBSyxHQUFHLFNBQVJBLEtBQVEsR0FBVztBQUNuQixRQUFJQyxLQUFLLEdBQUcsSUFBSUMsS0FBSixDQUFVLFlBQVYsRUFBd0I7QUFDaENDLGFBQU8sRUFBRTtBQUNMQyxlQUFPLEVBQUUsQ0FDTCxDQUFDO0FBQ0dDLGdCQUFNLEVBQUUsQ0FBQyxDQUFELEVBQUksQ0FBSixFQUFPLEtBQVA7QUFEWCxTQUFELENBREssRUFJTCxDQUFDLE1BQUQsRUFBUyxRQUFULEVBQW1CLFdBQW5CLENBSkssRUFLTCxDQUFDLE9BQUQsRUFBVSxZQUFWLENBTEs7QUFESixPQUR1QjtBQVVoQ0MsaUJBQVcsRUFBRSx3QkFWbUI7QUFXaENDLFdBQUssRUFBRSxNQVh5QixDQVdsQjs7QUFYa0IsS0FBeEIsQ0FBWjtBQWFILEdBZEQ7O0FBZ0JBLE1BQUlDLEtBQUssR0FBRyxTQUFSQSxLQUFRLEdBQVc7QUFDbkIsUUFBSUMsS0FBSyxHQUFHUCxLQUFLLFVBQUwsQ0FBYSxPQUFiLENBQVo7QUFDQSxRQUFJRCxLQUFLLEdBQUcsSUFBSUMsS0FBSixDQUFVLFlBQVYsRUFBd0I7QUFDaENDLGFBQU8sRUFBRTtBQUNMQyxlQUFPLEVBQUU7QUFESixPQUR1QjtBQUloQ0UsaUJBQVcsRUFBRSx3QkFKbUI7QUFLaENDLFdBQUssRUFBRTtBQUx5QixLQUF4QixDQUFaLENBRm1CLENBVW5COztBQUNBLFFBQUlHLE1BQU0sR0FBRyxJQUFJRCxLQUFKLEVBQWI7QUFDQVIsU0FBSyxDQUFDVSxFQUFOLENBQVMsYUFBVCxFQUF3QixVQUFTQyxLQUFULEVBQWdCO0FBQ3BDRixZQUFNLEdBQUdBLE1BQU0sQ0FBQ0csT0FBUCxDQUFlRCxLQUFmLENBQVQ7QUFDSCxLQUZELEVBWm1CLENBZ0JuQjs7QUFDQUUsZUFBVyxDQUFDLFlBQVc7QUFDbkIsVUFBSUosTUFBTSxDQUFDSyxNQUFQLEtBQWtCLENBQXRCLEVBQXlCO0FBQ3JCQyxlQUFPLENBQUNDLEdBQVIsQ0FBWSxnQkFBWixFQUE4QlAsTUFBOUI7QUFDQTs7Ozs7Ozs7Ozs7QUFXQUEsY0FBTSxHQUFHLElBQUlELEtBQUosRUFBVDtBQUNIO0FBQ0osS0FoQlUsRUFnQlIsSUFBSSxJQWhCSSxDQUFYLENBakJtQixDQW1DbkI7O0FBQ0FTLFVBQU0sQ0FBQ0MsY0FBUCxHQUF3QixZQUFXO0FBQy9CLFVBQUlULE1BQU0sQ0FBQ0ssTUFBUCxLQUFrQixDQUF0QixFQUF5QjtBQUNyQixlQUFPLDREQUFQO0FBQ0g7QUFDSixLQUpEO0FBS0gsR0F6Q0Q7O0FBMkNBLFNBQU87QUFDSDtBQUNBSyxRQUFJLEVBQUUsZ0JBQVc7QUFDYnBCLFdBQUs7QUFDTFEsV0FBSztBQUNSO0FBTEUsR0FBUDtBQU9ILENBckVpQixFQUFsQjs7QUF1RUFhLE1BQU0sQ0FBQ0MsUUFBRCxDQUFOLENBQWlCQyxLQUFqQixDQUF1QixZQUFXO0FBQzlCeEIsYUFBVyxDQUFDcUIsSUFBWjtBQUNILENBRkQiLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3J1ZC9mb3Jtcy9lZGl0b3JzL3F1aWxsLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gQ2xhc3MgZGVmaW5pdGlvblxudmFyIEtUUXVpbERlbW9zID0gZnVuY3Rpb24oKSB7XG5cbiAgICAvLyBQcml2YXRlIGZ1bmN0aW9uc1xuICAgIHZhciBkZW1vMSA9IGZ1bmN0aW9uKCkge1xuICAgICAgICB2YXIgcXVpbGwgPSBuZXcgUXVpbGwoJyNrdF9xdWlsXzEnLCB7XG4gICAgICAgICAgICBtb2R1bGVzOiB7XG4gICAgICAgICAgICAgICAgdG9vbGJhcjogW1xuICAgICAgICAgICAgICAgICAgICBbe1xuICAgICAgICAgICAgICAgICAgICAgICAgaGVhZGVyOiBbMSwgMiwgZmFsc2VdXG4gICAgICAgICAgICAgICAgICAgIH1dLFxuICAgICAgICAgICAgICAgICAgICBbJ2JvbGQnLCAnaXRhbGljJywgJ3VuZGVybGluZSddLFxuICAgICAgICAgICAgICAgICAgICBbJ2ltYWdlJywgJ2NvZGUtYmxvY2snXVxuICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBwbGFjZWhvbGRlcjogJ1R5cGUgeW91ciB0ZXh0IGhlcmUuLi4nLFxuICAgICAgICAgICAgdGhlbWU6ICdzbm93JyAvLyBvciAnYnViYmxlJ1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICB2YXIgZGVtbzIgPSBmdW5jdGlvbigpIHtcbiAgICAgICAgdmFyIERlbHRhID0gUXVpbGwuaW1wb3J0KCdkZWx0YScpO1xuICAgICAgICB2YXIgcXVpbGwgPSBuZXcgUXVpbGwoJyNrdF9xdWlsXzInLCB7XG4gICAgICAgICAgICBtb2R1bGVzOiB7XG4gICAgICAgICAgICAgICAgdG9vbGJhcjogdHJ1ZVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHBsYWNlaG9sZGVyOiAnVHlwZSB5b3VyIHRleHQgaGVyZS4uLicsXG4gICAgICAgICAgICB0aGVtZTogJ3Nub3cnXG4gICAgICAgIH0pO1xuXG4gICAgICAgIC8vIFN0b3JlIGFjY3VtdWxhdGVkIGNoYW5nZXNcbiAgICAgICAgdmFyIGNoYW5nZSA9IG5ldyBEZWx0YSgpO1xuICAgICAgICBxdWlsbC5vbigndGV4dC1jaGFuZ2UnLCBmdW5jdGlvbihkZWx0YSkge1xuICAgICAgICAgICAgY2hhbmdlID0gY2hhbmdlLmNvbXBvc2UoZGVsdGEpO1xuICAgICAgICB9KTtcblxuICAgICAgICAvLyBTYXZlIHBlcmlvZGljYWxseVxuICAgICAgICBzZXRJbnRlcnZhbChmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIGlmIChjaGFuZ2UubGVuZ3RoKCkgPiAwKSB7XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coJ1NhdmluZyBjaGFuZ2VzJywgY2hhbmdlKTtcbiAgICAgICAgICAgICAgICAvKlxuICAgICAgICAgICAgICAgIFNlbmQgcGFydGlhbCBjaGFuZ2VzXG4gICAgICAgICAgICAgICAgJC5wb3N0KCcveW91ci1lbmRwb2ludCcsIHtcbiAgICAgICAgICAgICAgICAgIHBhcnRpYWw6IEpTT04uc3RyaW5naWZ5KGNoYW5nZSlcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgICAgIFNlbmQgZW50aXJlIGRvY3VtZW50XG4gICAgICAgICAgICAgICAgJC5wb3N0KCcveW91ci1lbmRwb2ludCcsIHtcbiAgICAgICAgICAgICAgICAgIGRvYzogSlNPTi5zdHJpbmdpZnkocXVpbGwuZ2V0Q29udGVudHMoKSlcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICAqL1xuICAgICAgICAgICAgICAgIGNoYW5nZSA9IG5ldyBEZWx0YSgpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LCA1ICogMTAwMCk7XG5cbiAgICAgICAgLy8gQ2hlY2sgZm9yIHVuc2F2ZWQgZGF0YVxuICAgICAgICB3aW5kb3cub25iZWZvcmV1bmxvYWQgPSBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIGlmIChjaGFuZ2UubGVuZ3RoKCkgPiAwKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuICdUaGVyZSBhcmUgdW5zYXZlZCBjaGFuZ2VzLiBBcmUgeW91IHN1cmUgeW91IHdhbnQgdG8gbGVhdmU/JztcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgIH1cblxuICAgIHJldHVybiB7XG4gICAgICAgIC8vIHB1YmxpYyBmdW5jdGlvbnNcbiAgICAgICAgaW5pdDogZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICBkZW1vMSgpO1xuICAgICAgICAgICAgZGVtbzIoKTtcbiAgICAgICAgfVxuICAgIH07XG59KCk7XG5cbmpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgS1RRdWlsRGVtb3MuaW5pdCgpO1xufSk7XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/crud/forms/editors/quill.js\n");

/***/ }),

/***/ 56:
/*!***********************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/editors/quill.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/bilal/work/development/ematrix/rimula/shell/resources/metronic/js/pages/crud/forms/editors/quill.js */"./resources/metronic/js/pages/crud/forms/editors/quill.js");


/***/ })

/******/ });