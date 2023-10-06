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
const dataJSON = [
    { id: 1, name: "Person 1aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa" , username:"sulthan"},
    { id: 2, name: "Person 2" },
    { id: 3, name: "Person 3" },{ id: 3, name: "Person 3" },{ id: 3, name: "Person 3" },{ id: 3, name: "Person 3" },{ id: 3, name: "Person 3" },{ id: 3, name: "Person 3" },{ id: 3, name: "Person 3" },{ id: 3, name: "Person 3" },
];

const dataJSONunban = [
    { id: 2, name: "Person 2aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa" , username:"sulthaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaan"},
    { id: 3, name: "Person 3" },
    { id: 3, name: "Person 3" },
    { id: 3, name: "Person 3" },
    { id: 3, name: "Person 3" },
    { id: 3, name: "Person 3" },
];

// Fungsi untuk membuat daftar orang dari data JSON
function createPersonList(data) {
    const personList = document.getElementById("person-list");
    data.forEach((person) => {
        const personDiv = document.createElement("div");
        personDiv.classList.add("person");

        const nameSpan = document.createElement("span");
        nameSpan.textContent = person.name;
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
        nameSpan.textContent = person.name;
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
// Fungsi untuk mencetak ID person
function banId(personId) {
    alert(`ID Person: ${personId} di ban`);
}
function unbanId(personId) {
    alert(`ID Person: ${personId} di unban`);
}

// Memanggil fungsi untuk membuat daftar orang dari data JSON
createPersonList(dataJSON);
createPersonListunban(dataJSONunban);

