$(document).ready(function() {
    // Handle delete user
    var userDel;
    $('.usr-delete-btn').click((e) => {
        userDel = e.target.href;
        e.preventDefault();
    });
    $('.usr-confirm-btn').click((e) => {
        window.location.replace(userDel);
    })

    var cateDel;
    $('.cate-delete-btn').click((e) => {
        cateDel = e.target.href;
        e.preventDefault();
    });
    $('.cate-confirm-btn').click((e) => {
        window.location.replace(cateDel);
    })

    var resDel;
    $('.res-delete-btn').click((e) => {
        resDel = e.target.href;
        e.preventDefault();
    });
    $('.res-confirm-btn').click((e) => {
        window.location.replace(resDel);
    })

    // Handle delete comment (feedback)
    var cmtDel;
    $('.cmt-delete-btn').click((e) => {
        cmtDel = e.target.href;
        e.preventDefault();
    });
    $('.cmt-confirm-btn').click((e) => {
        window.location.replace(cmtDel);
    })

    // Handle delete comment (feedback)
    var bookingDel;
    $('.booking-delete-btn').click((e) => {
        bookingDel = e.target.href;
        e.preventDefault();
    });
    $('.booking-confirm-btn').click((e) => {
        window.location.replace(bookingDel);
    })
});