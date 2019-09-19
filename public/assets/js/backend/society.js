define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'society/index' + location.search,
                    add_url: 'society/add',
                    edit_url: 'society/edit',
                    del_url: 'society/del',
                    multi_url: 'society/multi',
                    table: 'society',
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
                        {checkbox: true},
                        {field: 'id', title: __('Id'), operate: false},
                        {field: 'admin_nicknames', title: __('Admin_ids'),formatter: Table.api.formatter.label, operate: 'like'},
                        {field: 'category_ids', title: __('Category_ids'), formatter: Table.api.formatter.search,visible:false,operate: false},
                       {field: 'addressname_names', title: __('Addressname_ids'),operate: 'like',formatter: Table.api.formatter.search},
                        {field: 'mesh_names', title: __('Mesh_ids'),operate: 'like',formatter: Table.api.formatter.search},
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange', sortable: true},
                        {field: 'images', title: __('Images'), events: Table.api.events.image, formatter: Table.api.formatter.images, operate: false},
                        {field: 'keywords', title: __('Keywords'),formatter: Table.api.formatter.search},
                        {field: 'age', title: __('Age'), operate: false},
                        {field: 'identity', title: __('Identity'),formatter: Table.api.formatter.search},
                        {field: 'city', title: __('City'), operate: false},
                        {field: 'street_names', title: __('Street_ids')},
                        {field: 'telhone', title: __('Telhone'),formatter: Table.api.formatter.search},
                        {field: 'genderdata', title: __('Genderdata'), searchList: {"male":__('Genderdata male'),"female":__('Genderdata female')}, formatter: Table.api.formatter.normal, operate: false},
                        {field: 'flag', title: __('Flag'), searchList: {"weifa":__('Flag weifa'),"anquan":__('Flag anquan'),"shiping":__('Flag shiping'),"weiwen":__('Flag weiwen'),"qita":__('Flag qita')}, operate:'FIND_IN_SET', formatter: Table.api.formatter.label, operate: false},
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
               Form.api.bindevent($("form[role=form]"));
        },
        edit: function () {
            Form.events.selectpage($("form"));
        Form.events.datetimepicker($("form"));
               Form.api.bindevent($("form[role=form]"));
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});