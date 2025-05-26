// let mahasiswa ={
//     nama : "Siti Aisyah Denia Putri",
//     nim : "2217020045",
//     email : "deniaaisyah1203@gmail.com",

// }
// console.log (mahasiswa);

let xhr = new XMLHttpRequest();
xhr.onreadystatechange == function () {
    if (xhr.readyState == 4 && xhr.status == 200){
        let mahasiswa = this.ResponseText;
        console.log(mahasiswa);
    }
}

xhr.open('GET', 'coba.json', true);
xhr.send();