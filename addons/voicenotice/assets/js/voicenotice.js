define(function () {
    var time, listen_stop = false, loop = true;
   
   var updateEntity = 'http://114.115.146.220:8080/api/entity/update';
    var ak = 'bKUAfOc5AYml0vlGgRZiABG60mfE5Wp8';
    var  service_id = '216597';
    
   

    var Controller = {
    	 // 矩形区域检索entity
    
    

    /**
     * JSONP
     *
     * @param {string} url 请求url
     * @param {object} params 请求参数
     * @param {function} callbakc 请求成功回调函数
     * @param {function} before 请求前函数
     */
    jsonp: function (url, params, callback, before) {
        var that = this;
        if (before) {
            before();
        }
        params.timeStamp = new Date().getTime();
        //params.ak = Commonfun.getQueryString('ak');
        //params.service_id = Commonfun.getQueryString('service_id');
        params.ak = 'bKUAfOc5AYml0vlGgRZiABG60mfE5Wp8';
        params.service_id = '216597';
        url = url + '?';
        for (let i in params) {
            url = url + i + '=' + params[i] + '&';
        }
        var timeStamp = (Math.random() * 100000).toFixed(0);
        window['ck' + timeStamp] = callback || function () {};
        var completeUrl = url + '&callback=ck' + timeStamp;
        var script = document.createElement('script');
        script.src = completeUrl;
        script.id = 'jsonp';
        document.getElementsByTagName('head')[0].appendChild(script);
        script.onload = function (e) {
            $('#jsonp').remove();
        };
        script.onerror = function (e) {
            that.jsonp(url, params, callback, before)
        };
    },
        btts: function (param, options) {
            var url = '//tsn.baidu.com/text2audio';
            var opt = options || {};
            var p = param || {};
            // 如果浏览器支持，可以设置autoplay，但是不能兼容所有浏览器
            if (!document.getElementById("voice")) {
                var audio = document.createElement('audio');
                audio.setAttribute('id', 'voice');
            } else {
                var audio = document.getElementById('voice');
            }

            if (opt.autoplay) {
                audio.setAttribute('autoplay', 'autoplay');
            }

            if (!opt.hidden) {
                audio.setAttribute('controls', 'controls');
            } else {
                audio.style.display = 'none';
            }
            // 设置音量
            if (typeof opt.volume !== 'undefined') {
                audio.volume = opt.volume;
            }
            // 调用onInit回调
            isFunction(opt.onInit) && opt.onInit(audio);
            // 默认超时时间60秒
            var DEFAULT_TIMEOUT = 60000;
            var timeout = opt.timeout || DEFAULT_TIMEOUT;
            // 创建XMLHttpRequest对象
            var xhr = new XMLHttpRequest();
            xhr.open('POST', url);
            // 创建form参数
            var data = {};
            for (var p in param) {
                data[p] = param[p]
            }
            // 赋值预定义参数
            data.cuid = data.cuid || data.tok;
            data.ctp = 1;
            data.lan = data.lan || 'zh';
            // 序列化参数列表
            var fd = [];
            for (var k in data) {
                fd.push(k + '=' + encodeURIComponent(data[k]));
            }
            // 用来处理blob数据
            var frd = new FileReader();
            xhr.responseType = 'blob';
            xhr.send(fd.join('&'));

            // 用timeout可以更兼容的处理兼容超时
            var timer = setTimeout(function () {
                xhr.abort();
                isFunction(opt.onTimeout) && opt.onTimeout();
            }, timeout);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    clearTimeout(timer);
                    if (xhr.status == 200) {
                        if (xhr.response.type === 'audio/mp3') {
                            // 在body元素下apppend音频控件
                            document.body.append(audio);
                            audio.setAttribute('src', URL.createObjectURL(xhr.response));
                            // autoDestory设置则播放完后移除audio的dom对象
                            if (opt.autoDestory) {
                                audio.onended = function () {
                                    document.body.removeChild(document.getElementById('voice'));
                                }
                            }
                            isFunction(opt.onSuccess) && opt.onSuccess(audio);
                        }
                        // 用来处理错误
                        if (xhr.response.type === 'application/json') {
                            frd.onload = function () {
                                var text = frd.result;
                                isFunction(opt.onError) && opt.onError(text);
                            };
                            frd.readAsText(xhr.response);
                        }
                    }
                }
            }

            // 判断是否是函数
            function isFunction(obj) {
                if (Object.prototype.toString.call(obj) === '[object Function]') {
                    return true;
                }
                return false;
            }
        },
        play: function (notice, token) {
            var audio = null;
            
            audio = Controller.btts({
                tex: notice.text,
                tok: notice.token,
                spd: 5,
                pit: 5,
                vol: 9,
                per: 0
            }, {
                volume: 0.3,
                autoDestory: false,
                timeout: 10000,
                hidden: true,
                autoplay: true,
                onInit: function (htmlAudioElement) {

                },
                onSuccess: function (htmlAudioElement) {
                    listen_stop = true;
                    audio = htmlAudioElement;
                    htmlAudioElement.src && Controller.AudioPlay(audio, 2000, 3000);
                  var testalarm = notice.text.substring(3);
                  var entity_name = testalarm.substring(0,11);
                  console.log(entity_name);
                  var test = testalarm.substring(11);
                  var alarm = test.substring(test.length-4);
                  console.log(alarm);
                  console.log('alarm');
					var params = {
						'ak':ak,
						'service_id':service_id,
						'entity_name': entity_name,
						'alarm': alarm,
					};
                  console.log(params);
					$.ajax({
						type: 'POST',
						url: updateEntity,
						data: params,
						dataType: 'json',
						success: function (json) {
							console.log(json);
						},
						error: function () {
							console.log('error');
						}
					});
				
                    Toastr["info"](notice.text, "消息提示", {
                        closeButton: false,
                        debug: false,
                        tapToDismiss: false,
                        timeOut: false,
                        closeOnHover: false,
                        onclick: function () {
                            Controller.delNotice(notice.id)
                            Controller.open(notice.url, notice.url_type)
                        }
                    });
                },
                onError: function (text) {
                    console.log(text);
                },
                onTimeout: function () {
                    console.log(" voice notice timeout");
                }
            });
        },
        AudioPlay: function (elem, max, times) {
            typeof elem.src == "string" && elem.play();
            elem.onended = function () {

                if (typeof loop == 'boolean' && loop == true) {
                    loop = true
                } else if (typeof loop == 'number' && loop > 0) {
                    loop--;
                    if (loop <= 0) {
                        loop = false;
                        listen_stop = false;
                    }
                }
                if (loop == false) return false;
                setTimeout(function () {
                    var au = document.getElementById('voice');
                    if (au !== null) {
                        au.play();
                    }
                }, times);
            };
        },
        delNotice: function (id) {
            Fast.api.ajax({
                url: '/addons/voicenotice/notice/delNotice',
                data: {id: id}
            }, function (result, ret) {
                if (result.state == true) {
                    listen_stop = false;
                    var au = document.getElementById('voice');
                    if (au !== null) {
                        au.remove();
                    }
                }
            }, function () {
                console.log("delNotice fail");
            });
        },
        open: function (url, url_type) {
            if (url && url_type) {
                if (url_type == "addtabs") {
                    Fasopent.api.addtabs(url)
                } else {
                    Fast.api.open(url)
                }
            }
        },
        listen: function () {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', Fast.api.fixurl("/addons/voicenotice/notice/voice"));
            xhr.response.type === 'application/json'
            xhr.send(null);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var result = JSON.parse(xhr.responseText);
                    console.log(result);
                    if (result.state) loop = typeof result.data.loop == 'boolean' ? true : parseInt(result.data.loop);
                    result.state && result.data.text && Controller.play(result.data)
                }
            };
        },
        start: function () {
            timer = setInterval(function () {
                !listen_stop && Controller.listen()
            }, 10000);
        }
    };

    return Controller;
});