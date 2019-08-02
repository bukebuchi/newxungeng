define(['jquery', 'bootstrap', 'upload', 'validator', 'backend', 'table', 'form'], function ($, undefined, Upload, Validator, Backend, Table, Form) {
    var Flow={
        option:{},
        bindevents:function(){
            var contrllerCode =Config.flowCode;
            Form.api.bindevent($("form[role=form]"));
            var search =location.search==''?'?':location.search;
            $('#save').click(function(){
                $("form[role=form]").attr('action','flow/'+contrllerCode+'/save'+search);
                var form =$("form[role=form]");
                if (form.size() === 0) {
                    Toastr.error("表单未初始化完成,无法提交");
                    return false;
                }
                if (typeof submit === 'function') {
                    if (false === submit.call(form, success, error)) {
                        return false;
                    }
                }
                var type = form.attr("method") ? form.attr("method").toUpperCase() : 'GET';
                type = type && (type === 'GET' || type === 'POST') ? type : 'GET';
                url = form.attr("action");
                url = url ? url : location.href;
                //修复当存在多选项元素时提交的BUG
                var params = {};
                var multipleList = $("[name$='[]']", form);
                if (multipleList.size() > 0) {
                    var postFields = form.serializeArray().map(function (obj) {
                        return $(obj).prop("name");
                    });
                    $.each(multipleList, function (i, j) {
                        if (postFields.indexOf($(this).prop("name")) < 0) {
                            params[$(this).prop("name")] = '';
                        }
                    });
                }
                //调用Ajax请求方法
                Fast.api.ajax({
                    type: type,
                    url: url,
                    data: form.serialize() + (Object.keys(params).length > 0 ? '&' + $.param(params) : ''),
                    dataType: 'json',
                    complete: function (xhr) {
                        var token = xhr.getResponseHeader('__token__');
                        if (token) {
                            $("input[name='__token__']", form).val(token);
                        }
                    }
                }, function (data, ret) {
                    $('.form-group', form).removeClass('has-feedback has-success has-error');
                    if (data && typeof data === 'object') {
                        //刷新客户端token
                        if (typeof data.token !== 'undefined') {
                            $("input[name='__token__']", form).val(data.token);
                        }
                        //调用客户端事件
                        if (typeof data.callback !== 'undefined' && typeof data.callback === 'function') {
                            data.callback.call(form, data);
                        }
                    }
                    if (typeof success === 'function') {
                        if (false === success.call(form, data, ret)) {
                            return false;
                        }
                    }
                    //提示及关闭当前窗口
                    var msg = ret.hasOwnProperty("msg") && ret.msg !== "" ? ret.msg : __('Operation completed');
                    parent.Toastr.success(msg);
                    parent.$(".btn-refresh").trigger("click");
                    var index = parent.Layer.getFrameIndex(window.name);
                    parent.Layer.close(index);
                    return false;
                }, function (data, ret) {
                    if (data && typeof data === 'object' && typeof data.token !== 'undefined') {
                        $("input[name='__token__']", form).val(data.token);
                    }
                    if (typeof error === 'function') {
                        if (false === error.call(form, data, ret)) {
                            return false;
                        }
                    }
                });
            });
            $('#start').click(function(){
                var that = this;
                $("form[role=form]").attr('action','flow/'+contrllerCode+'/edit'+search);
                $(that).closest("form").trigger("submit");
            });
            $('#agree').click(function(){
                var that = this;
                $(that).closest("form").trigger("submit");
            });
            $('#cancel').click(function(){
                var that = this;
                $("form[role=form]").attr('action','flow/'+contrllerCode+'/cancel'+search);
                $(that).closest("form").trigger("submit");
            });
            $('#refuse').click(function(){
                var that = this;
                $("form[role=form]").attr('action','flow/'+contrllerCode+'/refuse'+search);
                $(that).closest("form").trigger("submit");
            });
            $('#flowchart').click(function(){
                Fast.api.open('flow/scheme/flowchart'+search+'&flowcode='+contrllerCode,'流程图',{});
            });
        },
        getQueryString:function(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
            var r = window.location.search.substr(1).match(reg);
            var rtn='';
            if (r != null){
               rtn = unescape(r[2])
            }
            else{
                var ar =window.location.pathname.split('/');
                for(var i=0;i<ar.length;i++){
                    if(ar[i]==name){
                       rtn=ar[i+1]
                    }
                }
            }
            return rtn;
        },
        leftMenu:[{
            name: '审批节点',
            procId: '0',
            type:'node',
            username: 'aaaaa',
            removable:true,
            desc: '审批节点'
        }],
        flowChart:function(options){
            Flow.option=options
            require(['jsplumb','chart'], function () {

            Chart.ready(()=>{
            const basicX = 150;
            const startY = 20;
            const endY = 350;
            const newX = 50;
            const newY = 50;

            let _current = null; // 当前选择节点id
            var para ={
                    onNodeClick (data) { // 点击节点时触发

                    },
                    onNodeDel (data) {
                    },
                    onNodeDoubleClick(object,conn){
                        let Chart=this;
                        let node =$.extend({},object);;
                        if(node.name=='开始'||node.name=='结束'){
                                return ;
                            }
                            if(typeof node.setInfo==='undefined')
                            {
                                node.setInfo={
                                    nodeName:node.name,
                                    NodeDesignateData:{
                                        users:[],
                                        role:[]
                                    }
                                }
                            }
                            var area = [$(window).width() > 800 ? '800px' : '95%', $(window).height() > 600 ? '600px' : '95%'];
                            Layer.open({
                                btn: ['确定', '取消'],
                                title:'节点信息',
                                zIndex:100,
                                area: area,
                                content:Template("nodetpl", {activeNode:node}),
                                yes: function (index, layero) {
                                    var body = Layer.getChildFrame('body', index);
                                    var nodeName = $("#activeNodeName").val();
                                    var type=$('#selectType').val();
                                    var user = $("#txtUser").val();
                                    var role = $("#txtRole").val();
                                    node.name=nodeName;
                                    node.setInfo.nodeName=nodeName;
                                    node.setInfo.NodeDesignateData.users=user.split(',');
                                    node.setInfo.NodeDesignateData.role=[role];
                                    node.setInfo.nodeDesignate=type;
                                    Chart.updateNode(node);
                                    layer.close(index);
                                },
                                cancel: function (index) {
                                    layer.close(index);
                                },
                                success:function(layero){
                                    Form.events.selectpage($("form[role=form]", layero));
                                    $(document).on('change','#selectType',function () {
                                        var type =$('#selectType').val();
                                        if(type=='user'){
                                            $('#userGroup').show();
                                            $('#roleGroup').hide();
                                        }else{
                                            $('#roleGroup').show();
                                            $('#userGroup').hide();
                                        }
                                        $('.sp_result_area').css('z-index',110);
                                    });

                                    $('#selectType').trigger('change');
                                },
                            })
                    }
                }
            let _createChart = function() {
                return new Chart($('#demo-chart'), $.extend(para,Flow.option))
            };
            var chart = _createChart();
            const getTask = (id) => {
               return chart.getNode(id);
            };
            const addNewTask = (name, params) => {
                params = params || {};
                params.data = params.data || {};
                params.class = 'node-process';
                params.data.nodeType = 1; // 流程节点类型
                let node = chart.addNode(name, newX, newY, params);
                node.addPort({
                    isSource: true
                });
                node.addPort({
                    isTarget: true,
                    position: 'Top'
                });
            };
            const bindEvent = () => {
                $(".flowchart-panel").on('click', '.btn-add', function(event) {
                   let target = $(event.target);
                   let node = $.extend({},target.data('node'));
                   addNewTask(node.name, {
                       data: node
                   });
               });

               $(".btn-clear").click(() => {
                   $('#demo-chart').remove();
                   chart.clear();
               });

            };


            var content=$("input[name='row[flowcontent]']").val();
            if(content && content!=''){
                if ($('#demo-chart').length === 0) {
                $('<div id="demo-chart"></div>').appendTo($('#middle'));
                chart = _createChart();
                }
                chart.fromJson(content);
            }
            else{
                //添加开始节点
                let nodeStart = chart.addNode('开始', basicX, startY, {
                    class: 'node-start',
                    removable: false,
                    data: {
                        name: '开始',
                        type: 'start'
                    }
                });
                nodeStart.addPort({
                    isSource: true
                });

                //添加结束节点
                let nodeEnd = chart.addNode('结束', basicX, endY, {
                    class: 'node-end',
                    removable: false,
                    data: {
                        name: '结束',
                        type: 'end'
                    }
                });
                nodeEnd.addPort({
                    isTarget: true,
                    position: 'Top'
                });
            }

            // 使用测试数据
            if(typeof chart._option.isprocessing =='undefined'  || !chart._option.isprocessing){

                document.getElementById("ok").addEventListener('click',function(){
                var content = JSON.stringify(chart.toJson());
                if (content == -1) {
                    //alert('流程图错误，请检查后保存');
                    event.preventDefault();
                    return false; //阻止表单跳转。
                }
                $("input[name='row[flowcontent]']").val(content);
            },false)
                let listHtml = '';
                Flow.leftMenu.forEach(node => {
                    listHtml += `<li><button type="button" data-id='node.procId' class="btn btn-info btn-sm btn-add">添加 ${node.name}</button></li>`;
                });
                $('.nodes').html(listHtml);
                $('.nodes').find('.btn-add').each(function(index) {
                    $(this).data('node', $.extend({}, Flow.leftMenu[index]));
                });
                bindEvent();
            }
        })

        Form.api.bindevent($("form[role=form]"));
            });
        }
    }
    return Flow;
})