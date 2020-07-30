define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                showFooter:true,
                extend: {
                    index_url: 'relief/index' + location.search,
                    add_url: 'relief/add',
                    edit_url: 'relief/edit',
                    del_url: 'relief/del',
                    multi_url: 'relief/multi',
                    table: 'relief',
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
            table.on('load-success.bs.table', function (e, data) {//在表格数据加载成功后 data为数据
                //统计核算显示到模板页面

                $("#toolbar .total").remove(); //防着刷新后 生成多余的统计单元
                $("#toolbar").append('<a href="javascript:;" class="btn btn-default total" style="font-size:14px;color:dodgerblue;">' +
                    '合计：<span>救助人数 '+data.sum.totalviews+'\xa0'+'\xa0'+'救火次数'+data.sum.totalfireviews+' </span></a>');
                    //用js在按钮旁边加一个统计的单元 参照K神的demo
            });
            // // // 初始化表格
            // table.on('load-success.bs.table', function (e, data) {
            // //这里可以获取从服务端获取的JSON数据
            // console.log(data.sum.views);
            // //这里我们手动设置底部的值
            // $("#views").text(data.sum.views+'\xa0');
            // $("#fireviews").text(data.sum.fireviews+'\xa0');
            //     });
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
                        {field: 'id', title: __('Id'), operate: false},
                         {field: 'admin_nicknames', title: __('Admin_ids'), operate: 'like'},
                      
                        {field: 'addressname_names', title: __('Addressname_ids'),operate: 'like',formatter: Table.api.formatter.search},
                        {field: 'mesh_names', title: __('Mesh_ids'),operate: 'like',formatter: Table.api.formatter.search},
                        {field: 'dname_names', title: __('Dname_ids'),operate: 'like',formatter: Table.api.formatter.search},
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange', sortable: true},
                        {field: 'images', title: __('Images'), events: Table.api.events.image, formatter: Table.api.formatter.images, operate: false},
                        {field: 'views', title: __('Views'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                         {field: 'hobbydata', title: __('Hobbydata'), searchList: {"qd":__('Hobbydata qd'),"sd":__('Hobbydata sd')},operate:'FIND_IN_SET', formatter: Table.api.formatter.label, operate: false},
                        {field: 'fireviews', title: __('Fireviews'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }},
                        {field: 'addcontent', title: __('Addcontent'), operate: false},
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