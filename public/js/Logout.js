$("#logout_bttn").click(function(){
    localStorage.removeItem('accessToken'); // Xóa token trong localStorage
    window.location.replace("./Logout");
})

window.addEventListener('beforeunload', function() {
    localStorage.removeItem('accessToken'); // Xóa token khi đóng trình duyệt
});