<script>

    var load = (function () {
        // Function which returns a function: https://davidwalsh.name/javascript-functions
        function _load(tag) {
            return function (url, attrs = []) {
                // This promise will be used by Promise.all to determine success or failure
                return new Promise(function (resolve, reject) {
                    var element = document.createElement(tag);
                    var parent = 'head';
                    var attr = 'src';

                    // Important success and error for the promise
                    element.onload = function () {
                        resolve(url);
                    };
                    element.onerror = function () {
                        reject(url);
                    };

                    // Need to set different attributes depending on tag type
                    switch (tag) {
                        case 'script':
                            if (!attrs.length) element.defer = true;
                            else {
                                attrs.forEach(function (attr) {
                                    element[attr] = true;
                                });
                            }
                            break;
                        case 'link':
                            element.type = 'text/css';
                            element.rel = 'stylesheet';
                            attr = 'href';
                            parent = 'head';
                    }

                    // Inject into document to kick off loading
                    element[attr] = url;
                    document[parent].appendChild(element);
                });
            };
        }

        return {
            css: _load('link'),
            js: _load('script'),
            img: _load('img')
        }
    })();

</script>
