<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/admin.css">
</head>
<body>
    <div class="kotak">
        <div class="wrap">
            <div class="judul">
                <h1>Admin Page</h1>
                <h1>Daftar User</h1>
            </div>
        </div> 
        <div class="tombol">
            <div id="tmbl"></div>
            <button type="button" class="tombolpindah" onclick="pindahunban()">
                Ban
            </button>
            <button type="button" class="tombolpindah" onclick="pindahban()">
                Unban
            </button>
        </div>
        <div class="isikotak">
            <div id="ban" class="input">
                <div class="nam">
                    Daftar User yang Unbanned
                </div>
                <div id="person-list">
                </div>
            </div>
            <div id="unban" class="input">
                <div class="nam">
                    Daftar User yang Telah di Banned
                </div>
                <div id="person-list-unban">
                </div>
            </div>
        </div>
    </div>
    <script src="public/js/admin.js"></script>
</body>
</html>