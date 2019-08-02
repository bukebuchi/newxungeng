define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'map/index' + location.search,
                    add_url: 'map/add',
                    edit_url: 'map/edit',
                    del_url: 'map/del',
                    multi_url: 'map/multi',
                    table: 'map',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'index',
                sortName: 'index',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'index', title: __('Index')},
                        {field: 'userid', title: __('Userid')},
                        {field: 'datetime', title: __('Datetime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'pos_x', title: __('Pos_x'), operate:'BETWEEN'},
                        {field: 'pos_y', title: __('Pos_y'), operate:'BETWEEN'},
                        {field: 'state', title: __('State')},
                        {field: 'type', title: __('Type')},
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