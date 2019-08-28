define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'dispute1/index' + location.search,
                    add_url: 'dispute1/add',
                    edit_url: 'dispute1/edit',
                    del_url: 'dispute1/del',
                    multi_url: 'dispute1/multi',
                    table: 'dispute1',
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
                        {field: 'id', title: __('Id'), operate: false},
                        {field: 'admin_id', title: __('Admin_id')},
                        {field: 'admin_nicknames', title: __('Admin_ids'),formatter: Table.api.formatter.label, operate: false},
                        {field: 'category_ids', title: __('Category_ids'),formatter: Table.api.formatter.search,visible:false,operate: false},
                        {field: 'city', title: __('City'),operate: false},
                        {field: 'addressname', title: __('Addressname'),operate: false},
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange', sortable: true},
                        {field: 'images', title: __('Images'), events: Table.api.events.image, formatter: Table.api.formatter.images, operate: false},
                        {field: 'keywordsA', title: __('Keywordsa'),operate:'like'},
                        {field: 'ageA', title: __('Agea'), operate: false},
                        {field: 'identityA', title: __('Identitya'),operate:'like'},
                        {field: 'Acity', title: __('Acity'), operate: false},
                        {field: 'telhoneA', title: __('Telhonea'), operate: false},
                        {field: 'genderdataA', title: __('Genderdataa'), searchList: {"male":__('Genderdataa male'),"female":__('Genderdataa female')}, formatter: Table.api.formatter.normal, operate: false},
                        {field: 'Bcity', title: __('Bcity'), operate: false},
                        {field: 'keywordsB', title: __('Keywordsb'),operate:'like'},
                        {field: 'ageB', title: __('Ageb'), operate: false},
                        {field: 'identityB', title: __('Identityb'),operate:'like'},
                        {field: 'telhoneB', title: __('Telhoneb'), operate: false},
                        {field: 'genderdataB', title: __('Genderdatab'), searchList: {"male":__('Genderdatab male'),"female":__('Genderdatab female')}, formatter: Table.api.formatter.normal, operate: false},
                        {field: 'addcontent', title: __('Addcontent'), operate: false},
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