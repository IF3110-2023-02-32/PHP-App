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
        const apiUrl = 'http://localhost:8080/checkloginreg.php/login';
        const requestData = {
        username: usernameambil,
        password: passwordambil
        };
        const requestOptions = {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
        };
        fetch(apiUrl, requestOptions)
        .then(response => {
            if (!response.ok) {
            throw new Error('Terjadi kesalahan dalam mengambil data');
            }
            return response.json();
        })
        .then(data => {
            responseData = data;
            console.log('Data dari API:', responseData.role);
            if(responseData.role==="admin"){
                window.location.href = "admin.html";
            }
            else if(responseData.role==="user"){
                window.location.href = "user.html";
            }
            else if(responseData.status==="error"){
                alert("Username atau password salah");
            }
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
        });
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
        const apiUrl = 'http://localhost:8080/checkloginreg.php/register';
        const requestData = {
        username: userreg,
        password: passreg,
        nama: namareg
        };
        const requestOptions = {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
        };
        fetch(apiUrl, requestOptions)
        .then(response => {
            if (!response.ok) {
            throw new Error('Terjadi kesalahan dalam mengambil data');
            }
            return response.json();
        })
        .then(data => {
            responseData = data;
            console.log('Data dari API:', responseData.role);
            if(responseData.status==="error"){
                alert(responseData.message);
            }
            else if(responseData.status==="sukses"){
                alert("Data berhasil ditambahkan");
                window.location.href = "login.html";
            }
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
        });
    }   
});

