define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {

            // 初始化表格参数配置
            Table.api.init({
                //开启脚步统计
            showFooter:true,
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
            table.on('load-success.bs.table', function (e, data) {//在表格数据加载成功后 data为数据
                //统计核算显示到模板页面

                $("#toolbar .total").remove(); //防着刷新后 生成多余的统计单元
                $("#toolbar").append('<a href="javascript:;" class="btn btn-default total" style="font-size:14px;color:dodgerblue;">' +
                    '合计：<span>里程总数 '+data.sum.totalmiles+'\xa0'+'\xa0'+
                    '巡逻人员总数'+data.sum.totalpatrol+'\xa0'+'\xa0'+
                    '巡逻车次总数'+data.sum.totalpatrolcar+'\xa0'+'\xa0'+
                    '巡逻网格数'+data.sum.totalmeshnumber+'\xa0'+'\xa0'+
                    '步巡重点部位数'+data.sum.totalpointnumber+'\xa0'+'\xa0'+
                    '巡逻院坝数'+data.sum.totalyuanbanumber+'\xa0'+'\xa0'+
                    
                    
                                       
                    ' </span></a>');
                 $("#toolbar").append('<a href="javascript:;" class="btn btn-default total" style="font-size:14px;color:dodgerblue;">' +
                    '<span>盘查车次总数 '+data.sum.totalquestioncar+'\xa0'+'\xa0'+
                    '盘查人总数'+data.sum.totalquestionpeople+'\xa0'+'\xa0'+
                    '抓获嫌疑人总数'+data.sum.totalcapturepeople+'\xa0'+'\xa0'+
                    '化解矛盾次数'+data.sum.totaldispute+'\xa0'+'\xa0'+
                    '排查隐患总数'+data.sum.totaldanger+'\xa0'+'\xa0'+
                    '收集社情民意总数'+data.sum.totalsociety+'\xa0'+'\xa0'+
                                   
                    ' </span></a>');
                $("#toolbar").append('<a href="javascript:;" class="btn btn-default total" style="font-size:14px;color:dodgerblue;">' +
                    '<span>服务群众数 '+'\xa0'+'\xa0'+
                    data.sum.totalservice+ '\xa0'+'\xa0'+                   
                    '参与抢险排危数'+data.sum.totalrelief+'\xa0'+'\xa0'+
                    '灭火总数'+data.sum.totaloutfire+'\xa0'+'\xa0'+
                    '抓获摘除马蜂窝总数'+data.sum.totalmafeng+'\xa0'+'\xa0'+
                                     
                    ' </span></a>');
                $("#toolbar").append('<a href="javascript:;" class="btn btn-default total" style="font-size:14px;color:dodgerblue;">' +
                    '<span>救助群众次数 '+'\xa0'+'\xa0'+
                    data.sum.totalhelp+'\xa0'+'\xa0'+
                    '发放宣传资料数'+data.sum.totalxuanchuan+'\xa0'+'\xa0'+
                    '开展防范宣传数'+data.sum.totalfangfanxuanchuan+'\xa0'+'\xa0'+
                    '开展护校行动数'+data.sum.totalhuxiao+'\xa0'+'\xa0'+
                    '参与护校行动数'+data.sum.totalinhuxiao+'\xa0'+'\xa0'+
                    '协助查处非法捕鱼数'+data.sum.totalinfish+'\xa0'+'\xa0'+
                    '抓获非法捕捞人员数'+data.sum.totalfishpeople+'\xa0'+'\xa0'+                                      
                    ' </span></a>');
                $("#toolbar").append('<a href="javascript:;" class="btn btn-default total" style="font-size:14px;color:dodgerblue;">' +
                    '<span>收缴非法捕捞电瓶数 '+'\xa0'+'\xa0'+
                    data.sum.totaldianping+'\xa0'+'\xa0'+
                    '收缴各类渔具网具数'+data.sum.totalyuju+'\xa0'+'\xa0'+
                    '清理流动人口总数'+data.sum.totalclear+'\xa0'+'\xa0'+
                    '送证上门次数'+data.sum.totalsongzheng+'\xa0'+'\xa0'+
                    '好人好事次数'+data.sum.totalgoodthing+'\xa0'+'\xa0'+                   
                    ' </span></a>');
                    //用js在按钮旁边加一个统计的单元 参照K神的demo
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
                        {checkbox: true,footerFormatter:function(data){
                                return '总计';//在第一列开头写上总计、统计之类
                            }
                        },
                        {field: 'id', title: __('Id')},
                        {field: 'admin_nicknames', title: __('Admin_ids'),formatter: Table.api.formatter.label, operate: 'like'},
                      
                        {field: 'miles', title: __('Miles'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'patrol', title: __('Patrol'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'patrolcar', title: __('Patrolcar'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                         {field: 'meshnumber', title: __('Meshnumber'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                         {field: 'pointnumber', title: __('Pointnumber'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                         {field: 'yuanbanumber', title: __('Yuanbanumber'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },

                        {field: 'questioncar', title: __('Questioncar'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'questionpeople', title: __('Questionpeople'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'capturepeople', title: __('Capturepeople'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'dispute', title: __('Dispute'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'danger', title: __('Danger'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'society', title: __('Society'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'service', title: __('Service'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'relief', title: __('Relief'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                         {field: 'outfire', title: __('Outfire'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                    
                        {field: 'mafeng', title: __('Mafeng'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'help', title: __('Help'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'xuanchuan', title: __('Xuanchuan'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'fangfanxuanchuan', title: __('Fangfanxuanchuan'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'huxiao', title: __('Huxiao'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'inhuxiao', title: __('Inhuxiao'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'infish', title: __('Infish'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'fishpeople', title: __('Fishpeople'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'dianping', title: __('Dianping'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'yuju', title: __('Yuju'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },                        
                        {field: 'clear', title: __('Clear'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'songzheng', title: __('Songzheng'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                        {field: 'goodthing', title: __('Goodthing'), operate: false,footerFormatter: function (data) {
                                var field = this.field;
                                var total_sum = data.reduce(function (sum, row) {
                                    return (sum) + (parseFloat(row[field]) || 0);
                                }, 0);
                                return total_sum;
                            }
                        },
                      
                       
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange', sortable: true,formatter: Table.api.formatter.search},
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