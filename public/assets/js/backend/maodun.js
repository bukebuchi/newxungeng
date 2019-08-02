define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'maodun/index' + location.search,
                    add_url: 'maodun/add',
                    edit_url: 'maodun/edit',
                    del_url: 'maodun/del',
                    multi_url: 'maodun/multi',
                    table: 'maodun',
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
                        {field: 'category_ids', title: __('Category_ids'), operate: 'like', formatter: Table.api.formatter.search,visible:false},
                        {field: 'hobbydata', title: __('Hobbydata'), searchList: {"music":__('Hobbydata music'),"reading":__('Hobbydata reading'),"swimming":__('Hobbydata swimming')}, operate:'FIND_IN_SET', formatter: Table.api.formatter.label},
                        {field: 'city', title: __('City'),operate: false},
                        {field: 'addressname', title: __('Addressname'),operate: false},
                        {field: 'longtitude', title: __('Longtitude'), operate: false,visible:false},
                        {field: 'latitude', title: __('Latitude'), operate: false,visible:false},
                        {field: 'images', title: __('Images'), events: Table.api.events.image, formatter: Table.api.formatter.images, operate: false},
                        {field: 'keywords', title: __('Keywords'),formatter: Table.api.formatter.search,visible:false, operate: 'like'},
                        {field: 'identity', title: __('Identity'), formatter: Table.api.formatter.search,visible:false, operate: 'like'},
                        {field: 'addcontent', title: __('Addcontent'), operate: 'like'},
                        {field: 'genderdata', title: __('Genderdata'), searchList: {"male":__('Genderdata male'),"female":__('Genderdata female')}, formatter: Table.api.formatter.normal, operate: false,visible:false},
                        {field: 'views', title: __('Views'), operate: false},
                        {field: 'title', title: __('Title'), operate: false},
                        {field: 'activitytime', title: __('Activitytime'), formatter: Table.api.formatter.datetime, operate:'RANGE', addclass:'datetimerange', sortable: true},
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
        map: function () {
            Form.api.bindevent($("form[role=form]"));
            require(['async!BMap'], function () {
                // 更多文档可参考 http://lbsyun.baidu.com/jsdemo.htm
                // 百度地图API功能
                var map = new BMap.Map("allmap");
                var point = new BMap.Point(116.404, 39.915);

                map.centerAndZoom(point, 13); //设置中心坐标点和级别
                var marker = new BMap.Marker(point);  // 创建标注
                map.addOverlay(marker);               // 将标注添加到地图中
                marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画

                map.enableDragging();   //开启拖拽
                //map.enableInertialDragging();   //开启惯性拖拽
                map.enableScrollWheelZoom(true); //是否允许缩放
                //map.centerAndZoom("上海",15); //根据城市名设定地图中心点

                var geolocation = new BMap.Geolocation();
                geolocation.getCurrentPosition(function (r) {
                    if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                        var mk = new BMap.Marker(r.point);
                        map.addOverlay(mk);
                        map.panTo(r.point);
                        //Layer.alert('您的位置：' + r.point.lng + ',' + r.point.lat);
                    } else {
                        Layer.alert('failed' + this.getStatus());
                    }
                }, {enableHighAccuracy: true});
                
                // 点搜索按钮时解析地址坐标
                $(document).on('click', '.btn-search', function () {
                    // 创建地址解析器实例
                    var myGeo = new BMap.Geocoder();
                    // 将地址解析结果显示在地图上,并调整地图视野
                    myGeo.getPoint($("#searchaddress").val(), function (point) {
                        if (point) {
                            map.centerAndZoom(point, 16);
                            map.addOverlay(new BMap.Marker(point));
                        } else {
                            Layer.alert("您选择地址没有解析到结果!");
                        }
                    });
                });

            });
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});