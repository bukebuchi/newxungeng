define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'tongji/index' + location.search,
                    add_url: 'tongji/add',
                    edit_url: 'tongji/edit',
                    del_url: 'tongji/del',
                    multi_url: 'tongji/multi',
                    table: 'tongji',
                }
            });

            var table = $("#table");

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
                        {field: 'id', title: __('Id')},
                        {field: 'admin_id', title: __('Admin_id'),visible:false},
                        {field: 'admin_ids', title: __('Admin_ids'),visible:false},
                        {field: 'miles', title: __('Miles')},
                        {field: 'patrol', title: __('Patrol')},
                        {field: 'patrolcar', title: __('Patrolcar')},
                        {field: 'questioncar', title: __('Questioncar')},
                        {field: 'questionpeople', title: __('Questionpeople')},
                        {field: 'capturepeople', title: __('Capturepeople')},
                        {field: 'fishpeople', title: __('Fishpeople')},
                        {field: 'outfire', title: __('Outfire')},
                        {field: 'society', title: __('Society')},
                        {field: 'danger', title: __('Danger')},
                        {field: 'clear', title: __('Clear')},
                        {field: 'songzheng', title: __('Songzheng')},
                        {field: 'goodthing', title: __('Goodthing')},
                        {field: 'help', title: __('Help')},
                        {field: 'dispute', title: __('Dispute')},
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange', sortable: true,formatter: Table.api.formatter.search},
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