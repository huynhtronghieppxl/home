function login() {
    axios({
        method: 'post',
        url: '/api/auth/login',
        data: {
            username: $('#username-login').val(),
            password: $('#password-login').val(),
        }
    }).then(function (res) {
        console.log(res)
        document.cookie = `oauth_token="${res.data.token}}`;
        window.location.href = '/';
    })
}
