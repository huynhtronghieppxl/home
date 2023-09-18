function uploadMediaTemplate(file) {
    let data = new FormData();
    data.append("file", file);
    let method = 'post',
        url = 'upload-media-template',
        params = null;
    return axiosFileTemplate(method, url, params, data);
}

async function axiosFileTemplate(method, url, params, data) {
    try {
        let res = await axios({
            method: method, url: url, params: params, data: data, headers: {
                'content-type': 'multipart/form-data'
            }
        });
        console.log(res);
        return res;
    } catch (e) {
        console.log(e + ' AxiosTemplate' + '\n' + 'url: ' + url);
        return e;
    }
}
