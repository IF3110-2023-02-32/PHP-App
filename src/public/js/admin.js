ban = document.getElementById("ban");
unban = document.getElementById("unban");
tombol = document.getElementById("tmbl");

function pindahunban(){
    ban.style.left = "50px";
    unban.style.left = "750px";
    tombol.style.left = "0px";
}

function pindahban(){
    ban.style.left = "-700px";
    unban.style.left = "50px";
    tombol.style.left = "110px";
}


// Fungsi untuk membuat daftar orang dari data JSON
function createPersonList(data) {
    const personList = document.getElementById("person-list");
    data.forEach((person) => {
        const personDiv = document.createElement("div");
        personDiv.classList.add("person");

        const nameSpan = document.createElement("span");
        nameSpan.textContent = person.profile_name;
        nameSpan.classList.add("name");

        const username = document.createElement("span");
        username.textContent = "Username : " + person.username;
        username.classList.add("username");

        const printButton = document.createElement("button");
        printButton.textContent = "Ban";
        printButton.addEventListener("click", () => {
            banId(person.id);
        });

        personDiv.appendChild(nameSpan);
        personDiv.appendChild(username);
        personDiv.appendChild(printButton);
        personList.appendChild(personDiv);
    });
}

function createPersonListunban(data) {
    const personList = document.getElementById("person-list-unban");
    data.forEach((person) => {
        const personDiv = document.createElement("div");
        personDiv.classList.add("person");

        const nameSpan = document.createElement("span");
        nameSpan.textContent = person.profile_name;
        nameSpan.classList.add("name");

        const username = document.createElement("span");
        username.textContent = "Username : " + person.username;
        username.classList.add("username");

        const printButton = document.createElement("button");
        printButton.textContent = "Unban";
        printButton.addEventListener("click", () => {
            unbanId(person.id);
        });

        personDiv.appendChild(nameSpan);
        personDiv.appendChild(username);
        personDiv.appendChild(printButton);
        personList.appendChild(personDiv);
    });
}
function banId(personId) {
    const xhr = new XMLHttpRequest();
        const url = 'http://localhost:8008/api/ban';
        
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                alert(response.message);
                window.location.reload();
            } else {
                console.error('Gagal melakukan permintaan');
            }
          }
        };
        
        const formData = `id=${encodeURIComponent(personId)}`;
        xhr.send(formData);
}
function unbanId(personId) {
    const xhr = new XMLHttpRequest();
        const url = 'http://localhost:8008/api/unban';
        
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                alert(response.message);
                window.location.reload();
            } else {
                console.error('Gagal melakukan permintaan');
            }
          }
        };
        
        const formData = `id=${encodeURIComponent(personId)}`;
        xhr.send(formData);
    
}

const xhr = new XMLHttpRequest();
const url = 'http://localhost:8008/api/admin';

xhr.open('GET', url, true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
    if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        if(response.status==="error"){
            alert(response.message);
        }
        else if(response.status==="sukses"){
            console.log(response);
            createPersonListunban(response.ban);
            createPersonList(response.unban);
        }
    } else {
        console.error('Gagal melakukan permintaan');
    }
    }
};
xhr.send();

