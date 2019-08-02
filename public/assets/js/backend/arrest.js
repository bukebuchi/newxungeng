define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'arrest/index',
                    add_url: 'arrest/add',
                    edit_url: 'arrest/edit',
                    del_url: 'arrest/del',
                    multi_url: 'arrest/multi',
                    table: 'arrest',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'category_ids', title: __('Category_ids')},
                        {field: 'hobbydata', title: __('Hobbydata'), searchList: {"music":__('Hobbydata music'),"reading":__('Hobbydata reading'),"swimming":__('Hobbydata swimming')}, operate:'FIND_IN_SET', formatter: Table.api.formatter.label},
                        {field: 'city', title: __('City')},
                        {field: 'images', title: __('Images'), events: Table.api.events.image, formatter: Table.api.formatter.images},
                        {field: 'keywords', title: __('Keywords')},
                        {field: 'addcontent', title: __('Addcontent')},
                        {field: 'genderdata', title: __('Genderdata'), searchList: {"male":__('Genderdata male'),"female":__('Genderdata female')}, formatter: Table.api.formatter.normal},
                        {field: 'identity', title: __('Identity')},
                        {field: 'views', title: __('Views')},
                        {field: 'title', title: __('Title')},
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            Form.api.bindevent("form")；
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