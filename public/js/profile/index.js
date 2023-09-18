$(function () {
    console.log('ok')
    data()
})

function data() {
    axios({
        method: 'get',
        url: '/api/auth/user-profile',
    }).then(function (res) {
        console.log(res)
        window.location.href = '/';
    })
}

function logout() {
    axios({
        method: 'post',
        url: '/api/auth/logout',
    }).then(function (res) {
        console.log(res)
        window.location.href = '/login';
    })
}
