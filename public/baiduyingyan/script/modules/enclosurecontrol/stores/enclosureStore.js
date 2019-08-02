define('script/modules/enclosurecontrol/stores/enclosureStore', function(require, exports, module) {

  /* globals Reflux */
  /* eslint-disable fecs-camelcase */
  /**
   * @file 围栏管理台Reflux Actoin
   * @author Bluseli www.bluseli.cn 2019.06.29
   */
  
  'use strict';
  
  Object.defineProperty(exports, '__esModule', {
      value: true
  });
  
  function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }
  
  var _actionsEnclosureAction = require('script/modules/enclosurecontrol/actions/enclosureAction');
  
  var _actionsEnclosureAction2 = _interopRequireDefault(_actionsEnclosureAction);
  
  var _commonUrls = require('script/common/urls');
  
  var _commonUrls2 = _interopRequireDefault(_commonUrls);
  
  var _commonCommonfun = require('script/common/commonfun');
  
  var _commonCommonfun2 = _interopRequireDefault(_commonCommonfun);
  
  var EnclosureStore = Reflux.createStore({
      listenables: [_actionsEnclosureAction2['default']],
      init: function init() {},
      data: {}
  });
  
  exports['default'] = EnclosureStore;
  module.exports = exports['default'];
  //# sourceMappingURL=/script/modules/enclosurecontrol/stores/enclosureStore.js.map
  

});
