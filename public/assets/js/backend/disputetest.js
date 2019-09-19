define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
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
                        
                        {field: 'admin_nicknames', title: __('Admin_ids'),formatter: Table.api.formatter.label, operate: 'like'}, 
                        {field: 'city', title: __('City')},
                        {field: 'addressname_names', title: __('Addressname_ids'), operate: 'like',formatter: Table.api.formatter.search},
                        {field: 'mesh_names', title: __('Mesh_ids'), operate: 'like',formatter: Table.api.formatter.search},
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'images', title: __('Images'), events: Table.api.events.image, formatter: Table.api.formatter.images},
                        {field: 'keywordsA', title: __('Keywordsa')},
                        {field: 'ageA', title: __('Agea')},
                        {field: 'identityA', title: __('Identitya')},
                        {field: 'Acity', title: __('Acity')},
                        {field: 'telhoneA', title: __('Telhonea')},
                        {field: 'genderdataA', title: __('Genderdataa'), searchList: {"male":__('Genderdataa male'),"female":__('Genderdataa female')}, formatter: Table.api.formatter.normal},
                        {field: 'Bcity', title: __('Bcity')},
                        {field: 'keywordsB', title: __('Keywordsb')},
                        {field: 'ageB', title: __('Ageb')},
                        {field: 'identityB', title: __('Identityb')},
                        {field: 'telhoneB', title: __('Telhoneb')},
                        {field: 'genderdataB', title: __('Genderdatab'), searchList: {"male":__('Genderdatab male'),"female":__('Genderdatab female')}, formatter: Table.api.formatter.normal},
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