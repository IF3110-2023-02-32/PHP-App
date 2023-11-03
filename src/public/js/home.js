
function createPost(data,totalsemuapage,pagenow){
    const post = document.getElementById('list-post');
    data.forEach(element => {
        const username =  document.createElement('p');
        username.textContent = "@"+element.username;
        const nama =  document.createElement('p');
        nama.textContent = element.profile_name;

        const simpanidentitas = document.createElement('div');
        simpanidentitas.classList.add('kolom');
        simpanidentitas.appendChild(nama);
        simpanidentitas.appendChild(username);

        const fotoprofile = document.createElement('img');
        fotoprofile.classList.add('fotoprofil');
        if(element.profile_picture_path==null){
            fotoprofile.src = '/public/assets/kajuha.jpg';
        }
        else{
            path = element.profile_picture_path;
            path = path.replace("/var/www/html", '');
            fotoprofile.src = path;
        }

        const identitas = document.createElement('div');
        identitas.classList.add('iden');
        identitas.appendChild(fotoprofile);
        identitas.appendChild(simpanidentitas);

        const box = document.createElement('div');
        box.classList.add('box');
        box.appendChild(identitas);

        const isitext = document.createElement('p');
        isitext.textContent = element.body;
        box.appendChild(isitext);
        var pathToRemove = "/var/www/html";
        var path = element.path;
        if(path!=null){
            let gettype = element.path
            let type = gettype.split('.').pop();
            path = path.replace(pathToRemove, '');
            console.log(path);
            if(type=='jpg' || type=='jpeg' || type=='png'){
                const isifoto = document.createElement('img');
                isifoto.src = path;
                isifoto.classList.add('foto');
                box.appendChild(isifoto);
            }
            else if(type=='mp4'){
                const isivideo = document.createElement('video');
                isivideo.src = path;
                isivideo.classList.add('video');
                isivideo.controls = true;
                box.appendChild(isivideo);
            }
            else if(type=='mp3'){
                const isiaudio = document.createElement('audio');
                isiaudio.src = path;
                isiaudio.classList.add('audio');
                isiaudio.controls = true;
                box.appendChild(isiaudio);
            }
        }
        post.appendChild(box);
    });
    const list = document.createElement('ul');
    const pagination = document.createElement('div');
    pagination.classList.add('pagination');
    pagination.appendChild(list);
    post.appendChild(pagination);
    makePagination(totalsemuapage,pagenow);
}
const xhr = new XMLHttpRequest();
const url = '/api/getpost/0';

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
            var totalpost = response.data.count;
            var totalPage = Math.ceil(totalpost/10);
            createPost(response.data.data,totalPage,1);
        }
    } else {
        console.error('Gagal melakukan permintaan');
    }
    }
};
xhr.send();
function makePagination(totalPages,page){
    console.log(page);
    const ulTag = document.querySelector('ul');
    let liTag = '';
    if(totalPages===0){
        liTag+=`<p class="kosong">Belum ada post</p>`
    }
    else{
        let activeLi;
        let beforePage = page - 1;
        let afterPage = page + 1;
        if(page>1){
            liTag += `<li class="btn prev" onclick="klikPagination(${totalPages},${page-1})"><span><i class="fas fa-angle-left"></i>< Prev</span></li>`;
        }
        if(page>2){
            liTag+=`<li class="numb" onclick="klikPagination(${totalPages},1)"><span>1</span></li>`
            if(page>3){
                liTag+=`<li class="dots"><span>...</span></li>`
            }
        }
        for (let i=beforePage;i<=afterPage;i++){
            if(i>totalPages){
                continue;
            }
            if(i==0){
                i=1
            }

            if(page==i){
                activeLi = "active";
            }
            else{
                activeLi = "";
            }
            liTag+=`<li class="numb ${activeLi}" onclick="klikPagination(${totalPages},${i})"><span>${i}</span></li>`
        }
        if(page<totalPages-1){
            if(page<totalPages-2){
                liTag+=`<li class="dots"><span>...</span></li>`
            }
            liTag+=`<li class="numb" onclick="klikPagination(${totalPages},${totalPages})"><span>${totalPages}</span></li>`
        }
        if(page < totalPages){
            liTag += `<li class="btn next" onclick="klikPagination(${totalPages},${page+1})"><span>Next ><i class="fas fa-angle-right"></i></span></li>`;
        }
    }
    ulTag.innerHTML = liTag;
}

function klikPagination(totalPages,page){
    makePagination(totalPages,page);
    changePage(page);
}

function changePage(page){
    const xhr = new XMLHttpRequest();
    var getpage = (page-1);
    const url = '/api/getpost/'+getpage.toString();

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
                const box = document.querySelectorAll('.box');
                box.forEach(function(e){
                    e.remove();
                });
                const pagination = document.querySelectorAll('.pagination');
                pagination.forEach(function(e){
                    e.remove();
                });
                var totalpost = response.data.count;
                var totalPage = Math.ceil(totalpost/10);
                createPost(response.data.data,totalPage,page);
            }
        } else {
            console.error('Gagal melakukan permintaan');
        }
        }
    };
    xhr.send();
}
