let currUrl = window.location.href;
currUrl = currUrl.split('/');
postid = currUrl[currUrl.length-1];
ownerid = currUrl[currUrl.length-2];
console.log(postid);
console.log(ownerid);
const ambil = document.getElementById('test');
ambil.textContent = postid;
