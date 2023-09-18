// var firebaseConfig = {
//     apiKey: "AIzaSyD9ZrGO9CbatsjZwzOYhLJu38wEhnrisBs",
//     authDomain: "techres-tms.firebaseapp.com",
//     databaseURL: "https://techres-tms.firebaseio.com",
//     projectId: "techres-tms",
//     storageBucket: "techres-tms.appspot.com",
//     messagingSenderId: "507549433713",
//     appId: "1:507549433713:web:8eca878e1c859d26",
//     measurementId: "G-93KVHGFENG"
// };
// firebase.initializeApp(firebaseConfig);
// const messaging = firebase.messaging();
//     messaging.requestPermission()
//         .then(async function () {
//             return messaging.getToken()
//         })
//         .then(async function(token) {
//             console.log('====================================');
//             console.log("Token Notification: ", token);
//             console.log('====================================');
//             let  method = 'post',
//             url = '/Push-token',
//             params = {
//                 Token : token
//             },
//             data = {
//                 Token : token
//             }
//             let res = axiosTemplate(method, url, params, data)
//             console.log(res);
//
//         }).catch(function (err) {
//             console.log('User Chat Token Error'+ err);
//         });
//         messaging.onMessage(function(payload) {
//             console.log('data' , payload);
//             $('#list-notify').prepend('<li class="visit-notify" onclick="openModalDetailNotification()"><div class="media"> <img class="d-flex align-self-center img-radius" src="http://demo.ads.api.techres.vn:3005/public/resource/TMS/AVATAR/1/29/1/2021/3/8-3-2021/image/thumb/Avatar-nguyenthanhdoai-1615190894217.jpeg" alt="Generic placeholder image"> <div class="media-body"> <h5 class="notify-user">Được rôid    </h5> <p class="notify-msg">sadsdấdá</p> <span class="notify-time"></span></div> <label class="label label-danger">Mới</label>  </div> </li>',)
//             const noteTitle = 'tets';
//             const noteOptions = {
//                 body: 'hahahah',
//                 icon:'ahahahh',
//             };
//             new Notification(noteTitle, noteOptions);
//             $('#icon-notify').addClass('icon-notify-animation');
//         });
// $('#icon-notify').click(function(){
//     $('#icon-notify').removeClass('icon-notify-animation');
// });
