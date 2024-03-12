export default class Component {
    debounce(fn, wait)
    {
        var timeout
        return function () {
            clearTimeout(timeout)
            var args = arguments
            timeout = setTimeout(function () {
                fn.apply(this, args)
            }, (wait || 1))
        }
    }

    throttle(callback, limit)
    {
        var wait = false;
        return function () {
            if (!wait) {
                callback.call();
                wait = true;
                setTimeout(function () {
                    wait = false;
                }, limit);
            }
        }
    }
}
