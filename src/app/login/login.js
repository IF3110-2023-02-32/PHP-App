const tepi = document.querySelector('.tepi');
const login = document.querySelector('.login-link');
const register = document.querySelector('.register-link');

register.addEventListener('click', () => {
  tepi.classList.add('ganti');
}
);

login.addEventListener('click', () => {
    tepi.classList.remove('ganti');
    }
);

document.getElementById('tmblbuatlogin').addEventListener('click', function() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    if(username==="admin" && password==="admin"){
        console.log("admin sini");
        window.location.href = "admin.html";
    }
});
document.getElementById('tmblreg').addEventListener('click', function() {
    var contohuser = "a"
    var userreg = document.getElementById('userreg').value;
    var passreg = document.getElementById('passreg').value;
    var namareg = document.getElementById('namareg').value;
    if(userreg==="" || passreg==="" || namareg===""){
        alert("Data harus diisi semua");
    }
    else if(userreg===contohuser){
        alert("Username sudah ada");
    }
        

    else{
        alert("Registrasi berhasil");
        window.location.href = "login.html";
    }
});

