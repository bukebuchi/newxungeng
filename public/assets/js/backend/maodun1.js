define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'maodun1/index' + location.search,
                    add_url: 'maodun1/add',
                    edit_url: 'maodun1/edit',
                    del_url: 'maodun1/del',
                    multi_url: 'maodun1/multi',
                    table: 'maodun1',
                }
            });

            var table = $("#table");
//给添加按钮添加`data-area`属性
$(".btn-add").data("area", ["100%", "100%"]);
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
                        {checkbox: true},
                        {field: 'id', title: __('Id'),operate: false},
                        {field: 'admin_nicknames', title: __('Admin_ids'),formatter: Table.api.formatter.label, operate: false},
                        {field: 'category_ids', title: __('Category_ids'), formatter: Table.api.formatter.search,visible:false},
                        {field: 'hobbydata', title: __('Hobbydata'), searchList: {"music":__('Hobbydata music'),"reading":__('Hobbydata reading'),"swimming":__('Hobbydata swimming')}, operate:'FIND_IN_SET', formatter: Table.api.formatter.label},
                        {field: 'city', title: __('City')},
                        {field: 'addressname', title: __('Addressname')},
                        {field: 'images', title: __('Images'), events: Table.api.events.image, formatter: Table.api.formatter.images},
                        {field: 'addcontent', title: __('Addcontent')},
                        {field: 'genderdata', title: __('Genderdata'), searchList: {"male":__('Genderdata male'),"female":__('Genderdata female')}, formatter: Table.api.formatter.normal},
                        {field: 'views', title: __('Views')},
                        {field: 'title', title: __('Title')},
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
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