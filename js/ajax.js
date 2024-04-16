// //--------- Phân trang -----------
var soSanPham1Trang = 16;
var listSanPham = [];



function formatPrice(dongia) {
    var dongia = dongia.toString();
    var ketqua = '';
    for (var i = dongia.length - 1; i >= 0; i--) {
        ketqua = dongia[i] + ketqua;
        if ((dongia.length - i) % 3 === 0 && i != 0) {
            ketqua = '.' + ketqua;
        }
    }
    return ketqua + '₫';
}

function hienThiSanPham1Trang(viTriTrang) {
    $("#list-product div.product-item").remove();
    var soTrang = Math.ceil(listSanPham.length / soSanPham1Trang);
    var start = (viTriTrang - 1) * soSanPham1Trang;
    var temp = copyObject(listSanPham);
    temp = temp.slice(start, (start + soSanPham1Trang));
    for (var p of temp) {
        taoDivSanPham(p);
    }
    themThanhPhanTrang(soTrang);
}

function themThanhPhanTrang(soTrang) {
    var divPhanTrang = document.getElementsByClassName('pagination-bar')[0];
    divPhanTrang.innerHTML = '';
    if (soTrang > 1) {
        for (var i = 1; i <= soTrang; i++) {
            divPhanTrang.innerHTML += `<button class="page-item" onclick ="hienThiSanPham1Trang(` + i + `)">`+ i + `</button>`;
        }
    }
}

function taoDivSanPham(p) {
    var listProduct = document.getElementById('list-product')[0];
    listProduct.innerHTML = "";
    var newDiv = `
    <div class="product-item"> 
        <img src="images/product/` + p.img + `_11zon.png">
        <div class="product-item-info">
            <div class="product-item-name">` + p.tenSP + ` </div>
            <div class="product-item-price">` + formatPrice(p.dongia) + `</div>
            <div class="product-detail-button">
                <button> Xem chi tiết </button>
            </div>
        </div>  
    </div>    
    `
    listProduct.innerHTML += newDiv;
}




