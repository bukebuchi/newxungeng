define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'dutynew/index' + location.search,
                    add_url: 'dutynew/add',
                    edit_url: 'dutynew/edit',
                    del_url: 'dutynew/del',
                    multi_url: 'dutynew/multi',
                    table: 'dutynew',
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
                  {field: 'admin_nicknames', title: __('Admin_ids'),formatter: Table.api.formatter.label, perate: 'like'},
                        {field: 'addressname', title: __('Addressname')},
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'files', title: __('Files'),formatter: Table.api.formatter.url},
                        {field: 'content', title: __('Content')},
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