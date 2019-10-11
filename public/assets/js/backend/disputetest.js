define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                showFooter:true,
                extend: {
                    index_url: 'disputetest/index' + location.search,
                    add_url: 'disputetest/add',
                    edit_url: 'disputetest/edit',
                    del_url: 'disputetest/del',
                    multi_url: 'disputetest/multi',
                    table: 'disputetest',
                }
            });

            var table = $("#table");
//给添加按钮添加`data-area`属性
            $(".btn-add").data("area", ["100%", "100%"]);
            //当内容渲染完成给编辑按钮添加`data-area`属性
            table.on('post-body.bs.table', function (e, settings, json, xhr) {
            $(".btn-editone").data("area", ["100%", "100%"]);
            });
            $(".btn-edit").data("area", ["100%", "100%"]);
            //当内容渲染完成给编辑按钮添加`data-area`属性
            table.on('post-body.bs.table', function (e, settings, json, xhr) {
            $(".btn-editone").data("area", ["100%", "100%"]);
            });
            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                search: false,
                commonSearch: true,
                searchFormVisible: true,
                searchFormTemplate: 'customformtpl',

                columns: [
                    [
                        
                        {checkbox: true,footerFormatter:function(data){
                                return '总计';//在第一列开头写上总计、统计之类
                            }
                        },
                        {field: 'id', title: __('Id')},
                        
                        {field: 'admin_nicknames', title: __('Admin_ids'),formatter: Table.api.formatter.label, operate: 'like'}, 
                        {field: 'city', title: __('City')},
                        {field: 'addressname_names', title: __('Addressname_ids'), operate: 'like',formatter: Table.api.formatter.search},
                        {field: 'mesh_names', title: __('Mesh_ids'), operate: 'like',formatter: Table.api.formatter.search},
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'images', title: __('Images'), events: Table.api.events.image, formatter: Table.api.formatter.images},
                        {field: 'information', title: __('Information'), operate: 'like',formatter:function(value,row,index){ 
                             var str=row.information;
                             var obj1='';
                             var xqo = eval('(' + str + ')');
                             console.log(xqo);
                                for(var i in xqo){
                                var obj='姓名'+' : '+xqo[i].Name+'<br/>'+'身份证'+' : '+xqo[i].Id+'<br/>'+'性别'+' : '+xqo[i].Sex+'<br/>'+'电话'+' : '+xqo[i].Telephone+'<br/>';
                                var obj1=obj1+obj;
                                }

                             return obj1;
   
                             
                        }
                    },
                       
                        {field: 'addcontent', title: __('Addcontent')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
              Form.events.selectpage($("form"));
            Form.events.datetimepicker($("form"));
            Controller.api.bindevent();
        },
        edit: function () {
              Form.events.selectpage($("form"));
            Form.events.datetimepicker($("form"));
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});