require.config({
    paths: {
        'fullcalendar': '../addons/calendar/fullcalendar/dist/fullcalendar',
        'fullcalendar-lang': '../addons/calendar/fullcalendar/dist/locale/zh-cn',
    },
    // shim依赖配置
    shim: {
        'fullcalendar-lang': ['fullcalendar']
    }
});