export function camelize(str) {
    return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
        return index === 0 ? word.toLowerCase() : word.toUpperCase();
    }).replace(/\s+/g, '');
}

export function readUrlHash() {
    let result = {};
    let hashParam = window.location.hash.substring(1);
    let params = hashParam.split("&");

    for(let index in params){
        let paramSet = params[index].split("=");
        if (typeof (paramSet[1]) !== "undefined") {
            result[paramSet[0]] = decodeURIComponent(paramSet[1]);
        } else {
            result[paramSet[0]] = "";
        }
    }

    return result;
}
