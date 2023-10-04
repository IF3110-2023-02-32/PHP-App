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
    var usernameambil = document.getElementById('username').value;
    var passwordambil = document.getElementById('password').value;
    if(usernameambil==="" || passwordambil===""){
        alert("Username atau password tidak boleh kosong");
    }
    else{
        const url = '/checkloginreg.php/login';
        var xhr = new XMLHttpRequest();
        var data = JSON.stringify({ username: usernameambil, password: passwordambil });

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var responseData = JSON.parse(xhr.responseText);
                if(responseData.role==="admin"){
                    window.location.href = "admin.html";
                }
                else if(responseData.role==="user"){
                    window.location.href = "user.html";
                }
                else if(responseData.status==="error"){
                    alert("Username atau password salah");
                }
            }
        };
        xhr.send(data);
    }
    
});
document.getElementById('tmblreg').addEventListener('click', function() {
    var userreg = document.getElementById('userreg').value;
    var passreg = document.getElementById('passreg').value;
    var namareg = document.getElementById('namareg').value;
    var regex = /^\S+$/;

    if(regex.test(userreg)===false || regex.test(passreg)===false){
        alert("Username atau password tidak boleh mengandung spasi");
    }
    else if(userreg==="" || passreg==="" || namareg===""){
        alert("Username, password, atau nama tidak boleh kosong");
    }
    else if(userreg.length<5 || passreg.length<5){
        alert("Username atau password minimal 5 karakter");
    }
    else{
        const url = '/checkloginreg.php/register';
        var xhr = new XMLHttpRequest();
        var data = JSON.stringify({ username: userreg, password: passreg, nama: namareg });

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var responseData = JSON.parse(xhr.responseText);
                if(responseData.status==="error"){
                    alert(responseData.message);
                }
                else if(responseData.status==="sukses"){
                    alert("Data berhasil ditambahkan");
                    window.location.href = "login.html";
                }
            }
        };
        xhr.send(data);
    }   
});

