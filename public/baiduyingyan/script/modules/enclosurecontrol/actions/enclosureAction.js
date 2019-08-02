define('script/modules/enclosurecontrol/actions/enclosureAction', function(require, exports, module) {

  /**
   * @file 围栏管理台Reflux Actoin
   * @author Bluseli www.bluseli.cn 2019.06.29
   */
  
  'use strict';
  
  Object.defineProperty(exports, '__esModule', {
      value: true
  });
  var EnclosureAction = Reflux.createActions([
  // 创建地理围栏
  'create',
  // 删除地理围栏
  'delete',
  // 检索地理围栏
  'search',
  // 刷新地理围栏
  'refresh']);
  
  exports['default'] = EnclosureAction;
  module.exports = exports['default'];
  //# sourceMappingURL=/script/modules/enclosurecontrol/actions/enclosureAction.js.map
  

});
