window.getjson = function (url) {
    var result = null;
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        async: false,

        success: function (data) {
            result = data;
        }
    });
    return result;
}

window.getSdiIri = function (sampai_km, dari_km, nilai_sdi, nilai_iri) {
    var panjang_km = (sampai_km - dari_km);
    var baik = 0,
        sedang = 0,
        rusakringan = 0,
        rusakberat = 0;
    var mantap = 0,
        tdkmantap = 0;
    nilai_sdi = parseInt(nilai_sdi);
    var datasdiiri = getjson('/api/formskj/sdiiri/?sampai_km=' + sampai_km + '&dari_km=' + dari_km + '&nilai_iri=' + nilai_iri + '&nilai_sdi=' + nilai_sdi);
    baik = datasdiiri.baik;
    sedang = datasdiiri.sedang;
    rusakringan = datasdiiri.rusakringan;
    rusakberat = datasdiiri.rusakberat;

    mantap = baik + sedang;
    tdkmantap = rusakringan + rusakberat;
    console.log(baik, sedang, rusakringan, rusakberat);
    $('input.k_baik').val(datasdiiri.baik);
    $('input.k_sedang').val(datasdiiri.sedang);
    $('input.k_rusakringan').val(datasdiiri.rusakringan);
    $('input.k_rusakberat').val(datasdiiri.rusakberat);


}

window.getSdi = function (retak_luas = 0, retak_lebar = 0, jumlah_lubang = 0, bekasroda = 0) {
    console.log(retak_luas,retak_lebar,jumlah_lubang,bekasroda);
    var bantu = 0;
    var sdi_retaklebar = 0,
        sdi_retakluas = 0;
    if (retak_luas == 1) {
        sdi_retakluas = 0;
    } else if (retak_luas == 2) {
        sdi_retakluas = 5;
    } else if (retak_luas == 3) {
        sdi_retakluas = 20;
    } else if (retak_luas == 4) {
        sdi_retakluas = 40;
    } else {
        sdi_retakluas = 0;
    }
    sdi_retaklebar = (retak_lebar == 4) ? sdi_retakluas * 2 : 0;
    bantu = (sdi_retaklebar == 0) ? sdi_retakluas : sdi_retaklebar;

    if (jumlah_lubang == 1) {
        sdi_jumlahlubang = bantu;
    } else if (jumlah_lubang == 2) {
        sdi_jumlahlubang = bantu + 15;
    } else if (jumlah_lubang == 3) {
        sdi_jumlahlubang = bantu + 75;
    } else if (jumlah_lubang == 4) {
        sdi_jumlahlubang = bantu + 255;
    } else {
        sdi_jumlahlubang = 0;
    }
    if (bekasroda == 1) {
        sdi_bekasroda = sdi_jumlahlubang;
    } else if (bekasroda == 2) {
        sdi_bekasroda = sdi_jumlahlubang + (5 * 0.5);
    } else if (bekasroda == 3) {
        sdi_bekasroda = sdi_jumlahlubang + (5 * 2);
    } else if (bekasroda == 4) {
        sdi_bekasroda = sdi_jumlahlubang + (5 * 4);
    } else {
        sdi_bekasroda = 0;
    }
    nilai_sdi = (sdi_bekasroda > 0) ? sdi_bekasroda : 0;
    
    $('p.p_retaklebar').text(sdi_retaklebar);
    $('p.p_jumlahlubang').text(sdi_jumlahlubang);
    $('p.p_bekas_roda').text(sdi_bekasroda);
    $('input#nilai_sdi').val(nilai_sdi);
    $('p.p_nilaisdi').text(nilai_sdi);


}