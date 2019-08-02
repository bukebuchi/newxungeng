define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'policy/index' + location.search,
                    add_url: 'policy/add',
                    edit_url: 'policy/edit',
                    del_url: 'policy/del',
                    multi_url: 'policy/multi',
                    table: 'policy',
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
                        {field: 'category_ids', title: __('Category_ids'),formatter: Table.api.formatter.search},
                        {field: 'addressname', title: __('Addressname')},
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange', sortable: true},
                        {field: 'images', title: __('Images'), events: Table.api.events.image, formatter: Table.api.formatter.images, operate: false},
                        {field: 'xingshihobbydata', title: __('Xingshihobbydata'), searchList: {"kt":__('Xingshihobbydata kt'),"ff":__('Xingshihobbydata ff'),"yb":__('Xingshihobbydata yb'),"xl":__('Xingshihobbydata xl'),"zb":__('Xingshihobbydata zb'),"ll":__('Xingshihobbydata ll')}, operate:'FIND_IN_SET', formatter: Table.api.formatter.label},
                        {field: 'contenthobbydata', title: __('Contenthobbydata'), searchList: {"ff":__('Contenthobbydata ff'),"fh":__('Contenthobbydata fh'),"fk":__('Contenthobbydata fk'),"hd":__('Contenthobbydata hd'),"sh":__('Contenthobbydata sh'),"fj":__('Contenthobbydata fj'),"fx":__('Contenthobbydata fx'),"qt":__('Contenthobbydata qt')}, operate:'FIND_IN_SET', formatter: Table.api.formatter.label},
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