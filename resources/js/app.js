import './bootstrap';

let userId = 1;

Echo.private('App.Models.User.' + userId)
    .notification((notification) => {
        toastr.success(notification.msg)
});
