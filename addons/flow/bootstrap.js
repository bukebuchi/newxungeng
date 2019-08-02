require.config({
    paths: {
        'flow': '../addons/flow/js/require-flow',
        'jsplumb': '../addons/flow/js/jsplumb/jsplumb.min',
        'chart': '../addons/flow/js/jsplumb/chart'
    },
    shim: {
        'chart': ['css!../addons/flow/js/jsplumb/chart.css']
    }
});
