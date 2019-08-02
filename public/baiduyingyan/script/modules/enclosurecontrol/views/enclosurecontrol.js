define('script/modules/enclosurecontrol/views/enclosurecontrol', function(require, exports, module) {

  /**
   * @file 围栏管理台Reflux Actoin
   * @author Bluseli www.bluseli.cn 2019.06.29
   */
  'use strict';
  
  Object.defineProperty(exports, '__esModule', {
      value: true
  });
  
  function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }
  
  var _react = require('components/react/react');
  
  var _react2 = _interopRequireDefault(_react);
  
  var _reactDom = require('components/react-dom/react-dom');
  
  var _commonStoresCommonStore = require('script/modules/common/stores/commonStore');
  
  var _commonStoresCommonStore2 = _interopRequireDefault(_commonStoresCommonStore);
  
  var _manage = require('manage');
  
  var _manage2 = _interopRequireDefault(_manage);
  
  var _map = require('map');
  
  var _map2 = _interopRequireDefault(_map);
  
  var _timeline = require('timeline');
  
  var _timeline2 = _interopRequireDefault(_timeline);
  
  var _trackanalysis = require('trackanalysis');
  
  var _trackanalysis2 = _interopRequireDefault(_trackanalysis);
  
  var _boundcontrol = require('boundcontrol');
  
  var _boundcontrol2 = _interopRequireDefault(_boundcontrol);
  
  var Enclosurecontrol = _react2['default'].createClass({
      displayName: 'Enclosurecontrol',
  
      getInitialState: function getInitialState() {
          return {
              // 当前页签，0为轨迹监控，1为终端管理 2为围栏管理
              tabIndex: 0
          };
      },
      componentDidMount: function componentDidMount() {
          _commonStoresCommonStore2['default'].listen(this.onStatusChange);
      },
      onStatusChange: function onStatusChange(type, data) {
          switch (type) {
              case 'switchtab':
                  this.listenSwitchTab(data);
                  break;
          }
      },
      /**
       * 响应Store list事件，设置标签页
       *
       * @param {data} 标签页标识
       */
      listenSwitchTab: function listenSwitchTab(data) {
          this.setState({ tabIndex: data });
      },
      render: function render() {
          var tabIndex = this.state.tabIndex;
          return _react2['default'].createElement(
              'div',
              { className: tabIndex === 2 ? 'enclosureControl hidden' : 'enclosureControl visible' },
              _react2['default'].createElement(_map2['default'], null),
              _react2['default'].createElement(_manage2['default'], null),
              _react2['default'].createElement(_timeline2['default'], null),
              _react2['default'].createElement(_trackanalysis2['default'], null),
              _react2['default'].createElement(_boundcontrol2['default'], null)
          );
      }
  });
  
  exports['default'] = Enclosurecontrol;
  module.exports = exports['default'];
  //# sourceMappingURL=/script/modules/enclosurecontrol/views/enclosurecontrol.js.map
  

});
