define([], function () {
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
require.config({
    paths: {
        'jquery-colorpicker': '../addons/cms/js/jquery.colorpicker.min',
        'jquery-autocomplete': '../addons/cms/js/jquery.autocomplete',
        'jquery-tagsinput': '../addons/cms/js/jquery.tagsinput',
    },
    shim: {
        'jquery-colorpicker': {
            deps: ['jquery'],
            exports: '$.fn.extend'
        },
        'jquery-autocomplete': {
            deps: ['jquery'],
            exports: '$.fn.extend'
        },
        'jquery-tagsinput': {
            deps: ['jquery', 'jquery-autocomplete', 'css!../addons/cms/css/jquery.tagsinput.min.css'],
            exports: '$.fn.extend'
        }
    }
});
if (window.Config.modulename == 'admin' && window.Config.controllername == 'index' && window.Config.actionname == "login") {
    require.config({
        paths: {
            'csmradmin': ['../addons/csmradmin/js/login'],
        },
        shim: {
            csmradmin: ['css!../addons/csmradmin/css/login.css']
        },
    });
    require(["jquery", "csmradmin"], function ($, csmradmin) {
        csmradmin.mounted();
    });
}
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

require.config({
    paths: {
        'bootstrap-markdown': '../addons/markdown/js/bootstrap-markdown.min',
        'hyperdown': '../addons/markdown/js/hyperdown.min',
        'pasteupload': '../addons/markdown/js/jquery.pasteupload'
    },
    shim: {
        'bootstrap-markdown': {
            deps: [
                'jquery',
                'css!../addons/markdown/css/bootstrap-markdown.css'
            ],
            exports: '$.fn.markdown'
        },
        'pasteupload': {
            deps: [
                'jquery',
            ],
            exports: '$.fn.pasteUploadImage'
        }
    }
});
require(['form', 'upload'], function (Form, Upload) {
    var _bindevent = Form.events.bindevent;
    Form.events.bindevent = function (form) {
        _bindevent.apply(this, [form]);
        try {
            if ($(".editor", form).size() > 0) {
                require(['bootstrap-markdown', 'hyperdown', 'pasteupload'], function (undefined, undefined, undefined) {
                    $.fn.markdown.messages.zh = {
                        Bold: "粗体",
                        Italic: "斜体",
                        Heading: "标题",
                        "URL/Link": "链接",
                        Image: "图片",
                        List: "列表",
                        "Unordered List": "无序列表",
                        "Ordered List": "有序列表",
                        Code: "代码",
                        Quote: "引用",
                        Preview: "预览",
                        "strong text": "粗体",
                        "emphasized text": "强调",
                        "heading text": "标题",
                        "enter link description here": "输入链接说明",
                        "Insert Hyperlink": "URL地址",
                        "enter image description here": "输入图片说明",
                        "Insert Image Hyperlink": "图片URL地址",
                        "enter image title here": "在这里输入图片标题",
                        "list text here": "这里是列表文本",
                        "code text here": "这里输入代码",
                        "quote here": "这里输入引用文本"
                    };
                    var parser = new HyperDown();
                    window.marked = function (text) {
                        return parser.makeHtml(text);
                    };
                    //粘贴上传图片
                    $.fn.pasteUploadImage.defaults = $.extend(true, $.fn.pasteUploadImage.defaults, {
                        fileName: "file",
                        appendMimetype: false,
                        ajaxOptions: {
                            url: Fast.api.fixurl(Config.upload.uploadurl),
                            beforeSend: function (jqXHR, settings) {
                                $.each(Config.upload.multipart, function (i, j) {
                                    settings.data.append(i, j);
                                });
                                return true;
                            }
                        },
                        success: function (data, filename, file) {
                            var ret = Upload.events.onUploadResponse(data);
                            $(this).insertToTextArea(filename, Config.upload.cdnurl + data.data.url);
                            return false;
                        },
                        error: function (data, filename, file) {
                            console.log(data, filename, file);
                        }
                    });
                    //手动选择上传图片
                    $(document).on("change", "#selectimage", function () {
                        $.each($(this)[0].files, function (i, file) {
                            $("").uploadFile(file, file.name);
                        });
                        //$("#message").pasteUploadImage();
                    });
                    $(".editor", form).each(function () {
                        $(this).markdown({
                            resize: 'vertical',
                            language: 'zh',
                            iconlibrary: 'fa',
                            autofocus: false,
                            savable: false,
                            additionalButtons: [
                                [{
                                    name: "groupCustom",
                                    data: [{
                                        name: "cmdSelectImage",
                                        toggle: false,
                                        title: "Select image",
                                        icon: "fa fa-file-image-o",
                                        callback: function (e) {
                                            parent.Fast.api.open("general/attachment/select?element_id=&multiple=true&mimetype=image/*", __('Choose'), {
                                                callback: function (data) {
                                                    var urlArr = data.url.split(/\,/);
                                                    $.each(urlArr, function () {
                                                        var url = Fast.api.cdnurl(this);
                                                        e.replaceSelection("\n" + '![输入图片说明](' + url + ' "在这里输入图片标题")');
                                                    });
                                                    e.$element.blur();
                                                    e.$element.focus();
                                                }
                                            });
                                            return false;
                                        }
                                    }, {
                                        name: "cmdSelectAttachment",
                                        toggle: false,
                                        title: "Select image",
                                        icon: "fa fa-file",
                                        callback: function (e) {
                                            parent.Fast.api.open("general/attachment/select?element_id=&multiple=true&mimetype=*", __('Choose'), {
                                                callback: function (data) {
                                                    var urlArr = data.url.split(/\,/);
                                                    $.each(urlArr, function () {
                                                        var url = Fast.api.cdnurl(this);
                                                        e.replaceSelection("\n" + '[输入链接说明](' + url + ')');
                                                    });
                                                    e.$element.blur();
                                                    e.$element.focus();
                                                }
                                            });
                                            return false;
                                        }
                                    }]
                                }]
                            ]
                        });
                        $(this).pasteUploadImage();
                    });
                });
            }
        } catch (e) {

        }

    };
});

require.config({
    paths: {
        'nkeditor': '../addons/nkeditor/js/customplugin',
        'nkeditor-core': '../addons/nkeditor/nkeditor.min',
        'nkeditor-lang': '../addons/nkeditor/lang/zh-CN',
    },
    shim: {
        'nkeditor': {
            deps: [
                'nkeditor-core',
                'nkeditor-lang'
            ]
        },
        'nkeditor-core': {
            deps: [
                'css!../addons/nkeditor/themes/black/editor.min.css',
                'css!../addons/nkeditor/css/common.css'
            ],
            exports: 'window.KindEditor'
        },
        'nkeditor-lang': {
            deps: [
                'nkeditor-core'
            ]
        }
    }
});
require(['form'], function (Form) {
    var _bindevent = Form.events.bindevent;
    Form.events.bindevent = function (form) {
        _bindevent.apply(this, [form]);
        if ($(".editor", form).size() > 0) {
            require(['nkeditor', 'upload'], function (Nkeditor, Upload) {
                var getImageFromClipboard, getImageFromDrop;
                getImageFromClipboard = function (data) {
                    var i, item;
                    i = 0;
                    while (i < data.clipboardData.items.length) {
                        item = data.clipboardData.items[i];
                        if (item.type.indexOf("image") !== -1) {
                            return item.getAsFile() || false;
                        }
                        i++;
                    }
                    return false;
                };
                getImageFromDrop = function (data) {
                    var i, item, images;
                    i = 0;
                    images = [];
                    while (i < data.dataTransfer.files.length) {
                        item = data.dataTransfer.files[i];
                        if (item.type.indexOf("image") !== -1) {
                            images.push(item);
                        }
                        i++;
                    }
                    return images;
                };

                var getImageFromUrl = function (url, callback, outputFormat) {
                    var canvas = document.createElement('CANVAS'),
                        ctx = canvas.getContext('2d'),
                        img = new Image;
                    img.crossOrigin = 'Anonymous';
                    img.onload = function () {
                        var urlArr = url.split('.');
                        var suffix = urlArr.pop();
                        suffix = suffix.match(/^(jpg|png|gif|bmp|jpeg)$/i) ? suffix : 'png';

                        try {
                            canvas.height = img.height;
                            canvas.width = img.width;
                            ctx.drawImage(img, 0, 0);
                            var dataURL = canvas.toDataURL(outputFormat || 'image/' + suffix);

                            var arr = dataURL.split(','), mime = arr[0].match(/:(.*?);/)[1],
                                bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
                            while (n--) {
                                u8arr[n] = bstr.charCodeAt(n);
                            }
                            var filename = url.substr(url.lastIndexOf('/') + 1);
                            var exp = new RegExp("\\." + suffix + "$", "i");
                            filename = exp.test(filename) ? filename : filename + "." + suffix;
                            var file = new File([u8arr], filename, {type: mime});
                        } catch (e) {
                            callback.call(this, null);
                        }

                        callback.call(this, file);
                        canvas = null;
                    };
                    img.onerror = function (e) {
                        callback.call(this, null);
                    };
                    img.src = url;
                };

                Nkeditor.lang({
                    remoteimage: '下载远程图片'
                });
                //远程下载图片
                Nkeditor.plugin('remoteimage', function (K) {
                    var editor = this, name = 'remoteimage';
                    editor.plugin.remoteimage = {
                        download: function (e) {
                            var that = this;
                            var html = that.html();
                            var staging = {}, orgined = {}, index = 0, images = 0, completed = 0, failured = 0;
                            var checkrestore = function () {
                                if (completed + failured >= images) {
                                    $.each(staging, function (i, j) {
                                        that.html(that.html().replace("<code>" + i + "</code>", j));
                                    });
                                }
                            };
                            html.replace(/<code>([\s\S]*?)<\/code>/g, function (code) {
                                    staging[index] = code;
                                    return "<code>" + index + "</code>";
                                }
                            );
                            html = html.replace(/<img([\s\S]*?)\ssrc\s*=\s*('|")((http(s?):)([\s\S]*?))('|")([\s\S]*?)[\/]?>/g, function () {
                                images++;
                                var url = arguments[3];
                                var placeholder = '<img src="' + Fast.api.cdnurl("/assets/addons/nkeditor/img/downloading.png") + '" data-index="' + index + '" />';
                                //如果是云存储的链接,则忽略
                                if (Config.upload.cdnurl && url.indexOf(Config.upload.cdnurl) > -1) {
                                    completed++;
                                    return arguments[0];
                                } else {
                                    orgined[index] = arguments[0];
                                }
                                //下载远程图片
                                (function (index, url, placeholder) {
                                    getImageFromUrl(url, function (file) {
                                        if (!file) {
                                            failured++;
                                            that.html(that.html().replace(placeholder, orgined[index]));
                                            checkrestore();
                                        } else {
                                            Upload.api.send(file, function (data) {
                                                completed++;
                                                that.html(that.html().replace(placeholder, '<img src="' + Fast.api.cdnurl(data.url) + '" />'));
                                                checkrestore();
                                            }, function (data) {
                                                failured++;
                                                that.html(that.html().replace(placeholder, orgined[index]));
                                                checkrestore();
                                            });
                                        }
                                    });
                                })(index, url, placeholder);
                                index++;
                                return placeholder;
                            });
                            if (index > 0) {
                                that.html(html);
                            } else {
                                Toastr.info("没有需要下载的远程图片");
                            }
                        }
                    };
                    // 点击图标时执行
                    editor.clickToolbar(name, editor.plugin.remoteimage.download);
                });

                $(".editor", form).each(function () {
                    var that = this;
                    Nkeditor.create(that, {
                        width: '100%',
                        filterMode: false,
                        wellFormatMode: false,
                        allowMediaUpload: true, //是否允许媒体上传
                        allowFileManager: true,
                        allowImageUpload: true,
                        urlType: Config.upload.cdnurl ? 'domain' : '',//给图片加前缀
                        cssPath: Fast.api.cdnurl('/assets/addons/nkeditor/plugins/code/prism.css'),
                        cssData: "body {font-size: 13px}",
                        fillDescAfterUploadImage: false, //是否在上传后继续添加描述信息
                        themeType: typeof Config.nkeditor != 'undefined' ? Config.nkeditor.theme : 'black', //编辑器皮肤,这个值从后台获取
                        fileManagerJson: Fast.api.fixurl("/addons/nkeditor/index/attachment/module/" + Config.modulename),
                        items: [
                            'source', 'undo', 'redo', 'preview', 'print', 'template', 'code', 'quote', 'cut', 'copy', 'paste',
                            'plainpaste', 'wordpaste', 'justifyleft', 'justifycenter', 'justifyright',
                            'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                            'superscript', 'clearhtml', 'quickformat', 'selectall',
                            'formatblock', 'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'bold',
                            'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', 'image', 'multiimage', 'graft',
                            'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
                            'anchor', 'link', 'unlink', 'remoteimage', 'about', 'fullscreen'
                        ],
                        afterCreate: function () {
                            var self = this;
                            //Ctrl+回车提交
                            Nkeditor.ctrl(document, 13, function () {
                                self.sync();
                                $(that).closest("form").submit();
                            });
                            Nkeditor.ctrl(self.edit.doc, 13, function () {
                                self.sync();
                                $(that).closest("form").submit();
                            });
                            //粘贴上传
                            $("body", self.edit.doc).bind('paste', function (event) {
                                var image, pasteEvent;
                                pasteEvent = event.originalEvent;
                                if (pasteEvent.clipboardData && pasteEvent.clipboardData.items) {
                                    image = getImageFromClipboard(pasteEvent);
                                    if (image) {
                                        event.preventDefault();
                                        Upload.api.send(image, function (data) {
                                            self.exec("insertimage", Fast.api.cdnurl(data.url));
                                        });
                                    }
                                }
                            });
                            //挺拽上传
                            $("body", self.edit.doc).bind('drop', function (event) {
                                var image, pasteEvent;
                                pasteEvent = event.originalEvent;
                                if (pasteEvent.dataTransfer && pasteEvent.dataTransfer.files) {
                                    images = getImageFromDrop(pasteEvent);
                                    if (images.length > 0) {
                                        event.preventDefault();
                                        $.each(images, function (i, image) {
                                            Upload.api.send(image, function (data) {
                                                self.exec("insertimage", Fast.api.cdnurl(data.url));
                                            });
                                        });
                                    }
                                }
                            });
                        },
                        //FastAdmin自定义处理
                        beforeUpload: function (callback, file) {
                            var file = file ? file : $("input.ke-upload-file", this.form).prop('files')[0];
                            Upload.api.send(file, function (data) {
                                var data = {code: '000', data: {url: Fast.api.cdnurl(data.url)}, title: '', width: '', height: '', border: '', align: ''};
                                callback(data);
                            });

                        },
                        //错误处理 handler
                        errorMsgHandler: function (message, type) {
                            try {
                                console.log(message, type);
                            } catch (Error) {
                                alert(message);
                            }
                        }
                    });
                });
            });
        }
    }
});

require.config({
    paths: {
        'voicenotice': '../addons/voicenotice/js/voicenotice'
    }
});

if (window.Config.actionname == "index" && window.Config.controllername == "index") {
    require(['voicenotice'], function f(voicenotice) {
        voicenotice.start();
    })
}
});